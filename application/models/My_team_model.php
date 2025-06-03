<?php

defined('BASEPATH') or exit('No direct script access allowed');

class My_team_model extends App_Model
{
    protected $module_model_loaded = false;

    public function __construct()
    {
        parent::__construct();
        
        // Kiểm tra xem module có tồn tại không
        $module_path = FCPATH . 'modules/my_team/models/My_team_model.php';
        
        if (file_exists($module_path)) {
            $this->load->model('../modules/my_team/models/my_team_model', 'module_model');
            $this->module_model_loaded = true;
        }
    }

    /**
     * Chuyển tiếp phương thức đến model trong module
     */
    public function __call($method, $args)
    {
        if ($this->module_model_loaded && method_exists($this->module_model, $method)) {
            return call_user_func_array([$this->module_model, $method], $args);
        }
        
        return null;
    }
    
    /**
     * Lấy danh sách nhân viên theo phòng ban
     * @param  integer $department_id ID phòng ban
     * @return array
     */
    public function get_staff_by_department($department_id = null)
    {
        $this->db->select('*');
        $this->db->from(db_prefix() . 'staff');
        $this->db->where('active', 1);
        
        if ($department_id) {
            $this->db->where('department_id', $department_id);
        }
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Lấy thông tin về hiệu suất nhân viên
     * @param  integer $staff_id ID nhân viên
     * @return array
     */
    public function get_staff_performance($staff_id)
    {
        // Lấy dữ liệu task
        $this->db->where('id IN (SELECT taskid FROM ' . db_prefix() . 'task_assigned WHERE staffid = ' . $staff_id . ')');
        $tasks = $this->db->get(db_prefix() . 'tasks')->result_array();
        
        // Phân loại task theo trạng thái
        $tasks_data = [
            'completed' => 0,
            'in_progress' => 0,
            'not_started' => 0,
            'total' => count($tasks)
        ];
        
        foreach ($tasks as $task) {
            if ($task['status'] == 5) {
                $tasks_data['completed']++;
            } elseif ($task['status'] == 2 || $task['status'] == 3 || $task['status'] == 4) {
                $tasks_data['in_progress']++;
            } else {
                $tasks_data['not_started']++;
            }
        }
        
        // Lấy dữ liệu dự án
        $this->db->where('id IN (SELECT project_id FROM ' . db_prefix() . 'project_members WHERE staff_id = ' . $staff_id . ')');
        $projects = $this->db->get(db_prefix() . 'projects')->result_array();
        
        // Phân loại dự án theo trạng thái
        $projects_data = [
            'completed' => 0,
            'in_progress' => 0,
            'not_started' => 0,
            'total' => count($projects)
        ];
        
        foreach ($projects as $project) {
            if ($project['status'] == 4) {
                $projects_data['completed']++;
            } elseif ($project['status'] == 2 || $project['status'] == 3) {
                $projects_data['in_progress']++;
            } else {
                $projects_data['not_started']++;
            }
        }
        
        return [
            'tasks' => $tasks_data,
            'projects' => $projects_data
        ];
    }
    
    /**
     * Lấy danh sách phê duyệt
     * @param  array  $where điều kiện tìm kiếm
     * @return array
     */
    public function get_approvals($where = [])
    {
        // Kiểm tra bảng phê duyệt đã tồn tại chưa
        if (!$this->db->table_exists(db_prefix() . 'team_approvals')) {
            return [];
        }
        
        $this->db->select('*');
        $this->db->from(db_prefix() . 'team_approvals');
        
        if (!empty($where)) {
            $this->db->where($where);
        }
        
        $this->db->order_by('date_created', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Lấy danh sách các knowledge item
     * @param  array  $where điều kiện tìm kiếm
     * @return array
     */
    public function get_knowledge_items($where = [])
    {
        // Kiểm tra bảng knowledge đã tồn tại chưa
        if (!$this->db->table_exists(db_prefix() . 'knowledge_items')) {
            return [];
        }
        
        $this->db->select('*');
        $this->db->from(db_prefix() . 'knowledge_items');
        
        if (!empty($where)) {
            $this->db->where($where);
        }
        
        $this->db->order_by('date_created', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Lấy danh sách các knowledge item cho nhân viên
     * @param  integer $staff_id     ID nhân viên
     * @param  array   $departments  Mảng ID phòng ban
     * @return array
     */
    public function get_knowledge_items_for_staff($staff_id, $departments = [])
    {
        // Kiểm tra bảng knowledge đã tồn tại chưa
        if (!$this->db->table_exists(db_prefix() . 'knowledge_items')) {
            return [];
        }
        
        $this->db->select('*');
        $this->db->from(db_prefix() . 'knowledge_items');
        
        // Lấy các knowledge item của nhân viên hoặc được chia sẻ
        $this->db->where('staff_id', $staff_id);
        
        if (!empty($departments)) {
            $this->db->or_where_in('department_id', $departments);
        }
        
        $this->db->order_by('date_created', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Lấy danh sách danh mục knowledge
     * @param  array  $where điều kiện tìm kiếm
     * @return array
     */
    public function get_knowledge_categories($where = [])
    {
        // Kiểm tra bảng knowledge category đã tồn tại chưa
        if (!$this->db->table_exists(db_prefix() . 'knowledge_categories')) {
            return [];
        }
        
        $this->db->select('*');
        $this->db->from(db_prefix() . 'knowledge_categories');
        
        if (!empty($where)) {
            $this->db->where($where);
        }
        
        $this->db->order_by('name', 'asc');
        
        return $this->db->get()->result_array();
    }
} 