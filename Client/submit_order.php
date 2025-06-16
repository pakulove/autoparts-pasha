<?php
ob_start();
session_start();
require '../db.php';

// Включаем отображение ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

error_log("User ID: " . $user_id);

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

error_log("Cart items count: " . $cart_items->num_rows);

// Создаем заказ
$conn->begin_transaction();

try {
    // Вычисляем общую сумму заказа
    $total_amount = 0;
    while ($item = $cart_items->fetch_assoc()) {
        $total_amount += $item['cost'];
        error_log("Item cost: " . $item['cost']);
    }
    $cart_items->data_seek(0); // Сбрасываем указатель результата

    error_log("Total amount: " . $total_amount);

    // Создаем запись в таблице заказов
    $query = "INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, 'new')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $total_amount);
    
    if (!$stmt->execute()) {
        throw new Exception("Ошибка при создании заказа: " . $stmt->error);
    }
    
    $order_id = $conn->insert_id;
    if (!$order_id) {
        throw new Exception("Не удалось получить ID заказа");
    }

    error_log("Order created with ID: " . $order_id);

    // Добавляем товары в заказ
    $query = "INSERT INTO order_items (order_id, product_id, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    while ($item = $cart_items->fetch_assoc()) {
        $stmt->bind_param("iid", $order_id, $item['product_id'], $item['cost']);
        if (!$stmt->execute()) {
            throw new Exception("Ошибка при добавлении товара в заказ: " . $stmt->error);
        }
        error_log("Added item to order: product_id=" . $item['product_id'] . ", price=" . $item['cost']);
    }

    // Очищаем корзину
    $query = "DELETE FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    
    if (!$stmt->execute()) {
        throw new Exception("Ошибка при очистке корзины: " . $stmt->error);
    }

    error_log("Cart cleared for user: " . $user_id);

    $conn->commit();
    echo json_encode([
        'success' => true, 
        'message' => 'Заказ успешно оформлен',
        'order_id' => $order_id
    ]);
} catch (Exception $e) {
    $conn->rollback();
    error_log("Ошибка при оформлении заказа: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Ошибка при оформлении заказа: ' . $e->getMessage()
    ]);
} 