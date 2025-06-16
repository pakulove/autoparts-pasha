<?php
if (ob_get_level() == 0) {
    ob_start();
}
session_start();
require_once '../session_check.php';
require_once '../db.php';

// Проверяем авторизацию клиента
checkAuth('client');

// Получаем товары из корзины
$query = "SELECT c.*, a.name, a.type, a.cost 
          FROM cart c 
          JOIN autoparts a ON c.product_id = a.id 
          JOIN users u ON c.user_id = u.id 
          WHERE u.login = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $_SESSION['login']);
$stmt->execute();
$cart_items = $stmt->get_result();

// Если корзина пуста, перенаправляем на страницу заказов
if ($cart_items->num_rows === 0) {
    header('Location: Cabinet.php');
    exit;
}

$total = 0;
while ($item = $cart_items->fetch_assoc()) {
    $total += $item['cost'];
}
?>
<html>
    <head>
        <title>Оформление заказа</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="../styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="../main.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body background="../img/white2.jpg">
        <nav class="indigo lighten-2">
            <div class="nav-wrapper">
                <ol><a href="Main.php" class="brand-logo"><i class="material-icons left">home</i>LOGO</a></ol>
                <a href="Cabinet.php" class="brand-logo center"> <?php {echo "{$_SESSION['login']}";} ?></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="Catalog.php"><i class="material-icons left">grid_on</i>Каталог автозапчастей</a></li>
                    <li><a href="Basket.php"><i class="material-icons left">shopping_cart</i>Корзина</a></li>
                    <li><a href="Contacts.php"><i class="material-icons left">contacts</i>Контакты</a></li>
                    <li><a href="../authout.php"><i class="material-icons left">exit_to_app</i>Выйти из кабинета</a></li>
                </ul>
            </div>
        </nav>
        <header> 
            <div class="row">
                <div class="col s2">
                    <h5 class="white-text"><img src="../img/images.jpe" width="372"></h5>
                </div>
                <div class="col s8">
                    <font color="9fa8da "><center><h2>Оформление заказа</h2></center></font>
                </div>
                <div class="col s2">
                    <p><h5>+7 (495) <b>743-45-91</b></h5> 
                    <font size="+2" color="green">•</font> Пн-Пт: 09.00 - 21.00
                    <br>
                    <font size="+2" color="green">•</font> Cб: 09.00 - 19.00
                    <br>
                    <font size="+2" color="red">•</font> Вс: выходной
                    <br>
                    <br>
                    <b>
                    <u><b><i class="material-icons left">place</i><a class="indigo-text" href="https://2gis.ru/perm/search/%D0%BC%D0%B0%D0%BA%D1%81%D0%B8%D0%BC%D0%B0%20%D0%B3%D0%BE%D1%80%D1%8C%D0%BA%D0%BE%D0%B3%D0%BE%2C%2021?queryState=center%2F56.252258%2C58.014583%2Fzoom%2F16">Тюмень ул.Максима Горького 21<a></b></p></u>
                </div>
            </div>
        </header> 
        <hr width="1000" color="#7986cb"><br>
        <div class="container">
            <form class="col s12" action="submit_order.php" method="POST">
                <div class="row">
                    <div class="col s1">
                    </div>
                    <div class="input-field col s7 ">
                        <i class="material-icons prefix">account_circle</i>
                        <input placeholder="Введите адрес доставки" id="icon_prefix" type="text" class="validate" name="address" required>
                        <label for="icon_prefix">Адрес</label>
                        <span class="helper-text" data-error="wrong" data-success="right">Введите адрес доставки</span>
                    </div>
                    <div class="col s3">
                        <center><button type="submit" class="waves-effect waves-light btn-large indigo" style="width:270px"><i class="material-icons left">shopping_cart</i>Оформить заказ</button></center>
                    </div>
                </div>
            </form>
        </div>
        <div class="container">
            <h3><font color="black">Ваш заказ:</h3></font><br>
            <table class="centered highlight">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Тип</th>
                        <th>Цена</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cart_items->data_seek(0);
                    while ($item = $cart_items->fetch_assoc()) {
                        echo "<tr>
                            <td>{$item['name']}</td>
                            <td>{$item['type']}</td>
                            <td>{$item['cost']} руб.</td>
                        </tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><b>Итого:</b></td>
                        <td><b><?php echo $total; ?> руб.</b></td>
                    </tr>
                </tfoot>
            </table>
        </div><br><br><br><br>
        <hr width="1000" color="#7986cb"><br>
        <center><a href="../authout.php" class="waves-effect waves-light btn-large indigo" style="width:270px"><i class="material-icons left">cancel</i>Выйти из кабинета</a></center><br><br>
        <footer class="page-footer indigo lighten-2">
            <div class="container">
                <div class="row">
                    <div class="col s2">
                        <h5 class="white-text"><img src="../img/images.jpe" width="200"></h5>
                        <p class="grey-text text-lighten-4">Автопортал продажи запчастей.</p>
                    </div>
                    <div class="col s8">
                        <center><u><a class="grey-text text-lighten-3" href="Catalog.php">Каталог автозапчастей</a><br><br>
                        <a class="grey-text text-lighten-3" href="Basket.php">Корзина</a><br><br>
                        <a class="grey-text text-lighten-3" href="Contacts.php">Контакты</a></u></center></u><br></center>
                        <center><u><a class="grey-text text-lighten-3" href="../authout.php">Выйти из кабинета</a></u></center>
                    </div>
                    <div class="col s2">
                        <h6>+7 (495) <b>743-45-91</b></h6> 
                        <font size="+2" color="green">•</font> Пн-Пт: 09.00 - 21.00<br>
                        <font size="+2" color="green">•</font> Cб: 09.00 - 19.00<br>
                        <font size="+2" color="red">•</font> Вс: выходной<br></u>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    <div class="row">
                        <div class="col s2">
                            © "СпецАвтоПром", 2025
                            <br>
                            <a href="http://parts-soft.ru">Разработка sma8800@mail.ru</a>
                        </div>
                        <div class="col s8">
                        </div>
                        <div class="col s2">
                            <u><b><i class="material-icons left">place</i><a class="indigo-text white-text" href="https://2gis.ru/perm/search/%D0%BC%D0%B0%D0%BA%D1%81%D0%B8%D0%BC%D0%B0%20%D0%B3%D0%BE%D1%80%D1%8C%D0%BA%D0%BE%D0%B3%D0%BE%2C%2021?queryState=center%2F56.252258%2C58.014583%2Fzoom%2F16">Тюмень ул.Максима Горького 21<a></b></u>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="main.js"></script>
    </body>
</html>
