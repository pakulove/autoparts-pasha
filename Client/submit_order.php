<?php
session_start();
require '../db.php';

if (!isset($_SESSION['login']) || $_SESSION['type'] != 'client') {
    echo json_encode(['success' => false, 'message' => 'Необходима авторизация']);
    exit;
}

// Получаем user_id
$query = "SELECT id FROM users WHERE login = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $_SESSION['login']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_id = $user['id'];

// Проверяем, нет ли уже активного заказа
$query = "SELECT id FROM orders WHERE user_id = ? AND status IN ('new', 'processing')";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'У вас уже есть активный заказ']);
    exit;
}

// Получаем товары из корзины
$query = "SELECT c.*, a.cost 
          FROM cart c 
          JOIN autoparts a ON c.product_id = a.id 
          WHERE c.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_items = $stmt->get_result();

if ($cart_items->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Корзина пуста']);
    exit;
}

// Создаем заказ
$conn->begin_transaction();

try {
    // Создаем запись в таблице заказов
    $query = "INSERT INTO orders (user_id, total_amount, status) 
              SELECT ?, SUM(a.cost), 'new' 
              FROM cart c 
              JOIN autoparts a ON c.product_id = a.id 
              WHERE c.user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $user_id);
    
    if (!$stmt->execute()) {
        throw new Exception("Ошибка при создании заказа: " . $stmt->error);
    }
    
    $order_id = $conn->insert_id;
    if (!$order_id) {
        throw new Exception("Не удалось получить ID заказа");
    }

    // Добавляем товары в заказ
    $query = "INSERT INTO order_items (order_id, product_id, price) 
              SELECT ?, c.product_id, a.cost 
              FROM cart c 
              JOIN autoparts a ON c.product_id = a.id 
              WHERE c.user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $order_id, $user_id);
    
    if (!$stmt->execute()) {
        throw new Exception("Ошибка при добавлении товаров в заказ: " . $stmt->error);
    }

    // Очищаем корзину
    $query = "DELETE FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    
    if (!$stmt->execute()) {
        throw new Exception("Ошибка при очистке корзины: " . $stmt->error);
    }

    $conn->commit();
    echo json_encode([
        'success' => true, 
        'message' => 'Заказ успешно оформлен',
        'order_id' => $order_id
    ]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        'success' => false, 
        'message' => 'Ошибка при оформлении заказа: ' . $e->getMessage()
    ]);
} 