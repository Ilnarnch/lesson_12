-- Adminer 4.2.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `private` tinyint(4) NOT NULL,
  `seller_name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `allow_mail` varchar(4) DEFAULT NULL,
  `category_id` int(4) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `id_r` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ads` (`id`, `private`, `seller_name`, `email`, `phone`, `city_id`, `allow_mail`, `category_id`, `title`, `description`, `price`, `id_r`) VALUES
(21,	1,	'seller_name',	'123@ya.ru',	'+7927...',	641490,	'Yes',	81,	'title',	'dfg',	1111,	NULL);

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(40) NOT NULL,
  `parent_id` varchar(20) NOT NULL,
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`id`, `category`, `parent_id`) VALUES
(9,	'Автомобили с пробегом',	'1'),
(109,	'Новые автомобили',	'1'),
(14,	'Мотоциклы и мототехника',	'1'),
(81,	'Грузовики и спецтехника',	'1'),
(11,	'Водный транспорт',	'1'),
(10,	'Запчасти и аксессуары',	'1'),
(24,	'Квартиры',	'2'),
(23,	'Комнаты',	'2'),
(25,	'Дома, дачи, коттеджи',	'2'),
(26,	'Земельные участки',	'2'),
(85,	'Гаражи и машиноместа',	'2'),
(42,	'Коммерческая недвижимость',	'2'),
(86,	'Недвижимость за рубежом',	'2'),
(111,	'Вакансии (поиск сотрудников)',	'3'),
(112,	'Резюме (поиск работы)',	'3'),
(114,	'Предложения услуг',	'4'),
(115,	'Запросы на услуги',	'4'),
(27,	'Одежда, обувь, аксессуары',	'5'),
(29,	'Детская одежда и обувь',	'5'),
(30,	'Товары для детей и игрушки',	'5'),
(28,	'Часы и украшения',	'5'),
(88,	'Красота и здоровье',	'5'),
(21,	'Бытовая техника',	'6'),
(20,	'Мебель и интерьер',	'6'),
(87,	'Посуда и товары для кухни',	'6'),
(82,	'Продукты питания',	'6'),
(19,	'Ремонт и строительство',	'6'),
(106,	'Растения',	'6'),
(32,	'Аудио и видео',	'7'),
(97,	'Игры, приставки и программы',	'7'),
(31,	'Настольные компьютеры',	'7'),
(98,	'Ноутбуки',	'7'),
(99,	'Оргтехника и расходники',	'7'),
(96,	'Планшеты и электронные книги',	'7'),
(84,	'Телефоны',	'7'),
(101,	'Товары для компьютера',	'7'),
(105,	'Фототехника',	'7'),
(33,	'Билеты и путешествия',	'8'),
(34,	'Велосипеды',	'8'),
(83,	'Книги и журналы',	'8'),
(36,	'Коллекционирование',	'8'),
(38,	'Музыкальные инструменты',	'8'),
(102,	'Охота и рыбалка',	'8'),
(39,	'Спорт и отдых',	'8'),
(103,	'Знакомства',	'8'),
(89,	'Собаки',	'9'),
(90,	'Кошки',	'9'),
(91,	'Птицы',	'9'),
(92,	'Аквариум',	'9'),
(93,	'Другие животные',	'9'),
(94,	'Товары для животных',	'9'),
(116,	'Готовый бизнес',	'Для бизнеса'),
(40,	'Оборудование для бизнеса',	'Для бизнеса');

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cities` (`id`, `city`) VALUES
(0,	'Выбрать другой...'),
(641490,	'Барабинск'),
(641510,	'Бердск'),
(641600,	'Искитим'),
(641630,	'Колывань'),
(641680,	'Краснообск'),
(641710,	'Куйбышев'),
(641760,	'Мошково'),
(641790,	'Обь'),
(641800,	'Ордынское'),
(641970,	'Черепаново'),
(641780,	'Новосибирск');

INSERT INTO `departments` (`id`, `name`) VALUES
(1,	'Финансовый'),
(2,	'Почтовый '),
(3,	'Доставка'),
(101,	'post'),
(110,	'Уборка'),
(303,	'postwt');

INSERT INTO `new_table` (`id`, `column`) VALUES
(1,	'wer'),
(9,	'value_111');

DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `parent_id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(48) NOT NULL,
  PRIMARY KEY (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `sections` (`parent_id`, `section`) VALUES
(1,	'Транспорт'),
(2,	'Недвижимость'),
(3,	'Работа'),
(4,	'Услуги'),
(5,	'Личные вещи'),
(6,	'Для дома и дачи'),
(7,	'Бытовая техника'),
(8,	'Хобби'),
(9,	'Животные');

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `department`) VALUES
(1,	'Ильнар ',	'Гарифуллин',	'123',	1),
(2,	'Андрей ',	'Иванов',	'234567',	3),
(3,	'Иванов',	'Алексей',	'Викторович',	3),
(4,	'1_user',	'1_lastname',	'1_11111',	1),
(5,	'2_user',	'2_lastname',	'2_22222',	2),
(9,	'3_user',	'3_lastname',	'3_22222',	3),
(8,	'3_user',	'3_lastname',	'3_22222',	3),
(10,	'3_user',	'3_lastname',	'3_22222',	3),
(11,	'3_user',	'3_lastname',	'3_22222',	3);

-- 2016-03-24 11:12:20
