USE `Clients_db`;

CREATE TABLE `clients` (
	`id`		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `surname` 	VARCHAR(30),
    `name` 		VARCHAR(30),
    `patronymic`VARCHAR(30),
    `phone` 	BIGINT(30),
	`email`		VARCHAR(30),
    `address` 	VARCHAR(40),
    `birthday` 	DATE
);

INSERT INTO `clients` (`surname`, `name`, `patronymic`, `phone`,`email`,`address`, `birthday`) VALUES
		('Клюев', 'Юрий', 'Николаевич', '89648901356','Kluev@mail.ru','ул. Борчаниново 74', '1988-02-12');
INSERT INTO `clients` (`surname`, `name`, `patronymic`, `phone`,`email`,`address`, `birthday`) VALUES
		('Каурова ', 'Ольга ', 'Юрьевна', '89074590246','Kaurovaah@gmail.com','ул. шоссе Космонавтов 122', '1991-06-30');
INSERT INTO `clients` (`surname`, `name`, `patronymic`, `phone`,`email`,`address`, `birthday`) VALUES
		('Каранин ', 'Сергей', 'Олегович', '89528403624','Karanich23@mail.ru','ул. Ленина 20', '1999-12-05');
INSERT INTO `clients` (`surname`, `name`, `patronymic`, `phone`,`email`,`address`, `birthday`) VALUES
		('Офицеров ', 'Илья', 'Николаевич', '89420946718','KrasnayaPloshad@mail.ru','ул. Путровпавловская 59', '1995-01-31');
INSERT INTO `clients` (`surname`, `name`, `patronymic`, `phone`,`email`,`address`, `birthday`) VALUES
		('Мухина', 'Алена', 'Вечеславовна', '89294755991','Muha32@gmail.com	','ул. Куйбышева 15', '2000-09-23');
    
    

USE `Clients_db`;
CREATE TABLE `autoparts` (
	`id`				INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` 		VARCHAR(30),
    `type`			VARCHAR(30),
    `description`VARCHAR(1000),
	`cost`			INT(11)
);

INSERT INTO `autoparts` (`name`, `type`, `description`,`cost`) VALUES
		('Блок управления ABS', 'Блоки', 'Cистема, которая не даёт колёсам блокироваться во время экстренного торможения и регулирует усилия, создаваемые тормозными механизмами. ', '5000');
INSERT INTO `autoparts` (`name`, `type`, `description`,`cost`) VALUES
		('Штампованные диски ', 'Диски ', 'Такие диски изготавливаются из прокатной углеродистой («черной») стали путем штамповки отдельно обода и лицевой части и их последующего соединения сваркой.', '2625');
INSERT INTO `autoparts` (`name`, `type`, `description`,`cost`) VALUES
		('Насос гидроусилителя руля ', 'Насос', 'Предназначен для облегчения управления направлением движения автомобиля при сохранении необходимой «обратной связи» и обеспечении устойчивости и однозначности задаваемой траектории.', '3500');
INSERT INTO `autoparts` (`name`, `type`, `description`,`cost`) VALUES
		('Турбокомпрессор ', 'Блоки', 'Устройство, использующее отработавшие газы (выхлопные газы) для увеличения давления внутри камеры сгорания.', '20857');
INSERT INTO `autoparts` (`name`, `type`, `description`,`cost`) VALUES
		('Рулевая рейка', 'Кнопки', 'Устройство заставляющее передние колёса автомобиля, синхронно поворачиваться в ту сторону, в которую поворачивается рулевое колесо. ', '2300');        




USE Clients_db;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `login` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `type` varchar(30)	NOT NULL
 
);

INSERT INTO `users` (`login`, `pass`, `type`) VALUES ('Muhina', '57571', 'client');
INSERT INTO `users` (`login`, `pass`, `type`) VALUES ('Imaikin', '57571', 'master');
INSERT INTO `users` (`login`, `pass`, `type`) VALUES ('Fitisov', '57571', 'seller')





USE `Clients_db`;

CREATE TABLE `cart` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`product_id`) REFERENCES `autoparts`(`id`)
);

CREATE TABLE `orders` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `total_amount` DECIMAL(10,2) NOT NULL,
    `status` ENUM('new', 'processing', 'completed', 'cancelled') NOT NULL DEFAULT 'new',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

CREATE TABLE `order_items` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`),
    FOREIGN KEY (`product_id`) REFERENCES `autoparts`(`id`)
);




