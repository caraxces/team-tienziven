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
        
        // Tự động tạo bảng nếu cần
        $this->create_tables_if_not_exist();
    }

    /**
     * Tạo bảng nếu chưa tồn tại
     */
    public function create_tables_if_not_exist()
    {
        if (!$this->db->table_exists($this->team_members_table)) {
            $this->create_tables();
        }
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
        $this->db->select('p.*, c.company');
        $this->db->from(db_prefix() . 'projects as p');
        $this->db->join(db_prefix() . 'project_members as pm', 'pm.project_id = p.id');
        $this->db->join(db_prefix() . 'clients as c', 'c.userid = p.clientid', 'left');
        $this->db->where('pm.staff_id', $staff_id);
        
        return $this->db->get()->result_array();
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
        $this->db->select('a.*, CONCAT(s.firstname, " ", s.lastname) as staff_name, CONCAT(m.firstname, " ", m.lastname) as approver_name');
        $this->db->from($this->approvals_table . ' as a');
        $this->db->join(db_prefix() . 'staff as s', 's.staffid = a.staff_id');
        $this->db->join(db_prefix() . 'staff as m', 'm.staffid = a.approver_id');
        $this->db->join($this->team_members_table . ' as tm', 'tm.staff_id = a.staff_id');
        $this->db->where('tm.manager_id', $manager_id);
        
        if ($type != 'all') {
            $this->db->where('a.type', $type);
        }
        
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
        $this->db->select('a.*, CONCAT(s.firstname, " ", s.lastname) as staff_name, CONCAT(m.firstname, " ", m.lastname) as approver_name');
        $this->db->from($this->approvals_table . ' as a');
        $this->db->join(db_prefix() . 'staff as s', 's.staffid = a.staff_id');
        $this->db->join(db_prefix() . 'staff as m', 'm.staffid = a.approver_id');
        $this->db->where('a.staff_id', $staff_id);
        
        if ($type != 'all') {
            $this->db->where('a.type', $type);
        }
        
        $this->db->order_by('a.datecreated', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Get a single approval by ID
     * @param  int   $id
     * @return object
     */
    public function get_approval($id)
    {
        $this->db->select('a.*, CONCAT(s.firstname, " ", s.lastname) as staff_name, CONCAT(m.firstname, " ", m.lastname) as approver_name');
        $this->db->from($this->approvals_table . ' as a');
        $this->db->join(db_prefix() . 'staff as s', 's.staffid = a.staff_id');
        $this->db->join(db_prefix() . 'staff as m', 'm.staffid = a.approver_id');
        $this->db->where('a.id', $id);
        
        return $this->db->get()->row();
    }
    
    /**
     * Add a new approval request
     * @param  array  $data
     * @return int|boolean
     */
    public function add_approval($data)
    {
        // Get staff manager
        $manager_id = $this->get_staff_manager($data['staff_id']);
        
        if (!$manager_id) {
            return false;
        }
        
        $insert_data = [
            'staff_id' => $data['staff_id'],
            'approver_id' => $manager_id,
            'type' => $data['type'],
            'subject' => $data['subject'],
            'description' => isset($data['description']) ? $data['description'] : null,
            'date' => isset($data['date']) ? $data['date'] : date('Y-m-d'),
            'status' => 1, // Pending
            'datecreated' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert($this->approvals_table, $insert_data);
        
        if ($this->db->affected_rows() > 0) {
            $approval_id = $this->db->insert_id();
            
            // Send notification to manager
            $notified = add_notification([
                'description' => 'New approval request: ' . $data['subject'],
                'touserid' => $manager_id,
                'link' => 'my_team/view_approval/' . $approval_id
            ]);
            
            if ($notified) {
                pusher_trigger_notification([$manager_id]);
            }
            
            log_activity('New Approval Request Added [ID: ' . $approval_id . ']');
            return $approval_id;
        }
        
        return false;
    }
    
    /**
     * Change approval status
     * @param  int    $id
     * @param  int    $status
     * @return boolean
     */
    public function change_approval_status($id, $status)
    {
        $this->db->where('id', $id);
        $this->db->update($this->approvals_table, [
            'status' => $status,
            'date_approved' => date('Y-m-d H:i:s')
        ]);
        
        if ($this->db->affected_rows() > 0) {
            $approval = $this->get_approval($id);
            
            // Send notification to requester
            $status_text = $status == 2 ? 'approved' : 'rejected';
            $notified = add_notification([
                'description' => 'Your approval request "' . $approval->subject . '" has been ' . $status_text,
                'touserid' => $approval->staff_id,
                'link' => 'my_team/view_approval/' . $id
            ]);
            
            if ($notified) {
                pusher_trigger_notification([$approval->staff_id]);
            }
            
            log_activity('Approval Request Status Changed [ID: ' . $id . ', Status: ' . $status_text . ']');
            return true;
        }
        
        return false;
    }
    
    /* Knowledge Functions */
    
    /**
     * Get knowledge items created by a manager
     * @param  int   $manager_id
     * @return array
     */
    public function get_knowledge_items_by_manager($manager_id)
    {
        $this->db->select('k.*, CONCAT(s.firstname, " ", s.lastname) as manager_name');
        $this->db->from($this->knowledge_items_table . ' as k');
        $this->db->join(db_prefix() . 'staff as s', 's.staffid = k.manager_id');
        $this->db->where('k.manager_id', $manager_id);
        $this->db->order_by('k.date_created', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Get knowledge items for a staff member
     * @param  int   $staff_id
     * @return array
     */
    public function get_knowledge_items_for_staff($staff_id)
    {
        $manager_id = $this->get_staff_manager($staff_id);
        
        if (!$manager_id) {
            return [];
        }
        
        $this->db->select('k.*, CONCAT(s.firstname, " ", s.lastname) as manager_name, 
                          CASE WHEN kr.id IS NULL THEN 0 ELSE 1 END as is_read,
                          kr.date_read');
        $this->db->from($this->knowledge_items_table . ' as k');
        $this->db->join(db_prefix() . 'staff as s', 's.staffid = k.manager_id');
        $this->db->join($this->knowledge_reads_table . ' as kr', 'kr.knowledge_id = k.id AND kr.staff_id = ' . $staff_id, 'left');
        $this->db->where('k.manager_id', $manager_id);
        $this->db->order_by('k.date_created', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /**
     * Get a single knowledge item
     * @param  int   $id
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
     * Add a new knowledge item
     * @param  array  $data
     * @return int|boolean
     */
    public function add_knowledge_item($data)
    {
        $insert_data = [
            'title' => $data['title'],
            'content' => $data['content'],
            'manager_id' => $data['manager_id'],
            'date_created' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert($this->knowledge_items_table, $insert_data);
        
        if ($this->db->affected_rows() > 0) {
            $knowledge_id = $this->db->insert_id();
            
            // Get all team members for this manager
            $team_members = $this->get_staff_members_by_manager($data['manager_id']);
            
            // Send notification to all team members
            if (!empty($team_members)) {
                $staff_ids = [];
                
                foreach ($team_members as $member) {
                    $staff_ids[] = $member['staffid'];
                }
                
                $notified = add_notification([
                    'description' => 'New knowledge item: ' . $data['title'],
                    'touserid' => $staff_ids,
                    'link' => 'my_team/view_knowledge_item/' . $knowledge_id
                ]);
                
                if ($notified) {
                    pusher_trigger_notification($staff_ids);
                }
            }
            
            log_activity('New Knowledge Item Added [ID: ' . $knowledge_id . ']');
            return $knowledge_id;
        }
        
        return false;
    }
    
    /**
     * Check if a staff member can view a knowledge item
     * @param  int     $staff_id
     * @param  int     $item_id
     * @return boolean
     */
    public function can_view_knowledge_item($staff_id, $item_id)
    {
        $item = $this->get_knowledge_item($item_id);
        
        if (!$item) {
            return false;
        }
        
        // Manager who created the item can view it
        if ($staff_id == $item->manager_id) {
            return true;
        }
        
        // Check if staff is managed by the item creator
        return $this->is_staff_managed_by($item->manager_id, $staff_id);
    }
    
    /**
     * Mark a knowledge item as read by a staff member
     * @param  int     $item_id
     * @param  int     $staff_id
     * @return boolean
     */
    public function mark_knowledge_as_read($item_id, $staff_id)
    {
        // Check if already read
        $this->db->where('knowledge_id', $item_id);
        $this->db->where('staff_id', $staff_id);
        $already_read = $this->db->count_all_results($this->knowledge_reads_table) > 0;
        
        if ($already_read) {
            return true;
        }
        
        $this->db->insert($this->knowledge_reads_table, [
            'knowledge_id' => $item_id,
            'staff_id' => $staff_id,
            'date_read' => date('Y-m-d H:i:s')
        ]);
        
        if ($this->db->affected_rows() > 0) {
            // Notify manager that staff read the item
            $item = $this->get_knowledge_item($item_id);
            $staff = $this->ci->staff_model->get($staff_id);
            
            if ($item && $staff) {
                $notified = add_notification([
                    'description' => $staff->firstname . ' ' . $staff->lastname . ' has read: ' . $item->title,
                    'touserid' => $item->manager_id,
                    'link' => 'my_team/view_knowledge_item/' . $item_id
                ]);
                
                if ($notified) {
                    pusher_trigger_notification([$item->manager_id]);
                }
            }
            
            return true;
        }
        
        return false;
    }
    
    /**
     * Check if a staff member has read a knowledge item
     * @param  int     $staff_id
     * @param  int     $item_id
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
     * @param  int    $staff_id
     * @return array
     */
    public function get_staff_knowledge_items($staff_id)
    {
        $this->db->select('k.*, kr.date_read, CONCAT(s.firstname, " ", s.lastname) as manager_name');
        $this->db->from($this->knowledge_items_table . ' as k');
        $this->db->join($this->knowledge_reads_table . ' as kr', 'kr.knowledge_id = k.id');
        $this->db->join(db_prefix() . 'staff as s', 's.staffid = k.manager_id');
        $this->db->where('kr.staff_id', $staff_id);
        $this->db->order_by('kr.date_read', 'desc');
        
        return $this->db->get()->result_array();
    }
    
    /* Attitude Evaluations Functions */
    
    /**
     * Add attitude evaluation for a staff member
     * @param  array   $data
     * @return int|boolean
     */
    public function add_attitude_evaluation($data)
    {
        // Check if already exists for this month/year
        $this->db->where('staff_id', $data['staff_id']);
        $this->db->where('manager_id', $data['manager_id']);
        $this->db->where('month', $data['month']);
        $this->db->where('year', $data['year']);
        $exists = $this->db->count_all_results($this->attitude_evaluations_table) > 0;
        
        if ($exists) {
            // Update instead
            $this->db->where('staff_id', $data['staff_id']);
            $this->db->where('manager_id', $data['manager_id']);
            $this->db->where('month', $data['month']);
            $this->db->where('year', $data['year']);
            $this->db->update($this->attitude_evaluations_table, [
                'evaluation' => $data['evaluation'],
                'rating' => $data['rating']
            ]);
            
            if ($this->db->affected_rows() > 0) {
                log_activity('Attitude Evaluation Updated [Staff ID: ' . $data['staff_id'] . ']');
                return true;
            }
            
            return false;
        }
        
        $insert_data = [
            'staff_id' => $data['staff_id'],
            'manager_id' => $data['manager_id'],
            'month' => $data['month'],
            'year' => $data['year'],
            'evaluation' => $data['evaluation'],
            'rating' => $data['rating'],
            'datecreated' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert($this->attitude_evaluations_table, $insert_data);
        
        if ($this->db->affected_rows() > 0) {
            $evaluation_id = $this->db->insert_id();
            
            // Notify staff member
            $notified = add_notification([
                'description' => 'New attitude evaluation for ' . date('F Y', mktime(0, 0, 0, $data['month'], 1, $data['year'])),
                'touserid' => $data['staff_id'],
                'link' => 'my_team'
            ]);
            
            if ($notified) {
                pusher_trigger_notification([$data['staff_id']]);
            }
            
            log_activity('New Attitude Evaluation Added [ID: ' . $evaluation_id . ']');
            return $evaluation_id;
        }
        
        return false;
    }
    
    /**
     * Get attitude evaluations for a staff member
     * @param  int    $staff_id
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
     * @param  int       $staff_id
     * @return int|null  Manager ID
     */
    public function get_staff_manager($staff_id)
    {
        $this->db->select('manager_id');
        $this->db->from($this->team_members_table);
        $this->db->where('staff_id', $staff_id);
        $this->db->limit(1);
        
        $result = $this->db->get()->row();
        
        return $result ? $result->manager_id : null;
    }
    
    /**
     * Get all managers in the system
     * @return array
     */
    public function get_all_managers()
    {
        $this->db->select('DISTINCT s.staffid, CONCAT(s.firstname, " ", s.lastname) as full_name');
        $this->db->from(db_prefix() . 'staff as s');
        $this->db->join($this->team_members_table . ' as tm', 'tm.manager_id = s.staffid');
        $this->db->order_by('s.firstname', 'asc');
        
        return $this->db->get()->result_array();
    }

    /**
     * Đảm bảo admin có quyền quản lý
     * @param int $admin_id
     * @return boolean
     */
    public function ensure_admin_has_manager_rights($admin_id)
    {
        // Kiểm tra xem admin đã có trong bảng team_members chưa
        $this->db->where('manager_id', $admin_id);
        $existing = $this->db->count_all_results($this->team_members_table);

        // Nếu chưa có dữ liệu, thêm admin vào làm manager của chính mình và của tất cả staff
        if ($existing == 0) {
            // Thêm admin làm manager của chính mình
            $this->db->insert($this->team_members_table, [
                'manager_id' => $admin_id,
                'staff_id' => $admin_id,
                'date_assigned' => date('Y-m-d H:i:s')
            ]);
            
            // Lấy danh sách tất cả staff không phải admin hiện tại
            $this->db->where('staffid !=', $admin_id);
            $staffs = $this->db->get(db_prefix() . 'staff')->result_array();

            // Thêm admin làm quản lý cho tất cả staff
            foreach ($staffs as $staff) {
                $this->db->insert($this->team_members_table, [
                    'manager_id' => $admin_id,
                    'staff_id' => $staff['staffid'],
                    'date_assigned' => date('Y-m-d H:i:s')
                ]);
            }
            
            return true;
        }
        
        return false;
    }
} 