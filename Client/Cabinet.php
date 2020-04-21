
<?php 
    session_start(); 
    if (empty($_SESSION['id']) || $_SESSION['type'] == 'master' || $_SESSION['type'] == 'seller'){
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
						<font color="9fa8da "><center><h2>Личный кабинет</h2></center></font>
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
                        <u><b><i class="material-icons left">place</i><a class="indigo-text" href="https://2gis.ru/perm/search/%D0%BC%D0%B0%D0%BA%D1%81%D0%B8%D0%BC%D0%B0%20%D0%B3%D0%BE%D1%80%D1%8C%D0%BA%D0%BE%D0%B3%D0%BE%2C%2021?queryState=center%2F56.252258%2C58.014583%2Fzoom%2F16">Пермь ул.Максима Горького 21<a></b></p></u>
					</div>
            </div>
        </header> 
		<hr width="1000" color="#7986cb"><br>
		<div class="container">
			<form class="col s12">
                <div class="row">
					<div class="col s1">
					</div>
                    <div class="input-field col s7 ">
						<i class="material-icons prefix">account_circle</i>
                        <input placeholder="Поиск по номеру заказа" id="icon_prefix" type="text" class="validate placeholder">
                        <label for="icon_prefix">Номер</label>
						<span class="helper-text" data-error="wrong" data-success="right">Номер должен состоять только из цифр</span>
					</div>
					<div class="col s3">
						<center><a class="waves-effect waves-light btn-large indigo" style="width:270px"><i class="material-icons left">search</i>Найти</a></center>
					</div>
				</div>
			</form>
		</div>
		<div class="container">
            <h3><font color="black">Ваши заказы:</h3></font><br>
            <table class="centered highlight">
                <thead>
                    <tr>
                        <th>Дата заказа</th>
                        <th>Номер заказа</th>
                        <th>Доставка</th>
                        <th>Статус </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>02.02.2019</td>
                        <td>067234</td>
                        <td>Ул. Максима Горького 21</td>
                        <td><font color="red">Не оплачен</font><br><br><a class="waves-effect waves-light btn indigo" style="width:180px" onclick="M.toast({html: 'Благодарим за покупку!'})"><i class="material-icons left">credit_card</i>Оплатить</a></td> 
                    </tr>
                    <tr>
                        <td>02.12.2018</td>
                        <td>056892 </td>
                        <td>Самовывоз</td>
                        <td><font color="green">Выполнен</font></td>
                    </tr>
                </tbody>
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
							© "СпецАвтоПром", 2019
							<br>
							<a href="http://parts-soft.ru">Разработка sma8800@mail.ru</a>
						</div>
						<div class="col s8">
						</div>
						<div class="col s2">
							<u><b><i class="material-icons left">place</i><a class="indigo-text white-text" href="https://2gis.ru/perm/search/%D0%BC%D0%B0%D0%BA%D1%81%D0%B8%D0%BC%D0%B0%20%D0%B3%D0%BE%D1%80%D1%8C%D0%BA%D0%BE%D0%B3%D0%BE%2C%2021?queryState=center%2F56.252258%2C58.014583%2Fzoom%2F16">Пермь ул.Максима Горького 21<a></b></u>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<script src="main.js"></script>
	</body>
</html>
