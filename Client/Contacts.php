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
		<script type="text/javascript">
		 $(document).ready(function(){
            $(document).ready(function(){
                $('.parallax').parallax();
            });
        });
		</script>
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
						<br><br><font color="9fa8da"><center><h2>Контактные данные</h2></center></font>
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
		<div class="row black-text">
            <div class="col s4">
                <center><img src="../img/Контакты1.png" height="100" width="100"> 
                <h4>Позвоните нам</h4><br>Есть вопросы? Мы поможем!<br><br><br><b>+7 495 777-777-5</b> для Перми<br><b>+7 800 200 777-5</b> для регионов</center>
            </div>
            <div class="col s4">
				<center><img src="../img/Контакты2.png" height="100" width="100"> 
                <h4>Напишите нам</h4><br>Идеи? Предложения?<br>Мы открыты для любых вопросов!<br><br><br>Написать на <b>24@LOGO.ru</b></center>
            </div>
            <div class="col s4">
                <center><img src="../img/Контакты3.png" height="100" width="100">
                <h4>Обратная связь</h4><br>Поделитесь мнением о нашей<br>работе и помогите нас стать лучше!<br><br><br>Позвоните на <b>+7 800 225-777-7</b></center>
            </div>
		</div><br><br><br>	
		<div class="parallax-container">
			<div class="parallax"><img src="../img/LUDI.jpg"></div>
		</div>
		<font color="black">
			<div class="container">
				<b><h4>Реквизиты</h4></b><br>
				<div class="row">
					<div class="col s2">
						<b>Название организации:<br><br>
						ИНН/КПП:<br><br>
						ОГРН:<br><br>
						Юридический адрес:<br><br>
						Фактический адрес:<br><br>
						Телефон:<br><br>
						Банковские реквизиты</b>
					</div>
					<div class="col s10">
						ИП Караульных Павел Иванович<br><br>
						312200440688 / -<br><br>
						304312223200019<br><br>
						309850,Белгородская обл.,г. Алексеевка, пер. Чапаева, д.29<br><br>
						г,Тюмень ул.Максима Горького 21<br><br>
						+7 (951) 76-69-003<br><br>
						р/с 40802810507130001004 в БЕЛГОРОДСКОЕ ОТДЕЛЕНИЕ N8592 ПАО СБЕРБАНК, к/с 30101810100000000633, БИК 041403633
					</div>
				</div>
			</div>
			<hr>
			<div class="container">
				<b><h4>Сотрудники</h4></b><br>
				<div class="col s12 m8 offset-m2 l6 offset-l3">
					<div class="card-panel grey lighten-5 z-depth-1">
						<div class="row valign-wrapper">
							<div class="col s2">
								<center><img src="../img/FACE1.jpg" width="72" height="72" class="circle"></center>
							</div>
							<div class="col s10">
								<span class="black-text">
									<b>Имайкин Артем Алексеевич</b><br>
									<i>Продавец</i><br>
									+7 (951) 76-69-003<br>
									alekseevka@yulsun.ru
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col s12 m8 offset-m2 l6 offset-l3">
					<div class="card-panel grey lighten-5 z-depth-1">
						<div class="row valign-wrapper">
							<div class="col s2">
								<center><img src="../img/FACE2.jpg" width="72" height="72" class="circle"> </center>
							</div>
							<div class="col s10">
								<span class="black-text">
									<b>Бобров Кирилл Жукович</b><br>
									<i>Мастер - консультант</i><br>
									+7 (982) 95-56-933<br>
									bobr228@mail.ru
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col s12 m8 offset-m2 l6 offset-l3">
					<div class="card-panel grey lighten-5 z-depth-1">
						<div class="row valign-wrapper">
							<div class="col s2">
								<center><img src="../img/FACE3.jpg" width="72" height="72" class="circle"> </center>
							</div>
							<div class="col s10">
								<span class="black-text">
									<b>Нашенкин Андрей Вечеславович</b><br>
									<i>Продавец</i><br>
									+7 (973) 90-40-953<br>
									nashenshen@google.com
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col s12 m8 offset-m2 l6 offset-l3">
					<div class="card-panel grey lighten-5 z-depth-1">
						<div class="row valign-wrapper">
							<div class="col s2">
								<center><img src="../img/FACE4.jpg" width="72" height="72" class="circle"></center> 
							</div>
							<div class="col s10">
								<span class="black-text">
									<b>Анкушин Юрий Александрович</b><br>
									<i>Мастер - консультант</i><br>
									+7 (991) 64-78-920<br>
									nkushin@mail.ru
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col s12 m8 offset-m2 l6 offset-l3">
					<div class="card-panel grey lighten-5 z-depth-1">
						<div class="row valign-wrapper">
							<div class="col s2">
								<center><img src="../img/FACE5.jpg" width="72" height="72" class="circle"> </center>
							</div>
							<div class="col s10">
								<span class="black-text">
									<b>Фитисов Дмитрий Жилиновский</b><br>
									<i>Продавец</i><br>
									+7 (910) 37-56-309<br>
									fistin322@google.com
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</font>
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
		<script src="main.js"></script>
	</body>
</html>
