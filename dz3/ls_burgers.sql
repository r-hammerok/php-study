-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 07 2020 г., 15:08
-- Версия сервера: 5.6.43
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ls_burgers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `street` varchar(30) NOT NULL,
  `home` varchar(10) NOT NULL,
  `part` varchar(10) NOT NULL,
  `appt` varchar(10) NOT NULL,
  `floor` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  `payment` tinyint(1) UNSIGNED NOT NULL,
  `callback` tinyint(1) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `street`, `home`, `part`, `appt`, `floor`, `date`, `payment`, `callback`, `comment`) VALUES
(1, 1, 'Абаканская', '12', '', '12', '1', '2020-06-04 21:34:44', 2, 0, ''),
(2, 1, 'Абаканская', '12', '', '12', '1', '2020-06-04 21:35:22', 1, 1, 'Еще хочу'),
(3, 2, 'Абаканская', '12', '', '12', '1', '2020-06-04 21:35:36', 1, 1, 'Еще хочу'),
(4, 1, 'Ленина', '1', '', '1', '1', '2020-06-05 16:55:42', 1, 1, 'Снова я'),
(5, 3, 'Мира', '2', '2', '2', '9', '2020-06-05 16:56:48', 2, 0, 'Я новенький'),
(6, 6, 'Советская', '10', '', '10', '1', '2020-06-06 13:33:00', 1, 1, 'Я новичок 2'),
(7, 6, 'Советская', '10', '', '10', '1', '2020-06-06 13:33:46', 1, 1, 'Я новичок 3'),
(8, 6, 'Советская', '10', '', '10', '1', '2020-06-06 13:35:00', 1, 1, 'Я новичок 4'),
(9, 3, 'Советская', '10', '', '10', '1', '2020-06-06 13:35:20', 1, 1, 'Я новичок 4'),
(10, 7, 'Советская', '10', '', '10', '1', '2020-06-06 13:35:39', 1, 1, 'Я новичок 10'),
(15, 13, 'Рябинская', '100', '1', '103', '8', '2020-06-07 14:33:14', 2, 1, 'Я хочу есть!'),
(16, 13, 'Рябинская', '100', '1', '103', '8', '2020-06-07 14:33:49', 1, 1, 'Я хочу есть снова!'),
(18, 1, '1', '1', '1', '1', '1', '2020-06-07 15:02:57', 2, 0, '111111111111'),
(19, 14, '2', '2', '2', '2', '2', '2020-06-07 15:03:44', 1, 1, '2222222');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`) VALUES
(1, 'Роман', '+7 (000) 000 00 00', '1@mail.ru'),
(2, 'Маша', '+7 (000) 000 00 00', '2@mail.ru'),
(3, 'Саша', '+7 (711) 111 11 11', '3@mail.ru'),
(5, 'Нина', '+7 (999) 999 99 99', '4@MAIL.RU'),
(6, 'Нина', '+7 (999) 999 99 99', '5@MAIL.RU'),
(7, 'Нина', '+7 (999) 999 99 99', '10@MAIL.RU'),
(13, 'Нина', '+7 (333) 333 33 33', 'NINA@MAIL.RU'),
(14, '2', '+7 (222) 222 22 22', 'ROMAN@MAIL.RU');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
