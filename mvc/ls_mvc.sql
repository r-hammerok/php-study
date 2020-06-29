-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 29 2020 г., 06:52
-- Версия сервера: 5.6.43
-- Версия PHP: 7.3.9

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
  `owner_id` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `img_name` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `owner_id`, `text`, `img_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 3, 'Post with image', 'fd6590a03c.jpg', '2020-06-14 04:06:27', '0000-00-00 00:00:00', NULL),
(19, 5, 'New post without image', '', '2020-06-17 00:23:03', '0000-00-00 00:00:00', NULL),
(20, 5, 'New post with image', '479f9a8e45.jpg', '2020-06-17 00:23:45', '0000-00-00 00:00:00', NULL),
(21, 5, 'Again message without image', '', '2020-06-17 00:24:48', '0000-00-00 00:00:00', NULL),
(22, 5, 'Message from non Admin', '', '2020-06-17 00:25:19', '0000-00-00 00:00:00', NULL),
(31, 5, 'Hi again!', '', '2020-06-17 02:27:18', '0000-00-00 00:00:00', NULL),
(32, 5, 'Privet', '', '2020-06-17 03:09:07', '0000-00-00 00:00:00', NULL),
(33, 8, 'New message from root', '40ba3bbb93.jpg', '2020-06-17 03:22:04', '0000-00-00 00:00:00', NULL),
(35, 0, 'eeeeee', '95708adda0.jpg', '2020-06-22 04:28:22', '0000-00-00 00:00:00', NULL),
(36, 8, 'aqqqqq', '', '2020-06-25 09:29:35', '2020-06-25 09:29:35', NULL),
(37, 9, '444444', '', '2020-06-26 10:22:04', '2020-06-26 10:22:04', NULL),
(38, 0, '9999', 'c79d7907fc.jpg', '2020-06-26 23:14:06', '2020-06-26 23:23:04', '2020-06-26 23:23:04'),
(39, 9, 'hfhksdjfdsjkhfdf', '283fd6047f.jpg', '2020-06-26 23:22:36', '2020-06-26 23:22:36', NULL),
(40, 9, 'Привет еще раз!', 'a2986ec15c.jpg', '2020-06-28 03:24:45', '2020-06-28 03:24:45', NULL),
(41, 9, 'Hi', '', '2020-06-28 03:26:23', '2020-06-28 03:29:27', '2020-06-28 03:29:27'),
(42, 9, 'ssssaaaa', '92ced6d29d.jpg', '2020-06-28 06:47:51', '2020-06-28 06:47:51', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` char(14) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'roman', '1@mail.ru', '$2y$10$0KPmc738mpLeAYhZJ4vXMeD8bFDh6bUXSboFtaQD5W47.ZSFmF/fe', '', '2020-06-13 03:06:37', '2020-06-28 01:58:18', NULL),
(2, 'sergey', '2@mail.ru', '$2y$10$LvHknIdg7d5TrpV86F7.ledp7INOj/KWME0uZVG71O4bzurr2kxke', '09518900a6.jpg', '2020-06-13 05:06:09', '2020-06-28 08:18:50', NULL),
(3, 'anna', '3@mail.ru', '$2y$10$2FHK2yIpA/aRmENPfLrE2ulN2psydof1gqcPBYBxZkn7QzVYQh7IS', '', '2020-06-13 06:06:00', '2020-06-26 06:29:25', '2020-06-26 06:29:25'),
(4, 'dima', '4@mail.ru', '$2y$10$3mA9MGCnlbmPBuyGKPSa4.8IdN9PyyxCW/tn5zrx6Ygi8uHotVQM2', '', '2020-06-13 09:06:35', '2020-06-28 02:17:41', NULL),
(5, 'nina', '5@mail.ru', '$2y$10$8Gl.4b2E7dh1bvdKLxh14..Tg7rU7irh0iDNkLjQUJvV4tmqCxLXa', '', '2020-06-13 23:06:53', '0000-00-00 00:00:00', NULL),
(6, 'luyba', '7@mail.ru', '$2y$10$6nxEXBBux5WRugyYT2iv/Of.uGhKb4ykupzuZ8QypVLShGwCU6Sby', '', '2020-06-14 06:06:11', '0000-00-00 00:00:00', NULL),
(8, 'root', '9@mail.ru', '$2y$10$7IOkd1Q/dE1YT/CQLmKS4OZZ2cByPDkR3WOf0D46OJmM8uFEO4jmS', '', '2020-06-17 03:21:37', '0000-00-00 00:00:00', NULL),
(9, 'masha', '10@mail.ru', '$2y$10$t3SdMuyhj2Kn1S3bbUSNW.XkJJRPuis3yUbwOA2A8zToIEtpA2czu', '', '2020-06-25 00:59:14', '2020-06-25 00:59:14', NULL),
(11, 'Samuil', '12@mail.ru', '$2y$10$2IldnuLiaaWCVQk8vSTGGeBJWp5SI.CK.0UknNeAEugtyh97jEiaW', '', '2020-06-26 08:29:52', '2020-06-26 08:29:52', NULL),
(12, 'hacker', '100@mail.ru', '$2y$10$TdUXSIszmDCRY6Gly/P1Le3hPbxNHEY7.J9a1KXj3DpQPUTwme95e', '', '2020-06-27 04:13:08', '2020-06-27 04:13:08', NULL),
(13, '13', '13@mail.ru', '$2y$10$gi6/d5UU5CgBBPAg8n0h0eLKCijxJhua1or/vfCQDwafmOKtgcaZ.', '', '2020-06-27 05:20:01', '2020-06-27 05:26:56', '2020-06-27 05:26:56'),
(14, '14', '14@mail.ru', '$2y$10$qsNSiN1MH3D2YdoE4r5tf..kRydlHjmKAkWI0uZ7mffSaJnMd8hpa', '', '2020-06-27 05:25:46', '2020-06-27 05:39:11', '2020-06-27 05:39:11'),
(16, '145', '14@mail.ru', '$2y$10$tFncdU9mmF.o946QhIgWyOjW61PnDzGliIeP.oXCJjvqkBRguCFPO', '', '2020-06-27 05:41:47', '2020-06-27 22:57:20', '2020-06-27 22:57:20'),
(17, 'naday', '15@mail.ru', '$2y$10$L495l1rw8n7Pm3EhXRmTo..71Vy4h.4sEoa61k6M860sO9baG34UC', '', '2020-06-27 23:38:58', '2020-06-27 23:38:58', NULL),
(18, 'slava', '14@mail.ru', '$2y$10$caXN0B9.mZLkcHDntEDyReIdc29/vkyd8qL7Ao7DaIq1.LcXEyZhO', '5f76273e61.jpg', '2020-06-28 07:01:35', '2020-06-28 07:01:35', NULL),
(19, 'pasha', '16@mail.ru', '$2y$10$acR/LQXswDouRx/.1oAkOuQVqkA3o00pytx9k5pMS7hv3da0qbeo.', '163fa0090f.jpg', '2020-06-28 08:37:03', '2020-06-28 08:37:03', NULL);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
