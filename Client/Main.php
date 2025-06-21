<?php
if (session_status() === PHP_SESSION_NONE) {
    if (ob_get_level() == 0) {
        ob_start();
    }
    session_start();
}

require_once '../session_check.php';
require_once '../db.php';

// Проверяем авторизацию
if (!isset($_SESSION['login']) || $_SESSION['type'] !== 'client') {
    header('Location: ../authmain.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Магазин автозапчастей</title>
        <link rel="stylesheet" href="../styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                    <li><a href="../authmain.php"><i class="material-icons left">person</i>Личный кабинет</a></li>
                </ul>
            </div>
        </nav>
        <header> 
            <div class="row">
                <div class="col s2">
                    <br><br><h5 class="white-text"><img src="../img/images.jpe" width="372"></h5>
                </div>
                <div class="col s8">
                    <br><br><font color="#9fa8da "><center><h2>Личный кабинет</h2></center></font>
                </div>
                <div class="col s2">
                    <p><h5>+7 (495) <b>743-45-91</b></h5> 
                    <font size="+2" color="green">•</font> Пн-Пт: 09.00 - 21.00
                    <br>
                    <font size="+2" color="green">•</font> Cб: 09.00 - 19.00
                    <br>
                    <font size="+2" color="red">•</font> Вс: выходной</p>
                    <u><b><i class="material-icons left">place</i><a class="indigo-text" href="https://2gis.ru/perm/search/%D0%BC%D0%B0%D0%BA%D1%81%D0%B8%D0%BC%D0%B0%20%D0%B3%D0%BE%D1%80%D1%8C%D0%BA%D0%BE%D0%B3%D0%BE%2C%2021?queryState=center%2F56.252258%2C58.014583%2Fzoom%2F16">Тюмень ул.Максима Горького 21<a></b></p></u>

                </div>
            </div>
        </header> 
        <hr size="2" width="1000" color="#7986cb"><br>			
        <div class="container">
            <div class="carousel carousel-slider">
                <a class="carousel-item" href="#one!" ><img src="../img/1.jpg" ></a>
                <a class="carousel-item" href="#two!" ><img src="../img/2.jpg"></a>
                <a class="carousel-item" href="#three!" ><img src="../img/3.jpg" height="800"></a>
            </div><br><br><br>
            <div class="row">
                <div class="col s3">
                    <center><img src="../img/4.png" height="72" width="72"> 
                    <h4> Спецпредложения </h4></center>
                    <center>Гетерогенная структура, в согласии с традиционными представлениями, воспроизводима в лабораторных</center>
                </div>
                <div class="col s3">
                    <center><img src="../img/5.png" height="72" width="72"> 
                    <h4>Ассортимент </h4></center>
                    <center>Гетерогенная структура, в согласии с традиционными представлениями, воспроизводима в лабораторных</center>
                </div>
                <div class="col s3">
                    <center><img src="../img/6.png" height="72" width="72">
                    <h4>Доставка</h4></center>
                    <center>Гетерогенная структура, в согласии с традиционными представлениями, воспроизводима в лабораторных</center>
                </div>
                <div class="col s3">
                    <center><img src="../img/7.png" height="72" width="72">
                    <h4>Гарантия качества </h4></center>	
                    <center>Гетерогенная структура, в согласии с традиционными представлениями, воспроизводима в лабораторных</center>
                </div>
            </div>	
        </div><br><br><br>
        <hr size="2" width="1000" color="#7986cb"><br>
        <h2 align="center"><font color="#9fa8da ">Немного о нас</font></h2><br>
        <div class="row">
            <div class="col s2">
            </div>
            <div class="block col s8">
                Запчасти для иномарок интернет магазин AUTOPOINT, автозапчасти для автомобилей BMW AUDI VOLKSWAGEN MERCEDES TOYOTA FORD RENAULT MITSUBISHI NISSAN DAEWOO HYUNDAI KIA CHERRY и др. В Нашем магазине запчастей всегда есть в наличии расходные материалы, моторные масла и жидкости,фильтры, колодки, свечи, детали тормозной системы, систем охлаждения и рулевого управления так же детали подвески и различные аксессуары, защита двигателя и прочее.
            </div>
            <div class="col s2">
            </div>
        </div><br><br>
        <div class="parallax-container">
            <div class="parallax"><img src="../img/zdanie.jpg"></div>
        </div>
        <ol><h4><font color="#9fa8da  ">Наши преимущества:</font></h1><br>
        <ol><ul class="with-Point">
            <li> Кузовные запчасти, детали интерьера сложные технические детали привезем на заказ сроки от 1 дня до 14 дней.<br><br>	
            <li> За 17 лет работы у компании сложились прочные связи с производителями автозапчастей.<br><br>
            <li> Упрощенная гарантия на запасные части определенных фирм производителей, уточняйте у наших сотрудников.<br><br>
            <li> Регистрируйте карту покупателя нашего магазина запчастей для иномарок в личном кабинете, получайте дополнительные скидки на запчасти.<br><br>
            <li> В меню оформления заказа введите промокод LOTUS получите дополнительные 5% скидки к уже существующим, действия акции ограничено по колличеству активаций.<br><br>
            <li> В ближайшее время мы реализуем онлайн каталог по подбору запчастей для иномарок по автомобилям.<br><br>
        </ul></ol></ol>
        </div>  
        <hr size="2" width="1000" color="#7986cb"><br>
        <center><a href="../authout.php" class="waves-effect waves-light btn-large indigo" style="width:270px"><i class="material-icons left">cancel</i>Выйти из кабинета</a></center><br><br>
        <footer class="page-footer  indigo lighten-2">
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $('.carousel.carousel-slider').carousel({
                fullWidth: true
            });
            $(document).ready(function(){
                $('.parallax').parallax();
            });
        });
        </script>

        <!-- Форма отзывов -->
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Оставить отзыв</span>
                            <form id="reviewForm">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">rate_review</i>
                                        <textarea id="reviewText" class="materialize-textarea" required></textarea>
                                        <label for="reviewText">Ваш отзыв</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">star</i>
                                        <select id="rating" required>
                                            <option value="" disabled selected>Выберите оценку</option>
                                            <option value="5">5 звезд</option>
                                            <option value="4">4 звезды</option>
                                            <option value="3">3 звезды</option>
                                            <option value="2">2 звезды</option>
                                            <option value="1">1 звезда</option>
                                        </select>
                                        <label>Оценка</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <button type="submit" class="btn waves-effect waves-light indigo">
                                            <i class="material-icons left">send</i>Отправить отзыв
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Отзывы</span>
                            <div id="reviewsList"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Инициализация select
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);

            // Загрузка отзывов при загрузке страницы
            loadReviews();

            // Обработка отправки формы
            document.getElementById('reviewForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const reviewText = document.getElementById('reviewText').value;
                const rating = document.getElementById('rating').value;
                const username = '<?php echo $_SESSION['login']; ?>';
                const date = new Date().toLocaleDateString();

                // Создаем объект отзыва
                const review = {
                    text: reviewText,
                    rating: rating,
                    username: username,
                    date: date
                };

                // Получаем существующие отзывы
                let reviews = JSON.parse(localStorage.getItem('reviews') || '[]');
                
                // Добавляем новый отзыв
                reviews.push(review);
                
                // Сохраняем обновленный список отзывов
                localStorage.setItem('reviews', JSON.stringify(reviews));

                // Очищаем форму
                document.getElementById('reviewForm').reset();
                M.textareaAutoResize(document.getElementById('reviewText'));

                // Обновляем список отзывов
                loadReviews();

                // Показываем уведомление
                M.toast({html: 'Отзыв успешно добавлен!', classes: 'green'});
            });
        });

        function loadReviews() {
            const reviewsList = document.getElementById('reviewsList');
            const reviews = JSON.parse(localStorage.getItem('reviews') || '[]');

            if (reviews.length === 0) {
                reviewsList.innerHTML = '<p class="center">Пока нет отзывов</p>';
                return;
            }

            // Сортируем отзывы по дате (новые сверху)
            reviews.sort((a, b) => new Date(b.date) - new Date(a.date));

            let html = '';
            reviews.forEach(review => {
                html += `
                    <div class="card-panel">
                        <div class="row">
                            <div class="col s12">
                                <div class="flex-container">
                                    <div>
                                        <b>${review.username}</b>
                                        <span class="grey-text">${review.date}</span>
                                    </div>
                                    <div>
                                        ${'★'.repeat(review.rating)}${'☆'.repeat(5-review.rating)}
                                    </div>
                                </div>
                                <p>${review.text}</p>
                            </div>
                        </div>
                    </div>
                `;
            });

            reviewsList.innerHTML = html;
        }
        </script>
        <style>
        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .card-panel {
            margin-bottom: 20px;
        }
        </style>
    </body>
</html>
