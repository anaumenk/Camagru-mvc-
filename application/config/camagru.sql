-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 13 2018 г., 07:51
-- Версия сервера: 8.0.13
-- Версия PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `camagru`
--
CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `camagru`;
-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `img_id`, `user_id`, `comment`) VALUES
(229, 134, 90, '&lt;script&gt;alert(\'hee!\')&lt;/script&gt;'),
(230, 134, 90, '&lt;script&gt;alert(&quot;hee!&quot;)&lt;/script&gt;'),
(232, 158, 90, 'comment'),
(233, 131, 90, '1'),
(234, 159, 100, 's'),
(235, 132, 100, 'x'),
(236, 141, 100, 'dx'),
(238, 158, 100, 'ONE MORE');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id_img` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `img_src` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `comments` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id_img`, `user_id`, `img_src`, `likes`, `comments`) VALUES
(1, 90, '4.jpg', 1, 0),
(2, 90, '01.jpg', 0, 0),
(5, 90, '5.jpg', 1, 0),
(6, 90, '3.jpg', 0, 0),
(131, 90, '2.jpg', 1, 1),
(132, 90, '02.jpg', 1, 1),
(134, 90, '03.jpg', 1, 2),
(141, 90, '90-1542997565.png', 0, 1),
(157, 90, '90-1544714358.png', 0, 0),
(158, 90, '90-1544714373.png', 2, 2),
(159, 100, '100-1544715506.png', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `image_id`) VALUES
(192, 90, 1),
(193, 90, 158),
(194, 90, 131),
(195, 90, 134),
(196, 90, 5),
(198, 100, 132),
(205, 100, 158),
(237, 100, 159);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `token` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `activate` int(11) NOT NULL DEFAULT '0',
  `comments` int(11) NOT NULL DEFAULT '0',
  `user_image` text CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `token`, `activate`, `comments`, `user_image`) VALUES
(90, 'anaumenk', 'xefigaw@rsvhr.com', '21d5cb651222c347ea1284c0acf162000b4d3e34766f0d00312e3480f633088822809b6a54ba7edfa17e8fcb5713f8912ee3a218dd98d88c38bbf611b1b1ed2b', '1', 1, 1, '901544282195.png'),
(98, 'a', 'go1jufi@wokcy.com', '8c9ec9f0ac6ad6fea526dad1171e7507262d0ea9541a2e6ddcc5767a239d1da9edea948dbde5494bb7fb27df24d6ac5dfc3ad47cc52af76a7e9146c5125c6cf5', '470', 1, 0, NULL),
(99, 'as', 'gojufi@wokcy.com', '8c9ec9f0ac6ad6fea526dad1171e7507262d0ea9541a2e6ddcc5767a239d1da9edea948dbde5494bb7fb27df24d6ac5dfc3ad47cc52af76a7e9146c5125c6cf5', '2cd4a81e8e481759f3731cf9bc5c46419d99a54aa26f5c66285efb35bdc1b3f27a3aea5c2dee47aed5eb2a66b7b462cebc1e2b2b348d35e7b072521042d10b3f', 1, 0, NULL),
(100, 'new', 'al13ra@gmail.com', '21d5cb651222c347ea1284c0acf162000b4d3e34766f0d00312e3480f633088822809b6a54ba7edfa17e8fcb5713f8912ee3a218dd98d88c38bbf611b1b1ed2b', '75f846c0ec2dfbdaf51ae412907cb439ca63c4a2d1416e2f34d35b9be12c9abdf0b004c650680259bebe5ec5cfe8833fd1c2d8a98d357e7d45ec0f4325cf14da', 1, 0, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_img`);

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_name_2` (`user_name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
