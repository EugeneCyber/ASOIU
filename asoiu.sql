-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 06 2024 г., 03:24
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `asoiu`
--

-- --------------------------------------------------------

--
-- Структура таблицы `complitedgames`
--

CREATE TABLE `complitedgames` (
  `complited_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `game_ID` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `result` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `complitedgames`
--

INSERT INTO `complitedgames` (`complited_ID`, `user_ID`, `game_ID`, `date`, `result`) VALUES
(4, 1, 1, '2024-02-25', 1),
(5, 2, 1, '2024-02-27', 0),
(6, 2, 1, '2024-02-29', 0),
(7, 1, 1, '2024-03-01', 0),
(8, 1, 1, '2024-03-02', 1),
(9, 1, 1, '2024-03-03', 1),
(10, 1, 2, '2024-03-04', 1),
(11, 1, 3, '2024-03-04', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `games`
--

INSERT INTO `games` (`id`, `name`) VALUES
(1, 'Битва на мечах'),
(2, 'Мафия'),
(3, 'Пятнашки');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth` date DEFAULT NULL,
  `gender` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `birth`, `gender`) VALUES
(1, 'Eugene', '123', '2002-07-23', 1),
(2, 'DB2022_eugenecyber', 'DB2022_eugenecyber', NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `complitedgames`
--
ALTER TABLE `complitedgames`
  ADD PRIMARY KEY (`complited_ID`,`user_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `name_ID` (`game_ID`);

--
-- Индексы таблицы `games`
--
ALTER TABLE `games`
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
-- AUTO_INCREMENT для таблицы `complitedgames`
--
ALTER TABLE `complitedgames`
  MODIFY `complited_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `complitedgames`
--
ALTER TABLE `complitedgames`
  ADD CONSTRAINT `complitedgames_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complitedgames_ibfk_2` FOREIGN KEY (`game_ID`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
