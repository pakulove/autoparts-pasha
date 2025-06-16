<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Удаляем ob_clean() и добавляем проверку заголовков
    header('Content-Type: application/json');
    
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);

    // Проверки
    if (empty($login) || empty($password) || empty($password_confirm)) {
        echo json_encode(['success' => false, 'message' => 'Все поля обязательны для заполнения']);
        exit;
    }

    if ($password !== $password_confirm) {
        echo json_encode(['success' => false, 'message' => 'Пароли не совпадают']);
        exit;
    }

    if (strlen($password) < 6) {
        echo json_encode(['success' => false, 'message' => 'Пароль должен быть не менее 6 символов']);
        exit;
    }

    try {
        // Проверяем, не занят ли логин
        $query = "SELECT * FROM users WHERE login = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса проверки логина: " . $conn->error);
        }
        
        $stmt->bind_param("s", $login);
        if (!$stmt->execute()) {
            throw new Exception("Ошибка выполнения запроса проверки логина: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Этот логин уже занят']);
            exit;
        }
        $stmt->close();

        // Добавляем пользователя
        $query = "INSERT INTO users (login, pass, type) VALUES (?, ?, 'client')";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса добавления пользователя: " . $conn->error);
        }
        
        $stmt->bind_param("ss", $login, $password);
        if (!$stmt->execute()) {
            throw new Exception("Ошибка выполнения запроса добавления пользователя: " . $stmt->error);
        }

        $user_id = $conn->insert_id;
        $stmt->close();

        // Создаем запись в таблице clients
        $query = "INSERT INTO clients (email) VALUES (?)";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса добавления клиента: " . $conn->error);
        }
        
        $stmt->bind_param("s", $login);
        if (!$stmt->execute()) {
            throw new Exception("Ошибка выполнения запроса добавления клиента: " . $stmt->error);
        }

        echo json_encode(['success' => true, 'message' => 'Регистрация успешна']);
        
    } catch (Exception $e) {
        error_log("Ошибка при регистрации: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Ошибка при регистрации: ' . $e->getMessage()]);
    } finally {
        if (isset($stmt) && $stmt) {
            $stmt->close();
        }
        if (isset($conn) && $conn) {
            $conn->close();
        }
    }
    exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body background="img/white2.jpg">
    <nav class="indigo lighten-2">
        <div class="nav-wrapper">
            <ol><a href="Client/Main.php" class="brand-logo"><i class="material-icons left">home</i>LOGO</a></ol>                        
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="Client/Catalog.php"><i class="material-icons left">grid_on</i>Каталог автозапчастей</a></li>
                <li><a href="Client/Basket.php"><i class="material-icons left">shopping_cart</i>Корзина</a></li>
                <li><a href="Client/Contacts.php"><i class="material-icons left">contacts</i>Контакты</a></li>
                <li><a href="authmain.php"><i class="material-icons left">person</i>Войти</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col s3"></div>
            <div class="col s6">
                <div class="card indigo lighten-5">
                    <div class="card-content">
                        <span class="card-title center-align"><h4>Регистрация</h4></span>
                        <?php if (isset($_SESSION['message'])): ?>
                            <div class="card-panel red lighten-4">
                                <?php 
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                                ?>
                            </div>
                        <?php endif; ?>
                        <form id="registerForm">
                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="login" name="login" type="text" class="validate" required>
                                <label for="login">Логин</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">fingerprint</i>
                                <input id="password" name="password" type="password" class="validate" required>
                                <label for="password">Пароль</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="password_confirm" name="password_confirm" type="password" class="validate" required>
                                <label for="password_confirm">Подтвердите пароль</label>
                            </div>
                            <div class="center-align">
                                <button type="submit" class="waves-effect waves-light btn-large indigo">
                                    <i class="material-icons left">person_add</i>Зарегистрироваться
                                </button>
                            </div>
                        </form>
                        <div class="center-align" style="margin-top: 20px;">
                            <a href="authmain.php" class="waves-effect waves-light btn indigo">
                                <i class="material-icons left">arrow_back</i>Вернуться к входу
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s3"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var inputs = document.querySelectorAll('input');
            inputs.forEach(function(input) {
                M.updateTextFields();
            });
        });

        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: 'register.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            M.toast({html: response.message, classes: 'green'});
                            setTimeout(() => {
                                window.location.href = 'authmain.php';
                            }, 2000);
                        } else {
                            M.toast({html: response.message, classes: 'red'});
                            console.error('Ошибка:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Ошибка AJAX:', error);
                        console.error('Ответ сервера:', xhr.responseText);
                        M.toast({html: 'Произошла ошибка при регистрации', classes: 'red'});
                    }
                });
            });
        });
    </script>
</body>
</html> 