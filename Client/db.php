<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Проверяем, не определена ли уже константа
if (!defined('HOST')) {
    define('HOST', 'db');
    define('USER', 'root');
    define('PASS', 'admin');
    define('DB', 'Clients_db');
}

$conn = new mysqli(HOST, USER, PASS, DB);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 