<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_323 extends CI_Migration
{
    public function up()
    {
        $dbPrefix    = db_prefix();
        $dbCharset   = $this->db->char_set;
        $dbCollation = $this->db->dbcollat;
        if (! $this->db->table_exists($dbPrefix . 'approval_rules')) {
            $this->db->query('CREATE TABLE `' . $dbPrefix . 'approval_rules` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `form_type` varchar(50) NOT NULL,
                `condition` text NULL,
                `approver_role` varchar(50) NOT NULL,
                `created_at` datetime NOT NULL,
                `updated_at` datetime NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=' . $dbCharset . ' COLLATE=' . $dbCollation . ';');
        }
    }
} 