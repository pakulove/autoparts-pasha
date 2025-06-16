<?php
session_start();

// Если сессия пуста, но есть куки - восстанавливаем сессию
if (!isset($_SESSION['login']) && isset($_COOKIE['user_login'])) {
    $_SESSION['login'] = $_COOKIE['user_login'];
    $_SESSION['type'] = $_COOKIE['user_type'];
}

// Функция для проверки авторизации
function checkAuth($required_type = null) {
    if (!isset($_SESSION['login']) || !isset($_SESSION['type'])) {
        // Определяем текущий путь
        $current_path = $_SERVER['PHP_SELF'];
        $is_in_client = strpos($current_path, '/Client/') !== false;
        
        // Формируем правильный путь к authmain.php
        $redirect_path = $is_in_client ? '../authmain.php' : 'authmain.php';
        
        header('Location: ' . $redirect_path);
        exit;
    }

    if ($required_type !== null && $_SESSION['type'] !== $required_type) {
        // Определяем текущий путь
        $current_path = $_SERVER['PHP_SELF'];
        $is_in_client = strpos($current_path, '/Client/') !== false;
        
        // Формируем правильный путь к authmain.php
        $redirect_path = $is_in_client ? '../authmain.php' : 'authmain.php';
        
        header('Location: ' . $redirect_path);
        exit;
    }
} 