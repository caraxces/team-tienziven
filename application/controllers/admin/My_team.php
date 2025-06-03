<?php

defined('BASEPATH') or exit('No direct script access allowed');

class My_team extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        
        // Tải model cần thiết
        $this->load->model('my_team_model');
        $this->load->model('staff_model');
        $this->load->model('departments_model');
        $this->load->model('roles_model');
        
        // Kiểm tra quyền truy cập
        if (!has_permission('staff', '', 'view')) {
            access_denied('My Team');
        }
    }
    
    /**
     * Dashboard tổng quan
     */
    public function index()
    {
        $data = [];
        $data['title'] = _l('my_team');
        
        // Lấy thống kê nhân viên - sử dụng count_all_results thay vì get_total_staff_count
        $this->db->where('active', 1);
        $data['active_staff'] = $this->db->count_all_results(db_prefix() . 'staff');
        
        $data['total_staff'] = $this->db->count_all_results(db_prefix() . 'staff');
        
        // Lấy danh sách nhân viên
        $data['staff_members'] = $this->staff_model->get('', ['active' => 1]);
        
        // Lấy thông tin phòng ban
        $data['departments'] = $this->departments_model->get();
        
        // Lấy số lượng task và dự án đang hoạt động
        $this->db->where('status !=', 5); // Status 5 là hoàn thành
        $data['active_tasks'] = $this->db->count_all_results(db_prefix() . 'tasks');
        
        $this->db->where('status !=', 4); // Status 4 là hoàn thành
        $data['active_projects'] = $this->db->count_all_results(db_prefix() . 'projects');
        
        $this->load->view('admin/my_team/dashboard', $data);
    }

    /**
     * Trang quản lý thành viên
     */
    public function members()
    {
        $data = [];
        $data['title'] = _l('team_members');
        
        // Lấy danh sách nhân viên
        $data['staff_members'] = $this->staff_model->get('', ['active' => 1]);
        
        // Lấy thông tin phòng ban và vai trò
        $data['departments'] = $this->departments_model->get();
        $data['roles'] = $this->roles_model->get();
        
        $this->load->view('admin/my_team/members', $data);
    }
    
    /**
     * Trang phê duyệt
     */
    public function approvals()
    {
        $data = [];
        $data['title'] = _l('team_approvals');
        
        // Lấy danh sách phê duyệt nếu có
        $data['approvals'] = $this->my_team_model->get_approvals();
        
        // Lấy danh sách phòng ban
        $data['departments'] = $this->departments_model->get();
        
        $this->load->view('admin/my_team/approvals', $data);
    }
    
    /**
     * Trang kiến thức
     */
    public function knowledge()
    {
        $data = [];
        $data['title'] = _l('team_knowledge');
        
        // Lấy danh sách knowledge items nếu có
        $data['knowledge_items'] = $this->my_team_model->get_knowledge_items();
        
        // Lấy danh mục
        $data['categories'] = $this->my_team_model->get_knowledge_categories();
        
        $this->load->view('admin/my_team/knowledge', $data);
    }
    
    /**
     * Trang hiệu suất
     */
    public function performance()
    {
        $data = [];
        $data['title'] = _l('team_performance');
        
        // Lấy staff_id từ URL hoặc sử dụng ID của người đang đăng nhập
        $staff_id = $this->input->get('staff_id') ? $this->input->get('staff_id') : get_staff_user_id();
        $data['staff_id'] = $staff_id;
        
        // Lấy thông tin hiệu suất
        $data['performance'] = $this->my_team_model->get_staff_performance($staff_id);
        
        // Lấy danh sách nhân viên nếu là admin
        if (is_admin()) {
            $data['staff_members'] = $this->staff_model->get('', ['active' => 1]);
        } else {
            // Lấy thông tin nhân viên trong cùng phòng ban
            $staff_departments = $this->departments_model->get_staff_departments(get_staff_user_id());
            $department_ids = [];
            
            foreach ($staff_departments as $dept) {
                $department_ids[] = $dept['departmentid'];
            }
            
            if (!empty($department_ids)) {
                $this->db->where_in('departmentid', $department_ids);
                $data['staff_members'] = $this->staff_model->get('', ['active' => 1]);
            } else {
                $data['staff_members'] = [];
            }
        }
        
        $this->load->view('admin/my_team/performance', $data);
    }
} 