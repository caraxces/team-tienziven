<?php

defined('BASEPATH') or exit('No direct script access allowed');

class My_team_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Lấy danh sách phê duyệt
     * @param  array  $where điều kiện lọc
     * @return array
     */
    public function get_approvals($where = [])
    {
        $this->db->select('*');
        $this->db->from(db_prefix() . 'my_team_approvals');
        
        if (!empty($where)) {
            $this->db->where($where);
        }
        
        $this->db->order_by('created_date', 'desc');
        
        return $this->db->get()->result_array();
    }

    /**
     * Lấy thông tin phê duyệt theo ID
     * @param  int $id ID của phê duyệt
     * @return object|null
     */
    public function get_approval($id)
    {
        $this->db->where('id', $id);
        return $this->db->get(db_prefix() . 'my_team_approvals')->row();
    }

    /**
     * Thêm phê duyệt mới
     * @param array $data dữ liệu phê duyệt
     * @return int|boolean
     */
    public function add_approval($data)
    {
        // Xử lý dữ liệu động
        if (isset($data['json_data']) && is_array($data['json_data'])) {
            $data['json_data'] = json_encode($data['json_data']);
        }
        
        // Xử lý file đính kèm
        if (isset($data['attachment']) && !empty($data['attachment'])) {
            $attachment = handle_approval_attachments_array(null, 'attachment');
            if ($attachment && isset($attachment[0]['file_name'])) {
                $data['attachment'] = $attachment[0]['file_name'];
            }
        }
        
        $data['staff_id'] = get_staff_user_id();
        $data['created_date'] = date('Y-m-d H:i:s');
        
        $this->db->insert(db_prefix() . 'my_team_approvals', $data);
        $insert_id = $this->db->insert_id();
        
        if ($insert_id) {
            // Gửi thông báo cho người có quyền phê duyệt
            if (get_option('my_team_enable_notifications')) {
                $staff = $this->staff_model->get($data['staff_id']);
                $notified_users = [];
                
                // Lấy danh sách quản lý phòng ban
                $this->db->select('staffid');
                $this->db->where('role', 2); // Giả sử role_id 2 là quản lý
                if (isset($data['department_id']) && !empty($data['department_id'])) {
                    $this->db->where('departmentid', $data['department_id']);
                }
                $managers = $this->db->get(db_prefix() . 'staff')->result_array();
                
                foreach ($managers as $manager) {
                    $notified_users[] = $manager['staffid'];
                }
                
                // Thêm admin vào danh sách thông báo
                $this->db->select('staffid');
                $this->db->where('admin', 1);
                $admins = $this->db->get(db_prefix() . 'staff')->result_array();
                
                foreach ($admins as $admin) {
                    if (!in_array($admin['staffid'], $notified_users)) {
                        $notified_users[] = $admin['staffid'];
                    }
                }
                
                $approval_type = isset($data['approval_type']) ? $data['approval_type'] : 'general';
                $approval_type = _l('approval_type_' . $approval_type);
                
                // Gửi thông báo
                foreach ($notified_users as $staff_id) {
                    $link = admin_url('my_team/approvals/view/' . $insert_id);
                    
                    $notification_data = [
                        'description' => 'approval_approval_notification',
                        'touserid' => $staff_id,
                        'link' => $link,
                        'additional_data' => serialize([
                            $staff->firstname . ' ' . $staff->lastname,
                            $approval_type,
                            $data['subject']
                        ])
                    ];
                    
                    if ($staff_id != $data['staff_id']) {
                        add_notification($notification_data);
                    }
                }
                
                if (count($notified_users) > 0) {
                    pusher_trigger_notification($notified_users);
                }
            }
            
            log_activity('New Approval Request Created [ID:' . $insert_id . ']');
            return $insert_id;
        }
        
        return false;
    }

    /**
     * Cập nhật phê duyệt
     * @param  array $data dữ liệu phê duyệt
     * @param  int $id    ID của phê duyệt
     * @return boolean
     */
    public function update_approval($data, $id)
    {
        $current_approval = $this->get_approval($id);
        
        // Người tạo mới có quyền cập nhật phê duyệt chưa được xử lý
        if ($current_approval->staff_id != get_staff_user_id() && !is_admin()) {
            return false;
        }
        
        // Không thể cập nhật phê duyệt đã xử lý
        if ($current_approval->status != 0) {
            return false;
        }
        
        // Xử lý dữ liệu động
        if (isset($data['json_data']) && is_array($data['json_data'])) {
            $data['json_data'] = json_encode($data['json_data']);
        }
        
        // Xử lý file đính kèm
        if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '') {
            if ($current_approval->attachment) {
                unlink(get_upload_path_by_type('approval') . $id . '/' . $current_approval->attachment);
            }
            
            $attachment = handle_approval_attachments_array($id, 'attachment');
            if ($attachment && isset($attachment[0]['file_name'])) {
                $data['attachment'] = $attachment[0]['file_name'];
            }
        }
        
        $data['updated_date'] = date('Y-m-d H:i:s');
        
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'my_team_approvals', $data);
        
        if ($this->db->affected_rows() > 0) {
            log_activity('Approval Request Updated [ID:' . $id . ']');
            return true;
        }
        
        return false;
    }

    /**
     * Phê duyệt yêu cầu
     * @param  int $id ID của phê duyệt
     * @return boolean
     */
    public function approve_approval($id)
    {
        $approval = $this->get_approval($id);
        
        if (!$approval || $approval->status != 0) {
            return false;
        }
        
        $data = [
            'status' => 1,
            'approved_by' => get_staff_user_id(),
            'approved_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'my_team_approvals', $data);
        
        if ($this->db->affected_rows() > 0) {
            // Xử lý theo loại phê duyệt
            switch ($approval->approval_type) {
                case 'leave':
                    $this->process_leave_approval($approval);
                    break;
                case 'financial':
                    $this->process_financial_approval($approval);
                    break;
                case 'attendance':
                    $this->process_attendance_approval($approval);
                    break;
            }
            
            // Gửi thông báo
            if (get_option('my_team_enable_notifications')) {
                $staff = $this->staff_model->get($approval->staff_id);
                $approver = $this->staff_model->get(get_staff_user_id());
                
                $notified_users = [$approval->staff_id];
                $link = admin_url('my_team/approvals/view/' . $id);
                
                $notification_data = [
                    'description' => 'approval_approved_notification',
                    'touserid' => $approval->staff_id,
                    'link' => $link,
                    'additional_data' => serialize([
                        $approver->firstname . ' ' . $approver->lastname,
                        _l('approval_type_' . $approval->approval_type),
                        $approval->subject
                    ])
                ];
                
                add_notification($notification_data);
                pusher_trigger_notification($notified_users);
            }
            
            log_activity('Approval Request Approved [ID:' . $id . ']');
            return true;
        }
        
        return false;
    }

    /**
     * Từ chối yêu cầu
     * @param  int $id     ID của phê duyệt
     * @param  string $reason lý do từ chối
     * @return boolean
     */
    public function reject_approval($id, $reason)
    {
        $approval = $this->get_approval($id);
        
        if (!$approval || $approval->status != 0) {
            return false;
        }
        
        $data = [
            'status' => 2,
            'rejected_by' => get_staff_user_id(),
            'rejected_date' => date('Y-m-d H:i:s'),
            'rejected_reason' => $reason,
            'updated_date' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'my_team_approvals', $data);
        
        if ($this->db->affected_rows() > 0) {
            // Gửi thông báo
            if (get_option('my_team_enable_notifications')) {
                $staff = $this->staff_model->get($approval->staff_id);
                $rejecter = $this->staff_model->get(get_staff_user_id());
                
                $notified_users = [$approval->staff_id];
                $link = admin_url('my_team/approvals/view/' . $id);
                
                $notification_data = [
                    'description' => 'approval_rejected_notification',
                    'touserid' => $approval->staff_id,
                    'link' => $link,
                    'additional_data' => serialize([
                        $rejecter->firstname . ' ' . $rejecter->lastname,
                        _l('approval_type_' . $approval->approval_type),
                        $approval->subject,
                        $reason
                    ])
                ];
                
                add_notification($notification_data);
                pusher_trigger_notification($notified_users);
            }
            
            log_activity('Approval Request Rejected [ID:' . $id . ']');
            return true;
        }
        
        return false;
    }

    /**
     * Hủy yêu cầu
     * @param  int $id ID của phê duyệt
     * @return boolean
     */
    public function cancel_approval($id)
    {
        $approval = $this->get_approval($id);
        
        // Chỉ người tạo mới có quyền hủy yêu cầu chưa xử lý
        if (!$approval || $approval->status != 0 || ($approval->staff_id != get_staff_user_id() && !is_admin())) {
            return false;
        }
        
        $data = [
            'status' => 3,
            'updated_date' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'my_team_approvals', $data);
        
        if ($this->db->affected_rows() > 0) {
            log_activity('Approval Request Cancelled [ID:' . $id . ']');
            return true;
        }
        
        return false;
    }

    /**
     * Xử lý phê duyệt nghỉ phép
     * @param  object $approval thông tin phê duyệt
     * @return boolean
     */
    private function process_leave_approval($approval)
    {
        // Phân tích dữ liệu JSON
        $json_data = json_decode($approval->json_data, true);
        if (!$json_data || !isset($json_data['leave_type']) || !isset($json_data['days'])) {
            return false;
        }
        
        $leave_type = $json_data['leave_type'];
        $days = floatval($json_data['days']);
        $year = date('Y');
        
        if (isset($json_data['year'])) {
            $year = $json_data['year'];
        }
        
        // Cập nhật số ngày nghỉ đã sử dụng
        $this->db->where('staff_id', $approval->staff_id);
        $this->db->where('leave_type', $leave_type);
        $this->db->where('year', $year);
        $leave_balance = $this->db->get(db_prefix() . 'leave_balances')->row();
        
        if ($leave_balance) {
            $this->db->where('id', $leave_balance->id);
            $this->db->set('used_days', 'used_days + ' . $days, false);
            $this->db->set('updated_date', date('Y-m-d H:i:s'));
            $this->db->update(db_prefix() . 'leave_balances');
        } else {
            // Nếu chưa có, tạo mới
            $this->db->insert(db_prefix() . 'leave_balances', [
                'staff_id' => $approval->staff_id,
                'leave_type' => $leave_type,
                'year' => $year,
                'total_days' => $days,
                'used_days' => $days,
                'created_date' => date('Y-m-d H:i:s')
            ]);
        }
        
        return true;
    }

    /**
     * Xử lý phê duyệt tài chính
     * @param  object $approval thông tin phê duyệt
     * @return boolean
     */
    private function process_financial_approval($approval)
    {
        // Thêm vào bảng ghi chép tài chính
        $json_data = json_decode($approval->json_data, true);
        $type = isset($json_data['type']) ? $json_data['type'] : 'expense';
        $category = isset($json_data['category']) ? $json_data['category'] : '';
        
        $data = [
            'staff_id' => $approval->staff_id,
            'approval_id' => $approval->id,
            'type' => $type,
            'description' => $approval->description,
            'amount' => $approval->amount,
            'date' => date('Y-m-d'),
            'category' => $category,
            'status' => 1,
            'reference' => 'APPR-' . $approval->id,
            'created_date' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert(db_prefix() . 'financial_records', $data);
        return ($this->db->affected_rows() > 0);
    }

    /**
     * Xử lý phê duyệt điểm danh
     * @param  object $approval thông tin phê duyệt
     * @return boolean
     */
    private function process_attendance_approval($approval)
    {
        $json_data = json_decode($approval->json_data, true);
        if (!$json_data || !isset($json_data['date'])) {
            return false;
        }
        
        $date = $json_data['date'];
        $status = isset($json_data['status']) ? $json_data['status'] : 'present';
        $clock_in = isset($json_data['clock_in']) ? $json_data['clock_in'] : null;
        $clock_out = isset($json_data['clock_out']) ? $json_data['clock_out'] : null;
        $work_hours = isset($json_data['work_hours']) ? $json_data['work_hours'] : null;
        $overtime_hours = isset($json_data['overtime_hours']) ? $json_data['overtime_hours'] : 0;
        
        // Kiểm tra xem đã có điểm danh trong ngày này chưa
        $this->db->where('staff_id', $approval->staff_id);
        $this->db->where('date', $date);
        $existing = $this->db->get(db_prefix() . 'attendance_records')->row();
        
        if ($existing) {
            // Cập nhật
            $this->db->where('id', $existing->id);
            $this->db->update(db_prefix() . 'attendance_records', [
                'status' => $status,
                'clock_in' => $clock_in,
                'clock_out' => $clock_out,
                'work_hours' => $work_hours,
                'overtime_hours' => $overtime_hours,
                'reason' => $approval->description,
                'approval_id' => $approval->id,
                'updated_date' => date('Y-m-d H:i:s')
            ]);
        } else {
            // Thêm mới
            $this->db->insert(db_prefix() . 'attendance_records', [
                'staff_id' => $approval->staff_id,
                'date' => $date,
                'status' => $status,
                'clock_in' => $clock_in,
                'clock_out' => $clock_out,
                'work_hours' => $work_hours,
                'overtime_hours' => $overtime_hours,
                'reason' => $approval->description,
                'approval_id' => $approval->id,
                'created_date' => date('Y-m-d H:i:s')
            ]);
        }
        
        return ($this->db->affected_rows() > 0);
    }

    /**
     * Lấy số ngày nghỉ phép của nhân viên
     * @param  int $staff_id ID của nhân viên
     * @param  string $type     loại nghỉ phép
     * @param  int $year     năm
     * @return object
     */
    public function get_leave_balance($staff_id, $type = null, $year = null)
    {
        $this->db->where('staff_id', $staff_id);
        
        if ($type) {
            $this->db->where('leave_type', $type);
        }
        
        if ($year) {
            $this->db->where('year', $year);
        } else {
            $this->db->where('year', date('Y'));
        }
        
        return $this->db->get(db_prefix() . 'leave_balances')->result_array();
    }

    /**
     * Cập nhật số ngày nghỉ phép
     * @param  array $data dữ liệu nghỉ phép
     * @return boolean
     */
    public function update_leave_balance($data)
    {
        $staff_id = $data['staff_id'];
        $leave_type = $data['leave_type'];
        $year = isset($data['year']) ? $data['year'] : date('Y');
        $total_days = floatval($data['total_days']);
        
        $this->db->where('staff_id', $staff_id);
        $this->db->where('leave_type', $leave_type);
        $this->db->where('year', $year);
        $existing = $this->db->get(db_prefix() . 'leave_balances')->row();
        
        if ($existing) {
            $this->db->where('id', $existing->id);
            $this->db->update(db_prefix() . 'leave_balances', [
                'total_days' => $total_days,
                'updated_date' => date('Y-m-d H:i:s')
            ]);
        } else {
            $this->db->insert(db_prefix() . 'leave_balances', [
                'staff_id' => $staff_id,
                'leave_type' => $leave_type,
                'year' => $year,
                'total_days' => $total_days,
                'used_days' => 0,
                'created_date' => date('Y-m-d H:i:s')
            ]);
        }
        
        return ($this->db->affected_rows() > 0);
    }

    /**
     * Lấy dữ liệu báo cáo phê duyệt
     * @param  array  $where điều kiện lọc
     * @return array
     */
    public function get_approvals_report($where = [])
    {
        try {
            // Kiểm tra xem bảng my_team_approvals có tồn tại không
            if (!$this->db->table_exists(db_prefix() . 'my_team_approvals')) {
                return [];
            }
            
            $this->db->select('a.*, s.firstname, s.lastname, s.email, d.name as department_name, 
                             ad.firstname as approver_firstname, ad.lastname as approver_lastname, 
                             rd.firstname as rejecter_firstname, rd.lastname as rejecter_lastname,
                             cr.firstname as creator_firstname, cr.lastname as creator_lastname');
            $this->db->from(db_prefix() . 'my_team_approvals a');
            $this->db->join(db_prefix() . 'staff s', 's.staffid = a.staff_id', 'left');
            $this->db->join(db_prefix() . 'departments d', 'd.departmentid = a.department_id', 'left');
            $this->db->join(db_prefix() . 'staff ad', 'ad.staffid = a.approved_by', 'left');
            $this->db->join(db_prefix() . 'staff rd', 'rd.staffid = a.rejected_by', 'left');
            $this->db->join(db_prefix() . 'staff cr', 'cr.staffid = a.created_by', 'left');
            
            if (is_array($where) && count($where) > 0) {
                foreach ($where as $key => $value) {
                    if ($value !== null) {
                        if (strpos($key, ' ') !== false) {
                            // Điều kiện phức tạp như 'created_date >='
                            $this->db->where($key, $value);
                        } else {
                            // Điều kiện đơn giản
                            $this->db->where('a.' . $key, $value);
                        }
                    }
                }
            }
            
            $this->db->order_by('a.created_date', 'desc');
            
            $result = $this->db->get();
            
            if ($result) {
                return $result->result_array();
            } else {
                return [];
            }
            
        } catch (Exception $e) {
            log_message('error', 'Error in get_approvals_report: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Lấy dữ liệu hiệu suất của nhân viên
     * @param  int $staff_id ID của nhân viên
     * @param  string $date_from Ngày bắt đầu (định dạng Y-m-d)
     * @param  string $date_to Ngày kết thúc (định dạng Y-m-d)
     * @return array
     */
    public function get_staff_performance($staff_id, $date_from = null, $date_to = null)
    {
        $data = [];
        
        // Nếu không có ngày, lấy dữ liệu của tháng hiện tại
        if (!$date_from) {
            $date_from = date('Y-m-01');
        }
        
        if (!$date_to) {
            $date_to = date('Y-m-t');
        }
        
        // Tổng số công việc
        $this->db->where('id IN (SELECT taskid FROM ' . db_prefix() . 'task_assigned WHERE staffid = ' . $staff_id . ')');
        if ($date_from && $date_to) {
            $this->db->where('(startdate >= "' . $date_from . '" OR dateadded >= "' . $date_from . '")');
            $this->db->where('(startdate <= "' . $date_to . '" OR dateadded <= "' . $date_to . '")');
        }
        $total_tasks = $this->db->count_all_results(db_prefix() . 'tasks');
        
        // Công việc đã hoàn thành
        $this->db->where('id IN (SELECT taskid FROM ' . db_prefix() . 'task_assigned WHERE staffid = ' . $staff_id . ')');
        $this->db->where('status', 5); // 5 = hoàn thành
        if ($date_from && $date_to) {
            $this->db->where('(startdate >= "' . $date_from . '" OR dateadded >= "' . $date_from . '")');
            $this->db->where('(datefinished IS NULL OR datefinished <= "' . $date_to . '")');
        }
        $completed_tasks = $this->db->count_all_results(db_prefix() . 'tasks');
        
        // Công việc quá hạn
        $this->db->where('id IN (SELECT taskid FROM ' . db_prefix() . 'task_assigned WHERE staffid = ' . $staff_id . ')');
        $this->db->where('status !=', 5); // không hoàn thành
        $this->db->where('duedate <', date('Y-m-d'));
        if ($date_from && $date_to) {
            $this->db->where('(startdate >= "' . $date_from . '" OR dateadded >= "' . $date_from . '")');
            $this->db->where('(startdate <= "' . $date_to . '" OR dateadded <= "' . $date_to . '")');
        }
        $overdue_tasks = $this->db->count_all_results(db_prefix() . 'tasks');
        
        // Tính tỷ lệ hoàn thành
        $task_completion_rate = ($total_tasks > 0) ? ($completed_tasks / $total_tasks * 100) : 0;
        
        // Dự án
        $this->db->where('id IN (SELECT project_id FROM ' . db_prefix() . 'project_members WHERE staff_id = ' . $staff_id . ')');
        if ($date_from && $date_to) {
            $this->db->where('(start_date >= "' . $date_from . '" OR start_date IS NULL)');
            $this->db->where('(deadline <= "' . $date_to . '" OR deadline IS NULL)');
        }
        $total_projects = $this->db->count_all_results(db_prefix() . 'projects');
        
        // Dự án đã hoàn thành
        $this->db->where('id IN (SELECT project_id FROM ' . db_prefix() . 'project_members WHERE staff_id = ' . $staff_id . ')');
        $this->db->where('status', 4); // 4 = hoàn thành
        if ($date_from && $date_to) {
            $this->db->where('(start_date >= "' . $date_from . '" OR start_date IS NULL)');
            $this->db->where('(deadline <= "' . $date_to . '" OR deadline IS NULL)');
        }
        $completed_projects = $this->db->count_all_results(db_prefix() . 'projects');
        
        // Dự án quá hạn
        $this->db->where('id IN (SELECT project_id FROM ' . db_prefix() . 'project_members WHERE staff_id = ' . $staff_id . ')');
        $this->db->where('status !=', 4); // không hoàn thành
        $this->db->where('deadline <', date('Y-m-d'));
        $this->db->where('deadline IS NOT NULL');
        if ($date_from && $date_to) {
            $this->db->where('(start_date >= "' . $date_from . '" OR start_date IS NULL)');
            $this->db->where('(deadline <= "' . $date_to . '" OR deadline IS NULL)');
        }
        $overdue_projects = $this->db->count_all_results(db_prefix() . 'projects');
        
        // Tính tỷ lệ hoàn thành dự án
        $project_completion_rate = ($total_projects > 0) ? ($completed_projects / $total_projects * 100) : 0;
        
        // Phiếu hỗ trợ
        $this->db->where('assigned', $staff_id);
        if ($date_from && $date_to) {
            $this->db->where('date >= "' . $date_from . '"');
            $this->db->where('date <= "' . $date_to . '"');
        }
        $total_tickets = $this->db->count_all_results(db_prefix() . 'tickets');
        
        // Phiếu hỗ trợ đã đóng
        $this->db->where('assigned', $staff_id);
        $this->db->where('status', 5); // 5 = đã đóng
        if ($date_from && $date_to) {
            $this->db->where('date >= "' . $date_from . '"');
            $this->db->where('date <= "' . $date_to . '"');
        }
        $closed_tickets = $this->db->count_all_results(db_prefix() . 'tickets');
        
        // Tính tỷ lệ phản hồi phiếu hỗ trợ
        $ticket_response_rate = ($total_tickets > 0) ? ($closed_tickets / $total_tickets * 100) : 0;
        
        // Thống kê giờ làm việc
        $this->db->select('SUM(CASE WHEN end_time IS NOT NULL THEN (end_time - start_time) ELSE 0 END) as total_time');
        $this->db->where('staff_id', $staff_id);
        $this->db->where('task_id IN (SELECT id FROM ' . db_prefix() . 'tasks WHERE rel_type = "project")');
        if ($date_from && $date_to) {
            $this->db->where('start_time >= "' . strtotime($date_from) . '"');
            $this->db->where('(end_time <= "' . strtotime($date_to) . '" OR end_time IS NULL)');
        }
        $timesheet = $this->db->get(db_prefix() . 'taskstimers')->row();
        $total_hours = $timesheet ? round($timesheet->total_time / 3600, 2) : 0;
        
        // Điểm danh
        $this->db->where('staff_id', $staff_id);
        if ($date_from && $date_to) {
            $this->db->where('date >=', $date_from);
            $this->db->where('date <=', $date_to);
        } else {
            $year = date('Y');
            $month = date('m');
            $this->db->where('YEAR(date)', $year);
            $this->db->where('MONTH(date)', $month);
        }
        $attendance = $this->db->get(db_prefix() . 'attendance_records')->result_array();
        
        $present_days = 0;
        $absent_days = 0;
        $late_days = 0;
        
        foreach ($attendance as $day) {
            if ($day['status'] == 'present') {
                $present_days++;
            } elseif ($day['status'] == 'absent') {
                $absent_days++;
            } elseif ($day['status'] == 'late') {
                $late_days++;
            }
        }
        
        $workdays = count($attendance);
        $attendance_rate = ($workdays > 0) ? ($present_days / $workdays * 100) : 0;
        
        // Tạo dữ liệu trả về
        $data = [
            'tasks' => [
                'total' => $total_tasks,
                'completed' => $completed_tasks,
                'pending' => $total_tasks - $completed_tasks,
                'overdue' => $overdue_tasks,
                'completion_rate' => round($task_completion_rate, 2)
            ],
            'projects' => [
                'total' => $total_projects,
                'completed' => $completed_projects,
                'ongoing' => $total_projects - $completed_projects,
                'overdue' => $overdue_projects,
                'completion_rate' => round($project_completion_rate, 2)
            ],
            'tickets' => [
                'total' => $total_tickets,
                'closed' => $closed_tickets,
                'open' => $total_tickets - $closed_tickets,
                'response_rate' => round($ticket_response_rate, 2)
            ],
            'timesheet' => [
                'total_hours' => $total_hours
            ],
            'attendance' => [
                'present_days' => $present_days,
                'absent_days' => $absent_days,
                'late_days' => $late_days,
                'attendance_rate' => round($attendance_rate, 2)
            ],
            'period' => [
                'date_from' => $date_from,
                'date_to' => $date_to
            ]
        ];
        
        return $data;
    }

    /* Phần quản lý thành viên */

    /**
     * Lấy danh sách kỹ năng của thành viên
     * @param  int $member_id ID của thành viên
     * @return array
     */
    public function get_member_skills($member_id)
    {
        $this->db->where('staff_id', $member_id);
        return $this->db->get(db_prefix() . 'staff_skills')->result_array();
    }

    /**
     * Thêm kỹ năng cho thành viên
     * @param array $data dữ liệu kỹ năng
     * @return int|boolean
     */
    public function add_member_skill($data)
    {
        $this->db->insert(db_prefix() . 'staff_skills', [
            'staff_id' => $data['staff_id'],
            'skill_name' => $data['skill_name'],
            'skill_level' => $data['skill_level'] ?? 1,
            'created_date' => date('Y-m-d H:i:s')
        ]);

        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            log_activity('New Staff Skill Added [StaffID: ' . $data['staff_id'] . ', SkillID: ' . $insert_id . ']');
            return $insert_id;
        }

        return false;
    }

    /**
     * Cập nhật kỹ năng của thành viên
     * @param  array $data dữ liệu kỹ năng
     * @param  int $id    ID của kỹ năng
     * @return boolean
     */
    public function update_member_skill($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'staff_skills', [
            'skill_name' => $data['skill_name'],
            'skill_level' => $data['skill_level'] ?? 1,
            'updated_date' => date('Y-m-d H:i:s')
        ]);

        if ($this->db->affected_rows() > 0) {
            log_activity('Staff Skill Updated [ID: ' . $id . ']');
            return true;
        }

        return false;
    }

    /**
     * Xóa kỹ năng của thành viên
     * @param  int $id ID của kỹ năng
     * @return boolean
     */
    public function delete_member_skill($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'staff_skills');

        if ($this->db->affected_rows() > 0) {
            log_activity('Staff Skill Deleted [ID: ' . $id . ']');
            return true;
        }

        return false;
    }

    /* Phần quản lý Knowledge Items */

    /**
     * Lấy danh sách knowledge item
     * @param  array  $where điều kiện lọc
     * @return array
     */
    public function get_knowledge_items($where = [])
    {
        $this->db->select('ki.*, kc.name as category_name, s.firstname, s.lastname');
        $this->db->from(db_prefix() . 'knowledge_items ki');
        $this->db->join(db_prefix() . 'knowledge_categories kc', 'kc.id = ki.category_id', 'left');
        $this->db->join(db_prefix() . 'staff s', 's.staffid = ki.created_by', 'left');

        if (is_array($where) && count($where) > 0) {
            $this->db->where($where);
        }

        $this->db->order_by('ki.created_date', 'desc');

        return $this->db->get()->result_array();
    }

    /**
     * Lấy danh sách knowledge item dành cho nhân viên
     * @param  int $staff_id      ID của nhân viên
     * @param  array $department_ids Danh sách ID phòng ban của nhân viên
     * @return array
     */
    public function get_knowledge_items_for_staff($staff_id, $department_ids = [])
    {
        $items = [];

        // Lấy knowledge item công khai cho tất cả
        $this->db->select('ki.*, kc.name as category_name, s.firstname, s.lastname');
        $this->db->from(db_prefix() . 'knowledge_items ki');
        $this->db->join(db_prefix() . 'knowledge_categories kc', 'kc.id = ki.category_id', 'left');
        $this->db->join(db_prefix() . 'staff s', 's.staffid = ki.created_by', 'left');
        $this->db->where('ki.visibility', 'all');
        $this->db->order_by('ki.created_date', 'desc');
        $public_items = $this->db->get()->result_array();

        // Lấy knowledge item do nhân viên tạo
        $this->db->select('ki.*, kc.name as category_name, s.firstname, s.lastname');
        $this->db->from(db_prefix() . 'knowledge_items ki');
        $this->db->join(db_prefix() . 'knowledge_categories kc', 'kc.id = ki.category_id', 'left');
        $this->db->join(db_prefix() . 'staff s', 's.staffid = ki.created_by', 'left');
        $this->db->where('ki.created_by', $staff_id);
        $this->db->order_by('ki.created_date', 'desc');
        $own_items = $this->db->get()->result_array();

        // Lấy knowledge item được chia sẻ cho phòng ban của nhân viên
        $department_items = [];
        if (!empty($department_ids)) {
            $this->db->select('ki.*, kc.name as category_name, s.firstname, s.lastname');
            $this->db->from(db_prefix() . 'knowledge_items ki');
            $this->db->join(db_prefix() . 'knowledge_categories kc', 'kc.id = ki.category_id', 'left');
            $this->db->join(db_prefix() . 'staff s', 's.staffid = ki.created_by', 'left');
            $this->db->where('ki.visibility', 'departments');
            $this->db->order_by('ki.created_date', 'desc');
            $department_shared_items = $this->db->get()->result_array();

            foreach ($department_shared_items as $item) {
                $visible_departments = json_decode($item['visible_to_departments'], true);
                if (!$visible_departments) {
                    $visible_departments = [];
                }

                foreach ($department_ids as $department_id) {
                    if (in_array($department_id, $visible_departments)) {
                        $department_items[] = $item;
                        break;
                    }
                }
            }
        }

        // Gộp và loại bỏ trùng lặp
        $merged_items = array_merge($public_items, $own_items, $department_items);
        $unique_items = [];
        $added_ids = [];

        foreach ($merged_items as $item) {
            if (!in_array($item['id'], $added_ids)) {
                $added_ids[] = $item['id'];
                $unique_items[] = $item;
            }
        }

        return $unique_items;
    }

    /**
     * Lấy thông tin knowledge item theo ID
     * @param  int $id ID của knowledge item
     * @return object
     */
    public function get_knowledge_item($id)
    {
        $this->db->where('id', $id);
        return $this->db->get(db_prefix() . 'knowledge_items')->row();
    }

    /**
     * Thêm knowledge item mới
     * @param array $data dữ liệu knowledge item
     * @return int|boolean
     */
    public function add_knowledge_item($data)
    {
        // Xử lý danh sách phòng ban được phép xem
        if (isset($data['visible_to_departments']) && is_array($data['visible_to_departments'])) {
            $data['visible_to_departments'] = json_encode($data['visible_to_departments']);
        } elseif (isset($data['visible_to_departments']) && !is_array($data['visible_to_departments'])) {
            $data['visible_to_departments'] = json_encode([]);
        }

        // Xử lý file đính kèm
        if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '') {
            $attachment = handle_knowledge_attachment(null, 'attachment');
            if ($attachment) {
                $data['attachment'] = $attachment;
            }
        }

        $data['created_by'] = get_staff_user_id();
        $data['created_date'] = date('Y-m-d H:i:s');

        $this->db->insert(db_prefix() . 'knowledge_items', $data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            log_activity('New Knowledge Item Created [ID: ' . $insert_id . ']');
            return $insert_id;
        }

        return false;
    }

    /**
     * Cập nhật knowledge item
     * @param  array $data dữ liệu knowledge item
     * @param  int $id    ID của knowledge item
     * @return boolean
     */
    public function update_knowledge_item($data, $id)
    {
        $current_item = $this->get_knowledge_item($id);

        // Xử lý danh sách phòng ban được phép xem
        if (isset($data['visible_to_departments']) && is_array($data['visible_to_departments'])) {
            $data['visible_to_departments'] = json_encode($data['visible_to_departments']);
        } elseif (isset($data['visible_to_departments']) && !is_array($data['visible_to_departments'])) {
            $data['visible_to_departments'] = json_encode([]);
        }

        // Xử lý file đính kèm
        if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '') {
            // Xóa tệp cũ nếu có
            if ($current_item->attachment) {
                $old_path = get_upload_path_by_type('knowledge') . $id . '/' . $current_item->attachment;
                if (file_exists($old_path)) {
                    unlink($old_path);
                }
            }

            $attachment = handle_knowledge_attachment($id, 'attachment');
            if ($attachment) {
                $data['attachment'] = $attachment;
            }
        }

        $data['updated_date'] = date('Y-m-d H:i:s');

        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'knowledge_items', $data);

        if ($this->db->affected_rows() > 0) {
            log_activity('Knowledge Item Updated [ID: ' . $id . ']');
            return true;
        }

        return false;
    }

    /**
     * Xóa knowledge item
     * @param  int $id ID của knowledge item
     * @return boolean
     */
    public function delete_knowledge_item($id)
    {
        $item = $this->get_knowledge_item($id);

        // Xóa tệp đính kèm
        if ($item && $item->attachment) {
            $path = get_upload_path_by_type('knowledge') . $id;
            if (is_dir($path)) {
                delete_dir($path);
            }
        }

        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'knowledge_items');

        if ($this->db->affected_rows() > 0) {
            log_activity('Knowledge Item Deleted [ID: ' . $id . ']');
            return true;
        }

        return false;
    }

    /**
     * Lấy danh sách danh mục knowledge
     * @return array
     */
    public function get_knowledge_categories()
    {
        $this->db->order_by('name', 'asc');
        return $this->db->get(db_prefix() . 'knowledge_categories')->result_array();
    }

    /**
     * Lấy thông tin danh mục knowledge theo ID
     * @param  int $id ID của danh mục
     * @return object
     */
    public function get_knowledge_category($id)
    {
        $this->db->where('id', $id);
        return $this->db->get(db_prefix() . 'knowledge_categories')->row();
    }

    /**
     * Thêm danh mục knowledge mới
     * @param array $data dữ liệu danh mục
     * @return int|boolean
     */
    public function add_knowledge_category($data)
    {
        $data['created_date'] = date('Y-m-d H:i:s');

        $this->db->insert(db_prefix() . 'knowledge_categories', $data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            log_activity('New Knowledge Category Created [ID: ' . $insert_id . ']');
            return $insert_id;
        }

        return false;
    }

    /**
     * Cập nhật danh mục knowledge
     * @param  array $data dữ liệu danh mục
     * @param  int $id    ID của danh mục
     * @return boolean
     */
    public function update_knowledge_category($data, $id)
    {
        $data['updated_date'] = date('Y-m-d H:i:s');

        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'knowledge_categories', $data);

        if ($this->db->affected_rows() > 0) {
            log_activity('Knowledge Category Updated [ID: ' . $id . ']');
            return true;
        }

        return false;
    }

    /**
     * Xóa danh mục knowledge
     * @param  int $id ID của danh mục
     * @return boolean
     */
    public function delete_knowledge_category($id)
    {
        // Cập nhật các knowledge item thuộc danh mục này
        $this->db->where('category_id', $id);
        $this->db->update(db_prefix() . 'knowledge_items', [
            'category_id' => null
        ]);

        // Xóa danh mục
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'knowledge_categories');

        if ($this->db->affected_rows() > 0) {
            log_activity('Knowledge Category Deleted [ID: ' . $id . ']');
            return true;
        }

        return false;
    }

    /**
     * Lấy danh sách training documents
     * @param array $where điều kiện tìm kiếm
     * @return array
     */
    public function get_training_documents($where = [])
    {
        if (!$this->db->table_exists(db_prefix() . 'training_documents')) {
            return [];
        }
        
        $this->db->select('td.*, s.firstname, s.lastname, kc.name as category_name');
        $this->db->from(db_prefix() . 'training_documents td');
        $this->db->join(db_prefix() . 'staff s', 's.staffid = td.created_by', 'left');
        $this->db->join(db_prefix() . 'knowledge_categories kc', 'kc.id = td.category_id', 'left');
        
        if (!empty($where)) {
            $this->db->where($where);
        }
        
        $this->db->order_by('td.created_date', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Lấy training document theo ID
     * @param int $id
     * @return object|null
     */
    public function get_training_document($id)
    {
        if (!$this->db->table_exists(db_prefix() . 'training_documents')) {
            return null;
        }
        
        $this->db->select('td.*, s.firstname, s.lastname, kc.name as category_name');
        $this->db->from(db_prefix() . 'training_documents td');
        $this->db->join(db_prefix() . 'staff s', 's.staffid = td.created_by', 'left');
        $this->db->join(db_prefix() . 'knowledge_categories kc', 'kc.id = td.category_id', 'left');
        $this->db->where('td.id', $id);
        
        return $this->db->get()->row();
    }
    
    /**
     * Thêm training document mới
     * @param array $data
     * @return int|bool
     */
    public function add_training_document($data)
    {
        if (!$this->db->table_exists(db_prefix() . 'training_documents')) {
            return false;
        }
        
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['created_by'] = get_staff_user_id();
        
        $this->db->insert(db_prefix() . 'training_documents', $data);
        
        return $this->db->insert_id();
    }
    
    /**
     * Cập nhật training document
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update_training_document($data, $id)
    {
        if (!$this->db->table_exists(db_prefix() . 'training_documents')) {
            return false;
        }
        
        $data['updated_date'] = date('Y-m-d H:i:s');
        
        $this->db->where('id', $id);
        return $this->db->update(db_prefix() . 'training_documents', $data);
    }
    
    /**
     * Xóa training document
     * @param int $id
     * @return bool
     */
    public function delete_training_document($id)
    {
        if (!$this->db->table_exists(db_prefix() . 'training_documents')) {
            return false;
        }
        
        // Xóa các assignments liên quan
        $this->db->where('document_id', $id);
        $this->db->delete(db_prefix() . 'training_assignments');
        
        // Xóa document
        $this->db->where('id', $id);
        return $this->db->delete(db_prefix() . 'training_documents');
    }
    
    /**
     * Giao tài liệu cho nhân viên
     * @param int $document_id
     * @param array $staff_ids
     * @param string $deadline
     * @param string $notes
     * @return bool
     */
    public function assign_document_to_staff($document_id, $staff_ids, $deadline = null, $notes = null)
    {
        if (!$this->db->table_exists(db_prefix() . 'training_assignments')) {
            return false;
        }
        
        $success = true;
        
        foreach ($staff_ids as $staff_id) {
            // Kiểm tra xem đã được giao chưa
            $this->db->where('document_id', $document_id);
            $this->db->where('staff_id', $staff_id);
            $existing = $this->db->get(db_prefix() . 'training_assignments')->row();
            
            if (!$existing) {
                $assignment_data = [
                    'document_id' => $document_id,
                    'staff_id' => $staff_id,
                    'assigned_by' => get_staff_user_id(),
                    'assigned_date' => date('Y-m-d H:i:s'),
                    'deadline' => $deadline,
                    'notes' => $notes,
                    'status' => 'assigned'
                ];
                
                if (!$this->db->insert(db_prefix() . 'training_assignments', $assignment_data)) {
                    $success = false;
                }
            }
        }
        
        return $success;
    }
    
    /**
     * Lấy danh sách assignments của nhân viên
     * @param int $staff_id
     * @param string $status
     * @return array
     */
    public function get_staff_assignments($staff_id, $status = null)
    {
        if (!$this->db->table_exists(db_prefix() . 'training_assignments')) {
            return [];
        }
        
        $this->db->select('ta.*, td.title, td.description, td.file_path, td.file_name, s.firstname, s.lastname');
        $this->db->from(db_prefix() . 'training_assignments ta');
        $this->db->join(db_prefix() . 'training_documents td', 'td.id = ta.document_id');
        $this->db->join(db_prefix() . 'staff s', 's.staffid = ta.assigned_by', 'left');
        $this->db->where('ta.staff_id', $staff_id);
        
        if ($status) {
            $this->db->where('ta.status', $status);
        }
        
        $this->db->order_by('ta.assigned_date', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Lấy danh sách assignments theo document
     * @param int $document_id
     * @return array
     */
    public function get_document_assignments($document_id)
    {
        if (!$this->db->table_exists(db_prefix() . 'training_assignments')) {
            return [];
        }
        
        $this->db->select('ta.*, s.firstname, s.lastname, s.email');
        $this->db->from(db_prefix() . 'training_assignments ta');
        $this->db->join(db_prefix() . 'staff s', 's.staffid = ta.staff_id');
        $this->db->where('ta.document_id', $document_id);
        $this->db->order_by('ta.assigned_date', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Đánh dấu tài liệu đã đọc xong
     * @param int $assignment_id
     * @return bool
     */
    public function mark_document_completed($assignment_id)
    {
        if (!$this->db->table_exists(db_prefix() . 'training_assignments')) {
            return false;
        }
        
        $data = [
            'status' => 'completed',
            'completed_date' => date('Y-m-d H:i:s'),
            'progress' => 100
        ];
        
        $this->db->where('id', $assignment_id);
        return $this->db->update(db_prefix() . 'training_assignments', $data);
    }
    
    /**
     * Cập nhật tiến độ đọc tài liệu
     * @param int $assignment_id
     * @param int $progress (0-100)
     * @return bool
     */
    public function update_reading_progress($assignment_id, $progress)
    {
        if (!$this->db->table_exists(db_prefix() . 'training_assignments')) {
            return false;
        }
        
        $data = [
            'progress' => $progress,
            'last_accessed' => date('Y-m-d H:i:s')
        ];
        
        // Nếu progress = 100 thì tự động đánh dấu completed
        if ($progress >= 100) {
            $data['status'] = 'completed';
            $data['completed_date'] = date('Y-m-d H:i:s');
        }
        
        $this->db->where('id', $assignment_id);
        return $this->db->update(db_prefix() . 'training_assignments', $data);
    }
    
    /**
     * Lấy thống kê training cho manager
     * @param int $manager_id
     * @return array
     */
    public function get_training_stats_for_manager($manager_id)
    {
        $stats = [
            'total_documents' => 0,
            'total_assignments' => 0,
            'completed_assignments' => 0,
            'pending_assignments' => 0,
            'overdue_assignments' => 0
        ];
        
        if (!$this->db->table_exists(db_prefix() . 'training_documents')) {
            return $stats;
        }
        
        // Tổng số documents do manager tạo
        $this->db->where('created_by', $manager_id);
        $stats['total_documents'] = $this->db->count_all_results(db_prefix() . 'training_documents');
        
        // Tổng số assignments do manager giao
        $this->db->where('assigned_by', $manager_id);
        $stats['total_assignments'] = $this->db->count_all_results(db_prefix() . 'training_assignments');
        
        // Số assignments đã hoàn thành
        $this->db->where('assigned_by', $manager_id);
        $this->db->where('status', 'completed');
        $stats['completed_assignments'] = $this->db->count_all_results(db_prefix() . 'training_assignments');
        
        // Số assignments đang chờ
        $this->db->where('assigned_by', $manager_id);
        $this->db->where('status', 'assigned');
        $stats['pending_assignments'] = $this->db->count_all_results(db_prefix() . 'training_assignments');
        
        // Số assignments quá hạn
        $this->db->where('assigned_by', $manager_id);
        $this->db->where('status', 'assigned');
        $this->db->where('deadline <', date('Y-m-d'));
        $this->db->where('deadline IS NOT NULL');
        $stats['overdue_assignments'] = $this->db->count_all_results(db_prefix() . 'training_assignments');
        
        return $stats;
    }
    
    /**
     * Lấy danh sách nhân viên dưới quyền của manager
     * @param int $manager_id
     * @return array
     */
    public function get_subordinate_staff($manager_id)
    {
        // Lấy thông tin manager
        $this->load->model('staff_model');
        $manager = $this->staff_model->get($manager_id);
        
        if (!$manager) {
            return [];
        }
        
        // Lấy nhân viên cùng phòng ban (trừ admin và chính manager)
        $this->db->select('staffid, firstname, lastname, email, role');
        $this->db->from(db_prefix() . 'staff');
        $this->db->where('departmentid', $manager->departmentid);
        $this->db->where('staffid !=', $manager_id);
        $this->db->where('admin !=', 1);
        $this->db->where('active', 1);
        $this->db->order_by('firstname, lastname');
        
        return $this->db->get()->result_array();
    }
} 