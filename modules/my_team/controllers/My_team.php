<?php

defined('BASEPATH') or exit('No direct script access allowed');

class My_team extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        
        // Cho phép truy cập nếu:
        // 1. User có quyền xem my_team
        // 2. User có quyền xem team_approvals
        // 3. User là admin
        if (!has_permission('my_team', '', 'view') && !has_permission('team_approvals', '', 'view') && !is_admin()) {
            access_denied('my_team');
        }
        
        $this->load->model('my_team_model');
        $this->load->model('staff_model');
        $this->load->model('projects_model');
        $this->load->model('tasks_model');
        
        // Nếu là admin, đảm bảo có quyền quản lý
        if (is_admin()) {
            $this->my_team_model->ensure_admin_has_manager_rights(get_staff_user_id());
        }
    }

    /**
     * Main view - shows team members
     */
    public function index()
    {
        // Kiểm tra quyền xem team members
        if (!has_permission('my_team', '', 'view') && !is_admin()) {
            access_denied('my_team');
        }
        
        $data['title'] = _l('my_team');
        
        // Check if current staff member is a manager
        $staff_id = get_staff_user_id();
        
        // Special handling for admin users
        $is_admin = is_admin($staff_id);
        
        $team_members = $this->my_team_model->get_staff_members_by_manager($staff_id);
        
        $data['team_members'] = $team_members;
        $data['all_staff'] = $this->staff_model->get('', ['active' => 1]);
        
        // Cập nhật logic của is_manager để bao gồm người dùng có quyền create
        $data['is_manager'] = !empty($team_members) || $is_admin || has_permission('my_team', '', 'create'); 
        
        // For staff members who are not managers and not admins
        if (empty($team_members) && !$is_admin && !has_permission('my_team', '', 'create')) {
            $manager_id = $this->my_team_model->get_staff_manager($staff_id);
            if ($manager_id) {
                $data['manager'] = $this->staff_model->get($manager_id);
            }
        }
        
        $this->load->view('my_team/members/manage', $data);
    }
    
    /**
     * Add a team member to the current manager's team
     */
    public function add_team_member()
    {
        // Kiểm tra quyền tạo team member
        if (!has_permission('my_team', '', 'create') && !is_admin()) {
            access_denied('my_team');
        }
        
        if ($this->input->post()) {
            $data = $this->input->post();
            $manager_id = get_staff_user_id();
            
            $result = $this->my_team_model->add_team_member($data, $manager_id);
            
            if ($result) {
                set_alert('success', _l('team_member_added_successfully'));
            } else {
                set_alert('warning', _l('team_member_already_added'));
            }
        }
        
        redirect(admin_url('my_team'));
    }
    
    /**
     * Remove a team member from the current manager's team
     */
    public function remove_team_member($staff_id)
    {
        // Kiểm tra quyền xóa team member
        if (!has_permission('my_team', '', 'delete') && !is_admin()) {
            access_denied('my_team');
        }
        
        $manager_id = get_staff_user_id();
        
        // Check if staff_id is actually managed by current user
        if (!$this->my_team_model->is_staff_managed_by($manager_id, $staff_id) && !is_admin()) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team'));
        }
        
        $result = $this->my_team_model->remove_team_member($staff_id, $manager_id);
        
        if ($result) {
            set_alert('success', _l('team_member_removed_successfully'));
        } else {
            set_alert('warning', _l('team_member_remove_failed'));
        }
        
        redirect(admin_url('my_team'));
    }
    
    /**
     * View team member details and performance
     */
    public function view_member($staff_id)
    {
        // Kiểm tra quyền xem team member
        if (!has_permission('my_team', '', 'view') && !is_admin()) {
            access_denied('my_team');
        }
        
        $manager_id = get_staff_user_id();
        
        // Check if staff_id is actually managed by current user or is the current user
        if ($staff_id != $manager_id && !$this->my_team_model->is_staff_managed_by($manager_id, $staff_id) && !is_admin()) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team'));
        }
        
        $data['member'] = $this->staff_model->get($staff_id);
        
        if (!$data['member']) {
            show_404();
        }
        
        // Get projects
        $data['projects'] = $this->my_team_model->get_staff_projects($staff_id);
        
        // Get tasks
        $data['tasks'] = $this->tasks_model->get_tasks_by_staff_id($staff_id);
        
        // Get knowledge items read by this staff member
        $data['knowledge_items'] = $this->my_team_model->get_staff_knowledge_items($staff_id);
        
        // Get attitude evaluations
        $data['attitude_evaluations'] = $this->my_team_model->get_staff_attitude_evaluations($staff_id);
        
        $data['title'] = $data['member']->firstname . ' ' . $data['member']->lastname;
        $data['staff_id'] = $staff_id;
        $data['is_manager'] = ($manager_id == $staff_id) || $this->my_team_model->is_staff_managed_by($manager_id, $staff_id) || is_admin();
        
        $this->load->view('my_team/members/view', $data);
    }
    
    /**
     * Approvals main page
     */
    public function approvals($type = 'payment_requests')
    {
        // Tất cả người dùng đều có thể xem trang phê duyệt
        $data['title'] = _l('approvals');
        $data['type'] = $type;
        $staff_id = get_staff_user_id();
        
        // Special handling for admin users
        $is_admin = is_admin($staff_id);
        
        // Check if current staff is a manager
        $team_members = $this->my_team_model->get_staff_members_by_manager($staff_id);
        
        // Kiểm tra quyền phê duyệt
        $can_approve = has_permission('team_approvals', '', 'approve') || $is_admin;
        $has_create_permission = has_permission('my_team', '', 'create');
        $data['is_manager'] = (!empty($team_members) && $can_approve) || $is_admin || $has_create_permission; 
        $data['can_approve'] = $can_approve;
        
        // Kiểm tra quyền xem tất cả các yêu cầu
        $can_view_all = has_permission('team_approvals', '', 'view') || $is_admin;
        
        // For managers and admins - show all team members' approvals
        if ($data['is_manager'] && $can_view_all) {
            $data['approvals'] = $this->my_team_model->get_approvals_by_type($type, $staff_id);
        } else {
            // For staff - show only their approvals
            $data['approvals'] = $this->my_team_model->get_staff_approvals_by_type($type, $staff_id);
        }
        
        $this->load->view('my_team/approvals/manage', $data);
    }
    
    /**
     * Add new approval request
     */
    public function add_approval($type = 'payment_requests')
    {
        // Tất cả người dùng đều có thể tạo yêu cầu phê duyệt
        if ($this->input->post()) {
            $data = $this->input->post();
            $data['staff_id'] = get_staff_user_id();
            $data['type'] = $type;
            // Xử lý data động cho từng loại
            $dynamic_data = [];
            if ($type == 'payment_requests') {
                $dynamic_data['amount'] = $this->input->post('amount');
                $dynamic_data['purpose'] = $this->input->post('purpose');
                $dynamic_data['receiver'] = $this->input->post('receiver');
                // Xử lý file hóa đơn nếu có
                if (!empty($_FILES['invoice']['name'])) {
                    // TODO: Xử lý upload file, lưu đường dẫn vào attachments
                }
                // Điều kiện nhánh: số tiền > 10tr thì cần giám đốc duyệt
                if ((float)$dynamic_data['amount'] > 10000000) {
                    $data['branch_condition'] = 'require_director_approval';
                }
            } elseif ($type == 'leave') {
                $dynamic_data['leave_type'] = $this->input->post('leave_type');
                $dynamic_data['handover_to'] = $this->input->post('handover_to');
                $dynamic_data['reason'] = $this->input->post('reason');
                // Điều kiện nhánh: nếu là sick_leave thì yêu cầu giấy tờ y tế
                if ($dynamic_data['leave_type'] == 'sick_leave') {
                    $data['branch_condition'] = 'require_medical_doc';
                }
            } elseif ($type == 'attendance') {
                $dynamic_data['reason'] = $this->input->post('reason');
                // Xử lý file đính kèm nếu có
                if (!empty($_FILES['file']['name'])) {
                    // TODO: Xử lý upload file, lưu đường dẫn vào attachments
                }
            }
            $data['data'] = $dynamic_data;
            // TODO: Xử lý attachments nếu có
            $result = $this->my_team_model->add_approval($data);
            if ($result) {
                set_alert('success', _l('approval_added_successfully'));
            } else {
                set_alert('danger', _l('approval_add_failed'));
            }
            redirect(admin_url('my_team/approvals/' . $type));
        }
        // Lấy danh sách người phê duyệt (những người có quyền phê duyệt)
        $data['staff'] = [];
        $all_staff = $this->staff_model->get('', ['active' => 1]);
        foreach ($all_staff as $member) {
            if (is_admin($member['staffid']) || has_permission('team_approvals', '', 'approve', $member['staffid'])) {
                $data['staff'][] = $member;
            }
        }
        $data['title'] = _l('add_approval');
        $data['type'] = $type;
        
        $this->load->view('my_team/approvals/add', $data);
    }
    
    /**
     * View approval details
     */
    public function view_approval($id)
    {
        $approval = $this->my_team_model->get_approval($id);
        
        if (!$approval) {
            show_404();
        }
        
        $staff_id = get_staff_user_id();
        
        // Check if user is the approver, the requester, or manages the requester
        if ($approval->approver_id != $staff_id && 
            $approval->staff_id != $staff_id && 
            !$this->my_team_model->is_staff_managed_by($staff_id, $approval->staff_id) && 
            !has_permission('team_approvals', '', 'view') &&
            !is_admin()) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team/approvals'));
        }
        
        $data['approval'] = $approval;
        $data['title'] = _l('approval_details');
        // Chỉ những người có quyền phê duyệt mới có thể phê duyệt
        $data['can_approve'] = (($approval->approver_id == $staff_id || $this->my_team_model->is_staff_managed_by($staff_id, $approval->staff_id)) 
                                && has_permission('team_approvals', '', 'approve')) || is_admin();
        
        $this->load->view('my_team/approvals/view', $data);
    }
    
    /**
     * Change approval status
     */
    public function change_approval_status($id, $status)
    {
        // Kiểm tra quyền phê duyệt
        if (!has_permission('team_approvals', '', 'approve') && !is_admin()) {
            access_denied('team_approvals');
        }
        
        $approval = $this->my_team_model->get_approval($id);
        
        if (!$approval) {
            show_404();
        }
        
        $staff_id = get_staff_user_id();
        
        // Check if user is the approver or manages the requester
        if ($approval->approver_id != $staff_id && !$this->my_team_model->is_staff_managed_by($staff_id, $approval->staff_id) && !is_admin()) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team/approvals'));
        }
        
        $result = $this->my_team_model->change_approval_status($id, $status);
        
        if ($result) {
            set_alert('success', _l('approval_status_changed'));
        } else {
            set_alert('danger', _l('approval_status_change_failed'));
        }
        
        redirect(admin_url('my_team/view_approval/' . $id));
    }
    
    /**
     * Knowledge main page
     */
    public function knowledge()
    {
        $data['title'] = _l('knowledge_items');
        $staff_id = get_staff_user_id();
        
        // Special handling for admin users
        $is_admin = is_admin($staff_id);
        
        // Check if current staff is a manager
        $team_members = $this->my_team_model->get_staff_members_by_manager($staff_id);
        $data['is_manager'] = !empty($team_members) || $is_admin || has_permission('my_team', '', 'create'); // Cập nhật để bao gồm quyền create
        
        if ($data['is_manager']) {
            // Managers can see all knowledge items they created
            $data['knowledge_items'] = $this->my_team_model->get_knowledge_items_by_manager($staff_id);
        } else {
            // Staff can see knowledge items assigned to them
            $data['knowledge_items'] = $this->my_team_model->get_knowledge_items_for_staff($staff_id);
        }
        
        $this->load->view('my_team/knowledge/manage', $data);
    }
    
    /**
     * Add knowledge item
     */
    public function add_knowledge_item()
    {
        if (!has_permission('my_team', '', 'create') && !is_admin()) {
            access_denied('my_team');
        }
        
        if ($this->input->post()) {
            $data = $this->input->post();
            $data['manager_id'] = get_staff_user_id();
            
            $result = $this->my_team_model->add_knowledge_item($data);
            
            if ($result) {
                set_alert('success', _l('knowledge_item_added_successfully'));
            } else {
                set_alert('danger', _l('knowledge_item_add_failed'));
            }
            
            redirect(admin_url('my_team/knowledge'));
        }
        
        $data['title'] = _l('add_knowledge_item');
        $data['team_members'] = $this->my_team_model->get_staff_members_by_manager(get_staff_user_id());
        
        $this->load->view('my_team/knowledge/add', $data);
    }
    
    /**
     * View knowledge item
     */
    public function view_knowledge_item($id)
    {
        $item = $this->my_team_model->get_knowledge_item($id);
        
        if (!$item) {
            show_404();
        }
        
        $staff_id = get_staff_user_id();
        
        // Check if user is the creator or a staff member who can view this
        if ($item->manager_id != $staff_id && !$this->my_team_model->can_view_knowledge_item($staff_id, $id) && !is_admin()) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team/knowledge'));
        }
        
        $data['item'] = $item;
        $data['title'] = $item->title;
        $data['is_manager'] = ($item->manager_id == $staff_id) || is_admin();
        $data['has_read'] = $this->my_team_model->has_read_knowledge_item($staff_id, $id);
        
        // If staff member is accessing and hasn't marked as read yet
        if (!$data['is_manager'] && !$data['has_read']) {
            $data['mark_as_read_url'] = admin_url('my_team/mark_knowledge_read/' . $id);
        }
        
        $this->load->view('my_team/knowledge/view', $data);
    }
    
    /**
     * Mark knowledge item as read
     */
    public function mark_knowledge_read($id)
    {
        $staff_id = get_staff_user_id();
        $result = $this->my_team_model->mark_knowledge_as_read($id, $staff_id);
        
        if ($result) {
            set_alert('success', _l('knowledge_item_marked_as_read'));
        }
        
        redirect(admin_url('my_team/view_knowledge_item/' . $id));
    }
    
    /**
     * Performance main page
     */
    public function performance()
    {
        $data['title'] = _l('performance');
        $staff_id = get_staff_user_id();
        
        // Special handling for admin users
        $is_admin = is_admin($staff_id);
        
        // Load các model cần thiết cho widgets
        $this->load->model('dashboard_model');
        $this->load->model('utilities_model');
        $this->load->model('currencies_model');
        $this->load->model('todo_model');
        $this->load->model('tasks_model');
        $this->load->model('projects_model');
        $this->load->model('tickets_model');
        
        // Get team members
        $team_members = $this->my_team_model->get_team_members();
        
        // Check if current staff is a manager
        $data['is_manager'] = !empty($team_members) || $is_admin || has_permission('my_team', '', 'create');
        
        // Thêm dữ liệu cho widgets của dashboard
        $data['upcoming_events_next_week'] = $this->dashboard_model->get_upcoming_events_next_week();
        $data['upcoming_events'] = $this->dashboard_model->get_upcoming_events();
        $data['google_ids_calendars'] = $this->misc_model->get_google_calendar_ids();
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        
        // Tickets data
        if (is_admin()) {
            $data['tickets_report'] = (new app\services\TicketsReportByStaff())->filterBy('this_month');
        }
        
        // Set up todos
        $data['todos'] = $this->todo_model->get_todo_items(0);
        $this->todo_model->setTodosLimit(5);
        $data['todos_finished'] = $this->todo_model->get_todo_items(1);
        
        // Add calendar assets
        add_calendar_assets();
        
        // Include CI instance for views
        $data['CI'] = &get_instance();
        
        if ($data['is_manager']) {
            // Nếu không có team members và là manager, hiển thị dashboard của bản thân
            if (empty($team_members) && ($is_admin || has_permission('my_team', '', 'create'))) {
                $user = $this->staff_model->get($staff_id);
                $data['user'] = [
                    'staffid' => $user->staffid,
                    'full_name' => $user->firstname . ' ' . $user->lastname,
                    'email' => $user->email
                ];
                $this->load->view('my_team/performance/staff_view', $data);
                return;
            }
            
            // Get performance data for all team members
            $data['team_members'] = $team_members;
            
            // Nếu là manager, hiển thị danh sách các thành viên team
            $this->load->view('my_team/performance/manager_view', $data);
        } else {
            // Get manager
            $manager_id = $this->my_team_model->get_staff_manager($staff_id);
            if ($manager_id) {
                $data['manager'] = $this->staff_model->get($manager_id);
            }
            
            // Chỉ hiển thị dashboard cho người dùng hiện tại
            $user = $this->staff_model->get($staff_id);
            $data['user'] = [
                'staffid' => $user->staffid,
                'full_name' => $user->firstname . ' ' . $user->lastname,
                'email' => $user->email
            ];
            
            $this->load->view('my_team/performance/staff_view', $data);
        }
    }
    
    /**
     * Add attitude evaluation
     */
    public function add_attitude_evaluation($staff_id)
    {
        // Kiểm tra quyền tạo attitude evaluation
        if (!has_permission('my_team', '', 'create') && !is_admin()) {
            access_denied('my_team');
        }
        
        $manager_id = get_staff_user_id();
        
        // Check if staff_id is actually managed by current user
        if (!$this->my_team_model->is_staff_managed_by($manager_id, $staff_id) && !is_admin()) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team/performance'));
        }
        
        if ($this->input->post()) {
            $data = $this->input->post();
            $data['staff_id'] = $staff_id;
            $data['manager_id'] = $manager_id;
            
            $result = $this->my_team_model->add_attitude_evaluation($data);
            
            if ($result) {
                set_alert('success', _l('attitude_evaluation_added_successfully'));
            } else {
                set_alert('danger', _l('attitude_evaluation_add_failed'));
            }
            
            redirect(admin_url('my_team/view_member/' . $staff_id));
        }
        
        $staff = $this->staff_model->get($staff_id);
        
        $data['title'] = _l('add_attitude_evaluation');
        $data['staff_id'] = $staff_id;
        $data['staff_name'] = $staff->firstname . ' ' . $staff->lastname;
        
        $this->load->view('my_team/attitude/add', $data);
    }

    /**
     * Export approvals to CSV
     */
    public function export_approvals($type = 'payment_requests')
    {
        // Chỉ admin hoặc người có quyền xem tất cả mới được export
        if (!has_permission('team_approvals', '', 'view') && !is_admin()) {
            access_denied('team_approvals');
        }
        $staff_id = get_staff_user_id();
        $is_admin = is_admin($staff_id);
        $can_view_all = has_permission('team_approvals', '', 'view') || $is_admin;
        if ($can_view_all) {
            $approvals = $this->my_team_model->get_approvals_by_type($type, $staff_id);
        } else {
            $approvals = $this->my_team_model->get_staff_approvals_by_type($type, $staff_id);
        }
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=approvals_' . $type . '_' . date('Ymd_His') . '.csv');
        $output = fopen('php://output', 'w');
        // Header
        $header = ['ID', 'Người gửi', 'Người duyệt', 'Tiêu đề', 'Trạng thái', 'Ngày tạo', 'Ngày duyệt', 'Dữ liệu động'];
        fputcsv($output, $header);
        foreach ($approvals as $approval) {
            $row = [
                $approval['id'],
                $approval['staff_name'],
                isset($approval['approver_name']) ? $approval['approver_name'] : '',
                $approval['subject'],
                $approval['status'],
                $approval['datecreated'],
                $approval['date_approved'],
                $approval['data']
            ];
            fputcsv($output, $row);
        }
        fclose($output);
        exit;
    }

    /**
     * Báo cáo tổng hợp approval
     */
    public function approvals_report($type = 'payment_requests')
    {
        if (!has_permission('team_approvals', '', 'view') && !is_admin()) {
            access_denied('team_approvals');
        }
        $staff_id = get_staff_user_id();
        $is_admin = is_admin($staff_id);
        $can_view_all = has_permission('team_approvals', '', 'view') || $is_admin;
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        if ($can_view_all) {
            $approvals = $this->my_team_model->get_approvals_by_type($type, $staff_id);
        } else {
            $approvals = $this->my_team_model->get_staff_approvals_by_type($type, $staff_id);
        }
        // Lọc theo ngày nếu có
        if ($start_date || $end_date) {
            $approvals = array_filter($approvals, function($a) use ($start_date, $end_date) {
                $date = $a['datecreated'];
                if ($start_date && $date < $start_date) return false;
                if ($end_date && $date > $end_date) return false;
                return true;
            });
        }
        $report = [];
        if ($type == 'payment_requests') {
            $total = 0;
            foreach ($approvals as $a) {
                $data = json_decode($a['data'], true);
                if (isset($data['amount'])) {
                    $total += (float)$data['amount'];
                }
            }
            $report['total_amount'] = $total;
            $report['count'] = count($approvals);
        } elseif ($type == 'leave') {
            $report['count'] = count($approvals);
            // Có thể tính tổng ngày nghỉ nếu có trường ngày bắt đầu/kết thúc
        } elseif ($type == 'attendance') {
            $report['count'] = count($approvals);
        }
        $data['report'] = $report;
        $data['type'] = $type;
        $data['approvals'] = $approvals;
        $data['title'] = 'Báo cáo phê duyệt';
        $this->load->view('my_team/approvals/report', $data);
    }

    /**
     * API: Lấy danh sách quy tắc phê duyệt
     */
    public function rules_list()
    {
        if (!is_admin()) {
            access_denied('approval_rules');
        }
        $form_type = $this->input->get('form_type');
        $rules = $this->my_team_model->get_approval_rules($form_type);
        echo json_encode(['success' => true, 'rules' => $rules]);
        exit;
    }

    /**
     * API: Thêm quy tắc phê duyệt
     */
    public function add_rule()
    {
        if (!is_admin()) {
            access_denied('approval_rules');
        }
        $data = $this->input->post();
        $id = $this->my_team_model->add_approval_rule($data);
        echo json_encode(['success' => $id ? true : false, 'id' => $id]);
        exit;
    }

    /**
     * API: Sửa quy tắc phê duyệt
     */
    public function update_rule($id)
    {
        if (!is_admin()) {
            access_denied('approval_rules');
        }
        $data = $this->input->post();
        $ok = $this->my_team_model->update_approval_rule($id, $data);
        echo json_encode(['success' => $ok]);
        exit;
    }

    /**
     * API: Xóa quy tắc phê duyệt
     */
    public function delete_rule($id)
    {
        if (!is_admin()) {
            access_denied('approval_rules');
        }
        $ok = $this->my_team_model->delete_approval_rule($id);
        echo json_encode(['success' => $ok]);
        exit;
    }
} 