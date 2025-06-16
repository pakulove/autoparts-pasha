<?php
ob_start();
session_start();
require '../db.php';

if (!isset($_SESSION['login']) || $_SESSION['type'] != 'client') {
    echo json_encode(['success' => false, 'message' => 'Необходима авторизация']);
    exit;
}

if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'Неверные параметры']);
    exit;
}

$cart_id = (int)$_POST['id'];

// Получаем user_id из базы данных по логину
$query = "SELECT id FROM users WHERE login = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $_SESSION['login']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_id = $user['id'];

// Удаляем товар из корзины
$query = "DELETE FROM cart WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $cart_id, $user_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Товар удален из корзины']);
} else {
    echo json_encode(['success' => false, 'message' => 'Ошибка при удалении товара из корзины']);
} 