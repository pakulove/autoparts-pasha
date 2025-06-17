<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['login']) || $_SESSION['type'] != 'client') {
    echo json_encode(['success' => false, 'message' => 'Необходима авторизация']);
    exit;
}

if (!isset($_POST['cart'])) {
    echo json_encode(['success' => false, 'message' => 'Не указана корзина']);
    exit;
}

$cart = json_decode($_POST['cart'], true);
if (!$cart) {
    echo json_encode(['success' => false, 'message' => 'Ошибка при разборе данных корзины']);
    exit;
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Ошибка подключения к БД']);
    exit;
}

$conn->set_charset("utf8");

$allAvailable = true;
$errorMessage = '';

foreach ($cart as $item) {
    $stmt = $conn->prepare("SELECT quantity FROM products WHERE id = ?");
    $stmt->bind_param("i", $item['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if ($row['quantity'] < $item['quantity']) {
            $allAvailable = false;
            $errorMessage = "Товар {$item['name']} доступен только в количестве {$row['quantity']} шт.";
            break;
        }
    } else {
        $allAvailable = false;
        $errorMessage = "Товар {$item['name']} не найден";
        break;
    }
    
    $stmt->close();
}

$conn->close();

if ($allAvailable) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $errorMessage]);
}
?> 