<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">
                            <?php echo _l('my_team_setup_tables'); ?>
                        </h4>
                        <hr class="hr-panel-heading" />
                        
                        <?php 
                        // Kiểm tra xem người dùng hiện tại có phải là admin không
                        if (!is_admin()) {
                            echo '<div class="alert alert-danger">Chỉ có quản trị viên mới có thể thực hiện thao tác này.</div>';
                        } else {
                            // Kiểm tra xem người dùng đã submit form chưa
                            if ($this->input->post('setup_tables')) {
                                // Tạo bảng knowledge
                                $CI = &get_instance();
                                $errors = [];
                                
                                // Tạo bảng knowledge_categories
                                $query = "CREATE TABLE IF NOT EXISTS `" . db_prefix() . "knowledge_categories` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `name` varchar(191) NOT NULL,
                                    `description` text DEFAULT NULL,
                                    `parent_id` int(11) DEFAULT NULL,
                                    `created_by` int(11) NOT NULL,
                                    `created_at` datetime NOT NULL,
                                    `updated_at` datetime DEFAULT NULL,
                                    PRIMARY KEY (`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
                                
                                if (!$CI->db->query($query)) {
                                    $errors[] = $CI->db->error();
                                }
                                
                                // Tạo bảng knowledge_items
                                $query = "CREATE TABLE IF NOT EXISTS `" . db_prefix() . "knowledge_items` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `subject` varchar(191) NOT NULL,
                                    `description` text DEFAULT NULL,
                                    `category_id` int(11) DEFAULT NULL,
                                    `visibility` enum('all','departments','staff') NOT NULL DEFAULT 'all',
                                    `departments` text DEFAULT NULL,
                                    `staff` text DEFAULT NULL,
                                    `attachment` varchar(191) DEFAULT NULL,
                                    `created_by` int(11) NOT NULL,
                                    `created_at` datetime NOT NULL,
                                    `updated_at` datetime DEFAULT NULL,
                                    PRIMARY KEY (`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
                                
                                if (!$CI->db->query($query)) {
                                    $errors[] = $CI->db->error();
                                }
                                
                                // Tạo bảng attendance_records
                                $query = "CREATE TABLE IF NOT EXISTS `" . db_prefix() . "attendance_records` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `staff_id` int(11) NOT NULL,
                                    `date` date NOT NULL,
                                    `check_in` datetime DEFAULT NULL,
                                    `check_out` datetime DEFAULT NULL,
                                    `status` enum('present','absent','late','leave') NOT NULL DEFAULT 'present',
                                    `notes` text DEFAULT NULL,
                                    `created_at` datetime NOT NULL,
                                    `updated_at` datetime DEFAULT NULL,
                                    PRIMARY KEY (`id`),
                                    KEY `staff_id` (`staff_id`),
                                    KEY `date` (`date`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
                                
                                if (!$CI->db->query($query)) {
                                    $errors[] = $CI->db->error();
                                }
                                
                                // Tạo bảng team_approvals
                                $query = "CREATE TABLE IF NOT EXISTS `" . db_prefix() . "team_approvals` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `staff_id` int(11) NOT NULL,
                                    `department_id` int(11) DEFAULT NULL,
                                    `subject` varchar(191) NOT NULL,
                                    `description` text DEFAULT NULL,
                                    `approval_type` enum('leave','financial','attendance','general') NOT NULL DEFAULT 'general',
                                    `json_data` text DEFAULT NULL,
                                    `attachment` varchar(191) DEFAULT NULL,
                                    `status` tinyint(1) NOT NULL DEFAULT 0,
                                    `approved_by` int(11) DEFAULT NULL,
                                    `approved_date` datetime DEFAULT NULL,
                                    `rejected_by` int(11) DEFAULT NULL,
                                    `rejected_date` datetime DEFAULT NULL,
                                    `rejection_reason` text DEFAULT NULL,
                                    `created_at` datetime NOT NULL,
                                    `updated_at` datetime DEFAULT NULL,
                                    PRIMARY KEY (`id`),
                                    KEY `staff_id` (`staff_id`),
                                    KEY `department_id` (`department_id`),
                                    KEY `approval_type` (`approval_type`),
                                    KEY `status` (`status`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
                                
                                if (!$CI->db->query($query)) {
                                    $errors[] = $CI->db->error();
                                }
                                
                                // Tạo bảng training_documents
                                $query = "CREATE TABLE IF NOT EXISTS `" . db_prefix() . "training_documents` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `title` varchar(191) NOT NULL,
                                    `description` text DEFAULT NULL,
                                    `category_id` int(11) DEFAULT NULL,
                                    `file_name` varchar(255) NOT NULL,
                                    `file_path` varchar(500) NOT NULL,
                                    `file_size` int(11) DEFAULT NULL,
                                    `file_type` varchar(100) DEFAULT NULL,
                                    `created_by` int(11) NOT NULL,
                                    `created_at` datetime NOT NULL,
                                    `updated_at` datetime DEFAULT NULL,
                                    PRIMARY KEY (`id`),
                                    KEY `created_by` (`created_by`),
                                    KEY `category_id` (`category_id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
                                
                                if (!$CI->db->query($query)) {
                                    $errors[] = $CI->db->error();
                                }
                                
                                // Tạo bảng training_assignments
                                $query = "CREATE TABLE IF NOT EXISTS `" . db_prefix() . "training_assignments` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `document_id` int(11) NOT NULL,
                                    `staff_id` int(11) NOT NULL,
                                    `assigned_by` int(11) NOT NULL,
                                    `assigned_at` datetime NOT NULL,
                                    `deadline` date DEFAULT NULL,
                                    `notes` text DEFAULT NULL,
                                    `status` enum('assigned','in_progress','completed','overdue') NOT NULL DEFAULT 'assigned',
                                    `progress` tinyint(3) NOT NULL DEFAULT 0,
                                    `last_accessed` datetime DEFAULT NULL,
                                    `completed_at` datetime DEFAULT NULL,
                                    PRIMARY KEY (`id`),
                                    KEY `document_id` (`document_id`),
                                    KEY `staff_id` (`staff_id`),
                                    KEY `assigned_by` (`assigned_by`),
                                    KEY `status` (`status`),
                                    UNIQUE KEY `unique_assignment` (`document_id`, `staff_id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
                                
                                if (!$CI->db->query($query)) {
                                    $errors[] = $CI->db->error();
                                }
                                
                                if (empty($errors)) {
                                    // Tạo thư mục uploads nếu chưa tồn tại
                                    $folders = [
                                        'uploads/knowledge',
                                        'uploads/approvals'
                                    ];
                                    
                                    foreach ($folders as $folder) {
                                        if (!is_dir(FCPATH . $folder)) {
                                            mkdir(FCPATH . $folder, 0755, true);
                                        }
                                    }
                                    
                                    // Hiển thị thông báo thành công
                                    echo '<div class="alert alert-success">Các bảng đã được tạo thành công!</div>';
                                } else {
                                    // Hiển thị lỗi
                                    echo '<div class="alert alert-danger">';
                                    echo '<strong>Lỗi xảy ra khi tạo bảng:</strong><br>';
                                    foreach ($errors as $error) {
                                        echo $error . '<br>';
                                    }
                                    echo '</div>';
                                }
                            }
                        ?>
                        
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <strong>Cảnh báo:</strong> Thao tác này sẽ thêm các bảng mới vào cơ sở dữ liệu. Hãy đảm bảo rằng bạn đã sao lưu dữ liệu trước khi tiếp tục.
                        </div>
                        
                        <p>Thiết lập này sẽ tạo các bảng sau trong cơ sở dữ liệu:</p>
                        <ul>
                            <li><code><?php echo db_prefix(); ?>knowledge_categories</code> - Lưu trữ danh mục kiến thức</li>
                            <li><code><?php echo db_prefix(); ?>knowledge_items</code> - Lưu trữ các bài viết kiến thức</li>
                            <li><code><?php echo db_prefix(); ?>attendance_records</code> - Lưu trữ dữ liệu điểm danh</li>
                            <li><code><?php echo db_prefix(); ?>team_approvals</code> - Lưu trữ yêu cầu phê duyệt</li>
                        </ul>
                        
                        <hr />
                        
                        <form method="post" action="">
                            <?php echo render_yes_no_option('confirm_setup', 'confirm_action'); ?>
                            <button type="submit" name="setup_tables" value="1" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn muốn tiếp tục?');">Thiết lập bảng</button>
                        </form>
                        
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?> 