<?php

defined('BASEPATH') or exit('No direct script access allowed');

class My_team_workflow_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Tìm workflow phù hợp cho approval request
     * @param string $approval_type
     * @param int $department_id
     * @param float $amount
     * @return object|null
     */
    public function find_suitable_workflow($approval_type, $department_id = null, $amount = 0)
    {
        $this->db->select('*');
        $this->db->from(db_prefix() . 'my_team_approval_workflows');
        $this->db->where('approval_type', $approval_type);
        $this->db->where('is_active', 1);
        
        // Ưu tiên workflow cho department cụ thể
        if ($department_id) {
            $this->db->where('(department_id = ' . intval($department_id) . ' OR department_id IS NULL)');
        } else {
            $this->db->where('department_id IS NULL');
        }
        
        // Filter theo ngưỡng amount
        if ($amount > 0) {
            $this->db->where('(amount_threshold <= ' . floatval($amount) . ' OR amount_threshold = 0)');
        }
        
        $this->db->order_by('department_id', 'DESC'); // Ưu tiên department cụ thể
        $this->db->order_by('priority', 'ASC');
        $this->db->order_by('amount_threshold', 'DESC'); // Ngưỡng cao hơn có priority
        $this->db->limit(1);
        
        return $this->db->get()->row();
    }

    /**
     * Khởi tạo workflow instance cho approval
     * @param int $approval_id
     * @param string $approval_type
     * @param int $department_id
     * @param float $amount
     * @return int|false
     */
    public function start_workflow($approval_id, $approval_type, $department_id = null, $amount = 0)
    {
        // Tìm workflow phù hợp
        $workflow = $this->find_suitable_workflow($approval_type, $department_id, $amount);
        
        if (!$workflow) {
            log_message('error', 'No suitable workflow found for approval_id: ' . $approval_id);
            return false;
        }

        // Tạo workflow instance
        $instance_data = [
            'approval_id' => $approval_id,
            'workflow_id' => $workflow->id,
            'current_step' => 1,
            'overall_status' => 'pending',
            'started_date' => date('Y-m-d H:i:s')
        ];

        $this->db->insert(db_prefix() . 'my_team_approval_instances', $instance_data);
        $instance_id = $this->db->insert_id();

        if ($instance_id) {
            // Tạo step logs cho workflow này
            $this->create_step_logs($instance_id, $workflow->id, $approval_id);
            
            // Assign step đầu tiên
            $this->assign_current_step($instance_id);
            
            return $instance_id;
        }

        return false;
    }

    /**
     * Tạo step logs cho workflow instance
     * @param int $instance_id
     * @param int $workflow_id
     * @param int $approval_id
     * @return bool
     */
    private function create_step_logs($instance_id, $workflow_id, $approval_id)
    {
        // Lấy tất cả steps của workflow
        $this->db->select('*');
        $this->db->from(db_prefix() . 'my_team_approval_workflow_steps');
        $this->db->where('workflow_id', $workflow_id);
        $this->db->order_by('step_order', 'ASC');
        $steps = $this->db->get()->result();

        foreach ($steps as $step) {
            $step_log_data = [
                'instance_id' => $instance_id,
                'step_id' => $step->id,
                'step_order' => $step->step_order,
                'status' => 'pending',
                'created_date' => date('Y-m-d H:i:s')
            ];

            // Set timeout date nếu có
            if ($step->timeout_hours) {
                $step_log_data['timeout_date'] = date('Y-m-d H:i:s', strtotime('+' . $step->timeout_hours . ' hours'));
            }

            $this->db->insert(db_prefix() . 'my_team_approval_step_logs', $step_log_data);
        }

        return true;
    }

    /**
     * Assign người approve cho step hiện tại
     * @param int $instance_id
     * @return bool
     */
    public function assign_current_step($instance_id)
    {
        // Lấy thông tin instance
        $instance = $this->get_workflow_instance($instance_id);
        if (!$instance) {
            return false;
        }

        // Lấy step hiện tại
        $current_step_log = $this->get_current_step_log($instance_id);
        if (!$current_step_log) {
            return false;
        }

        // Lấy thông tin step
        $step = $this->get_workflow_step($current_step_log->step_id);
        if (!$step) {
            return false;
        }

        // Lấy thông tin approval để biết department
        $approval = $this->get_approval_info($instance->approval_id);
        if (!$approval) {
            return false;
        }

        // Xác định người approve
        $assigned_to = $this->determine_approver($step, $approval);

        if ($assigned_to) {
            // Update step log với assigned_to
            $this->db->where('id', $current_step_log->id);
            $this->db->update(db_prefix() . 'my_team_approval_step_logs', [
                'assigned_to' => $assigned_to
            ]);

            // Tạo notification
            $this->create_assignment_notification($instance_id, $current_step_log->id, $assigned_to);

            return true;
        }

        return false;
    }

    /**
     * Xác định người approve cho step
     * @param object $step
     * @param object $approval
     * @return int|null
     */
    private function determine_approver($step, $approval)
    {
        switch ($step->approver_type) {
            case 'specific_user':
                return $step->approver_user_id;

            case 'department_manager':
                // Tìm manager của department
                return $this->get_department_manager($approval->department_id);

            case 'role':
                // Tìm user có role cụ thể
                return $this->get_user_by_role($step->approver_role_id);

            case 'any_in_department':
                // Lấy bất kỳ user nào trong department (có thể random hoặc theo rule)
                return $this->get_any_user_in_department($step->approver_department_id ?: $approval->department_id);
        }

        return null;
    }

    /**
     * Approve step hiện tại
     * @param int $instance_id
     * @param int $staff_id
     * @param string $comments
     * @return bool
     */
    public function approve_step($instance_id, $staff_id, $comments = '')
    {
        $current_step_log = $this->get_current_step_log($instance_id);
        if (!$current_step_log || $current_step_log->assigned_to != $staff_id) {
            return false;
        }

        // Update step log
        $this->db->where('id', $current_step_log->id);
        $this->db->update(db_prefix() . 'my_team_approval_step_logs', [
            'status' => 'approved',
            'action_date' => date('Y-m-d H:i:s'),
            'comments' => $comments
        ]);

        // Kiểm tra xem có step tiếp theo không
        $next_step_order = $current_step_log->step_order + 1;
        $next_step_log = $this->get_step_log_by_order($instance_id, $next_step_order);

        if ($next_step_log) {
            // Chuyển sang step tiếp theo
            $this->db->where('id', $instance_id);
            $this->db->update(db_prefix() . 'my_team_approval_instances', [
                'current_step' => $next_step_order
            ]);

            // Assign step tiếp theo
            $this->assign_current_step($instance_id);
        } else {
            // Workflow hoàn thành - approve toàn bộ
            $this->complete_workflow($instance_id, 'approved');
        }

        return true;
    }

    /**
     * Reject step hiện tại
     * @param int $instance_id
     * @param int $staff_id
     * @param string $reason
     * @return bool
     */
    public function reject_step($instance_id, $staff_id, $reason = '')
    {
        $current_step_log = $this->get_current_step_log($instance_id);
        if (!$current_step_log || $current_step_log->assigned_to != $staff_id) {
            return false;
        }

        // Update step log
        $this->db->where('id', $current_step_log->id);
        $this->db->update(db_prefix() . 'my_team_approval_step_logs', [
            'status' => 'rejected',
            'action_date' => date('Y-m-d H:i:s'),
            'comments' => $reason
        ]);

        // Reject toàn bộ workflow
        $this->complete_workflow($instance_id, 'rejected');

        return true;
    }

    /**
     * Hoàn thành workflow
     * @param int $instance_id
     * @param string $status
     * @return bool
     */
    private function complete_workflow($instance_id, $status)
    {
        // Update workflow instance
        $this->db->where('id', $instance_id);
        $this->db->update(db_prefix() . 'my_team_approval_instances', [
            'overall_status' => $status,
            'completed_date' => date('Y-m-d H:i:s')
        ]);

        // Update approval status
        $instance = $this->get_workflow_instance($instance_id);
        if ($instance) {
            $approval_status = ($status == 'approved') ? 1 : 2; // 1=approved, 2=rejected
            
            $this->db->where('id', $instance->approval_id);
            $this->db->update(db_prefix() . 'my_team_approvals', [
                'status' => $approval_status,
                'approved_date' => $status == 'approved' ? date('Y-m-d H:i:s') : null,
                'rejected_date' => $status == 'rejected' ? date('Y-m-d H:i:s') : null
            ]);
        }

        return true;
    }

    /**
     * Lấy thông tin workflow instance
     * @param int $instance_id
     * @return object|null
     */
    public function get_workflow_instance($instance_id)
    {
        return $this->db->get_where(db_prefix() . 'my_team_approval_instances', ['id' => $instance_id])->row();
    }

    /**
     * Lấy step log hiện tại
     * @param int $instance_id
     * @return object|null
     */
    public function get_current_step_log($instance_id)
    {
        $instance = $this->get_workflow_instance($instance_id);
        if (!$instance) {
            return null;
        }

        return $this->get_step_log_by_order($instance_id, $instance->current_step);
    }

    /**
     * Lấy step log theo order
     * @param int $instance_id
     * @param int $step_order
     * @return object|null
     */
    public function get_step_log_by_order($instance_id, $step_order)
    {
        return $this->db->get_where(db_prefix() . 'my_team_approval_step_logs', [
            'instance_id' => $instance_id,
            'step_order' => $step_order
        ])->row();
    }

    /**
     * Lấy thông tin workflow step
     * @param int $step_id
     * @return object|null
     */
    public function get_workflow_step($step_id)
    {
        return $this->db->get_where(db_prefix() . 'my_team_approval_workflow_steps', ['id' => $step_id])->row();
    }

    /**
     * Lấy thông tin approval
     * @param int $approval_id
     * @return object|null
     */
    public function get_approval_info($approval_id)
    {
        return $this->db->get_where(db_prefix() . 'my_team_approvals', ['id' => $approval_id])->row();
    }

    /**
     * Tìm manager của department
     * @param int $department_id
     * @return int|null
     */
    private function get_department_manager($department_id)
    {
        // Giả sử có field department_manager_id trong bảng departments
        // Hoặc tìm staff có role manager trong department đó
        $this->db->select('departmentid');
        $this->db->from(db_prefix() . 'departments');
        $this->db->where('departmentid', $department_id);
        $department = $this->db->get()->row();

        if (!$department) {
            return null;
        }

        // Tìm staff có role cao nhất trong department (thường là manager)
        $this->db->select('staffid');
        $this->db->from(db_prefix() . 'staff');
        $this->db->where('departmentid', $department_id);
        $this->db->where('active', 1);
        $this->db->order_by('role', 'ASC'); // Role có ID nhỏ hơn thường có quyền cao hơn
        $this->db->limit(1);
        
        $manager = $this->db->get()->row();
        return $manager ? $manager->staffid : null;
    }

    /**
     * Tìm user theo role
     * @param int $role_id
     * @return int|null
     */
    private function get_user_by_role($role_id)
    {
        $this->db->select('staffid');
        $this->db->from(db_prefix() . 'staff');
        $this->db->where('role', $role_id);
        $this->db->where('active', 1);
        $this->db->limit(1);
        
        $user = $this->db->get()->row();
        return $user ? $user->staffid : null;
    }

    /**
     * Tìm user bất kỳ trong department
     * @param int $department_id
     * @return int|null
     */
    private function get_any_user_in_department($department_id)
    {
        $this->db->select('staffid');
        $this->db->from(db_prefix() . 'staff');
        $this->db->where('departmentid', $department_id);
        $this->db->where('active', 1);
        $this->db->limit(1);
        
        $user = $this->db->get()->row();
        return $user ? $user->staffid : null;
    }

    /**
     * Tạo notification assignment
     * @param int $instance_id
     * @param int $step_log_id
     * @param int $recipient_id
     * @return bool
     */
    private function create_assignment_notification($instance_id, $step_log_id, $recipient_id)
    {
        $notification_data = [
            'instance_id' => $instance_id,
            'step_log_id' => $step_log_id,
            'recipient_id' => $recipient_id,
            'notification_type' => 'assignment',
            'message' => 'Bạn có yêu cầu phê duyệt mới cần xử lý.',
            'is_read' => 0,
            'is_sent' => 0,
            'created_date' => date('Y-m-d H:i:s')
        ];

        $this->db->insert(db_prefix() . 'my_team_approval_notifications', $notification_data);
        return $this->db->insert_id() ? true : false;
    }

    /**
     * Lấy danh sách approval đang chờ staff approve
     * @param int $staff_id
     * @return array
     */
    public function get_pending_approvals_for_staff($staff_id)
    {
        $this->db->select('
            ai.id as instance_id,
            ai.approval_id,
            ai.current_step,
            ai.started_date,
            asl.id as step_log_id,
            asl.step_order,
            asl.timeout_date,
            aws.step_name,
            aw.name as workflow_name,
            ma.subject,
            ma.approval_type,
            ma.amount,
            ma.created_date as approval_created_date
        ');
        $this->db->from(db_prefix() . 'my_team_approval_instances ai');
        $this->db->join(db_prefix() . 'my_team_approval_step_logs asl', 'asl.instance_id = ai.id AND asl.step_order = ai.current_step');
        $this->db->join(db_prefix() . 'my_team_approval_workflow_steps aws', 'aws.id = asl.step_id');
        $this->db->join(db_prefix() . 'my_team_approval_workflows aw', 'aw.id = ai.workflow_id');
        $this->db->join(db_prefix() . 'my_team_approvals ma', 'ma.id = ai.approval_id');
        $this->db->where('ai.overall_status', 'pending');
        $this->db->where('asl.status', 'pending');
        $this->db->where('asl.assigned_to', $staff_id);
        $this->db->order_by('ai.started_date', 'ASC');

        return $this->db->get()->result_array();
    }

    /**
     * Lấy workflow history của approval
     * @param int $approval_id
     * @return array
     */
    public function get_approval_workflow_history($approval_id)
    {
        $this->db->select('
            ai.*,
            aw.name as workflow_name,
            aw.description as workflow_description
        ');
        $this->db->from(db_prefix() . 'my_team_approval_instances ai');
        $this->db->join(db_prefix() . 'my_team_approval_workflows aw', 'aw.id = ai.workflow_id');
        $this->db->where('ai.approval_id', $approval_id);
        
        $instance = $this->db->get()->row_array();
        
        if (!$instance) {
            return [];
        }

        // Lấy step logs
        $this->db->select('
            asl.*,
            aws.step_name,
            aws.approver_type,
            s.firstname,
            s.lastname,
            s.email
        ');
        $this->db->from(db_prefix() . 'my_team_approval_step_logs asl');
        $this->db->join(db_prefix() . 'my_team_approval_workflow_steps aws', 'aws.id = asl.step_id');
        $this->db->join(db_prefix() . 'staff s', 's.staffid = asl.assigned_to', 'left');
        $this->db->where('asl.instance_id', $instance['id']);
        $this->db->order_by('asl.step_order', 'ASC');
        
        $instance['steps'] = $this->db->get()->result_array();
        
        return $instance;
    }
} 