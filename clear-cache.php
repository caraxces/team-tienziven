<?php
/**
 * Clear Cache Script
 * This script clears the application's cache
 */

// Define the path to application directory
define('BASEPATH', __DIR__ . '/system/');
define('APPPATH', __DIR__ . '/application/');
define('FCPATH', __DIR__ . '/');

// Tắt thông báo lỗi
error_reporting(0);

// Function to delete directory and its contents
function delete_directory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!delete_directory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }

    return rmdir($dir);
}

// Style
echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clear Cache</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .btn:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Clear Cache</h1>';

$success = true;
$messages = [];

// Clear the cache directories
$cache_path = APPPATH . 'cache/';

// Clear db cache
try {
    if (is_dir($cache_path . 'db_cache')) {
        if (delete_directory($cache_path . 'db_cache')) {
            mkdir($cache_path . 'db_cache', 0755);
            $messages[] = '<div class="success">Database cache cleared successfully!</div>';
        } else {
            $success = false;
            $messages[] = '<div class="error">Failed to clear database cache.</div>';
        }
    } else {
        $messages[] = '<div class="info">Database cache directory not found.</div>';
    }
} catch (Exception $e) {
    $success = false;
    $messages[] = '<div class="error">Error clearing database cache: ' . $e->getMessage() . '</div>';
}

// Clear session files
try {
    if (is_dir($cache_path . 'sessions')) {
        foreach (scandir($cache_path . 'sessions') as $item) {
            if ($item == '.' || $item == '..') continue;
            @unlink($cache_path . 'sessions/' . $item);
        }
        $messages[] = '<div class="success">Session files cleared successfully!</div>';
    } else {
        $messages[] = '<div class="info">Sessions directory not found.</div>';
    }
} catch (Exception $e) {
    $success = false;
    $messages[] = '<div class="error">Error clearing session files: ' . $e->getMessage() . '</div>';
}

// Output messages
foreach ($messages as $message) {
    echo $message;
}

// Final message
if ($success) {
    echo '<div class="success">Cache has been cleared successfully!</div>';
} else {
    echo '<div class="error">There were some issues while clearing the cache. Please check the messages above.</div>';
}

// Redirect button
echo '<a href="' . ($_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '" class="btn">Go to Homepage</a>
    </div>
</body>
</html>';
?> 