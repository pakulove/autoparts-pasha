<?php
ob_start();
session_start();
?>
<html>
    <head>
        <title>Магазин автозапчастей</title>

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
			  <a href="Cabinet.php" class="brand-logo center"> <?php {echo "{$_SESSION['login']}";}
                ?></a>
			  <ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a href="Catalog.php"><i class="material-icons left">grid_on</i>Каталог автозапчастей</a></li>
				<li><a href="Basket.php"><i class="material-icons left">shopping_cart</i>Корзина</a></li>
				<li><a href="Contacts.php"><i class="material-icons left">contacts</i>Контакты</a></li>
				<li><a href="../authmain.php"><i class="material-icons left">person</i>Личный кабинет</a></li>
			  </ul>
			</div>
		</nav>
        <header> 
			<div class="row">
					<div class="col s2">
						<h5 class="white-text"><img src="../img/images.jpe" width="372"></h5>
					</div>
					<div class="col s8">
						<br><br><font color="9fa8da "><center><h2>Корзина</h2></center></font>
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
                       <u><b><i class="material-icons left">place</i><a class="indigo-text" href="https://2gis.ru/perm/search/%D0%BC%D0%B0%D0%BA%D1%81%D0%B8%D0%BC%D0%B0%20%D0%B3%D0%BE%D1%80%D1%8C%D0%BA%D0%BE%D0%B3%D0%BE%2C%2021?queryState=center%2F56.252258%2C58.014583%2Fzoom%2F16">Тюмень ул.Максима Горького 21<a></b></p></u>
					</div>
            </div>
        </header> 
        <hr width="1000" color="#7986cb"><br>
        <?php
        require_once '../session_check.php';
        require_once '../db.php';
        
        // Проверяем авторизацию клиента
        checkAuth('client');
        
        // Получаем user_id
        $query = "SELECT id FROM users WHERE login = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $_SESSION['login']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $user_id = $user['id'];
        
        $query = "SELECT c.*, a.name, a.type, a.cost 
                 FROM cart c 
                 JOIN autoparts a ON c.product_id = a.id 
                 WHERE c.user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo '<div class="container">
                <table class="centered highlight">
                    <thead>
                        <tr>
                            <th>Артикул</th>
                            <th>Наименование</th>
                            <th>Тип</th>
                            <th>Цена</th>
                            <th>Действие</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            $total = 0;
            while ($row = $result->fetch_assoc()) {
                $total += $row['cost'];
                echo "<tr>
                    <td>{$row['product_id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['type']}</td>
                    <td>{$row['cost']}</td>
                    <td>
                        <button onclick='removeFromCart({$row['id']})' class='btn-floating btn-small waves-effect waves-light red'>
                            <i class='material-icons'>delete</i>
                        </button>
                    </td>
                </tr>";
            }
            
            echo "</tbody>
                </table>
                <div class='row'>
                    <div class='col s12'>
                        <h4>Итого: {$total} руб.</h4>
                    </div>
                </div>
            </div>";
        } else {
            echo '<div class="row">
                <div class="col s2"></div>
                <div class="col s8">
                    <font color="black"><h4>В вашей корзине пусто !</h4><br><br>
                    <h5>Чтобы сделать заказ выберите нужные вам детали в </font>
                    <a class="indigo-text" href="Catalog.php"><u>каталоге автозапчастей</u></a>.<br><br>
                    Перейти в <u><a class="indigo-text" href="Orders.php">текущие заказы</u></a>.</h5>
                </div>
                <div class="col s1">
                    <img width="180" src="../img/BASKET.png">
                </div>
            </div>';
        }
        ?>
        <hr width="1000" color="#7986cb"><br>
        <?php if (isset($_SESSION['login']) && $_SESSION['type'] == 'client' && $result->num_rows > 0): ?>
            <center>
                <div class="row">
                    <div class="col s12">
                        <button onclick="placeOrder()" class="btn waves-effect waves-light indigo">
                            <i class="material-icons left">shopping_cart</i>Оформить заказ
                        </button>
                    </div>
                </div>
                <p><a class="indigo-text" href="#" onclick="clearCart()"><u>или очистить корзину</u></a></p>
            </center>
        <?php endif; ?>
        <br><br>
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
						<a class="grey-text text-lighten-3" href="Contacts.php">Контакты</a></u></center>
					</div>
					<div class="col s2">
						<h6>+7 (495) <b>743-45-91</b></h6> 
						<font size="+2" color="green">•</font> Пн-Пт: 09.00 - 21.00<br>
						<font size="+2" color="green">•</font> Cб: 09.00 - 19.00<br>
						<font size="+2" color="red">•</font> Вс: выходной<br>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					<div class="row">
						<div class="col s2">
							© "СпецАвтоПром", 2025
							<br>
							<a href="http://parts-soft.ru">Разработка pashakaraul@mail.ru@mail.ru</a>
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
		<script>
		function updateQuantity(cartId, change) {
			fetch('update_cart.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: 'id=' + cartId + '&change=' + change
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					location.reload();
				} else {
					M.toast({html: data.message, classes: 'red'});
				}
			});
		}

		function removeFromCart(cartId) {
			fetch('remove_from_cart.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: 'id=' + cartId
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					location.reload();
				} else {
					M.toast({html: data.message, classes: 'red'});
				}
			});
		}

		function clearCart() {
			if (confirm('Вы уверены, что хотите очистить корзину?')) {
				fetch('clear_cart.php', {
					method: 'POST'
				})
				.then(response => response.json())
				.then(data => {
					if (data.success) {
						location.reload();
					} else {
						M.toast({html: data.message, classes: 'red'});
					}
				});
			}
		}

		let total = 0; // Делаем total глобальной переменной
		
		function updateCartDisplay() {
			const cartItems = document.getElementById('cartItems');
			const totalElement = document.getElementById('total');
			const cart = JSON.parse(localStorage.getItem('cart')) || [];
			total = 0; // Сбрасываем total перед подсчетом
			
			if (cart.length === 0) {
				cartItems.innerHTML = '<p>Корзина пуста</p>';
				totalElement.textContent = '0';
				return;
			}
			
			let html = '<table class="striped"><thead><tr><th>Товар</th><th>Цена</th><th>Количество</th><th>Сумма</th><th>Действия</th></tr></thead><tbody>';
			
			cart.forEach((item, index) => {
				const itemTotal = item.price * item.quantity;
				total += itemTotal;
				html += `
					<tr>
						<td>${item.name}</td>
						<td>${item.price} ₽</td>
						<td>
							<button onclick="updateQuantity(${index}, ${item.quantity - 1})" class="btn-flat btn-small">
								<i class="material-icons">remove</i>
							</button>
							${item.quantity}
							<button onclick="updateQuantity(${index}, ${item.quantity + 1})" class="btn-flat btn-small">
								<i class="material-icons">add</i>
							</button>
						</td>
						<td>${itemTotal} ₽</td>
						<td>
							<button onclick="removeFromCart(${index})" class="btn-flat btn-small red-text">
								<i class="material-icons">delete</i>
							</button>
						</td>
					</tr>
				`;
			});
			
			html += '</tbody></table>';
			cartItems.innerHTML = html;
			totalElement.textContent = total;
		}

		function placeOrder() {
			if (total === 0) {
				M.toast({html: 'Корзина пуста', classes: 'red'});
				return;
			}
			
			$.ajax({
				url: 'submit_order.php',
				type: 'POST',
				data: {
					total: total
				},
				success: function(response) {
					try {
						const result = JSON.parse(response);
						if (result.success) {
							M.toast({html: decodeURIComponent(escape(result.message)), classes: 'green'});
							localStorage.removeItem('cart');
							updateCartDisplay();
						} else {
							M.toast({html: decodeURIComponent(escape(result.message)) || 'Ошибка при оформлении заказа', classes: 'red'});
						}
					} catch (e) {
						M.toast({html: 'Ошибка при обработке ответа сервера', classes: 'red'});
					}
				},
				error: function() {
					M.toast({html: 'Ошибка при отправке заказа', classes: 'red'});
				}
			});
		}
		</script>
	</body>
</html>
