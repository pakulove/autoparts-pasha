<?php
    session_start();
    
    if (isset($_POST['login'])) {
        $login=$_POST['login'];
    }
    
    if (isset($_POST['pass'])) {
        $pass=$_POST['pass'];
    }
    
    if (empty($login) or empty($pass)) {
        exit("Данные не введены!!!");
    }
    
    $login=stripcslashes($login);
    $login=htmlspecialchars($login);
    $login=trim($login);
    $pass=stripcslashes($pass);
    $pass=htmlspecialchars($pass);
    $pass=trim($pass);
        
    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "");
    define("DB", "Clients_db");
    
    $conn = mysqli_connect(HOST, USER, PASS, DB);
    if (!$conn) die('Не удалось подключиться к БД!');
    
    
    $query ="SELECT * FROM users WHERE login = '{$login}'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    
    
    if (!empty($user)) {

        if ($pass == $user['pass']) {
            $_SESSION['id']=$user['id'];
            $_SESSION['login'] =$user['login'];
            $_SESSION['type'] =$user['type'];
            
            if ($user['type'] == 'client'){
            header("Location:Client/Cabinet.php");
            exit();
            }
            
            if ($user['type'] == 'seller'){
            header("Location:Seller/Klients.php");
            exit();
            }
            
            if ($user['type'] == 'master'){
            header("Location:Master/Catalog.php");
            exit();
            }
    } else {
        echo 'Пароль не верный';
    }
} else {
    echo 'Никого не нашли';
}
    
?> 
