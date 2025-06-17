﻿<?php 
    session_start(); 
    if (empty($_SESSION['id']) || $_SESSION['type'] == 'client' || $_SESSION['type'] == 'master'){
    header("Location:../authmain.php");
    exit();
    }
?>
<html>
    <head>
        <title>Магазин автозапчастей</title>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link rel="stylesheet" href="../styles.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">	
		<script src="../main.js"></script>
		
		<script type="text/javascript">
            localStorage.client_id = 0;
		</script>
    </head>
    <body background="../img/white2.jpg">
		<nav class="indigo lighten-2">
			<div class="nav-wrapper">
			  <ol><a href="Klients.php" class="brand-logo"><i class="material-icons left">home</i>LOGO</a></ol>
			  <a href="Klients.php" class="brand-logo center"> Продавец: <?php {echo "{$_SESSION['login']}";} ?></a>
			  <ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a href="Orders.php"><i class="material-icons left">assignment_turned_in</i>Заказы</a></li>
				<li><a href="../authout.php"><i class="material-icons left">highlight_off</i>Выйти</a></li>
			  </ul>
			</div>
		</nav>
        <header> 
			<div class="row">
					<div class="col s2">
						<h5 class="white-text"><img src="../img/images.jpe" width="372"></h5>
					</div>
					<div class="col s8">
						<br><br><font color="9fa8da "><center><h2>Список клиентов</h2></center></font>
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
                        <input placeholder="Поиск по ФИО клиента" id="icon_prefix" type="text" class="validate placeholder">
                        <label for="icon_prefix">Клиент</label>
						<span class="helper-text" data-error="wrong" data-success="right">Если нет результатов, значит клиента нет в базе</span>
					</div>
					<div class="col s3">
						<center><a href="Basket.php" class="waves-effect waves-light btn-large indigo" style="width:270px"><i class="material-icons left">search</i>Найти</a></center>
					</div>
				</div>
			</form>
		</div>
		<div class="row">
			<div class="col s1">
			</div>
			<div class="col s10">
			<div class="scroll-box">
				<table id="clients-table" class="centered">
					<thead>
					  <tr>
						  <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Адрес</th>
                            <th>Дата рождения</th>
					  </tr>
					</thead>
					<tbody onclick='select_client(event)'>
					   <?php 
                    require 'clients_db.php';
                    $clients = get_all();
                    
                    foreach ($clients as $client) {
                        $client['birthday'] = strtotime(
                            $client['birthday']);
                        $client['birthday'] = 
                            date("d.m.Y", $client['birthday']);
                    
                        echo "<tr id='client-{$client['id']}'>
                            <td>{$client['surname']}</td>
                            <td>{$client['name']}</td>
                            <td>{$client['patronymic']}</td>
                            <td>{$client['phone']}</td>
                            <td>{$client['email']}</td>
                            <td>{$client['address']}</td>
                            <td>{$client['birthday']}</td>
                        </tr>";
                    }
                ?>
					</tbody>
				</table>
            </div>
			</div><br><br>
			<div class="col s1">
			</div>
		</div>
		<hr width="1000" color="#7986cb"><br>
		<div class="row">
			<div class="col s4">
				<center><a href="AddKlients.php" class="waves-effect waves-light btn-large indigo" onclick="clear_all()" style="width:270px"><i class="material-icons left">add_circle</i>Добавить</a></center><br><br>  
			</div>
			<div class="col s4">
				<center><a class="waves-effect waves-light btn-large indigo" onclick="edit_client1()" style="width:270px"><i class="material-icons left">edit</i>Изменить</a></center><br><br>  
			</div>
			<div class="col s4">
				<center><a class="waves-effect waves-light btn-large indigo" onclick="delete_client()" style="width:270px"><i class="material-icons left">remove_circle</i>Удалить</a></center><br><br> 
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
						<center><u><a class="grey-text text-lighten-3" href="Orders.php">Заказы</a><br><br></center></u>
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
		<script src="main.js"></script>
	</body>
</html>
