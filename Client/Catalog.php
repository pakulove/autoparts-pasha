<?php
require '../session_check.php';
require '../db.php';

// Проверяем авторизацию клиента
checkAuth('client');

// Получаем список автозапчастей
$query = "SELECT * FROM autoparts ORDER BY name";
$result = $conn->query($query);

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
						<br><br><font color="9fa8da "><center><h2>Каталог автозапчастей</h2></center></font>
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
        <hr color="#7986cb"><br>
		<div class="container">
			<form class="col s12">
                <div class="row">
					<div class="col s1">
					</div>
                    <div class="input-field col s7 ">
						<i class="material-icons prefix">account_circle</i>
                        <input placeholder="Поиск по артикулу(номеру детали)" id="icon_prefix" type="text" class="validate placeholder">
                        <label for="icon_prefix">Артикул</label>
						<span class="helper-text" data-error="wrong" data-success="right">Артикул должен состоять только из цифр</span>
					</div>
					<div class="col s3">
						<center><a class="waves-effect waves-light btn-large indigo" style="width:270px"><i class="material-icons left">search</i>Найти</a></center>
					</div>
				</div>
			</form>
		</div>
		<div class="row">
			<div class="col s1">
			</div>
			<div class="col s10">
			<div class="scroll-box">
				<table id="autoparts-table" class="centered">
					<thead>
					  <tr>
						  <th>Артикул</th>
						  <th>Наименование</th>
						  <th>Тип</th>
						  <th>Описание</th>
						  <th>Цена(р.)</th>
						  <?php if (isset($_SESSION['login']) && $_SESSION['type'] == 'client'): ?>
						  <th>Действие</th>
						  <?php endif; ?>
					  </tr>
					</thead>
					<tbody onclick='select_autopart(event)'>
					  <?php 
                    require 'autoparts_db.php';
                    $autoparts = get_all();
					
                     foreach ($autoparts as $autopart) {
                        echo "<tr id='autoparts-{$autopart['id']}'>
                            <td>{$autopart['id']}</td>
                            <td>{$autopart['name']}</td>
                            <td>{$autopart['type']}</td>
                            <td>{$autopart['description']}</td>
                            <td>{$autopart['cost']}</td>";
                        if (isset($_SESSION['login']) && $_SESSION['type'] == 'client') {
                            echo "<td>
                                <button onclick='addToCart({$autopart['id']})' class='btn-floating btn-small waves-effect waves-light indigo'>
                                    <i class='material-icons'>add_shopping_cart</i>
                                </button>
                            </td>";
                        }
                        echo "</tr>";
					 }
                ?>
					</tbody>
				</table>
			</div><br><br>
			<div class="col s1">
			</div>
		</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<hr width="1000" color="#7986cb"><br>
		<div class="row">
			<div class="col s6">
				<center><a href="Main.php" class="waves-effect waves-light btn-large indigo" style="width:270px"><i class="material-icons left">home</i>На главную</a></center>
			</div>
			<div class="col s6">
				<center><a href="Basket.php" class="waves-effect waves-light btn-large indigo" style="width:270px"><i class="material-icons left">shopping_cart</i>Перейти к корзине</a></center>
			</div>
		</div>
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
		<script>
		function addToCart(productId) {
			event.stopPropagation(); // Предотвращаем всплытие события клика
			
			fetch('add_to_cart.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: 'id=' + productId
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					M.toast({html: data.message, classes: 'green'});
				} else {
					M.toast({html: data.message, classes: 'red'});
				}
			})
			.catch(error => {
				console.error('Error:', error);
				M.toast({html: 'Произошла ошибка при добавлении в корзину', classes: 'red'});
			});
		}
		</script>
	</body>
</html>
