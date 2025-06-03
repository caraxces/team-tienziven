# Tạo file test-db.php
echo '<?php
// Test database connection và bảng training
echo "<h1>Test Database Training</h1>";

// Kết nối database
try {
    require_once 'application/config/database.php';
    
    $host = $db['default']['hostname'];
    $username = $db['default']['username'];
    $password = $db['default']['password'];
    $database = $db['default']['database'];
    $dbprefix = $db['default']['dbprefix'];
    
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✓ Kết nối database thành công</p>";
    echo "<p>Database: <strong>$database</strong></p>";
    echo "<p>Prefix: <strong>$dbprefix</strong></p>";
    
    // Kiểm tra các bảng training
    $tables_to_check = [
        $dbprefix . 'knowledge_categories',
        $dbprefix . 'training_documents', 
        $dbprefix . 'training_assignments'
    ];
    
    echo "<h2>Kiểm tra bảng:</h2>";
    foreach ($tables_to_check as $table) {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() > 0) {
            echo "<p style='color: green;'>✓ Bảng $table tồn tại</p>";
            
            // Đếm số record
            $count_stmt = $pdo->query("SELECT COUNT(*) as count FROM $table");
            $count = $count_stmt->fetch(PDO::FETCH_ASSOC)['count'];
            echo "<p>&nbsp;&nbsp;&nbsp;Số record: $count</p>";
        } else {
            echo "<p style='color: red;'>✗ Bảng $table KHÔNG tồn tại</p>";
        }
    }
    
    // Tạo bảng nếu chưa có
    echo "<h2>Tạo bảng thiếu:</h2>";
    
    // Tạo bảng knowledge_categories
    $table = $dbprefix . 'knowledge_categories';
    $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
    if ($stmt->rowCount() == 0) {
        $sql = "CREATE TABLE `$table` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(191) NOT NULL,
            `description` text DEFAULT NULL,
            `parent_id` int(11) DEFAULT NULL,
            `created_by` int(11) NOT NULL,
            `created_at` datetime NOT NULL,
            `updated_at` datetime DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        
        if ($pdo->exec($sql)) {
            echo "<p style='color: green;'>✓ Đã tạo bảng $table</p>";
        } else {
            echo "<p style='color: red;'>✗ Lỗi tạo bảng $table</p>";
        }
    }
    
    // Tạo bảng training_documents
    $table = $dbprefix . 'training_documents';
    $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
    if ($stmt->rowCount() == 0) {
        $sql = "CREATE TABLE `$table` (
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
        
        if ($pdo->exec($sql)) {
            echo "<p style='color: green;'>✓ Đã tạo bảng $table</p>";
        } else {
            echo "<p style='color: red;'>✗ Lỗi tạo bảng $table</p>";
        }
    }
    
    // Tạo bảng training_assignments
    $table = $dbprefix . 'training_assignments';
    $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
    if ($stmt->rowCount() == 0) {
        $sql = "CREATE TABLE `$table` (
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
        
        if ($pdo->exec($sql)) {
            echo "<p style='color: green;'>✓ Đã tạo bảng $table</p>";
        } else {
            echo "<p style='color: red;'>✗ Lỗi tạo bảng $table</p>";
        }
    }
    
    // Thêm category mẫu
    $table = $dbprefix . 'knowledge_categories';
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM $table WHERE name = ?");
    $stmt->execute(['Đào tạo chung']);
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    if ($count == 0) {
        $sql = "INSERT INTO `$table` (`name`, `description`, `created_by`, `created_at`) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute(['Đào tạo chung', 'Danh mục cho các tài liệu đào tạo chung', 1, date('Y-m-d H:i:s')])) {
            echo "<p style='color: green;'>✓ Đã thêm category mẫu</p>";
        }
    }
    
    // Tạo thư mục uploads
    $folders = [
        'uploads/training_documents',
        'uploads/knowledge',
        'uploads/approvals'
    ];
    
    echo "<h2>Tạo thư mục uploads:</h2>";
    foreach ($folders as $folder) {
        if (!is_dir($folder)) {
            if (mkdir($folder, 0755, true)) {
                echo "<p style='color: green;'>✓ Đã tạo thư mục $folder</p>";
            } else {
                echo "<p style='color: red;'>✗ Không thể tạo thư mục $folder</p>";
            }
        } else {
            echo "<p style='color: blue;'>ℹ Thư mục $folder đã tồn tại</p>";
        }
    }
    
    echo "<hr>";
    echo "<div style='background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
    echo "<strong>✓ Thiết lập database hoàn tất!</strong><br>";
    echo "Bây giờ bạn có thể truy cập Training page.";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Lỗi kết nối database: " . $e->getMessage() . "</p>";
}

echo "<p><a href='/admin/my_team/training' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Truy cập Training</a></p>";
?>' > test-db.php

# Copy file vào container
docker cp test-db.php team-tienziven-app:/var/www/html/