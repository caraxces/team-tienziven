<?php

defined('BASEPATH') or exit('No direct script access allowed');

class My_team extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        
        // Nếu không phải admin và không có quyền xem, từ chối truy cập
        if (!is_admin() && !has_permission('my_team', '', 'view')) {
            access_denied('my_team');
        }
        
        $this->load->model('my_team_model');
        $this->load->model('staff_model');
        $this->load->model('projects_model');
        $this->load->model('tasks_model');
        
        // Đảm bảo admin luôn có quyền quản lý
        if (is_admin()) {
            $staff_id = get_staff_user_id();
            $this->my_team_model->ensure_admin_has_manager_rights($staff_id);
        }
    }

    /**
     * Main view - shows team members
     */
    public function index()
    {
        $data['title'] = _l('my_team');
        
        // Check if current staff member is a manager
        $staff_id = get_staff_user_id();
        $is_admin = is_admin($staff_id);
        $team_members = $this->my_team_model->get_staff_members_by_manager($staff_id);
        
        $data['team_members'] = $team_members;
        $data['all_staff'] = $this->staff_model->get('', ['active' => 1]);
        $data['is_manager'] = !empty($team_members) || $is_admin || has_permission('my_team', '', 'create');
        
        // For staff members who are not managers
        if (empty($team_members) && !$is_admin && !has_permission('my_team', '', 'create')) {
            $manager_id = $this->my_team_model->get_staff_manager($staff_id);
            if ($manager_id) {
                $data['manager'] = $this->staff_model->get($manager_id);
            }
        }
        
        $this->load->view('admin/my_team/members/manage', $data);
    }
    
    /**
     * Add a team member to the current manager's team
     */
    public function add_team_member()
    {
        if (!has_permission('my_team', '', 'create')) {
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
        if (!has_permission('my_team', '', 'delete')) {
            access_denied('my_team');
        }
        
        $manager_id = get_staff_user_id();
        
        // Check if staff_id is actually managed by current user
        if (!$this->my_team_model->is_staff_managed_by($manager_id, $staff_id)) {
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
        $manager_id = get_staff_user_id();
        
        // Check if staff_id is actually managed by current user or is the current user
        if ($staff_id != $manager_id && !$this->my_team_model->is_staff_managed_by($manager_id, $staff_id)) {
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
        $data['is_manager'] = ($manager_id == $staff_id) || $this->my_team_model->is_staff_managed_by($manager_id, $staff_id);
        
        $this->load->view('admin/my_team/members/view', $data);
    }
    
    /**
     * Approvals main page
     */
    public function approvals($type = 'payment_requests')
    {
        $data['title'] = _l('approvals');
        $data['type'] = $type;
        $staff_id = get_staff_user_id();
        
        // Special handling for admin users
        $is_admin = is_admin($staff_id);
        
        // Check if current staff is a manager
        $team_members = $this->my_team_model->get_staff_members_by_manager($staff_id);
        $data['is_manager'] = !empty($team_members) || $is_admin || has_permission('my_team', '', 'create');
        
        // For managers - show all team members' approvals
        if ($data['is_manager']) {
            $data['approvals'] = $this->my_team_model->get_approvals_by_type($type, $staff_id);
        } else {
            // For staff - show only their approvals
            $data['approvals'] = $this->my_team_model->get_staff_approvals_by_type($type, $staff_id);
        }
        
        $this->load->view('admin/my_team/approvals/manage', $data);
    }
    
    /**
     * Add new approval request
     */
    public function add_approval($type = 'payment_requests')
    {
        if ($this->input->post()) {
            $data = $this->input->post();
            $data['staff_id'] = get_staff_user_id();
            $data['type'] = $type;
            
            $result = $this->my_team_model->add_approval($data);
            
            if ($result) {
                set_alert('success', _l('approval_added_successfully'));
            } else {
                set_alert('danger', _l('approval_add_failed'));
            }
            
            redirect(admin_url('my_team/approvals/' . $type));
        }
        
        $data['title'] = _l('add_approval');
        $data['type'] = $type;
        
        $this->load->view('admin/my_team/approvals/add', $data);
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
            !$this->my_team_model->is_staff_managed_by($staff_id, $approval->staff_id)) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team/approvals'));
        }
        
        $data['approval'] = $approval;
        $data['title'] = _l('approval_details');
        $data['can_approve'] = ($approval->approver_id == $staff_id || $this->my_team_model->is_staff_managed_by($staff_id, $approval->staff_id));
        
        $this->load->view('admin/my_team/approvals/view', $data);
    }
    
    /**
     * Change approval status
     */
    public function change_approval_status($id, $status)
    {
        $approval = $this->my_team_model->get_approval($id);
        
        if (!$approval) {
            show_404();
        }
        
        $staff_id = get_staff_user_id();
        
        // Check if user is the approver or manages the requester
        if ($approval->approver_id != $staff_id && !$this->my_team_model->is_staff_managed_by($staff_id, $approval->staff_id)) {
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
        $data['is_manager'] = !empty($team_members) || $is_admin || has_permission('my_team', '', 'create');
        
        // For managers - show all knowledge items they created
        if ($data['is_manager']) {
            $data['knowledge_items'] = $this->my_team_model->get_knowledge_items_by_manager($staff_id);
        } else {
            // For staff - show only knowledge items applicable to them
            $data['knowledge_items'] = $this->my_team_model->get_knowledge_items_for_staff($staff_id);
        }
        
        $this->load->view('admin/my_team/knowledge/manage', $data);
    }
    
    /**
     * Add new knowledge item
     */
    public function add_knowledge_item()
    {
        if (!has_permission('my_team', '', 'create')) {
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
        
        $this->load->view('admin/my_team/knowledge/add', $data);
    }
    
    /**
     * View knowledge item details
     */
    public function view_knowledge_item($id)
    {
        $staff_id = get_staff_user_id();
        
        // Check if user can view this knowledge item
        if (!$this->my_team_model->can_view_knowledge_item($staff_id, $id)) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team/knowledge'));
        }
        
        $data['item'] = $this->my_team_model->get_knowledge_item($id);
        
        if (!$data['item']) {
            show_404();
        }
        
        $data['title'] = _l('knowledge_item_details');
        $data['already_read'] = $this->my_team_model->has_read_knowledge_item($staff_id, $id);
        
        $this->load->view('admin/my_team/knowledge/view', $data);
    }
    
    /**
     * Mark knowledge item as read
     */
    public function mark_knowledge_read($id)
    {
        $staff_id = get_staff_user_id();
        
        // Check if user can view this knowledge item
        if (!$this->my_team_model->can_view_knowledge_item($staff_id, $id)) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team/knowledge'));
        }
        
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
        
        // Check if current staff is a manager
        $team_members = $this->my_team_model->get_staff_members_by_manager($staff_id);
        $data['is_manager'] = !empty($team_members) || $is_admin || has_permission('my_team', '', 'create');
        
        // Tải các model cần thiết cho widgets
        $this->load->model('dashboard_model');
        $this->load->model('utilities_model');
        $this->load->model('currencies_model');
        $this->load->model('todo_model');
        
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
        
        if ($data['is_manager']) {
            // Get performance data for team members
            $data['team_members'] = $team_members;
            $data['team_stats'] = [];
            
            foreach ($data['team_members'] as $member) {
                // Get task statistics
                $tasks = $this->tasks_model->get_tasks_by_staff_id($member['staffid']);
                $completed_tasks = array_filter($tasks, function($task) {
                    return $task['status'] == 5; // Completed status
                });
                $pending_tasks = array_filter($tasks, function($task) {
                    return $task['status'] != 5; // Not completed
                });
                
                // Knowledge read statistics
                $knowledge_items = $this->my_team_model->get_staff_knowledge_items($member['staffid']);
                
                // Store stats for this team member
                $data['team_stats'][$member['staffid']] = [
                    'completed_tasks' => count($completed_tasks),
                    'pending_tasks' => count($pending_tasks),
                    'total_task_comments' => $this->my_team_model->count_task_comments($member['staffid']),
                    'knowledge_read' => count($knowledge_items)
                ];
            }
            
            $this->load->view('admin/my_team/performance/manager_view', $data);
        } else {
            // Get manager
            $manager_id = $this->my_team_model->get_staff_manager($staff_id);
            if ($manager_id) {
                $data['manager'] = $this->staff_model->get($manager_id);
            }
            
            // Get own performance data
            $tasks = $this->tasks_model->get_tasks_by_staff_id($staff_id);
            $data['completed_tasks'] = count(array_filter($tasks, function($task) {
                return $task['status'] == 5; // Completed status
            }));
            $data['pending_tasks'] = count(array_filter($tasks, function($task) {
                return $task['status'] != 5; // Not completed
            }));
            $data['total_task_comments'] = $this->my_team_model->count_task_comments($staff_id);
            $data['knowledge_read'] = count($this->my_team_model->get_staff_knowledge_items($staff_id));
            $data['tasks'] = array_slice($tasks, 0, 10); // Get 10 most recent tasks
            
            $this->load->view('admin/my_team/performance/staff_view', $data);
        }
    }
    
    /**
     * Add attitude evaluation for a team member
     */
    public function add_attitude_evaluation($staff_id)
    {
        if (!has_permission('my_team', '', 'create')) {
            access_denied('my_team');
        }
        
        $manager_id = get_staff_user_id();
        
        // Check if staff_id is actually managed by current user
        if (!$this->my_team_model->is_staff_managed_by($manager_id, $staff_id)) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('my_team'));
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
        
        $data['staff'] = $this->staff_model->get($staff_id);
        $data['title'] = _l('add_attitude_evaluation');
        
        $this->load->view('admin/my_team/attitude/add', $data);
    }
} 