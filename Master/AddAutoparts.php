<?php 
    session_start(); 
?>
<html>
    <head>
        <title>Магазин автозапчастей</title>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link rel="stylesheet" href="../styles.css" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<script src="../main.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">		
    </head>
    <body background="../img/white2.jpg" onload=init1()>
		<nav class="indigo lighten-2">
			<div class="nav-wrapper">
			  <ol><a href="Klients.php" class="brand-logo"><i class="material-icons left">home</i>LOGO</a></ol>
			  <a href="Klients.php" class="brand-logo center"> Продавец: <?php {echo "{$_SESSION['login']}";} ?></a>
			  <ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a href="Orders.php"><i class="material-icons left">assignment_turned_in</i>Заказы</a></li>
				<li><a href="Klients.php"><i class="material-icons left">highlight_off</i>Выйти</a></li>
			  </ul>
			</div>
		</nav>
	  
        <header> 
			<div class="row">
					<div class="col s2">
						<h5 class="white-text"><img src="../img/images.jpe" width="372"></h5>
					</div>
					<div class="col s8">
						<br><br><font color="9fa8da"><center><h2>Добавление автозапчасти</h2></center></font>
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
    </div>
		<div class="container">
               <h4><a class="indigo-text">Данные автозапчасти:</a></h4><br>
                    <div class="row">
                        <form class="col s12">
                        <div class="row">
                            <div class="input-field col s6 ">
                            <i class="material-icons prefix ">dns</i>
                            <label for="name">Наименование</label>
                            <input placeholder="Введите наименование запчасти" id="name" name="name" type="text" class="validate placeholder">
                            </div>
                            <div class="input-field col s6">
                            <i class="material-icons prefix">storage</i>
                            <label for="type">Тип</label>
                            <input placeholder="Введите тип автозапчасти" id="type" name="type" type="text" class="validate">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                            <i class="material-icons prefix">comment</i>
                            <label for="description">Описание</label>
                            <input placeholder="Введите описание автозапчасти" id="description" name="description" type="text" class="validate">
                            </div>
						</div>
                        <div class="row">
                            <div class="input-field col s6">
                            <i class="material-icons prefix">attach_money</i>
                            <label for="cost">Цена(р.)</label>
                            <input placeholder="Введите цену автозапчасти в рублях" id="cost" name="cost" type="tel" class="validate">
                            </div>
							<div class="input-field col s6">
							<center><a href="#" class="waves-effect waves-light btn-large indigo" onclick="add_autopart(event)" style="width:275px"><i class="material-icons left">add_circle</i>Добавить</a> <a class="indigo-text" onclick="clear_autopart_form()"><u>или очистить форму</u></a></center>
							</div>
						</div>
						</form>
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
						<center><u><a class="grey-text text-lighten-3" href="Orders.php">Заказы</a><br><br></u></center>
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
	</body>
</html>
