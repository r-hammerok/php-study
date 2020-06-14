-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 14 2020 г., 12:36
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
-- База данных: `ls_mvc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `img_name` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `created_at`, `owner_id`, `text`, `img_name`) VALUES
(1, '2020-06-14 08:06:44', 3, '111', NULL),
(2, '2020-06-14 08:06:48', 3, '222', NULL),
(3, '2020-06-14 11:06:27', 3, 'Post with image', 'fd6590a03c.jpg'),
(4, '2020-06-14 12:06:33', 3, 'No image in post', NULL),
(5, '2020-06-14 12:06:38', 3, 'Hi', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `reg_data` datetime NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `reg_data`, `email`, `password`) VALUES
(1, 'roman', '2020-06-13 10:06:37', '1@mail.ru', '$2y$10$0KPmc738mpLeAYhZJ4vXMeD8bFDh6bUXSboFtaQD5W47.ZSFmF/fe'),
(2, 'sergey', '2020-06-13 12:06:09', '2@mail.ru', '$2y$10$LvHknIdg7d5TrpV86F7.ledp7INOj/KWME0uZVG71O4bzurr2kxke'),
(3, 'anna', '2020-06-13 13:06:00', '3@mail.ru', '$2y$10$2FHK2yIpA/aRmENPfLrE2ulN2psydof1gqcPBYBxZkn7QzVYQh7IS'),
(4, 'dima', '2020-06-13 16:06:35', '4@mail.ru', '$2y$10$3mA9MGCnlbmPBuyGKPSa4.8IdN9PyyxCW/tn5zrx6Ygi8uHotVQM2'),
(5, 'nina', '2020-06-14 06:06:53', '5@mail.ru', '$2y$10$8Gl.4b2E7dh1bvdKLxh14..Tg7rU7irh0iDNkLjQUJvV4tmqCxLXa');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
