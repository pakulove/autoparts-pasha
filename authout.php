<?php
ob_start();
session_start();

// Очищаем все переменные сессии
$_SESSION = array();

// Уничтожаем сессию
session_destroy();

// Удаляем куки
setcookie('user_login', '', time() - 3600, '/');
setcookie('user_type', '', time() - 3600, '/');

// Перенаправляем на страницу авторизации
header('Location: authmain.php');
exit;
?>
    
