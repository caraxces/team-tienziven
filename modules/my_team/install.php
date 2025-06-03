<?php

defined('BASEPATH') or exit('No direct script access allowed');

$CI = &get_instance();
$CI->load->dbforge();

// team_approvals table - lưu trữ thông tin phê duyệt
if (!$CI->db->table_exists(db_prefix() . 'team_approvals')) {
    $fields = [
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => true,
        ],
        'subject' => [
            'type' => 'VARCHAR',
            'constraint' => 191,
            'null' => true,
        ],
        'description' => [
            'type' => 'TEXT',
            'null' => true,
        ],
        'staff_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => false,
        ],
        'department_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => true,
        ],
        'approval_type' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => false,
            'default' => 'general',
        ],
        'status' => [
            'type' => 'TINYINT',
            'constraint' => 1,
            'null' => false,
            'default' => 0,
            'comment' => '0=pending, 1=approved, 2=rejected, 3=cancelled',
        ],
        'amount' => [
            'type' => 'DECIMAL',
            'constraint' => '15,2',
            'null' => true,
            'default' => 0.00,
        ],
        'json_data' => [
            'type' => 'TEXT',
            'null' => true,
            'comment' => 'JSON data for additional fields',
        ],
        'date_from' => [
            'type' => 'DATE',
            'null' => true,
        ],
        'date_to' => [
            'type' => 'DATE',
            'null' => true,
        ],
        'approved_by' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => true,
        ],
        'approved_date' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'rejected_by' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => true,
        ],
        'rejected_date' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'rejected_reason' => [
            'type' => 'TEXT',
            'null' => true,
        ],
        'attachment' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
            'null' => true,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => false,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ];

    $CI->dbforge->add_field($fields);
    $CI->dbforge->add_key('id', true);
    $CI->dbforge->add_key('staff_id');
    $CI->dbforge->create_table(db_prefix() . 'team_approvals');
}

// leave_balances table - lưu trữ số ngày nghỉ phép của nhân viên
if (!$CI->db->table_exists(db_prefix() . 'leave_balances')) {
    $fields = [
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => true,
        ],
        'staff_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => false,
        ],
        'leave_type' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => false,
            'default' => 'annual',
        ],
        'year' => [
            'type' => 'INT',
            'constraint' => 4,
            'null' => false,
        ],
        'total_days' => [
            'type' => 'DECIMAL',
            'constraint' => '5,1',
            'null' => false,
            'default' => 0.0,
        ],
        'used_days' => [
            'type' => 'DECIMAL',
            'constraint' => '5,1',
            'null' => false,
            'default' => 0.0,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => false,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ];

    $CI->dbforge->add_field($fields);
    $CI->dbforge->add_key('id', true);
    $CI->dbforge->add_key(['staff_id', 'leave_type', 'year']);
    $CI->dbforge->create_table(db_prefix() . 'leave_balances');
}

// financial_records table - lưu trữ các giao dịch tài chính
if (!$CI->db->table_exists(db_prefix() . 'financial_records')) {
    $fields = [
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => true,
        ],
        'staff_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => false,
        ],
        'approval_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => true,
        ],
        'type' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => false,
        ],
        'description' => [
            'type' => 'TEXT',
            'null' => true,
        ],
        'amount' => [
            'type' => 'DECIMAL',
            'constraint' => '15,2',
            'null' => false,
        ],
        'date' => [
            'type' => 'DATE',
            'null' => false,
        ],
        'category' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
            'null' => true,
        ],
        'status' => [
            'type' => 'TINYINT',
            'constraint' => 1,
            'null' => false,
            'default' => 1,
        ],
        'reference' => [
            'type' => 'VARCHAR',
            'constraint' => 191,
            'null' => true,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => false,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ];

    $CI->dbforge->add_field($fields);
    $CI->dbforge->add_key('id', true);
    $CI->dbforge->add_key('staff_id');
    $CI->dbforge->add_key('approval_id');
    $CI->dbforge->create_table(db_prefix() . 'financial_records');
}

// attendance_records table - lưu trữ dữ liệu điểm danh
if (!$CI->db->table_exists(db_prefix() . 'attendance_records')) {
    $fields = [
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => true,
        ],
        'staff_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => false,
        ],
        'date' => [
            'type' => 'DATE',
            'null' => false,
        ],
        'clock_in' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'clock_out' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'status' => [
            'type' => 'VARCHAR',
            'constraint' => 20,
            'null' => false,
            'default' => 'present',
        ],
        'reason' => [
            'type' => 'TEXT',
            'null' => true,
        ],
        'work_hours' => [
            'type' => 'DECIMAL',
            'constraint' => '5,2',
            'null' => true,
        ],
        'overtime_hours' => [
            'type' => 'DECIMAL',
            'constraint' => '5,2',
            'null' => true,
            'default' => 0.00,
        ],
        'approval_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => true,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => false,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ];

    $CI->dbforge->add_field($fields);
    $CI->dbforge->add_key('id', true);
    $CI->dbforge->add_key(['staff_id', 'date']);
    $CI->dbforge->add_key('approval_id');
    $CI->dbforge->create_table(db_prefix() . 'attendance_records');
}

// staff_skills table - lưu trữ kỹ năng của nhân viên
if (!$CI->db->table_exists(db_prefix() . 'staff_skills')) {
    $fields = [
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => true,
        ],
        'staff_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => false,
        ],
        'skill_name' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
            'null' => false,
        ],
        'skill_level' => [
            'type' => 'TINYINT',
            'constraint' => 1,
            'null' => false,
            'default' => 1,
            'comment' => '1-5 (beginner to expert)',
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => false,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ];

    $CI->dbforge->add_field($fields);
    $CI->dbforge->add_key('id', true);
    $CI->dbforge->add_key('staff_id');
    $CI->dbforge->create_table(db_prefix() . 'staff_skills');
}

// knowledge_categories table - lưu trữ danh mục knowledge
if (!$CI->db->table_exists(db_prefix() . 'knowledge_categories')) {
    $fields = [
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => true,
        ],
        'name' => [
            'type' => 'VARCHAR',
            'constraint' => 191,
            'null' => false,
        ],
        'description' => [
            'type' => 'TEXT',
            'null' => true,
        ],
        'color' => [
            'type' => 'VARCHAR',
            'constraint' => 10,
            'null' => true,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => false,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ];

    $CI->dbforge->add_field($fields);
    $CI->dbforge->add_key('id', true);
    $CI->dbforge->create_table(db_prefix() . 'knowledge_categories');
}

// knowledge_items table - lưu trữ các knowledge item
if (!$CI->db->table_exists(db_prefix() . 'knowledge_items')) {
    $fields = [
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => true,
        ],
        'subject' => [
            'type' => 'VARCHAR',
            'constraint' => 191,
            'null' => false,
        ],
        'content' => [
            'type' => 'TEXT',
            'null' => true,
        ],
        'category_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => true,
        ],
        'created_by' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => false,
        ],
        'visibility' => [
            'type' => 'VARCHAR',
            'constraint' => 20,
            'null' => false,
            'default' => 'all',
            'comment' => 'all, private, departments',
        ],
        'visible_to_departments' => [
            'type' => 'TEXT',
            'null' => true,
            'comment' => 'JSON encoded array of department IDs',
        ],
        'attachment' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
            'null' => true,
        ],
        'allow_comments' => [
            'type' => 'TINYINT',
            'constraint' => 1,
            'null' => false,
            'default' => 1,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => false,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ];

    $CI->dbforge->add_field($fields);
    $CI->dbforge->add_key('id', true);
    $CI->dbforge->add_key('category_id');
    $CI->dbforge->add_key('created_by');
    $CI->dbforge->create_table(db_prefix() . 'knowledge_items');
}

// Thêm các tùy chọn mặc định cho module
add_option('my_team_enable_notifications', 1);
add_option('my_team_approval_hierarchy', json_encode(['department_manager', 'admin']));
add_option('my_team_leave_types', json_encode(['annual', 'sick', 'unpaid', 'other']));
add_option('my_team_attendance_working_days', json_encode([1, 2, 3, 4, 5])); // 1-7 (thứ 2 đến chủ nhật)
add_option('my_team_attendance_work_hours', 8.0); 