-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 17 2017 г., 19:11
-- Версия сервера: 10.1.13-MariaDB
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `furniture_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `category_id` int(3) NOT NULL,
  `category_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `category_description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Корпусная мебель', 'Корпусная мебель описание'),
(2, 'Кухни', 'Кухни описание'),
(3, 'Столы и стулья', 'Столы и стулья описание');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(6) NOT NULL,
  `comment_author` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comment_text` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_author`, `comment_text`, `comment_date`, `item_id`) VALUES
(1, 'testA', 'testT', '2017-01-02', 1),
(2, 'test1', 'test1', '2017-01-17', 1),
(3, 'test2', 'test2', '2017-01-17', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `example_images`
--

CREATE TABLE `example_images` (
  `image_id` int(4) NOT NULL,
  `image_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `example_images`
--

INSERT INTO `example_images` (`image_id`, `image_name`, `item_id`) VALUES
(1, 'pic1.jpg', 2),
(2, 'pic2.jpg', 3),
(3, 'pic3.jpg', 4),
(4, 'pic4.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `item_id` int(4) NOT NULL,
  `item_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(3) NOT NULL,
  `item_descr` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `category_id`, `item_descr`) VALUES
(1, 'Шкаф 1', 1, 'Шкаф 1 описание'),
(2, 'Комод 1', 1, 'Комод 1 описание'),
(3, 'Кухонный гарнитур 1', 2, 'Кухонный гарнитур 1 описание'),
(4, 'Стул 1', 3, 'Стул 1 описание');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(2) NOT NULL,
  `menu_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `menu_order` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `file_name`, `menu_order`) VALUES
(1, 'Главная', 'mainpage.php', NULL),
(2, 'Категории мебели', 'categories.php', 1),
(3, 'Галерея', 'examples.php', 2),
(4, 'Покупателю', 'info.php', 3),
(5, 'Контакт', 'contact.php', 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Индексы таблицы `example_images`
--
ALTER TABLE `example_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `example_images`
--
ALTER TABLE `example_images`
  MODIFY `image_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
