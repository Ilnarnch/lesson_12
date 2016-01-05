-- Adminer 4.2.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `adStore`;
CREATE TABLE `adStore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `private` int(2) NOT NULL,
  `seller_name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `checkbox` varchar(4) DEFAULT NULL,
  `category_id` int(4) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `main_form_submit` varchar(10) NOT NULL,
  `hidden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_number` int(11) NOT NULL,
  `category_name` varchar(40) NOT NULL,
  `section_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `category` (`id`, `category_number`, `category_name`, `section_id`) VALUES
(1, 9,  'Автомобили с пробегом',  '1'),
(2, 109,  'Новые автомобили', '1'),
(3, 14, 'Мотоциклы и мототехника',  '1'),
(4, 81, 'Грузовики и спецтехника',  '1'),
(5, 11, 'Водный транспорт', '1'),
(6, 10, 'Запчасти и аксессуары',  '1'),
(7, 24, 'Квартиры', '2'),
(8, 23, 'Комнаты',  '2'),
(9, 25, 'Дома, дачи, коттеджи', '2'),
(10,  26, 'Земельные участки',  '2'),
(11,  85, 'Гаражи и машиноместа', '2'),
(12,  42, 'Коммерческая недвижимость',  '2'),
(13,  86, 'Недвижимость за рубежом',  '2'),
(14,  111,  'Вакансии (поиск сотрудников)', '3'),
(15,  112,  'Резюме (поиск работы)',  '3'),
(16,  114,  'Предложения услуг',  '4'),
(17,  115,  'Запросы на услуги',  '4'),
(18,  27, 'Одежда, обувь, аксессуары',  '5'),
(19,  29, 'Детская одежда и обувь', '5'),
(20,  30, 'Товары для детей и игрушки', '5'),
(21,  28, 'Часы и украшения', '5'),
(22,  88, 'Красота и здоровье', '5'),
(23,  21, 'Бытовая техника',  '6'),
(24,  20, 'Мебель и интерьер',  '6'),
(25,  87, 'Посуда и товары для кухни',  '6'),
(26,  82, 'Продукты питания', '6'),
(27,  19, 'Ремонт и строительство', '6'),
(28,  106,  'Растения', '6'),
(29,  32, 'Аудио и видео',  '7'),
(30,  97, 'Игры, приставки и программы',  '7'),
(31,  31, 'Настольные компьютеры',  '7'),
(32,  98, 'Ноутбуки', '7'),
(33,  99, 'Оргтехника и расходники',  '7'),
(34,  96, 'Планшеты и электронные книги', '7'),
(35,  84, 'Телефоны', '7'),
(36,  101,  'Товары для компьютера',  '7'),
(37,  105,  'Фототехника',  '7'),
(38,  33, 'Билеты и путешествия', '8'),
(39,  34, 'Велосипеды', '8'),
(40,  83, 'Книги и журналы',  '8'),
(41,  36, 'Коллекционирование', '8'),
(42,  38, 'Музыкальные инструменты',  '8'),
(43,  102,  'Охота и рыбалка',  '8'),
(44,  39, 'Спорт и отдых',  '8'),
(45,  103,  'Знакомства', '8'),
(46,  89, 'Собаки', '9'),
(47,  90, 'Кошки',  '9'),
(48,  91, 'Птицы',  '9'),
(49,  92, 'Аквариум', '9'),
(50,  93, 'Другие животные',  '9'),
(51,  94, 'Товары для животных',  '9'),
(52,  116,  'Готовый бизнес', 'Для бизнеса'),
(53,  40, 'Оборудование для бизнеса', 'Для бизнеса');

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cities` (`id`, `number`, `city`) VALUES
(1, 641780, 'Новосибирск'),
(2, 641490, 'Барабинск'),
(3, 641510, 'Бердск'),
(4, 641600, 'Искитим'),
(5, 641630, 'Колывань'),
(6, 641680, 'Краснообск'),
(7, 641710, 'Куйбышев'),
(8, 641760, 'Мошково'),
(9, 641790, 'Обь'),
(10,  641800, 'Ордынское'),
(11,  641970, 'Черепаново'),
(12,  0,  'Выбрать другой...');

DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(48) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `sections` (`section_id`, `section`) VALUES
(1, 'Транспорт'),
(2, 'Недвижимость'),
(3, 'Работа'),
(4, 'Услуги'),
(5, 'Личные вещи'),
(6, 'Для дома и дачи'),
(7, 'Бытовая техника'),
(8, 'Хобби'),
(9, 'Животные');

-- 2016-01-04 12:36:24
