<?php
// config.php

define('DB_HOST', 'localhost');
define('DB_NAME', 'cara_db');
define('DB_USER', 'root');
define('DB_PASS', ''); // Update with your DB password

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4";
try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    error_log('DB Connection failed: ' . $e->getMessage());
    die('Internal Server Error');
}
