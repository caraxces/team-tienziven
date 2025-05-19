<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_322 extends CI_Migration
{
    public function up()
    {
        $dbPrefix    = db_prefix();
        $dbCharset   = $this->db->char_set;
        $dbCollation = $this->db->dbcollat;

        // Chuẩn hóa bảng team_approvals
        if ($this->db->table_exists($dbPrefix . 'team_approvals')) {
            // Thêm trường data (JSON/text)
            if (! $this->db->field_exists('data', $dbPrefix . 'team_approvals')) {
                $this->db->query('ALTER TABLE `' . $dbPrefix . 'team_approvals` ADD `data` TEXT NULL AFTER `description`;');
            }
            // Thêm trường attachments
            if (! $this->db->field_exists('attachments', $dbPrefix . 'team_approvals')) {
                $this->db->query('ALTER TABLE `' . $dbPrefix . 'team_approvals` ADD `attachments` TEXT NULL AFTER `data`;');
            }
            // Thêm trường read_by_approver
            if (! $this->db->field_exists('read_by_approver', $dbPrefix . 'team_approvals')) {
                $this->db->query('ALTER TABLE `' . $dbPrefix . 'team_approvals` ADD `read_by_approver` TINYINT(1) NOT NULL DEFAULT 0 AFTER `date_approved`;');
            }
            // Thêm trường read_by_staff
            if (! $this->db->field_exists('read_by_staff', $dbPrefix . 'team_approvals')) {
                $this->db->query('ALTER TABLE `' . $dbPrefix . 'team_approvals` ADD `read_by_staff` TINYINT(1) NOT NULL DEFAULT 0 AFTER `read_by_approver`;');
            }
            // Thêm trường last_updated
            if (! $this->db->field_exists('last_updated', $dbPrefix . 'team_approvals')) {
                $this->db->query('ALTER TABLE `' . $dbPrefix . 'team_approvals` ADD `last_updated` DATETIME NULL AFTER `read_by_staff`;');
            }
            // Thêm trường branch_condition
            if (! $this->db->field_exists('branch_condition', $dbPrefix . 'team_approvals')) {
                $this->db->query('ALTER TABLE `' . $dbPrefix . 'team_approvals` ADD `branch_condition` VARCHAR(191) NULL AFTER `last_updated`;');
            }
        }

        // Tạo bảng leave_balances
        if (! $this->db->table_exists($dbPrefix . 'leave_balances')) {
            $this->db->query('CREATE TABLE `' . $dbPrefix . 'leave_balances` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `user_id` int(11) NOT NULL,
                `leave_type` varchar(50) NOT NULL,
                `balance` float NOT NULL DEFAULT 0,
                PRIMARY KEY (`id`),
                UNIQUE KEY `user_leave_type` (`user_id`, `leave_type`)
            ) ENGINE=InnoDB DEFAULT CHARSET=' . $dbCharset . ' COLLATE=' . $dbCollation . ';');
        }

        // Tạo bảng financial_records
        if (! $this->db->table_exists($dbPrefix . 'financial_records')) {
            $this->db->query('CREATE TABLE `' . $dbPrefix . 'financial_records` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `request_id` int(11) NOT NULL,
                `amount` decimal(18,2) NOT NULL,
                `purpose` varchar(255) NULL,
                `receiver` varchar(255) NULL,
                `invoice_file` varchar(255) NULL,
                `created_at` datetime NOT NULL,
                PRIMARY KEY (`id`),
                KEY `request_id` (`request_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=' . $dbCharset . ' COLLATE=' . $dbCollation . ';');
        }

        // Tạo bảng attendance_records
        if (! $this->db->table_exists($dbPrefix . 'attendance_records')) {
            $this->db->query('CREATE TABLE `' . $dbPrefix . 'attendance_records` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `request_id` int(11) NOT NULL,
                `user_id` int(11) NOT NULL,
                `checkin` datetime NULL,
                `checkout` datetime NULL,
                `reason` varchar(255) NULL,
                `file` varchar(255) NULL,
                `status` varchar(50) NULL,
                `created_at` datetime NOT NULL,
                PRIMARY KEY (`id`),
                KEY `request_id` (`request_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=' . $dbCharset . ' COLLATE=' . $dbCollation . ';');
        }
    }
} 