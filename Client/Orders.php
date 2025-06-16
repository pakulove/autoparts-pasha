<?php
require '../session_check.php';
require '../db.php';

// Проверяем авторизацию клиента
checkAuth('client');

// Получаем данные пользователя
$query = "SELECT c.* FROM clients c 
          JOIN users u ON c.email = u.login 
          WHERE u.login = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $_SESSION['login']);
$stmt->execute();
$result = $stmt->get_result();
$client = $result->fetch_assoc();

// Если данных клиента нет, перенаправляем на страницу профиля
if (!$client) {
    header('Location: Cabinet.php?error=no_data');
    exit;
}

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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body background="../img/white2.jpg">
        <nav class="indigo lighten-2">
            <div class="nav-wrapper">
                <ol><a href="Main.php" class="brand-logo"><i class="material-icons left">home</i>LOGO</a></ol>
                <a href="Cabinet.php" class="brand-logo center"><?php echo $_SESSION['login']; ?></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="Catalog.php"><i class="material-icons left">grid_on</i>Каталог автозапчастей</a></li>
                    <li><a href="Basket.php"><i class="material-icons left">shopping_cart</i>Корзина</a></li>
                    <li><a href="Contacts.php"><i class="material-icons left">contacts</i>Контакты</a></li>
                    <li><a href="../authmain.php"><i class="material-icons left">person</i>Личный кабинет</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <h3 class="center">Оформление заказа</h3>
            
            <div class="row">
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Данные для доставки</span>
                            <p>ФИО: <?php echo $client['surname'] . ' ' . $client['name'] . ' ' . $client['patronymic']; ?></p>
                            <p>Телефон: <?php echo $client['phone']; ?></p>
                            <p>Адрес: <?php echo $client['address']; ?></p>
                            <p>Email: <?php echo $client['email']; ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Состав заказа</span>
                            <table class="striped">
                                <thead>
                                    <tr>
                                        <th>Товар</th>
                                        <th>Цена</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cart_items->data_seek(0);
                                    while ($item = $cart_items->fetch_assoc()) {
                                        echo "<tr>
                                            <td>{$item['name']}</td>
                                            <td>{$item['cost']} руб.</td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Итого:</th>
                                        <th><?php echo $total; ?> руб.</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row center">
                <div class="col s12">
                    <button onclick="submitOrder()" class="btn-large waves-effect waves-light indigo">
                        <i class="material-icons left">check</i>Подтвердить заказ
                    </button>
                </div>
            </div>
        </div>

        <script>
        function submitOrder() {
            fetch('submit_order.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    M.toast({html: data.message, classes: 'green'});
                    setTimeout(() => {
                        window.location.href = 'Cabinet.php';
                    }, 2000);
                } else {
                    M.toast({html: data.message, classes: 'red'});
                    console.error('Ошибка:', data.message);
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                M.toast({html: 'Произошла ошибка при оформлении заказа', classes: 'red'});
            });
        }
        </script>
    </body>
</html>
