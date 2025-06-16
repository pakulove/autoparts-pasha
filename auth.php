<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    
    $query = "SELECT * FROM users WHERE login = ? AND pass = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $login, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['login'] = $login;
        $_SESSION['type'] = $user['type'];
        
        // Устанавливаем куки на 30 дней
        setcookie('user_login', $login, time() + (86400 * 30), "/");
        setcookie('user_type', $user['type'], time() + (86400 * 30), "/");
        
        // Определяем страницу для перенаправления в зависимости от типа пользователя
        $redirect = '';
        switch($user['type']) {
            case 'client':
                $redirect = 'Client/Main.php';
                break;
            case 'master':
                $redirect = 'Master/Main.php';
                break;
            case 'seller':
                $redirect = 'Seller/Main.php';
                break;
        }
        
        echo json_encode([
            'success' => true, 
            'message' => 'Авторизация успешна',
            'redirect' => $redirect
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Неверный логин или пароль']);
    }
}
?> 
