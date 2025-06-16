<?php
session_start();
require '../db.php';

if (!isset($_SESSION['login']) || $_SESSION['type'] != 'client') {
    echo json_encode(['success' => false, 'message' => 'Необходима авторизация']);
    exit;
}

$query = "DELETE FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Ошибка при очистке корзины']);
} 