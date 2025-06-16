<?php
ob_start();
session_start();

header('Content-Type: application/json');

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login']);
    $password = trim($_POST['pass']);

    try {
        $query = "SELECT * FROM users WHERE login = ? AND pass = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса: " . $conn->error);
        }
        
        $stmt->bind_param("ss", $login, $password);
        if (!$stmt->execute()) {
            throw new Exception("Ошибка выполнения запроса: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['login'] = $user['login'];
            $_SESSION['type'] = $user['type'];
            $_SESSION['id'] = $user['id'];
            
            // Если пользователь - клиент, проверяем наличие записи в таблице clients
            if ($user['type'] == 'client') {
                $query = "SELECT * FROM clients WHERE email = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $login);
                $stmt->execute();
                $result = $stmt->get_result();
                
                // Если записи нет, создаем пустую запись
                if ($result->num_rows == 0) {
                    $query = "INSERT INTO clients (email) VALUES (?)";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $login);
                    $stmt->execute();
                }
            }
            
            // Устанавливаем куки на 30 дней
            setcookie('user_login', $user['login'], time() + 30*24*60*60, '/');
            setcookie('user_type', $user['type'], time() + 30*24*60*60, '/');
            
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
            echo json_encode([
                'success' => false,
                'message' => 'Неверный логин или пароль'
            ]);
        }
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Ошибка при авторизации: ' . $e->getMessage()
        ]);
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
    exit;
}
?> 
