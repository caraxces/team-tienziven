# Tạo file test-db.php
echo '<?php
require_once("application/config/app-config.php");
try {
    $conn = new PDO("mysql:host=".APP_DB_HOSTNAME.";dbname=".APP_DB_NAME, APP_DB_USERNAME, APP_DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối thành công đến database ".APP_DB_NAME;
    
    $stmt = $conn->query("SHOW TABLES");
    echo "<br><br>Các bảng trong database:<br>";
    while($row = $stmt->fetch()) {
        echo $row[0] . "<br>";
    }
} catch(PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
}
?>' > test-db.php

# Copy file vào container
docker cp test-db.php team-tienziven-app:/var/www/html/