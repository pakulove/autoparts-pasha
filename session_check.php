<?php
if (session_status() === PHP_SESSION_NONE) {
    ob_start();
    session_start();
}

// Если сессия пуста, но есть куки - восстанавливаем сессию
if (!isset($_SESSION['login']) && isset($_COOKIE['user_login'])) {
    $_SESSION['login'] = $_COOKIE['user_login'];
    $_SESSION['type'] = $_COOKIE['user_type'];
}

// Функция для проверки авторизации
function checkAuth($requiredType = null) {
    if (!isset($_SESSION['login']) || !isset($_SESSION['type'])) {
        if (isset($_COOKIE['user_login']) && isset($_COOKIE['user_type'])) {
            $_SESSION['login'] = $_COOKIE['user_login'];
            $_SESSION['type'] = $_COOKIE['user_type'];
        } else {
            header('Location: authmain.php');
            exit;
        }
    }

    if ($requiredType !== null && $_SESSION['type'] !== $requiredType) {
        header('Location: authmain.php');
        exit;
    }
} 