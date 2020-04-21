
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link rel="stylesheet" href="styles.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<script src="main.js"></script>
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
        <header> 
			<div class="row">
					<div class="col s2">
						<br><h5 class="white-text"><img src="img/images.jpe" width="372"></h5>
					</div>
					<div class="col s8">
						<br><br><font color="#9fa8da "><center><h2>Авторизация</h2></center></font>
                    </div>
                    <div class="col s2">
						<p><h5>+7 (495) <b>743-45-91</b></h5> 
                        <font size="+2" color="green">•</font> Пн-Пт: 09.00 - 21.00
                        <br>
                        <font size="+2" color="green">•</font> Cб: 09.00 - 19.00
                        <br>
                        <font size="+2" color="red">•</font> Вс: выходной</p>
                        <u><b><i class="material-icons left">place</i><a class="indigo-text" href="https://2gis.ru/perm/search/%D0%BC%D0%B0%D0%BA%D1%81%D0%B8%D0%BC%D0%B0%20%D0%B3%D0%BE%D1%80%D1%8C%D0%BA%D0%BE%D0%B3%D0%BE%2C%2021?queryState=center%2F56.252258%2C58.014583%2Fzoom%2F16">Пермь ул.Максима Горького 21<a></b></p></u>

					</div>
            </div>
        </header> 
    <?php

        if (empty($_SESSION['login']) or
            empty($_SESSION['id'])) {
    ?>
            <hr width="500" color="#7986cb"><br>
    <div class="container">
        <div class="row">
            <div class="col s3">
            </div>
            <div class="col s6">
                <form action="auth.php" method="post" class="mx-auto" style="width:100%">
                    <p>
                        <div class="form-group">
                         <div class="input-field">
                            <i class="material-icons prefix ">account_circle</i>
                        <label for='login'>Логин:</label>
                        <input
                            id='login'
                            name='login'
                            type='text'
                            size='20'
                            maxlength='25'
                            placeholder="Введите логин"
                            class="form-control">
                        </input>
                        </div>
                        </div>
                    </p>
                    <br>
                    <p>
                        <div class="form-group">
                        <div class="input-field">
                        <i class="material-icons prefix ">fingerprint</i>
                        <label for='pass'>Пароль:</label>
                        <input
                            id='pass'
                            name='pass'
                            type='password'
                            size='20'
                            maxlength='25'
                            placeholder="Введите пароль"
                            class="form-control">
                        </input>
                        </div><br><br>
                    <center><button type='submit' value='Войти' class="waves-effect waves-light btn-large indigo" style="width:275px"><i class="material-icons left">face</i>Войти</button></center>
                    </p>
                </form>
            </div>
            </div>
            <div class="col s3">
            </div>
        </div>
    </div>
    <?php
        } else {
            header("Location:Client/Cabinet.php");
        }
    ?>
<footer class="page-footer  indigo lighten-2">
			<div class="container">
				<div class="row">
					<div class="col s2">
						<h5 class="white-text"><img src="img/images.jpe" width="200"></h5>
						<p class="grey-text text-lighten-4">Автопортал продажи запчастей.</p>
					</div>
					<div class="col s8">
						<center><u><a class="grey-text text-lighten-3" href="Client/Catalog.php">Каталог автозапчастей</a><br><br>
						<a class="grey-text text-lighten-3" href="Client/Basket.php">Корзина</a><br><br>
						<a class="grey-text text-lighten-3" href="Client/Contacts.php">Контакты</a></u></center>
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
</body>
</html>
