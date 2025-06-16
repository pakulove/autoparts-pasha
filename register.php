<?php
session_start();
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    $pass_confirm = trim($_POST['pass_confirm']);

    if (empty($login) || empty($pass) || empty($pass_confirm)) {
        $_SESSION['message'] = 'Все поля обязательны для заполнения!';
        header('Location: register.php');
        exit();
    }

    if (strlen($pass) < 6) {
        $_SESSION['message'] = 'Пароль должен быть не менее 6 символов!';
        header('Location: register.php');
        exit();
    }

    if ($pass !== $pass_confirm) {
        $_SESSION['message'] = 'Пароли не совпадают!';
        header('Location: register.php');
        exit();
    }

    try {
        // Check if login already exists
        $stmt = $connect->prepare("SELECT id FROM users WHERE login = ?");
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса: " . $connect->error);
        }
        
        $stmt->bind_param("s", $login);
        if (!$stmt->execute()) {
            throw new Exception("Ошибка выполнения запроса: " . $stmt->error);
        }
        
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['message'] = 'Пользователь с таким логином уже существует!';
            header('Location: register.php');
            exit();
        }
        $stmt->close();

        // Insert new user with plain password (as per database structure)
        $stmt = $connect->prepare("INSERT INTO users (login, pass, type) VALUES (?, ?, 'client')");
        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса: " . $connect->error);
        }
        
        $stmt->bind_param("ss", $login, $pass);
        if (!$stmt->execute()) {
            throw new Exception("Ошибка выполнения запроса: " . $stmt->error);
        }

        $_SESSION['message'] = 'Регистрация успешна! Теперь вы можете войти.';
        header('Location: authmain.php');
        
    } catch (Exception $e) {
        $_SESSION['message'] = 'Ошибка при регистрации: ' . $e->getMessage();
        header('Location: register.php');
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $connect->close();
    }
    exit();
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
                        <form action="register.php" method="post">
                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="login" name="login" type="text" class="validate" required>
                                <label for="login">Логин</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">fingerprint</i>
                                <input id="pass" name="pass" type="password" class="validate" required>
                                <label for="pass">Пароль</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="pass_confirm" name="pass_confirm" type="password" class="validate" required>
                                <label for="pass_confirm">Повторите пароль</label>
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
    </script>
</body>
</html> 