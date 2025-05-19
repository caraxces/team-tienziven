<?php

defined('BASEPATH') or exit('No direct script access allowed');

class My_team_model extends App_Model
{
    private $team_members_table;
    private $approvals_table;
    private $knowledge_items_table;
    private $knowledge_reads_table;
    private $attitude_evaluations_table;

    public function __construct()
    {
        parent::__construct();
        $this->team_members_table = db_prefix() . 'team_members';
        $this->approvals_table = db_prefix() . 'team_approvals';
        $this->knowledge_items_table = db_prefix() . 'team_knowledge_items';
        $this->knowledge_reads_table = db_prefix() . 'team_knowledge_reads';
        $this->attitude_evaluations_table = db_prefix() . 'team_attitude_evaluations';
    }

    /**
     * Create database tables required for the module
     */
    public function create_tables()
    {
        // Team Members Table
        if (!$this->db->table_exists($this->team_members_table)) {
            $this->db->query("CREATE TABLE `" . $this->team_members_table . "` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `manager_id` int(11) NOT NULL,
                `staff_id` int(11) NOT NULL,
                `date_assigned` datetime NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        }
        
        // Approvals Table
        if (!$this->db->table_exists($this->approvals_table)) {
            $this->db->query("CREATE TABLE `" . $this->approvals_table . "` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `staff_id` int(11) NOT NULL,
                `approver_id` int(11) NOT NULL,
                `type` varchar(50) NOT NULL,
                `status` int(11) NOT NULL DEFAULT '1',
                `subject` varchar(191) NOT NULL,
                `description` text NULL,
                `date` date NULL,
                `datecreated` datetime NOT NULL,
                `date_approved` datetime NULL,
                `read_by_approver` tinyint(1) NOT NULL DEFAULT '0',
                `read_by_staff` tinyint(1) NOT NULL DEFAULT '1',
                `last_updated` datetime NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        }
        
        // Knowledge Items Table
        if (!$this->db->table_exists($this->knowledge_items_table)) {
            $this->db->query("CREATE TABLE `" . $this->knowledge_items_table . "` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` varchar(191) NOT NULL,
                `content` text NOT NULL,
                `manager_id` int(11) NOT NULL,
                `date_created` datetime NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        }
        
        // Knowledge Reads Table
        if (!$this->db->table_exists($this->knowledge_reads_table)) {
            $this->db->query("CREATE TABLE `" . $this->knowledge_reads_table . "` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `knowledge_id` int(11) NOT NULL,
                `staff_id` int(11) NOT NULL,
                `date_read` datetime NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        }
        
        // Attitude Evaluations Table
        if (!$this->db->table_exists($this->attitude_evaluations_table)) {
            $this->db->query("CREATE TABLE `" . $this->attitude_evaluations_table . "` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `staff_id` int(11) NOT NULL,
                `manager_id` int(11) NOT NULL,
                `month` int(11) NOT NULL,
                `year` int(11) NOT NULL,
                `evaluation` text NOT NULL,
                `rating` int(11) NOT NULL DEFAULT '0',
                `datecreated` datetime NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        }
    }

    /**
     * Get staff members managed by a specific manager
     * @param  int  $manager_id
     * @return array 
     */
    public function get_staff_members_by_manager($manager_id)
    {
        $this->db->select('s.*, CONCAT(s.firstname, " ", s.lastname) as full_name');
        $this->db->from(db_prefix() . 'staff as s');
        $this->db->join($this->team_members_table . ' as tm', 'tm.staff_id = s.staffid');
        $this->db->where('tm.manager_id', $manager_id);
        $this->db->order_by('s.firstname', 'asc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Check if a staff member is managed by a specific manager
     * @param  int  $manager_id
     * @param  int  $staff_id  
     * @return boolean 
     */
    public function is_staff_managed_by($manager_id, $staff_id)
    {
        $this->db->where('manager_id', $manager_id);
        $this->db->where('staff_id', $staff_id);
        return $this->db->count_all_results($this->team_members_table) > 0;
    }
    
    /**
     * Add a staff member to a manager's team
     * @param  array $data
     * @param  int   $manager_id
     * @return int|boolean
     */
    public function add_team_member($data, $manager_id)
    {
        // Check if already exists
        $this->db->where('manager_id', $manager_id);
        $this->db->where('staff_id', $data['staff_id']);
        $exists = $this->db->count_all_results($this->team_members_table) > 0;
        
        if ($exists) {
            return false;
        }
        
        $this->db->insert($this->team_members_table, [
            'manager_id' => $manager_id,
            'staff_id' => $data['staff_id'],
            'date_assigned' => date('Y-m-d H:i:s')
        ]);
        
        if ($this->db->affected_rows() > 0) {
            log_activity('New Team Member Added [Manager ID: ' . $manager_id . ', Staff ID: ' . $data['staff_id'] . ']');
            return $this->db->insert_id();
        }
        
        return false;
    }
    
    /**
     * Remove a staff member from a manager's team
     * @param  int   $staff_id
     * @param  int   $manager_id
     * @return boolean
     */
    public function remove_team_member($staff_id, $manager_id)
    {
        $this->db->where('manager_id', $manager_id);
        $this->db->where('staff_id', $staff_id);
        $this->db->delete($this->team_members_table);
        
        if ($this->db->affected_rows() > 0) {
            log_activity('Team Member Removed [Manager ID: ' . $manager_id . ', Staff ID: ' . $staff_id . ']');
            return true;
        }
        
        return false;
    }
    
    /**
     * Get projects assigned to a staff member
     * @param  int  $staff_id
     * @return array
     */
    public function get_staff_projects($staff_id)
    {
        $this->db->where('project_members.staff_id', $staff_id);
        $this->db->join(db_prefix() . 'project_members', db_prefix() . 'project_members.project_id = ' . db_prefix() . 'projects.id');
        $this->db->order_by(db_prefix() . 'projects.name', 'asc');
        
        return $this->db->get(db_prefix() . 'projects')->result_array();
    }
    
    /**
     * Count task comments for a specific staff member
     * @param  int  $staff_id
     * @return int
     */
    public function count_task_comments($staff_id)
    {
        $this->db->where('staffid', $staff_id);
        return $this->db->count_all_results(db_prefix() . 'task_comments');
    }
    
    /* Approvals Functions */
    
    /**
     * Get approvals by type and manager
     * @param  string $type
     * @param  int    $manager_id
     * @return array
     */
    public function get_approvals_by_type($type, $manager_id)
    {
        $this->db->select('a.*, CONCAT(s.firstname, " ", s.lastname) as staff_name');
        $this->db->from($this->approvals_table . ' as a');
        $this->db->join(db_prefix() . 'staff as s', 's.staffid = a.staff_id');
        $this->db->join($this->team_members_table . ' as tm', 'tm.staff_id = a.staff_id');
        $this->db->where('a.type', $type);
        $this->db->where('tm.manager_id', $manager_id);
        $this->db->order_by('a.datecreated', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Get staff approvals by type
     * @param  string $type
     * @param  int    $staff_id
     * @return array
     */
    public function get_staff_approvals_by_type($type, $staff_id)
    {
        $this->db->select('a.*, CONCAT(s.firstname, " ", s.lastname) as staff_name');
        $this->db->from($this->approvals_table . ' as a');
        $this->db->join(db_prefix() . 'staff as s', 's.staffid = a.staff_id');
        $this->db->where('a.type', $type);
        $this->db->where('a.staff_id', $staff_id);
        $this->db->order_by('a.datecreated', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Get a specific approval
     * @param  int    $id
     * @return object
     */
    public function get_approval($id)
    {
        $this->db->select('a.*, CONCAT(s.firstname, " ", s.lastname) as staff_name, CONCAT(sa.firstname, " ", sa.lastname) as approver_name');
        $this->db->from($this->approvals_table . ' as a');
        $this->db->join(db_prefix() . 'staff as s', 's.staffid = a.staff_id');
        $this->db->join(db_prefix() . 'staff as sa', 'sa.staffid = a.approver_id');
        $this->db->where('a.id', $id);
        $approval = $this->db->get()->row();
        if ($approval) {
            if (!empty($approval->data)) {
                $approval->data = json_decode($approval->data, true);
            }
            if (!empty($approval->attachments)) {
                $approval->attachments = json_decode($approval->attachments, true);
            }
        }
        return $approval;
    }
    
    /**
     * Add a new approval request
     * @param  array  $data
     * @return int|boolean
     */
    public function add_approval($data)
    {
        $approver_id = isset($data['approver_id']) ? $data['approver_id'] : null;
        if (!$approver_id) {
            return false;
        }
        $insert_data = [
            'staff_id' => $data['staff_id'],
            'approver_id' => $approver_id,
            'type' => $data['type'],
            'subject' => $data['subject'],
            'description' => $data['description'],
            'status' => 1, // Pending
            'datecreated' => date('Y-m-d H:i:s'),
            'read_by_approver' => 0,
            'read_by_staff' => 1, // Người gửi mặc định đã đọc
            'last_updated' => date('Y-m-d H:i:s'),
        ];
        if (isset($data['date']) && !empty($data['date'])) {
            $insert_data['date'] = $data['date'];
        }
        // Lưu data động (JSON)
        if (isset($data['data'])) {
            $insert_data['data'] = is_array($data['data']) ? json_encode($data['data']) : $data['data'];
        }
        // Lưu file đính kèm
        if (isset($data['attachments'])) {
            $insert_data['attachments'] = is_array($data['attachments']) ? json_encode($data['attachments']) : $data['attachments'];
        }
        // Điều kiện nhánh
        if (isset($data['branch_condition'])) {
            $insert_data['branch_condition'] = $data['branch_condition'];
        }
        $this->db->insert($this->approvals_table, $insert_data);
        if ($this->db->affected_rows() > 0) {
            $approval_id = $this->db->insert_id();
            log_activity('New Approval Request Added [ID: ' . $approval_id . ', Type: ' . $data['type'] . ']');
            // Send notification to approver
            $this->load->model('emails_model');
            $this->emails_model->add_notification([
                'fromcompany' => true,
                'touserid' => $approver_id,
                'description' => 'New approval request from ' . get_staff_full_name($data['staff_id']),
                'link' => admin_url('my_team/view_approval/' . $approval_id),
                'additional_data' => serialize([
                    $data['subject']
                ])
            ]);
            return $approval_id;
        }
        return false;
    }
    
    /**
     * Đánh dấu đã đọc cho approver
     */
    public function mark_approval_read_by_approver($id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->approvals_table, [
            'read_by_approver' => 1,
            'last_updated' => date('Y-m-d H:i:s')
        ]);
    }
    /**
     * Đánh dấu đã đọc cho staff
     */
    public function mark_approval_read_by_staff($id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->approvals_table, [
            'read_by_staff' => 1,
            'last_updated' => date('Y-m-d H:i:s')
        ]);
    }
    
    /**
     * Change approval status
     * @param  int  $id
     * @param  int  $status
     * @return boolean
     */
    public function change_approval_status($id, $status)
    {
        $this->db->where('id', $id);
        $this->db->update($this->approvals_table, [
            'status' => $status,
            'date_approved' => date('Y-m-d H:i:s'),
            'last_updated' => date('Y-m-d H:i:s'),
            'read_by_staff' => 0 // Khi duyệt/từ chối, staff sẽ có badge đỏ
        ]);
        if ($this->db->affected_rows() > 0) {
            $approval = $this->get_approval($id);
            // Send notification to staff
            $this->load->model('emails_model');
            $status_text = '';
            if ($status == 2) {
                $status_text = 'approved';
            } elseif ($status == 3) {
                $status_text = 'rejected';
            }
            $this->emails_model->add_notification([
                'fromcompany' => true,
                'touserid' => $approval->staff_id,
                'description' => 'Your approval request has been ' . $status_text,
                'link' => admin_url('my_team/view_approval/' . $id),
                'additional_data' => serialize([
                    $approval->subject
                ])
            ]);
            log_activity('Approval Status Changed [ID: ' . $id . ', Status: ' . $status_text . ']');
            return true;
        }
        return false;
    }
    
    /* Knowledge Functions */
    
    /**
     * Get knowledge items by manager
     * @param  int  $manager_id
     * @return array
     */
    public function get_knowledge_items_by_manager($manager_id)
    {
        $this->db->select('k.*, COUNT(kr.id) as reads');
        $this->db->from($this->knowledge_items_table . ' as k');
        $this->db->join($this->knowledge_reads_table . ' as kr', 'kr.knowledge_id = k.id', 'left');
        $this->db->where('k.manager_id', $manager_id);
        $this->db->group_by('k.id');
        $this->db->order_by('k.date_created', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Get knowledge items for a staff member
     * @param  int  $staff_id
     * @return array
     */
    public function get_knowledge_items_for_staff($staff_id)
    {
        // Get the manager of this staff
        $manager_id = $this->get_staff_manager($staff_id);
        
        if (!$manager_id) {
            return [];
        }
        
        $this->db->select('k.*, kr.date_read');
        $this->db->from($this->knowledge_items_table . ' as k');
        $this->db->join($this->knowledge_reads_table . ' as kr', 'kr.knowledge_id = k.id AND kr.staff_id = ' . $staff_id, 'left');
        $this->db->where('k.manager_id', $manager_id);
        $this->db->order_by('k.date_created', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Get a specific knowledge item
     * @param  int  $id
     * @return object
     */
    public function get_knowledge_item($id)
    {
        $this->db->select('k.*, CONCAT(s.firstname, " ", s.lastname) as manager_name');
        $this->db->from($this->knowledge_items_table . ' as k');
        $this->db->join(db_prefix() . 'staff as s', 's.staffid = k.manager_id');
        $this->db->where('k.id', $id);
        
        return $this->db->get()->row();
    }
    
    /**
     * Add knowledge item
     * @param  array  $data
     * @return int|boolean
     */
    public function add_knowledge_item($data)
    {
        $this->db->insert($this->knowledge_items_table, [
            'title' => $data['title'],
            'content' => $data['content'],
            'manager_id' => $data['manager_id'],
            'date_created' => date('Y-m-d H:i:s')
        ]);
        
        if ($this->db->affected_rows() > 0) {
            $item_id = $this->db->insert_id();
            
            log_activity('New Knowledge Item Added [ID: ' . $item_id . ']');
            
            // Notify team members
            $team_members = $this->get_staff_members_by_manager($data['manager_id']);
            $this->load->model('emails_model');
            
            foreach ($team_members as $member) {
                $this->emails_model->add_notification([
                    'fromcompany' => true,
                    'touserid' => $member['staffid'],
                    'description' => 'New knowledge item: ' . $data['title'],
                    'link' => admin_url('my_team/view_knowledge_item/' . $item_id),
                    'additional_data' => serialize([
                        'Please review and mark as read when completed'
                    ])
                ]);
            }
            
            return $item_id;
        }
        
        return false;
    }
    
    /**
     * Check if a staff member can view a knowledge item
     * @param  int  $staff_id
     * @param  int  $item_id
     * @return boolean
     */
    public function can_view_knowledge_item($staff_id, $item_id)
    {
        $item = $this->get_knowledge_item($item_id);
        
        if (!$item) {
            return false;
        }
        
        // If staff is the manager who created it
        if ($item->manager_id == $staff_id) {
            return true;
        }
        
        // If staff is managed by the creator
        return $this->is_staff_managed_by($item->manager_id, $staff_id);
    }
    
    /**
     * Mark knowledge item as read
     * @param  int  $item_id
     * @param  int  $staff_id
     * @return boolean
     */
    public function mark_knowledge_as_read($item_id, $staff_id)
    {
        // Check if already marked as read
        $this->db->where('knowledge_id', $item_id);
        $this->db->where('staff_id', $staff_id);
        $exists = $this->db->count_all_results($this->knowledge_reads_table) > 0;
        
        if ($exists) {
            return false;
        }
        
        $this->db->insert($this->knowledge_reads_table, [
            'knowledge_id' => $item_id,
            'staff_id' => $staff_id,
            'date_read' => date('Y-m-d H:i:s')
        ]);
        
        if ($this->db->affected_rows() > 0) {
            log_activity('Knowledge Item Marked as Read [Item ID: ' . $item_id . ', Staff ID: ' . $staff_id . ']');
            
            // Notify manager
            $item = $this->get_knowledge_item($item_id);
            $this->load->model('emails_model');
            
            $this->emails_model->add_notification([
                'fromcompany' => true,
                'touserid' => $item->manager_id,
                'description' => get_staff_full_name($staff_id) . ' has read: ' . $item->title,
                'link' => admin_url('my_team/view_knowledge_item/' . $item_id),
                'additional_data' => serialize([
                    'Knowledge item marked as read at ' . date('Y-m-d H:i:s')
                ])
            ]);
            
            return true;
        }
        
        return false;
    }
    
    /**
     * Check if a staff member has read a knowledge item
     * @param  int  $staff_id
     * @param  int  $item_id
     * @return boolean
     */
    public function has_read_knowledge_item($staff_id, $item_id)
    {
        $this->db->where('knowledge_id', $item_id);
        $this->db->where('staff_id', $staff_id);
        return $this->db->count_all_results($this->knowledge_reads_table) > 0;
    }
    
    /**
     * Get knowledge items read by a staff member
     * @param  int  $staff_id
     * @return array
     */
    public function get_staff_knowledge_items($staff_id)
    {
        $this->db->select('k.*, kr.date_read');
        $this->db->from($this->knowledge_items_table . ' as k');
        $this->db->join($this->knowledge_reads_table . ' as kr', 'kr.knowledge_id = k.id');
        $this->db->where('kr.staff_id', $staff_id);
        $this->db->order_by('kr.date_read', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /* Attitude Evaluations Functions */
    
    /**
     * Add attitude evaluation
     * @param  array  $data
     * @return int|boolean
     */
    public function add_attitude_evaluation($data)
    {
        $insert_data = [
            'staff_id' => $data['staff_id'],
            'manager_id' => $data['manager_id'],
            'month' => date('n'),
            'year' => date('Y'),
            'evaluation' => $data['evaluation'],
            'rating' => $data['rating'],
            'datecreated' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert($this->attitude_evaluations_table, $insert_data);
        
        if ($this->db->affected_rows() > 0) {
            $id = $this->db->insert_id();
            log_activity('New Attitude Evaluation Added [Staff ID: ' . $data['staff_id'] . ', Month: ' . date('n') . ', Year: ' . date('Y') . ']');
            
            // Notify staff
            $this->load->model('emails_model');
            $this->emails_model->add_notification([
                'fromcompany' => true,
                'touserid' => $data['staff_id'],
                'description' => 'You have received a new attitude evaluation',
                'link' => admin_url('my_team/performance'),
                'additional_data' => serialize([
                    'For: ' . date('F Y')
                ])
            ]);
            
            return $id;
        }
        
        return false;
    }
    
    /**
     * Get staff attitude evaluations
     * @param  int  $staff_id
     * @return array
     */
    public function get_staff_attitude_evaluations($staff_id)
    {
        $this->db->select('ae.*, CONCAT(s.firstname, " ", s.lastname) as manager_name');
        $this->db->from($this->attitude_evaluations_table . ' as ae');
        $this->db->join(db_prefix() . 'staff as s', 's.staffid = ae.manager_id');
        $this->db->where('ae.staff_id', $staff_id);
        $this->db->order_by('ae.year', 'desc');
        $this->db->order_by('ae.month', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Get the manager of a staff member
     * @param  int  $staff_id
     * @return int|null
     */
    public function get_staff_manager($staff_id)
    {
        $this->db->select('manager_id');
        $this->db->from($this->team_members_table);
        $this->db->where('staff_id', $staff_id);
        $result = $this->db->get()->row();
        
        return $result ? $result->manager_id : null;
    }

    /**
     * Get all managers in the system
     * @return array
     */
    public function get_all_managers()
    {
        $this->db->select('DISTINCT(tm.manager_id) as staffid, CONCAT(s.firstname, " ", s.lastname) as full_name');
        $this->db->from($this->team_members_table . ' as tm');
        $this->db->join(db_prefix() . 'staff as s', 's.staffid = tm.manager_id');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Check if a staff member is an admin
     * @param  int  $staff_id
     * @return boolean
     */
    public function is_admin($staff_id = null)
    {
        if (is_null($staff_id)) {
            $staff_id = get_staff_user_id();
        }
        
        return is_admin($staff_id);
    }
    
    /**
     * Ensure admin users have manager rights
     * This function will check if the admin is already a manager
     * If not, it will make them manager of all staff
     * @param  int  $staff_id
     * @return boolean
     */
    public function ensure_admin_has_manager_rights($staff_id)
    {
        if (!is_admin($staff_id)) {
            return false;
        }
        
        // Check if admin is already managing some staff
        $team_members = $this->get_staff_members_by_manager($staff_id);
        
        if (!empty($team_members)) {
            return true; // Already a manager with team members
        }
        
        // Get all staff who don't have this admin as manager already
        $this->db->select('staffid');
        $this->db->from(db_prefix() . 'staff');
        $this->db->where('active', 1);
        $this->db->where('staffid !=', $staff_id); // Exclude self
        
        // Exclude staff who already have this admin as manager
        $this->db->where_not_in('staffid', "SELECT staff_id FROM {$this->team_members_table} WHERE manager_id = {$staff_id}", false);
        
        $staff = $this->db->get()->result_array();
        
        foreach ($staff as $member) {
            $this->db->insert($this->team_members_table, [
                'manager_id' => $staff_id,
                'staff_id' => $member['staffid'],
                'date_assigned' => date('Y-m-d H:i:s')
            ]);
        }
        
        return true;
    }

    /**
     * Lấy danh sách quy tắc phê duyệt
     */
    public function get_approval_rules($form_type = null)
    {
        $this->db->from(db_prefix() . 'approval_rules');
        if ($form_type) {
            $this->db->where('form_type', $form_type);
        }
        return $this->db->get()->result_array();
    }
    /**
     * Thêm quy tắc phê duyệt
     */
    public function add_approval_rule($data)
    {
        $insert = [
            'form_type' => $data['form_type'],
            'condition' => $data['condition'],
            'approver_role' => $data['approver_role'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert(db_prefix() . 'approval_rules', $insert);
        return $this->db->insert_id();
    }
    /**
     * Sửa quy tắc phê duyệt
     */
    public function update_approval_rule($id, $data)
    {
        $update = [
            'form_type' => $data['form_type'],
            'condition' => $data['condition'],
            'approver_role' => $data['approver_role'],
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'approval_rules', $update);
        return $this->db->affected_rows() > 0;
    }
    /**
     * Xóa quy tắc phê duyệt
     */
    public function delete_approval_rule($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'approval_rules');
        return $this->db->affected_rows() > 0;
    }

    /**
     * Get all team members for the current user (if is manager)
     * @return array
     */
    public function get_team_members()
    {
        // Nếu là admin, lấy tất cả staff
        if (is_admin()) {
            return $this->db->get(db_prefix() . 'staff')->result_array();
        }
        
        // Lấy ID của người dùng hiện tại
        $staff_id = get_staff_user_id();
        
        // Kiểm tra xem có phải team leader không
        $this->db->where('team_leader', $staff_id);
        $teams = $this->db->get(db_prefix() . 'staff_team')->result_array();
        
        if (empty($teams)) {
            // Không phải team leader, trả về chỉ thông tin của chính họ
            $this->db->where('staffid', $staff_id);
            return $this->db->get(db_prefix() . 'staff')->result_array();
        }
        
        // Lấy tất cả thành viên trong các team mà người dùng là team leader
        $team_ids = [];
        foreach ($teams as $team) {
            $team_ids[] = $team['team_id'];
        }
        
        $this->db->select('DISTINCT(staffid), firstname, lastname, email, profile_image, CONCAT(firstname, " ", lastname) as full_name');
        $this->db->from(db_prefix() . 'staff');
        $this->db->join(db_prefix() . 'staff_team_members', db_prefix() . 'staff_team_members.staff_id = ' . db_prefix() . 'staff.staffid', 'inner');
        $this->db->where_in(db_prefix() . 'staff_team_members.team_id', $team_ids);
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Check if a staff member is manager of another
     * @param int $manager_id
     * @param int $staff_id
     * @return bool
     */
    public function is_manager_of($manager_id, $staff_id)
    {
        if (is_admin($manager_id)) {
            return true; // Admin là manager của tất cả
        }
        
        $this->db->where('team_leader', $manager_id);
        $teams = $this->db->get(db_prefix() . 'staff_team')->result_array();
        
        if (empty($teams)) {
            return false;
        }
        
        $team_ids = [];
        foreach ($teams as $team) {
            $team_ids[] = $team['team_id'];
        }
        
        $this->db->where('staff_id', $staff_id);
        $this->db->where_in('team_id', $team_ids);
        
        return $this->db->count_all_results(db_prefix() . 'staff_team_members') > 0;
    }
} 