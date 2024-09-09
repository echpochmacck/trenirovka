-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 09 2024 г., 21:27
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tren`
--

-- --------------------------------------------------------

--
-- Структура таблицы `kind`
--

CREATE TABLE `kind` (
  `id` int UNSIGNED NOT NULL,
  `korm_per_day` float NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `family` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `continent` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `kind`
--

INSERT INTO `kind` (`id`, `korm_per_day`, `title`, `family`, `continent`) VALUES
(1, 12, 'шемпанзе', 'обезьяны', 'африка'),
(2, 25, 'арагнутангги', 'обезьяны', 'африка'),
(3, 25, 'карликовыйгипопатам', 'слоны', 'африка'),
(4, 25, 'овчарка', 'псовые', 'африка'),
(5, 25, 'бульдог', 'псовые', 'африка');

-- --------------------------------------------------------

--
-- Структура таблицы `razmechenie`
--

CREATE TABLE `razmechenie` (
  `id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `kind_id` int UNSIGNED NOT NULL,
  `room_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `razmechenie`
--

INSERT INTO `razmechenie` (`id`, `quantity`, `kind_id`, `room_id`) VALUES
(1, 1, 2, 1),
(2, 1, 1, 1),
(3, 12, 3, 2),
(4, 1, 3, 3),
(5, 12, 4, 1),
(6, 10, 4, 2),
(7, 30, 5, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `room`
--

CREATE TABLE `room` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `number` int NOT NULL,
  `is_water` tinyint(1) NOT NULL,
  `is_hot` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `room`
--

INSERT INTO `room` (`id`, `title`, `number`, `is_water`, `is_hot`) VALUES
(1, 'приматы', 1, 1, 1),
(2, 'без воды1', 2, 0, 1),
(3, 'без воды2', 3, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `patronymic` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `authKey` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`name`, `surname`, `patronymic`, `email`, `login`, `password`, `authKey`, `phone`, `id`) VALUES
('выыв', 'ыв', 'вы', 'mdsadasd@hdad.com', 'max', '$2y$13$/JOFOn7mxlTFQ95/oPcNfOWv76XhY7IXwqZd1sopJUf4GiSe7000K', '9J7wx6rS3y-MBrW4D7VDIdsE9alXsQf4', '+313213231223', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `kind`
--
ALTER TABLE `kind`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `razmechenie`
--
ALTER TABLE `razmechenie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kind_id` (`kind_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Индексы таблицы `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `kind`
--
ALTER TABLE `kind`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `razmechenie`
--
ALTER TABLE `razmechenie`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `room`
--
ALTER TABLE `room`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `razmechenie`
--
ALTER TABLE `razmechenie`
  ADD CONSTRAINT `razmechenie_ibfk_1` FOREIGN KEY (`kind_id`) REFERENCES `kind` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `razmechenie_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
