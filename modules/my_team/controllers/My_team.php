<?php

defined('BASEPATH') or exit('No direct script access allowed');

class My_team extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('my_team_model');
        $this->load->model('my_team_workflow_model');
        $this->load->library('form_validation');
    }
    
    /**
     * Dashboard tổng quan của module
     * @return void
     */
    public function index()
    {
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        $data = [];
        $data['title'] = _l('my_team_dashboard');
        
        // Lấy thống kê nhân viên sử dụng count_all_results thay vì get_total_staff_count
        $this->load->model('staff_model');
        $data['total_staff'] = $this->db->count_all_results(db_prefix() . 'staff');
        
        $this->db->where('active', 1);
        $data['active_staff'] = $this->db->count_all_results(db_prefix() . 'staff');
        
        // Lấy thống kê phê duyệt
        $data['total_approvals'] = count($this->my_team_model->get_approvals());
        $data['pending_approvals'] = count($this->my_team_model->get_approvals(['status' => 0]));
        
        // Lấy thống kê kiến thức
        $data['knowledge_items'] = count($this->my_team_model->get_knowledge_items());
        $data['knowledge_categories'] = count($this->my_team_model->get_knowledge_categories());
        
        // Lấy thống kê dự án và task đang hoạt động
        $this->db->where('status', 2); // Giả sử 2 là trạng thái đang tiến hành
        $data['active_projects'] = $this->db->count_all_results(db_prefix() . 'projects');
        
        $this->db->where('status !=', 5); // Giả sử 5 là trạng thái hoàn thành
        $data['active_tasks'] = $this->db->count_all_results(db_prefix() . 'tasks');
        
        // Lấy các hoạt động gần đây
        $this->db->limit(10);
        $this->db->order_by('date', 'desc');
        $this->db->select('date, staff_id, description');
        $activities = $this->db->get(db_prefix() . 'activity_log')->result_array();
        
        // Thêm tên nhân viên vào hoạt động
        foreach ($activities as &$activity) {
            $staff = $this->staff_model->get($activity['staff_id']);
            if ($staff) {
                $activity['full_name'] = $staff->firstname . ' ' . $staff->lastname;
            } else {
                $activity['full_name'] = 'Unknown';
            }
        }
        
        $data['recent_activities'] = $activities;
        
        // Lấy các phê duyệt gần đây
        $this->db->limit(10);
        $this->db->order_by('created_date', 'desc');
        $data['recent_approvals'] = $this->my_team_model->get_approvals();
        
        // Lấy các knowledge item gần đây
        $this->db->limit(10);
        $this->db->order_by('created_date', 'desc');
        $data['recent_knowledge'] = $this->my_team_model->get_knowledge_items();
        
        // Lấy thông tin các phòng ban
        $this->load->model('departments_model');
        $departments = $this->departments_model->get();
        
        // Thêm thông tin thống kê cho mỗi phòng ban
        foreach ($departments as &$department) {
            // Đếm số nhân viên trong phòng ban
            $this->db->where('departmentid', $department['departmentid']);
            $department['staff_count'] = $this->db->count_all_results(db_prefix() . 'staff');
            
            // Đếm số dự án và công việc
            $department['projects_count'] = 0;
            $department['tasks_count'] = 0;
            
            $department_staff = $this->staff_model->get('', ['active' => 1, 'departmentid' => $department['departmentid']]);
            
            foreach ($department_staff as $staff) {
                // Dự án
                $this->db->where('id IN (SELECT project_id FROM ' . db_prefix() . 'project_members WHERE staff_id = ' . $staff['staffid'] . ')');
                $department['projects_count'] += $this->db->count_all_results(db_prefix() . 'projects');
                
                // Công việc
                $this->db->where('id IN (SELECT taskid FROM ' . db_prefix() . 'task_assigned WHERE staffid = ' . $staff['staffid'] . ')');
                $department['tasks_count'] += $this->db->count_all_results(db_prefix() . 'tasks');
            }
        }
        
        $data['departments'] = $departments;
        
        $this->load->view('my_team/dashboard', $data);
    }

    /* Phần phê duyệt */
    
    /**
     * Trang quản lý phê duyệt
     * @return void
     */
    public function approvals()
    {
        if (!staff_can('view', 'my_team')) {
            access_denied('my_team');
        }

        try {
            // Kiểm tra xem bảng có tồn tại không
            if (!$this->db->table_exists(db_prefix() . 'my_team_approvals')) {
                $data['table_not_exists'] = true;
                $data['setup_url'] = admin_url('my_team/setup_tables');
                
                // Giá trị mặc định khi bảng chưa tồn tại
                $data['approvals'] = [];
                $data['total_approvals'] = 0;
                $data['pending_approvals'] = 0;
                $data['approved_count'] = 0;
                $data['rejected_count'] = 0;
                $data['cancelled_count'] = 0;
                $data['total_pending'] = 0;
                $data['total_approved'] = 0;
                $data['total_rejected'] = 0;
                $data['total_cancelled'] = 0;
            } else {
                $data['table_not_exists'] = false;
                
                // Lấy danh sách approvals với filter
                $where = [];
                
                // Filter theo status
                if ($this->input->get('status') !== null && $this->input->get('status') !== '') {
                    $where['status'] = $this->input->get('status');
                }
                
                // Filter theo loại approval
                if ($this->input->get('type') && $this->input->get('type') != '') {
                    $where['approval_type'] = $this->input->get('type');
                }
                
                // Filter theo staff (chỉ admin mới thấy tất cả)
                if (!is_admin()) {
                    $where['staff_id'] = get_staff_user_id();
                }
                
                // Filter theo department
                if ($this->input->get('department') && $this->input->get('department') != '') {
                    $where['department_id'] = $this->input->get('department');
                }
                
                // Filter theo thời gian
                if ($this->input->get('date_from') !== null && $this->input->get('date_from') !== '') {
                    $date_from = to_sql_date($this->input->get('date_from'));
                    $where['created_date >='] = $date_from . ' 00:00:00';
                }
                
                if ($this->input->get('date_to') !== null && $this->input->get('date_to') !== '') {
                    $date_to = to_sql_date($this->input->get('date_to'));
                    $where['created_date <='] = $date_to . ' 23:59:59';
                }
                
                $data['approvals'] = $this->my_team_model->get_approvals($where);
                
                // Thống kê nhanh
                $data['total_approvals'] = count($this->my_team_model->get_approvals([]));
                $data['pending_approvals'] = count($this->my_team_model->get_approvals(['status' => 0]));
                $data['approved_count'] = count($this->my_team_model->get_approvals(['status' => 1]));
                $data['rejected_count'] = count($this->my_team_model->get_approvals(['status' => 2]));
                
                // Thêm các biến cho stats widget
                $data['total_pending'] = $data['pending_approvals'];
                $data['total_approved'] = $data['approved_count'];
                $data['total_rejected'] = $data['rejected_count'];
                
                // Thống kê cancelled
                $data['cancelled_count'] = count($this->my_team_model->get_approvals(['status' => 3]));
                $data['total_cancelled'] = $data['cancelled_count'];
            }
            
        } catch (Exception $e) {
            $data['table_not_exists'] = true;
            $data['error'] = $e->getMessage();
            $data['setup_url'] = admin_url('my_team/setup_tables');
            
            // Giá trị mặc định khi bảng chưa tồn tại
            $data['approvals'] = [];
            $data['total_approvals'] = 0;
            $data['pending_approvals'] = 0;
            $data['approved_count'] = 0;
            $data['rejected_count'] = 0;
            $data['cancelled_count'] = 0;
            $data['total_pending'] = 0;
            $data['total_approved'] = 0;
            $data['total_rejected'] = 0;
            $data['total_cancelled'] = 0;
        }

        // Load dependencies
        $this->load->model('departments_model');
        $data['departments'] = $this->departments_model->get();
        
        // Thêm biến base_currency để tránh lỗi
        $this->load->model('currencies_model');
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        
        // Nếu không có tiền tệ mặc định, tạo một đối tượng giả lập để tránh lỗi
        if (!$data['base_currency']) {
            $data['base_currency'] = new stdClass();
            $data['base_currency']->id = 1;
            $data['base_currency']->name = 'VND';
            $data['base_currency']->symbol = '₫';
            $data['base_currency']->placement = 'after';
        }
        
        $data['title'] = _l('my_team_approvals');
        $data['approval_types'] = ['general', 'leave', 'payment', 'travel', 'expense', 'other'];
        
        $this->load->view('my_team/approvals/manage', $data);
    }
    
    /**
     * Trang thêm/chỉnh sửa phê duyệt
     * @param int $id ID của phê duyệt (nếu chỉnh sửa)
     * @return void
     */
    public function approval($id = '')
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        // Nếu có ID thì chỉnh sửa, nếu không thì chuyển đến trang chọn loại
        if ($id) {
            $approval = $this->my_team_model->get_approval($id);
            
            if (!$approval) {
                set_alert('danger', _l('approval_not_found'));
                redirect(admin_url('my_team/approvals'));
            }
            
            // Kiểm tra quyền chỉnh sửa
            if ($approval->staff_id != get_staff_user_id() && !is_admin()) {
                set_alert('danger', _l('access_denied'));
                redirect(admin_url('my_team/approvals'));
            }
            
            // Chỉ cho phép chỉnh sửa nếu chưa được phê duyệt/từ chối
            if ($approval->status != 0) {
                set_alert('warning', _l('cannot_edit_processed_approval'));
                redirect(admin_url('my_team/view_approval/' . $id));
            }
            
            // Chuyển hướng đến trang chỉnh sửa phù hợp với loại approval
            switch ($approval->approval_type) {
                case 'payment':
                case 'financial':
                    redirect(admin_url('my_team/approval_payment/' . $id));
                    break;
                case 'leave':
                    redirect(admin_url('my_team/approval_leave/' . $id));
                    break;
                default:
                    // Fallback to old method for other types
                    $this->_load_old_approval_form($id);
                    break;
            }
        } else {
            // Chuyển đến trang chọn loại approval
            $data = [];
            $data['title'] = _l('select_approval_type');
            $this->load->view('my_team/approvals/select_type', $data);
        }
    }
    
    /**
     * Trang tạo/chỉnh sửa approval thanh toán
     * @param int $id ID của approval (nếu chỉnh sửa)
     * @return void
     */
    public function approval_payment($id = '')
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        $data = [];
        
        if ($id) {
            $approval = $this->my_team_model->get_approval($id);
            
            if (!$approval) {
                set_alert('danger', _l('approval_not_found'));
                redirect(admin_url('my_team/approvals'));
            }
            
            // Kiểm tra quyền chỉnh sửa
            if ($approval->staff_id != get_staff_user_id() && !is_admin()) {
                set_alert('danger', _l('access_denied'));
                redirect(admin_url('my_team/approvals'));
            }
            
            // Chỉ cho phép chỉnh sửa nếu chưa được phê duyệt/từ chối
            if ($approval->status != 0) {
                set_alert('warning', _l('cannot_edit_processed_approval'));
                redirect(admin_url('my_team/view_approval/' . $id));
            }
            
            // Xử lý json_data
            if ($approval->json_data) {
                $json_data = json_decode($approval->json_data, true);
                $data['json_data'] = $json_data;
            }
            
            $data['approval'] = $approval;
            $data['title'] = _l('edit_payment_approval');
        } else {
            $data['title'] = _l('create_payment_approval');
        }
        
        // Xử lý POST request
        if ($this->input->post()) {
            $success = $this->_handle_payment_approval_post($id);
            if ($success) {
                $message = $id ? _l('payment_approval_updated_successfully') : _l('payment_approval_created_successfully');
                set_alert('success', $message);
                redirect(admin_url('my_team/approvals'));
            }
        }
        
        // Lấy danh sách phòng ban
        $this->load->model('departments_model');
        $data['departments'] = $this->departments_model->get();
        
        // Nếu không có departments, tạo mảng rỗng để tránh lỗi
        if (!$data['departments']) {
            $data['departments'] = [];
        }
        
        // Lấy thông tin tiền tệ mặc định
        $this->load->model('currencies_model');
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        
        // Nếu không có tiền tệ mặc định, tạo một đối tượng giả lập để tránh lỗi
        if (!$data['base_currency']) {
            $data['base_currency'] = new stdClass();
            $data['base_currency']->symbol = '$';
        }
        
        $this->load->view('my_team/approvals/payment', $data);
    }
    
    /**
     * Trang tạo/chỉnh sửa approval nghỉ phép
     * @param int $id ID của approval (nếu chỉnh sửa)
     * @return void
     */
    public function approval_leave($id = '')
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        $data = [];
        
        if ($id) {
            $approval = $this->my_team_model->get_approval($id);
            
            if (!$approval) {
                set_alert('danger', _l('approval_not_found'));
                redirect(admin_url('my_team/approvals'));
            }
            
            // Kiểm tra quyền chỉnh sửa
            if ($approval->staff_id != get_staff_user_id() && !is_admin()) {
                set_alert('danger', _l('access_denied'));
                redirect(admin_url('my_team/approvals'));
            }
            
            // Chỉ cho phép chỉnh sửa nếu chưa được phê duyệt/từ chối
            if ($approval->status != 0) {
                set_alert('warning', _l('cannot_edit_processed_approval'));
                redirect(admin_url('my_team/view_approval/' . $id));
            }
            
            // Xử lý json_data
            if ($approval->json_data) {
                $json_data = json_decode($approval->json_data, true);
                $data['json_data'] = $json_data;
            }
            
            $data['approval'] = $approval;
            $data['title'] = _l('edit_leave_approval');
        } else {
            $data['title'] = _l('create_leave_approval');
        }
        
        // Xử lý POST request
        if ($this->input->post()) {
            $success = $this->_handle_leave_approval_post($id);
            if ($success) {
                $message = $id ? _l('leave_approval_updated_successfully') : _l('leave_approval_created_successfully');
                set_alert('success', $message);
                redirect(admin_url('my_team/approvals'));
            }
        }
        
        // Lấy danh sách phòng ban
        $this->load->model('departments_model');
        $data['departments'] = $this->departments_model->get();
        
        // Nếu không có departments, tạo mảng rỗng để tránh lỗi
        if (!$data['departments']) {
            $data['departments'] = [];
        }
        
        // Lấy danh sách nhân viên để chọn người thay thế
        $this->load->model('staff_model');
        $data['staff_members'] = $this->staff_model->get('', ['active' => 1]);
        
        $this->load->view('my_team/approvals/leave', $data);
    }
    
    /**
     * Xem chi tiết phê duyệt
     * @param  int $id ID của phê duyệt
     * @return void
     */
    public function view_approval($id)
    {
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        $approval = $this->my_team_model->get_approval($id);
        
        if (!$approval) {
            set_alert('danger', _l('approval_not_found'));
            redirect(admin_url('my_team/approvals'));
        }
        
        // Kiểm tra quyền xem
        if ($approval->staff_id != get_staff_user_id() && !is_admin()) {
            // Kiểm tra xem người dùng có phải là quản lý phòng ban không
            $this->load->model('departments_model');
            $staff_departments = $this->departments_model->get_staff_departments(get_staff_user_id());
            
            $has_permission = false;
            foreach ($staff_departments as $department) {
                if ($department['departmentid'] == $approval->department_id) {
                    $has_permission = true;
                    break;
                }
            }
            
            if (!$has_permission) {
                set_alert('danger', _l('access_denied'));
                redirect(admin_url('my_team/approvals'));
            }
        }
        
        $data['approval'] = $approval;
        $data['title'] = _l('approval_view');
        
        // Lấy thông tin staff
        $this->load->model('staff_model');
        $data['staff'] = $this->staff_model->get($approval->staff_id);
        
        // Lấy thông tin người phê duyệt/từ chối
        if ($approval->approved_by) {
            $data['approver'] = $this->staff_model->get($approval->approved_by);
        }
        
        if ($approval->rejected_by) {
            $data['rejecter'] = $this->staff_model->get($approval->rejected_by);
        }
        
        // Lấy thông tin phòng ban
        if ($approval->department_id) {
            $this->load->model('departments_model');
            $data['department'] = $this->departments_model->get($approval->department_id);
        }
        
        // Xử lý dữ liệu JSON
        if ($approval->json_data) {
            $data['json_data'] = json_decode($approval->json_data, true);
        } else {
            $data['json_data'] = [];
        }
        
        // Thêm biến base_currency để tránh lỗi
        $this->load->model('currencies_model');
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        
        // Nếu không có tiền tệ mặc định, tạo một đối tượng giả lập để tránh lỗi
        if (!$data['base_currency']) {
            $data['base_currency'] = new stdClass();
            $data['base_currency']->id = 1;
            $data['base_currency']->name = 'VND';
            $data['base_currency']->symbol = '₫';
            $data['base_currency']->placement = 'after';
            $data['base_currency']->decimal_separator = ',';
            $data['base_currency']->thousand_separator = '.';
        }
        
        // Xử lý dữ liệu đặc biệt cho từng loại approval
        if ($approval->approval_type == 'leave' && !empty($data['json_data'])) {
            // Đảm bảo có đủ dữ liệu cho leave approval
            if (!isset($data['json_data']['total_days'])) {
                // Tính số ngày nghỉ từ date_from và date_to
                if ($approval->date_from && $approval->date_to) {
                    $start_date = new DateTime($approval->date_from);
                    $end_date = new DateTime($approval->date_to);
                    $interval = $start_date->diff($end_date);
                    $data['json_data']['total_days'] = $interval->days + 1; // +1 để bao gồm cả ngày cuối
                } else {
                    $data['json_data']['total_days'] = 0;
                }
            }
            
            // Đảm bảo có leave_type
            if (!isset($data['json_data']['leave_type'])) {
                $data['json_data']['leave_type'] = 'annual';
            }
        }
        
        // Xử lý dữ liệu cho financial approval
        if (in_array($approval->approval_type, ['financial', 'payment']) && !empty($data['json_data'])) {
            // Đảm bảo có amount trong json_data
            if (!isset($data['json_data']['amount'])) {
                $data['json_data']['amount'] = $approval->amount;
            }
        }
        
        $this->load->view('my_team/approvals/view', $data);
    }
    
    /**
     * Phê duyệt yêu cầu
     * @param  int $id ID của phê duyệt
     * @return void
     */
    public function approve($id)
    {
        if (!staff_can('edit', 'my_team')) {
            access_denied('My Team');
        }
        
        $success = $this->my_team_model->approve_approval($id);
        
        if ($success) {
            set_alert('success', _l('approval_approved_successfully'));
        } else {
            set_alert('danger', _l('approval_approval_failed'));
        }
        
        redirect(admin_url('my_team/view_approval/' . $id));
    }
    
    /**
     * Từ chối yêu cầu
     * @return void
     */
    public function reject()
    {
        if (!staff_can('edit', 'my_team')) {
            access_denied('My Team');
        }
        
        $id = $this->input->post('id');
        $reason = $this->input->post('reason');
        
        if (!$id || !$reason) {
            set_alert('danger', _l('approval_rejection_failed'));
            redirect(admin_url('my_team/approvals'));
        }
        
        $success = $this->my_team_model->reject_approval($id, $reason);
        
        if ($success) {
            set_alert('success', _l('approval_rejected_successfully'));
        } else {
            set_alert('danger', _l('approval_rejection_failed'));
        }
        
        redirect(admin_url('my_team/view_approval/' . $id));
    }
    
    /**
     * Hủy yêu cầu
     * @param  int $id ID của phê duyệt
     * @return void
     */
    public function cancel($id)
    {
        $approval = $this->my_team_model->get_approval($id);
        
        if (!$approval || ($approval->staff_id != get_staff_user_id() && !is_admin())) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team/approvals'));
        }
        
        $success = $this->my_team_model->cancel_approval($id);
        
        if ($success) {
            set_alert('success', _l('approval_cancelled_successfully'));
        } else {
            set_alert('danger', _l('approval_cancellation_failed'));
        }
        
        redirect(admin_url('my_team/view_approval/' . $id));
    }
    
    /**
     * Báo cáo phê duyệt
     * @return void
     */
    public function report()
    {
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        $data = [];
        $data['title'] = _l('approval_report');
        
        try {
            // Kiểm tra xem bảng my_team_approvals có tồn tại không
            if (!$this->db->table_exists(db_prefix() . 'my_team_approvals')) {
                $data['table_not_exists'] = true;
                $data['setup_url'] = admin_url('my_team/setup_tables');
                $data['approvals'] = [];
                $data['departments'] = [];
                $data['staff_members'] = [];
                
                $this->load->view('my_team/approvals/report', $data);
                return;
            }
            
            // Xử lý lọc
            $where = [];
            
            if ($this->input->get('status') !== null && $this->input->get('status') !== '') {
                $where['status'] = $this->input->get('status');
            }
            
            if ($this->input->get('approval_type') !== null && $this->input->get('approval_type') !== '') {
                $where['approval_type'] = $this->input->get('approval_type');
            }
            
            if ($this->input->get('department_id') !== null && $this->input->get('department_id') !== '') {
                $where['department_id'] = $this->input->get('department_id');
            }
            
            if ($this->input->get('staff_id') !== null && $this->input->get('staff_id') !== '') {
                $where['staff_id'] = $this->input->get('staff_id');
            }
            
            if ($this->input->get('date_from') !== null && $this->input->get('date_from') !== '') {
                $date_from = to_sql_date($this->input->get('date_from'));
                $where['created_date >='] = $date_from . ' 00:00:00';
            }
            
            if ($this->input->get('date_to') !== null && $this->input->get('date_to') !== '') {
                $date_to = to_sql_date($this->input->get('date_to'));
                $where['created_date <='] = $date_to . ' 23:59:59';
            }
            
            // Lấy dữ liệu báo cáo
            $data['approvals'] = [];
            
            if (is_admin()) {
                $data['approvals'] = $this->my_team_model->get_approvals_report($where);
            } else {
                // Staff bình thường chỉ xem báo cáo của bản thân
                $where['staff_id'] = get_staff_user_id();
                $data['approvals'] = $this->my_team_model->get_approvals_report($where);
                
                // Manager xem thêm của phòng ban mình quản lý
                if (staff_can('view', 'my_team')) {
                    $this->load->model('departments_model');
                    $staff_departments = $this->departments_model->get_staff_departments(get_staff_user_id());
                    
                    if (!empty($staff_departments)) {
                        $dept_where = $where;
                        unset($dept_where['staff_id']);
                        
                        $department_ids = [];
                        foreach ($staff_departments as $department) {
                            $department_ids[] = $department['departmentid'];
                        }
                        
                        if (!empty($department_ids)) {
                            $dept_where['department_id'] = $department_ids;
                            $department_approvals = $this->my_team_model->get_approvals_report($dept_where);
                            
                            // Gộp danh sách và loại bỏ trùng lặp
                            if (!empty($department_approvals)) {
                                $merged_approvals = array_merge($data['approvals'], $department_approvals);
                                $unique_approvals = [];
                                $added_ids = [];
                                
                                foreach ($merged_approvals as $approval) {
                                    if (!in_array($approval['id'], $added_ids)) {
                                        $added_ids[] = $approval['id'];
                                        $unique_approvals[] = $approval;
                                    }
                                }
                                
                                $data['approvals'] = $unique_approvals;
                            }
                        }
                    }
                }
            }
            
            // Chuẩn bị dữ liệu cho bộ lọc
            $this->load->model('departments_model');
            $this->load->model('staff_model');
            
            $data['departments'] = $this->departments_model->get();
            $data['staff_members'] = $this->staff_model->get('', ['active' => 1]);
            
            // Đảm bảo không bị null
            if (!$data['departments']) {
                $data['departments'] = [];
            }
            if (!$data['staff_members']) {
                $data['staff_members'] = [];
            }
            
            $data['table_not_exists'] = false;
            
        } catch (Exception $e) {
            log_message('error', 'Error in approval report: ' . $e->getMessage());
            $data['table_not_exists'] = true;
            $data['setup_url'] = admin_url('my_team/setup_tables');
            $data['approvals'] = [];
            $data['departments'] = [];
            $data['staff_members'] = [];
            $data['error_message'] = 'Có lỗi xảy ra khi tải báo cáo. Vui lòng kiểm tra cấu hình database.';
        }
        
        $this->load->view('my_team/approvals/report', $data);
    }
    
    /**
     * Xuất báo cáo ra CSV
     * @return void
     */
    public function export_csv()
    {
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        try {
            // Kiểm tra xem bảng my_team_approvals có tồn tại không
            if (!$this->db->table_exists(db_prefix() . 'my_team_approvals')) {
                set_alert('danger', 'Bảng dữ liệu chưa được thiết lập. Vui lòng thiết lập database trước.');
                redirect(admin_url('my_team/setup_tables'));
                return;
            }
            
            // Xử lý lọc
            $where = [];
            
            if ($this->input->get('status') !== null && $this->input->get('status') !== '') {
                $where['status'] = $this->input->get('status');
            }
            
            if ($this->input->get('approval_type') !== null && $this->input->get('approval_type') !== '') {
                $where['approval_type'] = $this->input->get('approval_type');
            }
            
            if ($this->input->get('department_id') !== null && $this->input->get('department_id') !== '') {
                $where['department_id'] = $this->input->get('department_id');
            }
            
            if ($this->input->get('staff_id') !== null && $this->input->get('staff_id') !== '') {
                $where['staff_id'] = $this->input->get('staff_id');
            }
            
            if ($this->input->get('date_from') !== null && $this->input->get('date_from') !== '') {
                $date_from = to_sql_date($this->input->get('date_from'));
                $where['created_date >='] = $date_from . ' 00:00:00';
            }
            
            if ($this->input->get('date_to') !== null && $this->input->get('date_to') !== '') {
                $date_to = to_sql_date($this->input->get('date_to'));
                $where['created_date <='] = $date_to . ' 23:59:59';
            }
            
            // Lấy dữ liệu báo cáo
            $approvals = [];
            
            if (is_admin()) {
                $approvals = $this->my_team_model->get_approvals_report($where);
            } else {
                // Staff bình thường chỉ xem báo cáo của bản thân
                $where['staff_id'] = get_staff_user_id();
                $approvals = $this->my_team_model->get_approvals_report($where);
                
                // Manager xem thêm của phòng ban mình quản lý
                if (staff_can('view', 'my_team')) {
                    $this->load->model('departments_model');
                    $staff_departments = $this->departments_model->get_staff_departments(get_staff_user_id());
                    
                    if (!empty($staff_departments)) {
                        $dept_where = $where;
                        unset($dept_where['staff_id']);
                        
                        $department_ids = [];
                        foreach ($staff_departments as $department) {
                            $department_ids[] = $department['departmentid'];
                        }
                        
                        if (!empty($department_ids)) {
                            $dept_where['department_id'] = $department_ids;
                            $department_approvals = $this->my_team_model->get_approvals_report($dept_where);
                            
                            // Gộp danh sách và loại bỏ trùng lặp
                            if (!empty($department_approvals)) {
                                $merged_approvals = array_merge($approvals, $department_approvals);
                                $unique_approvals = [];
                                $added_ids = [];
                                
                                foreach ($merged_approvals as $approval) {
                                    if (!in_array($approval['id'], $added_ids)) {
                                        $added_ids[] = $approval['id'];
                                        $unique_approvals[] = $approval;
                                    }
                                }
                                
                                $approvals = $unique_approvals;
                            }
                        }
                    }
                }
            }
            
            // Tạo CSV
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=approvals_report_' . date('Y-m-d') . '.csv');
            
            $output = fopen('php://output', 'w');
            
            // UTF-8 BOM for Excel
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Tiêu đề cột
            fputcsv($output, [
                _l('id'),
                _l('general_subject'),
                _l('general_staff'),
                _l('general_department'),
                _l('approval_type'),
                _l('approval_status'),
                _l('general_amount'),
                _l('approval_date_from'),
                _l('approval_date_to'),
                _l('approval_approved_by'),
                _l('approval_approved_date'),
                _l('approval_rejected_by'),
                _l('approval_rejected_date'),
                _l('approval_rejected_reason'),
                _l('approval_created_date')
            ]);
            
            // Dữ liệu
            foreach ($approvals as $approval) {
                $status = '';
                switch ($approval['status']) {
                    case 0:
                        $status = _l('approval_status_pending');
                        break;
                    case 1:
                        $status = _l('approval_status_approved');
                        break;
                    case 2:
                        $status = _l('approval_status_rejected');
                        break;
                    case 3:
                        $status = _l('approval_status_cancelled');
                        break;
                }
                
                $staff_name = isset($approval['firstname']) ? $approval['firstname'] . ' ' . $approval['lastname'] : '';
                $approver_name = isset($approval['approver_firstname']) ? $approval['approver_firstname'] . ' ' . $approval['approver_lastname'] : '';
                $rejecter_name = isset($approval['rejecter_firstname']) ? $approval['rejecter_firstname'] . ' ' . $approval['rejecter_lastname'] : '';
                
                fputcsv($output, [
                    $approval['id'],
                    $approval['subject'],
                    $staff_name,
                    $approval['department_name'],
                    _l('approval_type_' . $approval['approval_type']),
                    $status,
                    $approval['amount'],
                    $approval['date_from'],
                    $approval['date_to'],
                    $approver_name,
                    $approval['approved_date'],
                    $rejecter_name,
                    $approval['rejected_date'],
                    $approval['rejected_reason'],
                    $approval['created_date']
                ]);
            }
            
            fclose($output);
            exit;
        } catch (Exception $e) {
            log_message('error', 'Error exporting CSV: ' . $e->getMessage());
            set_alert('danger', 'Có lỗi xảy ra khi xuất báo cáo CSV. Vui lòng kiểm tra lỗi.');
            redirect(admin_url('my_team/approvals'));
        }
    }
    
    /* Phần hiệu suất */
    
    /**
     * Trang hiệu suất
     * @return void
     */
    public function performance()
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        $data = [];
        $data['title'] = _l('team_performance');
        
        // Lấy thông tin filter
        $staff_id = $this->input->get('staff_id');
        if (!$staff_id) {
            $staff_id = get_staff_user_id();
        }
        
        $period = $this->input->get('period');
        if (!$period) {
            $period = 'this_month';
        }
        
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');
        
        if ($period == 'custom' && (!$date_from || !$date_to)) {
            $period = 'this_month';
        }
        
        // Xử lý thời gian
        switch ($period) {
            case 'this_month':
                $date_from = date('Y-m-01');
                $date_to = date('Y-m-t');
                break;
            case 'last_month':
                $date_from = date('Y-m-01', strtotime('-1 month'));
                $date_to = date('Y-m-t', strtotime('-1 month'));
                break;
            case 'this_year':
                $date_from = date('Y-01-01');
                $date_to = date('Y-12-31');
                break;
            case 'last_year':
                $date_from = date('Y-01-01', strtotime('-1 year'));
                $date_to = date('Y-12-31', strtotime('-1 year'));
                break;
            case 'custom':
                $date_from = to_sql_date($date_from);
                $date_to = to_sql_date($date_to);
                break;
        }
        
        $data['staff_id'] = $staff_id;
        $data['period'] = $period;
        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;
        
        // Lấy danh sách nhân viên
        $this->load->model('staff_model');
        
        if (has_permission('my_team', '', 'view') || is_admin()) {
            // Admin hoặc người có quyền xem toàn bộ
            $data['staff_members'] = $this->staff_model->get('', ['active' => 1]);
        } else {
            // Quản lý chỉ xem phòng ban của mình
            $this->load->model('departments_model');
            $staff_departments = $this->departments_model->get_staff_departments(get_staff_user_id());
            
            $department_ids = [];
            foreach ($staff_departments as $department) {
                $department_ids[] = $department['departmentid'];
            }
            
            if (!empty($department_ids)) {
                $data['staff_members'] = $this->staff_model->get('', ['active' => 1, 'where_in' => ['departmentid', $department_ids]]);
            } else {
                // Nếu không quản lý phòng ban nào thì chỉ xem của chính mình
                $data['staff_members'] = [$this->staff_model->get(get_staff_user_id())];
            }
        }
        
        // Lấy hiệu suất của nhân viên được chọn
        try {
            $data['performance'] = $this->my_team_model->get_staff_performance($staff_id, $date_from, $date_to);
        } catch (Exception $e) {
            // Nếu bảng attendance_records chưa tồn tại, trả về mẫu dữ liệu mặc định
            $data['performance'] = [
                'tasks' => $this->get_default_tasks_performance(),
                'projects' => $this->get_default_projects_performance(),
                'tickets' => $this->get_default_tickets_performance(),
                'attendance' => $this->get_default_attendance_performance()
            ];
        }
        
        $this->load->view('admin/my_team/performance', $data);
    }
    
    /**
     * Trả về dữ liệu mặc định cho phần tasks performance khi không có dữ liệu thực
     * @return array
     */
    private function get_default_tasks_performance() 
    {
        return [
            'total' => 0,
            'completed' => 0,
            'in_progress' => 0,
            'not_started' => 0,
            'completion_rate' => 0,
            'monthly_stats' => [
                date('F Y') => [
                    'assigned' => 0,
                    'completed' => 0
                ]
            ]
        ];
    }
    
    /**
     * Trả về dữ liệu mặc định cho phần projects performance khi không có dữ liệu thực
     * @return array
     */
    private function get_default_projects_performance() 
    {
        return [
            'total' => 0,
            'completed' => 0,
            'in_progress' => 0,
            'not_started' => 0,
            'completion_rate' => 0,
            'status_stats' => [
                _l('project_status_1') => 0,
                _l('project_status_2') => 0,
                _l('project_status_3') => 0,
                _l('project_status_4') => 0,
                _l('project_status_5') => 0
            ]
        ];
    }
    
    /**
     * Trả về dữ liệu mặc định cho phần tickets performance khi không có dữ liệu thực
     * @return array
     */
    private function get_default_tickets_performance() 
    {
        return [
            'total' => 0,
            'closed' => 0,
            'open' => 0,
            'response_rate' => 0,
            'monthly_stats' => [
                date('F Y') => [
                    'assigned' => 0,
                    'closed' => 0,
                    'avg_response_time' => 0
                ]
            ]
        ];
    }
    
    /**
     * Trả về dữ liệu mặc định cho phần attendance performance khi không có dữ liệu thực
     * @return array
     */
    private function get_default_attendance_performance() 
    {
        return [
            'present_days' => 0,
            'absent_days' => 0,
            'late_days' => 0,
            'leave_days' => 0,
            'attendance_rate' => 0
        ];
    }

    /**
     * API lấy dữ liệu hiệu suất cho AJAX
     * @return json
     */
    public function get_performance_data()
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('view', 'my_team')) {
            echo json_encode([
                'success' => false,
                'message' => _l('access_denied')
            ]);
            return;
        }
        
        $staff_id = $this->input->get('staff_id');
        if (!$staff_id) {
            echo json_encode([
                'success' => false,
                'message' => _l('staff_id_required')
            ]);
            return;
        }
        
        // Kiểm tra quyền xem thông tin của nhân viên này
        if ($staff_id != get_staff_user_id() && !is_admin()) {
            $this->load->model('staff_model');
            $staff = $this->staff_model->get($staff_id);
            
            if (!$staff) {
                echo json_encode([
                    'success' => false,
                    'message' => _l('staff_not_found')
                ]);
                return;
            }
            
            $this->load->model('departments_model');
            $staff_departments = $this->departments_model->get_staff_departments(get_staff_user_id());
            
            $has_permission = false;
            foreach ($staff_departments as $department) {
                if ($department['departmentid'] == $staff->departmentid) {
                    $has_permission = true;
                    break;
                }
            }
            
            if (!$has_permission) {
                echo json_encode([
                    'success' => false,
                    'message' => _l('access_denied')
                ]);
                return;
            }
        }
        
        // Xử lý các tham số lọc
        $period = $this->input->get('period') ? $this->input->get('period') : 'this_month';
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');
        
        // Xác định dải ngày dựa trên period
        if (!$date_from || !$date_to) {
            switch ($period) {
                case 'this_month':
                    $date_from = date('Y-m-01');
                    $date_to = date('Y-m-t');
                    break;
                case 'last_month':
                    $date_from = date('Y-m-01', strtotime('first day of last month'));
                    $date_to = date('Y-m-t', strtotime('last day of last month'));
                    break;
                case 'this_year':
                    $date_from = date('Y-01-01');
                    $date_to = date('Y-12-31');
                    break;
                case 'last_year':
                    $date_from = date('Y-01-01', strtotime('-1 year'));
                    $date_to = date('Y-12-31', strtotime('-1 year'));
                    break;
                default:
                    $date_from = date('Y-m-01');
                    $date_to = date('Y-m-t');
                    break;
            }
        }
        
        // Lấy dữ liệu hiệu suất với dải ngày đã xác định
        $performance = $this->my_team_model->get_staff_performance($staff_id, $date_from, $date_to);
        
        echo json_encode([
            'success' => true,
            'data' => $performance
        ]);
    }

    /**
     * Tải xuống tệp đính kèm
     * @param  int $approval_id ID của phê duyệt
     * @return void
     */
    public function download_attachment($approval_id)
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        $approval = $this->my_team_model->get_approval($approval_id);
        
        if (!$approval || !$approval->attachment) {
            set_alert('danger', _l('attachment_not_found'));
            redirect(admin_url('my_team/approvals'));
        }
        
        // Kiểm tra quyền xem
        if ($approval->staff_id != get_staff_user_id() && !is_admin()) {
            // Kiểm tra xem người dùng có phải là quản lý phòng ban không
            $this->load->model('departments_model');
            $staff_departments = $this->departments_model->get_staff_departments(get_staff_user_id());
            
            $has_permission = false;
            foreach ($staff_departments as $department) {
                if ($department['departmentid'] == $approval->department_id) {
                    $has_permission = true;
                    break;
                }
            }
            
            if (!$has_permission) {
                set_alert('danger', _l('access_denied'));
                redirect(admin_url('my_team/approvals'));
            }
        }
        
        // Tải xuống tệp
        $this->load->helper('my_team');
        approval_download_attachment($approval_id, $approval->attachment);
    }
    
    /* Phần quản lý thành viên */
    
    /**
     * Trang quản lý thành viên nhóm
     * @return void
     */
    public function members()
    {
        // Kiểm tra quyền truy cập cơ bản
        if (!staff_can('view', 'staff') && !staff_can('view', 'my_team')) {
            access_denied('Team Members');
        }
        
        $data = [];
        $data['title'] = _l('team_members');
        
        // Load models
        $this->load->model('staff_model');
        $this->load->model('departments_model');
        $this->load->model('roles_model');
        
        // Xử lý filters
        $where = ['active' => 1];
        
        if ($this->input->get('department_id') && $this->input->get('department_id') != '') {
            $where['departmentid'] = $this->input->get('department_id');
        }
        
        if ($this->input->get('role') && $this->input->get('role') != '') {
            $where['role'] = $this->input->get('role');
        }
        
        if ($this->input->get('search') && $this->input->get('search') != '') {
            $search = $this->input->get('search');
            $where['(firstname LIKE "%' . $search . '%" OR lastname LIKE "%' . $search . '%" OR email LIKE "%' . $search . '%")'] = null;
        }
        
        // Lấy danh sách nhân viên theo phân quyền Role
        if (is_admin() || staff_can('view', 'staff')) {
            // Admin hoặc có quyền view staff - xem tất cả
            $data['members'] = $this->staff_model->get('', $where);
        } else {
            // Chỉ xem nhân viên trong cùng phòng ban hoặc phòng ban mình quản lý
            $current_staff = $this->staff_model->get(get_staff_user_id());
            
            if ($current_staff && $current_staff->departmentid) {
                $where['departmentid'] = $current_staff->departmentid;
                $data['members'] = $this->staff_model->get('', $where);
            } else {
                // Nếu không thuộc phòng ban nào, chỉ xem thông tin bản thân
                $where['staffid'] = get_staff_user_id();
                $data['members'] = $this->staff_model->get('', $where);
            }
        }
        
        // Lấy danh sách phòng ban và vai trò cho filter
        $data['departments'] = $this->departments_model->get();
        $data['roles'] = $this->roles_model->get();
        
        $this->load->view('members/manage', $data);
    }
    

    
    /**
     * Danh sách skill của thành viên
     * @param int $member_id ID của thành viên
     * @return json
     */
    public function get_member_skills($member_id)
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('view', 'my_team')) {
            echo json_encode([
                'success' => false,
                'message' => _l('access_denied')
            ]);
            return;
        }
        
        // Lấy danh sách kỹ năng
        $skills = $this->my_team_model->get_member_skills($member_id);
        
        echo json_encode([
            'success' => true,
            'data' => $skills
        ]);
    }
    
    /**
     * Quản lý kỹ năng của thành viên
     * @param int $member_id ID của thành viên
     * @return void
     */
    public function manage_skills($member_id)
    {
        if (!staff_can('view', 'my_team') && get_staff_user_id() != $member_id) {
            access_denied('My Team');
        }
        
        $this->load->model('staff_model');
        $member = $this->staff_model->get($member_id);
        
        if (!$member) {
            set_alert('danger', _l('member_not_found'));
            redirect(admin_url('my_team/members'));
        }
        
        $data = [];
        $data['title'] = _l('staff_skills_for') . ' ' . $member->firstname . ' ' . $member->lastname;
        $data['member'] = $member;
        $data['skills'] = $this->my_team_model->get_member_skills($member_id);
        
        $this->load->view('my_team/members/skills', $data);
    }
    
    /**
     * Lưu/cập nhật kỹ năng
     * @param int $member_id ID của thành viên
     * @return void
     */
    public function save_skill($member_id)
    {
        // Kiểm tra quyền
        if (!staff_can('edit', 'my_team') && get_staff_user_id() != $member_id) {
            access_denied('My Team');
        }
        
        if ($this->input->post()) {
            $data = [
                'staff_id' => $member_id,
                'skill_name' => $this->input->post('skill_name'),
                'skill_level' => $this->input->post('skill_level')
            ];
            
            $id = $this->input->post('id', false);
            
            if ($id) {
                // Cập nhật
                $success = $this->my_team_model->update_member_skill($data, $id);
                $message = _l('skill_updated_successfully');
            } else {
                // Thêm mới
                $success = $this->my_team_model->add_member_skill($data);
                $message = _l('skill_added_successfully');
            }
            
            if ($success) {
                set_alert('success', $message);
            } else {
                set_alert('danger', _l('skill_update_failed'));
            }
        }
        
        redirect(admin_url('my_team/manage_skills/' . $member_id));
    }
    
    /**
     * Xóa kỹ năng
     * @param int $id        ID của kỹ năng
     * @param int $member_id ID của thành viên
     * @return void
     */
    public function delete_skill($id, $member_id)
    {
        // Kiểm tra quyền
        if (!staff_can('delete', 'my_team') && get_staff_user_id() != $member_id) {
            access_denied('My Team');
        }
        
        $success = $this->my_team_model->delete_member_skill($id);
        
        if ($success) {
            set_alert('success', _l('skill_deleted_successfully'));
        } else {
            set_alert('danger', _l('skill_delete_failed'));
        }
        
        redirect(admin_url('my_team/manage_skills/' . $member_id));
    }
    
    /* Phần quản lý Training Documents */
    
    /**
     * Trang quản lý training documents
     * @return void
     */
    public function training()
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        $data = [];
        $data['title'] = _l('team_training');
        
        // Lấy danh sách training documents theo vai trò
        try {
            if (is_admin() || staff_can('create', 'my_team')) {
                // Admin hoặc manager xem tất cả documents của mình
                $data['training_documents'] = $this->my_team_model->get_training_documents(['created_by' => get_staff_user_id()]);
                $data['is_manager'] = true;
            } else {
                // Staff chỉ xem assignments được giao cho mình
                $data['training_assignments'] = $this->my_team_model->get_staff_assignments(get_staff_user_id());
                $data['is_manager'] = false;
            }
            
            // Lấy danh sách danh mục
            $data['categories'] = $this->my_team_model->get_knowledge_categories();
            
            // Lấy thống kê cho manager
            if ($data['is_manager']) {
                $data['training_stats'] = $this->my_team_model->get_training_stats_for_manager(get_staff_user_id());
                $data['subordinate_staff'] = $this->my_team_model->get_subordinate_staff(get_staff_user_id());
            }
            
        } catch (Exception $e) {
            // Nếu bảng chưa tồn tại, trả về mảng rỗng
            $data['training_documents'] = [];
            $data['training_assignments'] = [];
            $data['categories'] = [];
            $data['is_manager'] = false;
            
            // Thông báo cho người dùng biết cần thiết lập bảng
            set_alert('warning', 'Bạn cần thiết lập bảng dữ liệu trước khi sử dụng tính năng này. <a href="' . admin_url('my_team/setup_tables') . '">Nhấn vào đây để thiết lập</a>.');
        }
        
        // Debug: Log thông tin để kiểm tra
        log_message('debug', 'Training method called - is_manager: ' . ($data['is_manager'] ? 'true' : 'false'));
        log_message('debug', 'Training documents count: ' . count($data['training_documents']));
        log_message('debug', 'Training assignments count: ' . count($data['training_assignments']));
        
        $this->load->view('my_team/training/manage', $data);
    }
    
    /**
     * Upload training document
     * @return json
     */
    public function upload_training_document()
    {
        if (!staff_can('create', 'my_team')) {
            echo json_encode(['success' => false, 'message' => _l('access_denied')]);
            return;
        }
        
        if (!$this->input->post()) {
            echo json_encode(['success' => false, 'message' => _l('invalid_request')]);
            return;
        }
        
        // Xử lý upload file
        $upload_path = FCPATH . 'uploads/training_documents/';
        
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
        
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|xls|xlsx|txt|jpg|jpeg|png|gif|mp4|avi|mov';
        $config['max_size'] = 50000; // 50MB
        $config['encrypt_name'] = true;
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('file')) {
            echo json_encode([
                'success' => false, 
                'message' => $this->upload->display_errors('', '')
            ]);
            return;
        }
        
        $upload_data = $this->upload->data();
        
        // Lưu thông tin document vào database
        $document_data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'category_id' => $this->input->post('category_id'),
            'file_name' => $upload_data['orig_name'],
            'file_path' => 'uploads/training_documents/' . $upload_data['file_name'],
            'file_size' => $upload_data['file_size'],
            'file_type' => $upload_data['file_type']
        ];
        
        $document_id = $this->my_team_model->add_training_document($document_data);
        
        if ($document_id) {
            echo json_encode([
                'success' => true,
                'message' => _l('training_document_uploaded_successfully'),
                'document_id' => $document_id,
                'document' => $document_data
            ]);
        } else {
            // Xóa file đã upload nếu lưu database thất bại
            unlink($upload_path . $upload_data['file_name']);
            echo json_encode([
                'success' => false,
                'message' => _l('training_document_upload_failed')
            ]);
        }
    }
    
    /**
     * Giao tài liệu cho nhân viên
     * @return json
     */
    public function assign_document()
    {
        if (!staff_can('create', 'my_team')) {
            echo json_encode(['success' => false, 'message' => _l('access_denied')]);
            return;
        }
        
        $document_id = $this->input->post('document_id');
        $staff_ids = $this->input->post('staff_ids');
        $deadline = $this->input->post('deadline');
        $notes = $this->input->post('notes');
        
        if (!$document_id || !$staff_ids) {
            echo json_encode(['success' => false, 'message' => _l('required_fields_missing')]);
            return;
        }
        
        $success = $this->my_team_model->assign_document_to_staff($document_id, $staff_ids, $deadline, $notes);
        
        if ($success) {
            echo json_encode([
                'success' => true,
                'message' => _l('training_document_assigned_successfully')
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => _l('training_document_assignment_failed')
            ]);
        }
    }
    
    /**
     * Xem tài liệu training
     * @param int $assignment_id
     * @return void
     */
    public function view_training_document($assignment_id)
    {
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        // Lấy thông tin assignment
        $this->db->select('ta.*, td.*, s.firstname, s.lastname');
        $this->db->from(db_prefix() . 'training_assignments ta');
        $this->db->join(db_prefix() . 'training_documents td', 'td.id = ta.document_id');
        $this->db->join(db_prefix() . 'staff s', 's.staffid = ta.assigned_by', 'left');
        $this->db->where('ta.id', $assignment_id);
        $assignment = $this->db->get()->row();
        
        if (!$assignment) {
            set_alert('danger', _l('training_assignment_not_found'));
            redirect(admin_url('my_team/training'));
        }
        
        // Kiểm tra quyền xem
        if ($assignment->staff_id != get_staff_user_id() && $assignment->created_by != get_staff_user_id() && !is_admin()) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team/training'));
        }
        
        $data = [];
        $data['assignment'] = $assignment;
        $data['title'] = $assignment->title;
        
        // Cập nhật last_accessed
        if ($assignment->staff_id == get_staff_user_id()) {
            $this->db->where('id', $assignment_id);
            $this->db->update(db_prefix() . 'training_assignments', ['last_accessed' => date('Y-m-d H:i:s')]);
        }
        
        $this->load->view('my_team/training/view_document', $data);
    }
    
    /**
     * Đánh dấu tài liệu đã hoàn thành
     * @return json
     */
    public function mark_training_completed()
    {
        $assignment_id = $this->input->post('assignment_id');
        
        if (!$assignment_id) {
            echo json_encode(['success' => false, 'message' => _l('invalid_request')]);
            return;
        }
        
        // Kiểm tra quyền
        $this->db->where('id', $assignment_id);
        $this->db->where('staff_id', get_staff_user_id());
        $assignment = $this->db->get(db_prefix() . 'training_assignments')->row();
        
        if (!$assignment) {
            echo json_encode(['success' => false, 'message' => _l('access_denied')]);
            return;
        }
        
        $success = $this->my_team_model->mark_document_completed($assignment_id);
        
        if ($success) {
            echo json_encode([
                'success' => true,
                'message' => _l('training_document_marked_completed')
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => _l('training_document_completion_failed')
            ]);
        }
    }
    
    /**
     * Cập nhật tiến độ đọc
     * @return json
     */
    public function update_training_progress()
    {
        $assignment_id = $this->input->post('assignment_id');
        $progress = $this->input->post('progress');
        
        if (!$assignment_id || $progress === null) {
            echo json_encode(['success' => false, 'message' => _l('invalid_request')]);
            return;
        }
        
        // Kiểm tra quyền
        $this->db->where('id', $assignment_id);
        $this->db->where('staff_id', get_staff_user_id());
        $assignment = $this->db->get(db_prefix() . 'training_assignments')->row();
        
        if (!$assignment) {
            echo json_encode(['success' => false, 'message' => _l('access_denied')]);
            return;
        }
        
        $success = $this->my_team_model->update_reading_progress($assignment_id, $progress);
        
        if ($success) {
            echo json_encode([
                'success' => true,
                'message' => _l('training_progress_updated')
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => _l('training_progress_update_failed')
            ]);
        }
    }
    
    /**
     * Lấy thống kê training cho dashboard
     * @return json
     */
    public function get_training_dashboard_stats()
    {
        if (!staff_can('view', 'my_team')) {
            echo json_encode(['success' => false, 'message' => _l('access_denied')]);
            return;
        }
        
        $stats = $this->my_team_model->get_training_stats_for_manager(get_staff_user_id());
        
        echo json_encode([
            'success' => true,
            'data' => $stats
        ]);
    }
    
    /**
     * Lấy danh sách assignments của document (AJAX)
     * @param int $document_id
     * @return void
     */
    public function get_document_assignments($document_id)
    {
        if (!staff_can('view', 'my_team')) {
            echo '<div class="alert alert-danger">' . _l('access_denied') . '</div>';
            return;
        }
        
        $document = $this->my_team_model->get_training_document($document_id);
        
        if (!$document || ($document->created_by != get_staff_user_id() && !is_admin())) {
            echo '<div class="alert alert-danger">' . _l('access_denied') . '</div>';
            return;
        }
        
        $assignments = $this->my_team_model->get_document_assignments($document_id);
        
        if (count($assignments) > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>' . _l('staff_member') . '</th>';
            echo '<th>' . _l('assigned_date') . '</th>';
            echo '<th>' . _l('deadline') . '</th>';
            echo '<th>' . _l('progress') . '</th>';
            echo '<th>' . _l('status') . '</th>';
            echo '<th>' . _l('last_accessed') . '</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            foreach ($assignments as $assignment) {
                echo '<tr>';
                echo '<td>' . $assignment['firstname'] . ' ' . $assignment['lastname'] . '<br><small class="text-muted">' . $assignment['email'] . '</small></td>';
                echo '<td>' . _dt($assignment['assigned_date']) . '</td>';
                echo '<td>' . ($assignment['deadline'] ? _d($assignment['deadline']) : '-') . '</td>';
                echo '<td>';
                echo '<div class="progress" style="margin-bottom: 0;">';
                echo '<div class="progress-bar progress-bar-' . ($assignment['progress'] >= 100 ? 'success' : ($assignment['progress'] > 0 ? 'info' : 'default')) . '" style="width: ' . $assignment['progress'] . '%">';
                echo $assignment['progress'] . '%';
                echo '</div>';
                echo '</div>';
                echo '</td>';
                echo '<td>';
                if ($assignment['status'] == 'completed') {
                    echo '<span class="label label-success">' . _l('completed') . '</span>';
                } elseif ($assignment['deadline'] && strtotime($assignment['deadline']) < time()) {
                    echo '<span class="label label-danger">' . _l('overdue') . '</span>';
                } elseif ($assignment['progress'] > 0) {
                    echo '<span class="label label-info">' . _l('in_progress') . '</span>';
                } else {
                    echo '<span class="label label-default">' . _l('assigned') . '</span>';
                }
                echo '</td>';
                echo '<td>' . ($assignment['last_accessed'] ? _dt($assignment['last_accessed']) : '-') . '</td>';
                echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-info text-center">';
            echo '<i class="fa fa-info-circle"></i> ' . _l('no_assignments_found_for_document');
            echo '</div>';
        }
    }
    
    /**
     * Xóa training document
     * @param int $id
     * @return void
     */
    public function delete_training_document($id)
    {
        if (!staff_can('delete', 'my_team')) {
            access_denied('My Team');
        }
        
        $document = $this->my_team_model->get_training_document($id);
        
        if (!$document || ($document->created_by != get_staff_user_id() && !is_admin())) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team/training'));
        }
        
        // Xóa file vật lý
        if ($document->file_path && file_exists(FCPATH . $document->file_path)) {
            unlink(FCPATH . $document->file_path);
        }
        
        $success = $this->my_team_model->delete_training_document($id);
        
        if ($success) {
            set_alert('success', _l('training_document_deleted_successfully'));
        } else {
            set_alert('danger', _l('training_document_deletion_failed'));
        }
        
        redirect(admin_url('my_team/training'));
    }
    
    /* Phần quản lý Knowledge Item (cũ) */
    
    /**
     * Trang quản lý knowledge - chuyển hướng đến training
     * @return void
     */
    public function knowledge()
    {
        // Chuyển hướng đến training
        redirect(admin_url('my_team/training'));
    }
    
    /**
     * Thêm/Chỉnh sửa knowledge item
     * @param int $id ID của knowledge item (nếu chỉnh sửa)
     * @return void
     */
    public function knowledge_item($id = '')
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        // Nếu là chỉnh sửa
        if ($id) {
            $item = $this->my_team_model->get_knowledge_item($id);
            
            // Kiểm tra quyền chỉnh sửa
            if (!$item || ($item->created_by != get_staff_user_id() && !is_admin())) {
                set_alert('danger', _l('access_denied'));
                redirect(admin_url('my_team/knowledge'));
            }
            
            $data['item'] = $item;
            $data['title'] = _l('edit_knowledge_item');
        } else {
            // Thêm mới
            if (!staff_can('create', 'my_team')) {
                access_denied('My Team');
            }
            
            $data['title'] = _l('add_knowledge_item');
        }
        
        // Xử lý post data
        if ($this->input->post()) {
            $post_data = $this->input->post();
            
            if ($id) {
                // Cập nhật
                $success = $this->my_team_model->update_knowledge_item($post_data, $id);
                
                if ($success) {
                    set_alert('success', _l('knowledge_item_updated_successfully'));
                } else {
                    set_alert('danger', _l('knowledge_item_update_failed'));
                }
            } else {
                // Thêm mới
                $id = $this->my_team_model->add_knowledge_item($post_data);
                
                if ($id) {
                    set_alert('success', _l('knowledge_item_created_successfully'));
                } else {
                    set_alert('danger', _l('knowledge_item_creation_failed'));
                }
            }
            
            redirect(admin_url('my_team/knowledge'));
        }
        
        // Lấy danh sách danh mục
        $data['categories'] = $this->my_team_model->get_knowledge_categories();
        
        // Lấy danh sách phòng ban để phân quyền xem
        $this->load->model('departments_model');
        $data['departments'] = $this->departments_model->get();
        
        // Nếu không có departments, tạo mảng rỗng để tránh lỗi
        if (!$data['departments']) {
            $data['departments'] = [];
        }
        
        $this->load->view('my_team/knowledge/item', $data);
    }
    
    /**
     * Xem chi tiết knowledge item
     * @param int $id ID của knowledge item
     * @return void
     */
    public function view_knowledge($id)
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        $item = $this->my_team_model->get_knowledge_item($id);
        
        if (!$item) {
            set_alert('danger', _l('knowledge_item_not_found'));
            redirect(admin_url('my_team/knowledge'));
        }
        
        // Kiểm tra quyền xem
        if ($item->created_by != get_staff_user_id() && !is_admin()) {
            // Kiểm tra xem item có được chia sẻ cho phòng ban của nhân viên không
            $this->load->model('departments_model');
            $staff_departments = $this->departments_model->get_staff_departments(get_staff_user_id());
            
            $visible_departments = json_decode($item->visible_to_departments, true);
            if (!$visible_departments) {
                $visible_departments = [];
            }
            
            $has_permission = false;
            foreach ($staff_departments as $department) {
                if (in_array($department['departmentid'], $visible_departments)) {
                    $has_permission = true;
                    break;
                }
            }
            
            if (!$has_permission && $item->visibility != 'all') {
                set_alert('danger', _l('access_denied'));
                redirect(admin_url('my_team/knowledge'));
            }
        }
        
        $data = [];
        $data['item'] = $item;
        $data['title'] = $item->subject;
        
        // Lấy thông tin người tạo
        $this->load->model('staff_model');
        $data['creator'] = $this->staff_model->get($item->created_by);
        
        // Lấy thông tin danh mục
        if ($item->category_id) {
            $data['category'] = $this->my_team_model->get_knowledge_category($item->category_id);
        }
        
        $this->load->view('my_team/knowledge/view', $data);
    }
    
    /**
     * Xóa knowledge item
     * @param int $id ID của knowledge item
     * @return void
     */
    public function delete_knowledge($id)
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('delete', 'my_team')) {
            access_denied('My Team');
        }
        
        $item = $this->my_team_model->get_knowledge_item($id);
        
        // Kiểm tra quyền xóa
        if (!$item || ($item->created_by != get_staff_user_id() && !is_admin())) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team/knowledge'));
        }
        
        $success = $this->my_team_model->delete_knowledge_item($id);
        
        if ($success) {
            set_alert('success', _l('knowledge_item_deleted_successfully'));
        } else {
            set_alert('danger', _l('knowledge_item_deletion_failed'));
        }
        
        redirect(admin_url('my_team/knowledge'));
    }
    
    /**
     * Quản lý danh mục knowledge
     * @return void
     */
    public function knowledge_categories()
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        $data = [];
        $data['title'] = _l('knowledge_categories');
        $data['categories'] = $this->my_team_model->get_knowledge_categories();
        
        $this->load->view('my_team/knowledge/categories', $data);
    }
    
    /**
     * Thêm/Chỉnh sửa danh mục knowledge
     * @return void
     */
    public function knowledge_category()
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('edit', 'my_team')) {
            access_denied('My Team');
        }
        
        if ($this->input->post()) {
            $post_data = $this->input->post();
            $id = $post_data['id'] ?? '';
            
            if ($id) {
                // Cập nhật
                $success = $this->my_team_model->update_knowledge_category($post_data, $id);
                
                if ($success) {
                    set_alert('success', _l('knowledge_category_updated_successfully'));
                } else {
                    set_alert('danger', _l('knowledge_category_update_failed'));
                }
            } else {
                // Thêm mới
                $id = $this->my_team_model->add_knowledge_category($post_data);
                
                if ($id) {
                    set_alert('success', _l('knowledge_category_created_successfully'));
                } else {
                    set_alert('danger', _l('knowledge_category_creation_failed'));
                }
            }
        }
        
        redirect(admin_url('my_team/knowledge_categories'));
    }
    
    /**
     * Tải xuống tệp đính kèm knowledge
     * @param  int $knowledge_id ID của knowledge item
     * @return void
     */
    public function download_knowledge_attachment($knowledge_id)
    {
        // Kiểm tra quyền truy cập
        if (!staff_can('view', 'my_team')) {
            access_denied('My Team');
        }
        
        $item = $this->my_team_model->get_knowledge_item($knowledge_id);
        
        if (!$item || !$item->attachment) {
            set_alert('danger', _l('attachment_not_found'));
            redirect(admin_url('my_team/knowledge'));
        }
        
        // Kiểm tra quyền xem
        if ($item->created_by != get_staff_user_id() && !is_admin()) {
            // Kiểm tra xem item có được chia sẻ cho phòng ban của nhân viên không
            $this->load->model('departments_model');
            $staff_departments = $this->departments_model->get_staff_departments(get_staff_user_id());
            
            $visible_departments = json_decode($item->visible_to_departments, true);
            if (!$visible_departments) {
                $visible_departments = [];
            }
            
            $has_permission = false;
            foreach ($staff_departments as $department) {
                if (in_array($department['departmentid'], $visible_departments)) {
                    $has_permission = true;
                    break;
                }
            }
            
            if (!$has_permission && $item->visibility != 'all') {
                set_alert('danger', _l('access_denied'));
                redirect(admin_url('my_team/knowledge'));
            }
        }
        
        // Tải xuống tệp
        $this->load->helper('my_team');
        knowledge_download_attachment($knowledge_id, $item->attachment);
    }

    /**
     * Hiển thị biểu đồ hiệu suất chi tiết cho thành viên
     * @param  int $member_id ID thành viên
     * @return void
     */
    public function performance_charts($member_id)
    {
        if (!staff_can('view', 'my_team') && get_staff_user_id() != $member_id) {
            access_denied('My Team');
        }
        
        $this->load->model('staff_model');
        $member = $this->staff_model->get($member_id);
        
        if (!$member) {
            set_alert('danger', _l('member_not_found'));
            redirect(admin_url('my_team/members'));
        }
        
        $data = [];
        $data['title'] = _l('performance_charts_for') . ' ' . $member->firstname . ' ' . $member->lastname;
        $data['member'] = $member;
        
        // Xử lý filter
        $data['period'] = $this->input->get('period') ? $this->input->get('period') : 'last_30_days';
        $data['chart_type'] = $this->input->get('chart_type') ? $this->input->get('chart_type') : 'line';
        $data['date_range'] = '';
        
        // Xác định khoảng thời gian
        $from_date = date('Y-m-d', strtotime('-30 days'));
        $to_date = date('Y-m-d');
        
        switch ($data['period']) {
            case 'this_month':
                $from_date = date('Y-m-01');
                $to_date = date('Y-m-t');
                break;
            case 'last_month':
                $from_date = date('Y-m-01', strtotime('first day of last month'));
                $to_date = date('Y-m-t', strtotime('last day of last month'));
                break;
            case 'this_year':
                $from_date = date('Y-01-01');
                $to_date = date('Y-12-31');
                break;
            case 'last_year':
                $from_date = date('Y-01-01', strtotime('-1 year'));
                $to_date = date('Y-12-31', strtotime('-1 year'));
                break;
            case 'custom':
                $date_range = $this->input->get('date_range');
                $data['date_range'] = $date_range;
                
                if ($date_range) {
                    $dates = explode(' - ', $date_range);
                    $from_date = date('Y-m-d', strtotime($dates[0]));
                    $to_date = date('Y-m-d', strtotime($dates[1]));
                }
                break;
            default: // last_30_days
                $from_date = date('Y-m-d', strtotime('-30 days'));
                $to_date = date('Y-m-d');
                break;
        }
        
        // Lấy dữ liệu hiệu suất trong khoảng thời gian
        $performance = $this->my_team_model->get_staff_performance($member_id, $from_date, $to_date);
        
        // Chuẩn bị dữ liệu cho biểu đồ công việc
        $task_data = [
            'completed' => [],
            'new' => []
        ];
        
        $task_labels = [];
        
        // Tạo mảng các ngày trong khoảng thời gian
        $current_date = new DateTime($from_date);
        $end_date = new DateTime($to_date);
        $end_date->modify('+1 day'); // Bao gồm cả ngày cuối
        
        $interval = new DateInterval('P1D');
        $date_range = new DatePeriod($current_date, $interval, $end_date);
        
        // Khởi tạo mảng dữ liệu cho tất cả các ngày
        foreach ($date_range as $date) {
            $date_str = $date->format('Y-m-d');
            $task_labels[] = $date->format('d/m/Y');
            $task_data['completed'][] = 0;
            $task_data['new'][] = 0;
        }
        
        // Điền dữ liệu thực tế
        foreach ($performance['tasks'] as $task) {
            $date = new DateTime($task['date']);
            $index = $date->diff($current_date)->days;
            
            if (isset($task_data['completed'][$index])) {
                if ($task['status'] == 5) { // Giả sử 5 là trạng thái hoàn thành
                    $task_data['completed'][$index]++;
                } else {
                    $task_data['new'][$index]++;
                }
            }
        }
        
        $data['task_labels'] = $task_labels;
        $data['task_data'] = $task_data;
        
        // Chuẩn bị dữ liệu cho biểu đồ dự án
        $project_data = [
            'active' => [],
            'completed' => []
        ];
        
        $project_labels = $task_labels;
        
        // Khởi tạo mảng dữ liệu cho tất cả các ngày
        foreach ($date_range as $date) {
            $project_data['active'][] = 0;
            $project_data['completed'][] = 0;
        }
        
        // Điền dữ liệu thực tế
        foreach ($performance['projects'] as $project) {
            $date = new DateTime($project['date']);
            $index = $date->diff($current_date)->days;
            
            if (isset($project_data['active'][$index])) {
                if ($project['status'] == 2) { // Giả sử 2 là trạng thái đang tiến hành
                    $project_data['active'][$index]++;
                } elseif ($project['status'] == 4) { // Giả sử 4 là trạng thái hoàn thành
                    $project_data['completed'][$index]++;
                }
            }
        }
        
        $data['project_labels'] = $project_labels;
        $data['project_data'] = $project_data;
        
        // Chuẩn bị dữ liệu cho biểu đồ điểm danh
        $attendance_data = [
            'hours' => []
        ];
        
        $attendance_labels = $task_labels;
        
        // Khởi tạo mảng dữ liệu cho tất cả các ngày
        foreach ($date_range as $date) {
            $attendance_data['hours'][] = 0;
        }
        
        // Điền dữ liệu thực tế
        foreach ($performance['attendance'] as $attendance) {
            $date = new DateTime($attendance['date']);
            $index = $date->diff($current_date)->days;
            
            if (isset($attendance_data['hours'][$index])) {
                $attendance_data['hours'][$index] = (float)$attendance['work_hours'];
            }
        }
        
        $data['attendance_labels'] = $attendance_labels;
        $data['attendance_data'] = $attendance_data;
        
        // Chuẩn bị dữ liệu cho biểu đồ phiếu hỗ trợ
        $ticket_data = [
            'response_time' => []
        ];
        
        $ticket_labels = $task_labels;
        
        // Khởi tạo mảng dữ liệu cho tất cả các ngày
        foreach ($date_range as $date) {
            $ticket_data['response_time'][] = 0;
        }
        
        // Điền dữ liệu thực tế
        foreach ($performance['tickets'] as $ticket) {
            $date = new DateTime($ticket['date']);
            $index = $date->diff($current_date)->days;
            
            if (isset($ticket_data['response_time'][$index])) {
                $ticket_data['response_time'][$index] = (float)$ticket['response_time'];
            }
        }
        
        $data['ticket_labels'] = $ticket_labels;
        $data['ticket_data'] = $ticket_data;
        
        // Tính toán các chỉ số hiệu suất tổng hợp
        $data['completion_rate'] = isset($performance['tasks']['completion_rate']) ? $performance['tasks']['completion_rate'] : 0;
        $data['avg_task_time'] = isset($performance['tasks']['avg_time']) ? $performance['tasks']['avg_time'] : 0;
        $data['attendance_rate'] = isset($performance['attendance']['attendance_rate']) ? $performance['attendance']['attendance_rate'] : 0;
        $data['ticket_response_time'] = isset($performance['tickets']['avg_response_time']) ? $performance['tickets']['avg_response_time'] : 0;
        
        $this->load->view('my_team/performance/performance_charts', $data);
    }

    /**
     * Trang thiết lập bảng dữ liệu
     * @return void
     */
    public function setup_tables()
    {
        // Chỉ admin mới có quyền thiết lập bảng
        if (!is_admin()) {
            access_denied('My Team');
        }
        
        // Xử lý tạo bảng nếu có POST request
        if ($this->input->post('create_tables')) {
            $success = $this->create_my_team_tables();
            if ($success) {
                set_alert('success', _l('setup_tables_success'));
            } else {
                set_alert('danger', _l('setup_tables_error'));
            }
            redirect(admin_url('my_team/setup_tables'));
        }
        
        $data = [];
        $data['title'] = _l('my_team_setup_tables');
        
        // Kiểm tra trạng thái các bảng
        $data['tables_status'] = $this->check_tables_status();
        
        $this->load->view('my_team/setup_tables', $data);
    }
    
    /**
     * Tạo các bảng cần thiết cho module my_team
     * @return bool
     */
    private function create_my_team_tables()
    {
        try {
            // Tạo bảng my_team_approvals
            if (!$this->db->table_exists(db_prefix() . 'my_team_approvals')) {
                $sql = "CREATE TABLE `" . db_prefix() . "my_team_approvals` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `subject` varchar(500) NOT NULL,
                    `description` text DEFAULT NULL,
                    `approval_type` varchar(50) NOT NULL DEFAULT 'general',
                    `priority` varchar(20) DEFAULT 'normal',
                    `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=approved, 2=rejected, 3=cancelled',
                    `amount` decimal(15,2) DEFAULT 0.00,
                    `department_id` int(11) DEFAULT NULL,
                    `staff_id` int(11) NOT NULL,
                    `date_from` date DEFAULT NULL,
                    `date_to` date DEFAULT NULL,
                    `attachment` varchar(500) DEFAULT NULL,
                    `json_data` text DEFAULT NULL,
                    `approved_by` int(11) DEFAULT NULL,
                    `approved_date` datetime DEFAULT NULL,
                    `rejected_by` int(11) DEFAULT NULL,
                    `rejected_date` datetime DEFAULT NULL,
                    `rejected_reason` text DEFAULT NULL,
                    `created_by` int(11) NOT NULL,
                    `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    KEY `staff_id` (`staff_id`),
                    KEY `department_id` (`department_id`),
                    KEY `status` (`status`),
                    KEY `approval_type` (`approval_type`),
                    KEY `created_date` (`created_date`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                
                $this->db->query($sql);
                log_message('info', 'My Team: Created table my_team_approvals');
            }
            
            // Tạo bảng my_team_knowledge
            if (!$this->db->table_exists(db_prefix() . 'my_team_knowledge')) {
                $sql = "CREATE TABLE `" . db_prefix() . "my_team_knowledge` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `subject` varchar(500) NOT NULL,
                    `content` longtext,
                    `category_id` int(11) DEFAULT NULL,
                    `visibility` varchar(20) DEFAULT 'department',
                    `visible_to_departments` text DEFAULT NULL,
                    `attachment` varchar(500) DEFAULT NULL,
                    `created_by` int(11) NOT NULL,
                    `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    KEY `category_id` (`category_id`),
                    KEY `created_by` (`created_by`),
                    KEY `visibility` (`visibility`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                
                $this->db->query($sql);
                log_message('info', 'My Team: Created table my_team_knowledge');
            }
            
            // Tạo bảng my_team_knowledge_categories
            if (!$this->db->table_exists(db_prefix() . 'my_team_knowledge_categories')) {
                $sql = "CREATE TABLE `" . db_prefix() . "my_team_knowledge_categories` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `name` varchar(200) NOT NULL,
                    `description` text DEFAULT NULL,
                    `color` varchar(7) DEFAULT '#007bff',
                    `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                
                $this->db->query($sql);
                log_message('info', 'My Team: Created table my_team_knowledge_categories');
            }
            
            // Tạo bảng my_team_skills
            if (!$this->db->table_exists(db_prefix() . 'my_team_skills')) {
                $sql = "CREATE TABLE `" . db_prefix() . "my_team_skills` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `staff_id` int(11) NOT NULL,
                    `skill_name` varchar(200) NOT NULL,
                    `skill_level` varchar(50) DEFAULT 'beginner',
                    `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    KEY `staff_id` (`staff_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                
                $this->db->query($sql);
                log_message('info', 'My Team: Created table my_team_skills');
            }
            
            // Tạo bảng my_team_training_documents
            if (!$this->db->table_exists(db_prefix() . 'my_team_training_documents')) {
                $sql = "CREATE TABLE `" . db_prefix() . "my_team_training_documents` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `title` varchar(500) NOT NULL,
                    `description` text DEFAULT NULL,
                    `category_id` int(11) DEFAULT NULL,
                    `file_name` varchar(500) NOT NULL,
                    `file_path` varchar(1000) NOT NULL,
                    `file_size` int(11) DEFAULT 0,
                    `file_type` varchar(100) DEFAULT NULL,
                    `created_by` int(11) NOT NULL,
                    `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    KEY `category_id` (`category_id`),
                    KEY `created_by` (`created_by`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                
                $this->db->query($sql);
                log_message('info', 'My Team: Created table my_team_training_documents');
            }
            
            // Tạo bảng my_team_training_assignments
            if (!$this->db->table_exists(db_prefix() . 'my_team_training_assignments')) {
                $sql = "CREATE TABLE `" . db_prefix() . "my_team_training_assignments` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `document_id` int(11) NOT NULL,
                    `staff_id` int(11) NOT NULL,
                    `assigned_by` int(11) NOT NULL,
                    `assigned_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `deadline` date DEFAULT NULL,
                    `notes` text DEFAULT NULL,
                    `status` varchar(20) DEFAULT 'assigned',
                    `progress` decimal(5,2) DEFAULT 0.00,
                    `completed_date` datetime DEFAULT NULL,
                    `last_accessed` datetime DEFAULT NULL,
                    PRIMARY KEY (`id`),
                    KEY `document_id` (`document_id`),
                    KEY `staff_id` (`staff_id`),
                    KEY `assigned_by` (`assigned_by`),
                    KEY `status` (`status`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                
                $this->db->query($sql);
                log_message('info', 'My Team: Created table my_team_training_assignments');
            }
            
            return true;
            
        } catch (Exception $e) {
            log_message('error', 'My Team: Error creating tables - ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Kiểm tra trạng thái các bảng
     * @return array
     */
    private function check_tables_status()
    {
        $tables = [
            'my_team_approvals' => 'Approval requests',
            'my_team_knowledge' => 'Knowledge items',
            'my_team_knowledge_categories' => 'Knowledge categories',
            'my_team_skills' => 'Staff skills',
            'my_team_training_documents' => 'Training documents',
            'my_team_training_assignments' => 'Training assignments'
        ];
        
        $status = [];
        foreach ($tables as $table => $description) {
            $status[$table] = [
                'name' => $table,
                'description' => $description,
                'exists' => $this->db->table_exists(db_prefix() . $table)
            ];
        }
        
        return $status;
    }

    /**
     * Lấy hoạt động của nhân viên từ các bảng có sẵn
     * @param int $staff_id ID của nhân viên
     * @param int $limit Số lượng hoạt động cần lấy
     * @return array
     */
    private function get_staff_activities($staff_id, $limit = 10)
    {
        $activities = [];
        
        try {
            // Lấy từ bảng activity_log (hoạt động chung của hệ thống)
            // Lấy tên nhân viên trước để tránh lỗi
            $this->load->model('staff_model');
            $staff = $this->staff_model->get($staff_id);
            $staff_name = $staff ? $staff->firstname . ' ' . $staff->lastname : '';
            
            if ($this->db->table_exists(db_prefix() . 'activity_log') && $staff_name) {
                $this->db->select('description, date, "system" as type');
                $this->db->from(db_prefix() . 'activity_log');
                $this->db->where('staffid', $staff_name);
                $this->db->order_by('date', 'DESC');
                $this->db->limit($limit);
                $system_activities = $this->db->get()->result_array();
            } else {
                $system_activities = [];
            }
        
        foreach ($system_activities as $activity) {
            $activities[] = [
                'description' => $activity['description'],
                'date' => $activity['date'],
                'type' => 'system',
                'icon' => 'fa fa-cog',
                'color' => 'info'
            ];
        }
        
            // Lấy từ bảng tasks (công việc được giao)
            if ($this->db->table_exists(db_prefix() . 'tasks')) {
                $this->db->select('name as description, dateadded as date');
                $this->db->from(db_prefix() . 'tasks');
                $this->db->where('FIND_IN_SET(' . $staff_id . ', assignees) >', 0);
                $this->db->order_by('dateadded', 'DESC');
                $this->db->limit($limit);
                $task_activities = $this->db->get()->result_array();
            } else {
                $task_activities = [];
            }
            
            foreach ($task_activities as $activity) {
                $activities[] = [
                    'description' => 'Được giao công việc: ' . $activity['description'],
                    'date' => $activity['date'],
                    'type' => 'task',
                    'icon' => 'fa fa-tasks',
                    'color' => 'primary'
                ];
            }
            
            // Lấy từ bảng projects (dự án tham gia)
            if ($this->db->table_exists(db_prefix() . 'projects') && $this->db->table_exists(db_prefix() . 'project_members')) {
                $this->db->select('name as description, date_created as date');
                $this->db->from(db_prefix() . 'projects');
                $this->db->join(db_prefix() . 'project_members', db_prefix() . 'project_members.project_id = ' . db_prefix() . 'projects.id');
                $this->db->where(db_prefix() . 'project_members.staff_id', $staff_id);
                $this->db->order_by('date_created', 'DESC');
                $this->db->limit($limit);
                $project_activities = $this->db->get()->result_array();
            } else {
                $project_activities = [];
            }
            
            foreach ($project_activities as $activity) {
                $activities[] = [
                    'description' => 'Tham gia dự án: ' . $activity['description'],
                    'date' => $activity['date'],
                    'type' => 'project',
                    'icon' => 'fa fa-folder',
                    'color' => 'success'
                ];
            }
            
            // Lấy từ bảng tickets (phiếu hỗ trợ được giao)
            if ($this->db->table_exists(db_prefix() . 'tickets')) {
                $this->db->select('subject as description, date as date');
                $this->db->from(db_prefix() . 'tickets');
                $this->db->where('assigned', $staff_id);
                $this->db->order_by('date', 'DESC');
                $this->db->limit($limit);
                $ticket_activities = $this->db->get()->result_array();
            } else {
                $ticket_activities = [];
            }
            
            foreach ($ticket_activities as $activity) {
                $activities[] = [
                    'description' => 'Được giao phiếu hỗ trợ: ' . $activity['description'],
                    'date' => $activity['date'],
                    'type' => 'ticket',
                    'icon' => 'fa fa-life-ring',
                    'color' => 'warning'
                ];
            }
            
            // Lấy từ bảng my_team_approvals (phê duyệt đã tạo)
            if ($this->db->table_exists(db_prefix() . 'my_team_approvals')) {
                $this->db->select('title as description, created_date as date');
                $this->db->from(db_prefix() . 'my_team_approvals');
                $this->db->where('created_by', $staff_id);
                $this->db->order_by('created_date', 'DESC');
                $this->db->limit($limit);
                $approval_activities = $this->db->get()->result_array();
                
                foreach ($approval_activities as $activity) {
                    $activities[] = [
                        'description' => 'Tạo yêu cầu phê duyệt: ' . $activity['description'],
                        'date' => $activity['date'],
                        'type' => 'approval',
                        'icon' => 'fa fa-check-circle',
                        'color' => 'info'
                    ];
                }
            }
            
        } catch (Exception $e) {
            // Nếu có lỗi, trả về mảng rỗng
            $activities = [];
        }
        
        // Sắp xếp theo thời gian giảm dần
        if (!empty($activities)) {
            usort($activities, function($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });
        }
        
        // Giới hạn số lượng kết quả
        return array_slice($activities, 0, $limit);
    }

    /**
     * Xử lý dữ liệu POST cho approval
     * @param bool $is_update Có phải là cập nhật không
     * @param int $id ID của approval (nếu cập nhật)
     * @return bool
     */
    private function _handle_approval_post($is_update = false, $id = null)
    {
        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'approval_type' => $this->input->post('approval_type'),
            'priority' => $this->input->post('priority'),
            'department_id' => $this->input->post('department_id'),
            'staff_id' => $this->input->post('staff_id') ? $this->input->post('staff_id') : get_staff_user_id(),
        ];

        // Xử lý dữ liệu JSON cho các loại approval khác nhau
        $json_data = [];
        
        if ($data['approval_type'] == 'leave') {
            $json_data = [
                'leave_type' => $this->input->post('leave_type'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'total_days' => $this->input->post('total_days'),
                'reason' => $this->input->post('leave_reason')
            ];
        } elseif ($data['approval_type'] == 'financial') {
            $json_data = [
                'amount' => $this->input->post('amount'),
                'currency' => $this->input->post('currency'),
                'expense_type' => $this->input->post('expense_type'),
                'purpose' => $this->input->post('purpose')
            ];
        }
        
        if (!empty($json_data)) {
            $data['json_data'] = json_encode($json_data);
        }

        if ($is_update && $id) {
            $data['updated_date'] = date('Y-m-d H:i:s');
            return $this->my_team_model->update_approval($data, $id);
        } else {
            $data['created_date'] = date('Y-m-d H:i:s');
            $data['created_by'] = get_staff_user_id();
            $data['status'] = 0; // Pending
            return $this->my_team_model->add_approval($data);
        }
    }

    /**
     * Xử lý dữ liệu POST cho payment approval
     * @param int $id ID của approval (nếu cập nhật)
     * @return bool
     */
    private function _handle_payment_approval_post($id = null)
    {
        // Xử lý upload file
        $attachment_path = '';
        if (!empty($_FILES['invoice_attachment']['name'])) {
            $upload_path = FCPATH . 'uploads/approvals/';
            
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }
            
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'pdf|jpg|jpeg|png|doc|docx';
            $config['max_size'] = 10240; // 10MB
            $config['encrypt_name'] = true;
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('invoice_attachment')) {
                $upload_data = $this->upload->data();
                $attachment_path = 'uploads/approvals/' . $upload_data['file_name'];
            } else {
                set_alert('danger', $this->upload->display_errors('', ''));
                return false;
            }
        }
        
        $data = [
            'subject' => $this->input->post('subject'),
            'description' => $this->input->post('description'),
            'approval_type' => 'payment',
            'priority' => $this->input->post('priority') ? $this->input->post('priority') : 'normal',
            'department_id' => $this->input->post('department_id') ? $this->input->post('department_id') : null,
            'amount' => $this->input->post('amount'),
            'staff_id' => get_staff_user_id(),
        ];
        
        // Thêm ngày thanh toán nếu có
        if ($this->input->post('payment_date')) {
            $data['date_from'] = to_sql_date($this->input->post('payment_date'));
        }
        
        // Thêm attachment nếu có
        if ($attachment_path) {
            $data['attachment'] = $attachment_path;
        }
        
        // Tạo JSON data cho payment
        $json_data = [
            'payment_type' => 'invoice',
            'invoice_details' => $this->input->post('description'),
            'due_date' => $this->input->post('payment_date')
        ];
        
        $data['json_data'] = json_encode($json_data);

        if ($id) {
            $data['updated_date'] = date('Y-m-d H:i:s');
            return $this->my_team_model->update_approval($data, $id);
        } else {
            $data['created_date'] = date('Y-m-d H:i:s');
            $data['created_by'] = get_staff_user_id();
            $data['status'] = 0; // Pending
            return $this->my_team_model->add_approval($data);
        }
    }

    /**
     * Xử lý dữ liệu POST cho leave approval
     * @param int $id ID của approval (nếu cập nhật)
     * @return bool
     */
    private function _handle_leave_approval_post($id = null)
    {
        // Xử lý upload file (optional cho leave)
        $attachment_path = '';
        if (!empty($_FILES['supporting_document']['name'])) {
            $upload_path = FCPATH . 'uploads/approvals/';
            
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }
            
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'pdf|jpg|jpeg|png|doc|docx';
            $config['max_size'] = 5120; // 5MB
            $config['encrypt_name'] = true;
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('supporting_document')) {
                $upload_data = $this->upload->data();
                $attachment_path = 'uploads/approvals/' . $upload_data['file_name'];
            } else {
                set_alert('danger', $this->upload->display_errors('', ''));
                return false;
            }
        }
        
        $data = [
            'subject' => $this->input->post('subject'),
            'description' => $this->input->post('detailed_reason'),
            'approval_type' => 'leave',
            'priority' => $this->input->post('priority') ? $this->input->post('priority') : 'normal',
            'department_id' => $this->input->post('department_id') ? $this->input->post('department_id') : null,
            'amount' => 0, // Leave không cần amount
            'staff_id' => get_staff_user_id(),
        ];
        
        // Thêm ngày bắt đầu và kết thúc
        if ($this->input->post('start_date')) {
            $data['date_from'] = to_sql_date($this->input->post('start_date'));
        }
        
        if ($this->input->post('end_date')) {
            $data['date_to'] = to_sql_date($this->input->post('end_date'));
        }
        
        // Thêm attachment nếu có
        if ($attachment_path) {
            $data['attachment'] = $attachment_path;
        }
        
        // Tạo JSON data cho leave
        $json_data = [
            'leave_type' => $this->input->post('leave_type'),
            'total_days' => $this->input->post('total_days'),
            'half_day_option' => $this->input->post('half_day_option'),
            'replacement_staff' => $this->input->post('replacement_staff'),
            'detailed_reason' => $this->input->post('detailed_reason')
        ];
        
        $data['json_data'] = json_encode($json_data);

        if ($id) {
            $data['updated_date'] = date('Y-m-d H:i:s');
            return $this->my_team_model->update_approval($data, $id);
        } else {
            $data['created_date'] = date('Y-m-d H:i:s');
            $data['created_by'] = get_staff_user_id();
            $data['status'] = 0; // Pending
            return $this->my_team_model->add_approval($data);
        }
    }
    
    /**
     * Load form approval cũ cho các loại approval khác
     * @param int $id ID của approval
     * @return void
     */
    private function _load_old_approval_form($id)
    {
        $approval = $this->my_team_model->get_approval($id);
        
        if (!$approval) {
            set_alert('danger', _l('approval_not_found'));
            redirect(admin_url('my_team/approvals'));
        }
        
        // Kiểm tra quyền chỉnh sửa
        if ($approval->staff_id != get_staff_user_id() && !is_admin()) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team/approvals'));
        }
        
        // Chỉ cho phép chỉnh sửa nếu chưa được phê duyệt/từ chối
        if ($approval->status != 0) {
            set_alert('warning', _l('cannot_edit_processed_approval'));
            redirect(admin_url('my_team/view_approval/' . $id));
        }
        
        // Xử lý json_data
        if ($approval->json_data) {
            $json_data = json_decode($approval->json_data, true);
            $data['json_data'] = $json_data;
        }
        
        $data['approval'] = $approval;
        $data['title'] = _l('edit_approval');
        
        // Lấy danh sách phòng ban
        $this->load->model('departments_model');
        $data['departments'] = $this->departments_model->get();
        
        // Lấy danh sách loại nghỉ phép
        $data['leave_types'] = ['annual', 'sick', 'maternity', 'paternity', 'unpaid', 'other'];
        
        // Lấy thông tin tiền tệ mặc định
        $this->load->model('currencies_model');
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        
        // Nếu không có tiền tệ mặc định, tạo một đối tượng giả lập để tránh lỗi
        if (!$data['base_currency']) {
            $data['base_currency'] = new stdClass();
            $data['base_currency']->symbol = '$';
        }
        
        if ($this->input->post()) {
            // Cập nhật
            $success = $this->_handle_approval_post(true, $id);
            if ($success) {
                set_alert('success', _l('approval_updated_successfully'));
                redirect(admin_url('my_team/approvals'));
            }
        }
        
        $this->load->view('my_team/approvals/add', $data);
    }

    /**
     * Lấy thống kê approvals của nhân viên
     * @param int $staff_id ID của nhân viên
     * @return json
     */
    public function get_staff_approvals_stats($staff_id)
    {
        if (!staff_can('view', 'my_team') && get_staff_user_id() != $staff_id) {
            echo json_encode(['success' => false, 'message' => _l('access_denied')]);
            return;
        }

        try {
            // Kiểm tra xem bảng my_team_approvals có tồn tại không
            if (!$this->db->table_exists(db_prefix() . 'my_team_approvals')) {
                echo json_encode([
                    'success' => true,
                    'data' => ['total' => 0, 'pending' => 0, 'approved' => 0, 'rejected' => 0]
                ]);
                return;
            }

            // Lấy tổng số approvals
            $this->db->where('staff_id', $staff_id);
            $total = $this->db->count_all_results(db_prefix() . 'my_team_approvals');

            // Lấy số pending
            $this->db->where('staff_id', $staff_id);
            $this->db->where('status', 0);
            $pending = $this->db->count_all_results(db_prefix() . 'my_team_approvals');

            // Lấy số approved
            $this->db->where('staff_id', $staff_id);
            $this->db->where('status', 1);
            $approved = $this->db->count_all_results(db_prefix() . 'my_team_approvals');

            // Lấy số rejected
            $this->db->where('staff_id', $staff_id);
            $this->db->where('status', 2);
            $rejected = $this->db->count_all_results(db_prefix() . 'my_team_approvals');

            echo json_encode([
                'success' => true,
                'data' => [
                    'total' => $total,
                    'pending' => $pending,
                    'approved' => $approved,
                    'rejected' => $rejected
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => true,
                'data' => ['total' => 0, 'pending' => 0, 'approved' => 0, 'rejected' => 0]
            ]);
        }
    }

    /**
     * Lấy thống kê knowledge items của nhân viên
     * @param int $staff_id ID của nhân viên
     * @return json
     */
    public function get_staff_knowledge_stats($staff_id)
    {
        if (!staff_can('view', 'my_team') && get_staff_user_id() != $staff_id) {
            echo json_encode(['success' => false, 'message' => _l('access_denied')]);
            return;
        }

        try {
            // Kiểm tra xem bảng my_team_knowledge có tồn tại không
            if (!$this->db->table_exists(db_prefix() . 'my_team_knowledge')) {
                echo json_encode([
                    'success' => true,
                    'data' => ['total' => 0, 'read' => 0, 'assigned' => 0]
                ]);
                return;
            }

            // Lấy tổng số knowledge items được assign cho nhân viên này
            $this->db->where('FIND_IN_SET(' . $staff_id . ', assigned_to) >', 0);
            $total = $this->db->count_all_results(db_prefix() . 'my_team_knowledge');

            // Lấy số đã đọc (giả sử có bảng tracking hoặc field read_by)
            $read = 0; // Tạm thời set = 0, có thể implement sau

            echo json_encode([
                'success' => true,
                'data' => [
                    'total' => $total,
                    'read' => $read,
                    'assigned' => $total
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => true,
                'data' => ['total' => 0, 'read' => 0, 'assigned' => 0]
            ]);
        }
    }

    /**
     * Lấy thống kê tickets của nhân viên (sử dụng bảng có sẵn)
     * @param int $staff_id ID của nhân viên
     * @return json
     */
    public function get_staff_tickets_stats($staff_id)
    {
        if (!staff_can('view', 'my_team') && get_staff_user_id() != $staff_id) {
            echo json_encode(['success' => false, 'message' => _l('access_denied')]);
            return;
        }

        try {
            // Lấy tổng số tickets được assign cho nhân viên này
            $this->db->where('assigned', $staff_id);
            $total = $this->db->count_all_results(db_prefix() . 'tickets');

            // Lấy số tickets đang mở (status != closed)
            $this->db->where('assigned', $staff_id);
            $this->db->where('status !=', 5); // Giả sử 5 là status closed
            $open = $this->db->count_all_results(db_prefix() . 'tickets');

            // Lấy số tickets đã đóng
            $this->db->where('assigned', $staff_id);
            $this->db->where('status', 5);
            $closed = $this->db->count_all_results(db_prefix() . 'tickets');

            echo json_encode([
                'success' => true,
                'data' => [
                    'total' => $total,
                    'open' => $open,
                    'closed' => $closed
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => true,
                'data' => ['total' => 0, 'open' => 0, 'closed' => 0]
            ]);
        }
    }

    /**
     * Redirect đến setup tables
     * @return void
     */
    public function setup()
    {
        redirect(admin_url('my_team/setup_tables'));
    }

    /**
     * Approve một step trong workflow
     */
    public function approve_step()
    {
        if (!staff_can('edit', 'my_team')) {
            access_denied('my_team');
        }

        $instance_id = $this->input->post('instance_id');
        $comments = $this->input->post('comments', true);
        $staff_id = get_staff_user_id();

        if (!$instance_id) {
            set_alert('danger', 'Invalid approval instance.');
            redirect(admin_url('my_team/approvals'));
        }

        try {
            $success = $this->my_team_workflow_model->approve_step($instance_id, $staff_id, $comments);
            
            if ($success) {
                set_alert('success', 'Yêu cầu đã được phê duyệt thành công.');
            } else {
                set_alert('danger', 'Không thể phê duyệt yêu cầu này. Vui lòng kiểm tra lại quyền của bạn.');
            }
        } catch (Exception $e) {
            set_alert('danger', 'Lỗi: ' . $e->getMessage());
        }

        redirect(admin_url('my_team/approvals'));
    }

    /**
     * Reject một step trong workflow
     */
    public function reject_step()
    {
        if (!staff_can('edit', 'my_team')) {
            access_denied('my_team');
        }

        $instance_id = $this->input->post('instance_id');
        $reason = $this->input->post('reason', true);
        $staff_id = get_staff_user_id();

        if (!$instance_id) {
            set_alert('danger', 'Invalid approval instance.');
            redirect(admin_url('my_team/approvals'));
        }

        if (empty($reason)) {
            set_alert('danger', 'Vui lòng cung cấp lý do từ chối.');
            redirect(admin_url('my_team/approvals'));
        }

        try {
            $success = $this->my_team_workflow_model->reject_step($instance_id, $staff_id, $reason);
            
            if ($success) {
                set_alert('success', 'Yêu cầu đã được từ chối.');
            } else {
                set_alert('danger', 'Không thể từ chối yêu cầu này. Vui lòng kiểm tra lại quyền của bạn.');
            }
        } catch (Exception $e) {
            set_alert('danger', 'Lỗi: ' . $e->getMessage());
        }

        redirect(admin_url('my_team/approvals'));
    }

    /**
     * View workflow history
     */
    public function workflow_history($approval_id)
    {
        if (!staff_can('view', 'my_team')) {
            access_denied('my_team');
        }

        $data['approval_id'] = $approval_id;
        $data['workflow_history'] = $this->my_team_workflow_model->get_approval_workflow_history($approval_id);
        $data['title'] = 'Workflow History';

        $this->load->view('approvals/workflow_history', $data);
    }

    /**
     * Get pending approvals for current staff (AJAX)
     */
    public function get_my_pending_approvals()
    {
        if (!staff_can('view', 'my_team')) {
            echo json_encode(['success' => false, 'message' => 'Access denied']);
            return;
        }

        $staff_id = get_staff_user_id();
        $pending_approvals = $this->my_team_workflow_model->get_pending_approvals_for_staff($staff_id);

        echo json_encode([
            'success' => true,
            'data' => $pending_approvals,
            'count' => count($pending_approvals)
        ]);
    }

    /**
     * Setup database tables (bao gồm cả workflow tables)
     */
} 