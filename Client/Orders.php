
<?php 
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
						<br><br><font color="9fa8da"><center><h2>Заказы</h2></center></font>
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
                        <u><b><i class="material-icons left">place</i><a class="indigo-text" href="https://2gis.ru/perm/search/%D0%BC%D0%B0%D0%BA%D1%81%D0%B8%D0%BC%D0%B0%20%D0%B3%D0%BE%D1%80%D1%8C%D0%BA%D0%BE%D0%B3%D0%BE%2C%2021?queryState=center%2F56.252258%2C58.014583%2Fzoom%2F16">Пермь ул.Максима Горького 21<a></b></p></u>
					</div>
            </div>
        </header> 
        <hr width="1000" color="#7986cb"><br>
		<div class="container">
            <div class="row">
                <h4><a class="indigo-text">Текущий заказ:</a></h4><br>
					<table class="centered highlight">
						<thead>
							<tr>
								<th>Артикул</th>
                                <th>Наименование</th>
                                <th>Тип</th>
                                <th>Цена(шт.)</th>
                                <th>Количество</th>
                                <th>Сумма</th>
							</tr>
						</thead>
					</table><br><br>
                    <div class="row">
                        <form class="col s12">
                        <div class="row">
                            <div class="input-field col s6 ">
                            <i class="material-icons prefix ">account_circle</i>
                            <input placeholder="Введите ваше имя" id="icon_prefix" type="text" class="validate placeholder">
                            <label for="icon_prefix">Имя</label>
                            </div>
                            <div class="input-field col s6">
                            <i class="material-icons prefix">account_circle</i>
                            <input placeholder="Введите вашу фамилию" id="last_name" type="text" class="validate">
                            <label for="last_name">Фимилия</label>
                            </div>
                            <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input placeholder="Введите ваше отчество" id="last_name" type="text" class="validate">
                            <label for="last_name">Отчество</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">directions_run</i>
                                <select>
                                    <option value="1">Самовывоз</option>
                                    <option value="2">Доставка по адресу</option>
                                </select>
                                <label>Способ получения заказа</label>
                            </div>
                        <div class="row">
                            <div class="input-field col s6">
                            <i class="material-icons prefix">pin_drop</i>
                            <input disabled value placeholder="Введите адрес доставки" id="disabled" type="text" class="validate"><!--ЗАБЛОКИРОВАНО ПОКА НЕ ВЫБИРУТ СПОСОБ ДОСТАВКИ: ПО АДРЕСУ-->
                            <label for="disabled">Адрес</label>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                            <i class="material-icons prefix">pan_tool</i>
                            <input placeholder="Введите пароль от личного кабинета" id="password" type="password" class="validate">
                            <label for="password">Пароль</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                            <i class="material-icons prefix">local_phone</i>
                            <input placeholder="Введите ваш номер телефона" id="input_text" type="text" class="validate">
                            <label for="password">Телефон</label>
                            </div>
                            <div class="input-field col s6">
                            <i class="material-icons prefix">email</i>
                            <input placeholder="Введите ваш Email" id="email" type="email" class="validate">
                            <label for="email">Email</label>
                            <span class="helper-text" data-error="wrong" data-success="right"></span>
                            </div>
                        </div>
                        </form>
                        <h5>Итоговая стоимость: р.</h5><br>
                        <center><a href="Cabinet.php" class="waves-effect waves-light btn-large indigo" style="width:275px"><i class="material-icons left">assignment_turned_in</i>Оформить</a></center>
                    </div>
                    </div>
				</div>
				</div>
			</div>
		  
		</div>
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
