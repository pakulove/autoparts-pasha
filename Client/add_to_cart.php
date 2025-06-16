<?php
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

$product_id = (int)$_POST['id'];

// Получаем user_id из базы данных по логину
$query = "SELECT id FROM users WHERE login = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $_SESSION['login']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_id = $user['id'];

// Проверяем, есть ли уже такой товар в корзине
$query = "SELECT id FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Товар уже в корзине']);
} else {
    // Добавляем новый товар
    $query = "INSERT INTO cart (user_id, product_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $product_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Товар добавлен в корзину']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ошибка при добавлении товара в корзину']);
    }
} 