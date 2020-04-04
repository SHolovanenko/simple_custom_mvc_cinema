-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 03 2020 г., 05:33
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cinema_develop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `movies`
--

CREATE TABLE `movies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description_short` varchar(100) DEFAULT NULL,
  `description_full` text NOT NULL,
  `duration_mins` int(11) NOT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `movies`
--

INSERT INTO `movies` (`id`, `title`, `alias`, `description_short`, `description_full`, `duration_mins`, `poster`, `created_at`, `deleted_at`) VALUES
(1, 'First movie', 'first-movie', 'Short description of first movie', 'Here is a full description with a lot of words for full description of first movie. ', 120, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&s', '2020-04-02 14:50:27', NULL),
(2, 'Second film', 'second-film', 'short desc of second movie', 'Here is a full description for second movie with a lot of awesome words.', 90, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&s', '2020-04-02 14:50:56', NULL),
(3, 'third movie', 'third-movie', 'This is my short-full description...', 'This is my short-full description', 95, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&s', '2020-04-02 14:51:03', NULL),
(7, 'Fourth movie with new title', 'fourth-movie-with-new-title', '', 'Here is description of fourth movie, this description will be automatically cuted to 100 symbolse to store a special short description.', 125, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&s', '2020-04-02 14:50:42', '2020-04-01 12:40:38'),
(8, 'Fifth movie', 'fifth-movie', 'Nunc et libero orci. In hac habitasse', 'Nunc et libero orci. In hac habitasse platea dictumst. Fusce fermentum hendrerit commodo. Suspendisse aliquet tempus pulvinar. Curabitur ultrices, velit at rutrum blandit, metus nisi mollis augue, et dignissim felis risus a enim.', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&amp;s', '2020-04-03 00:41:29', NULL),
(9, 'Lorem ipsum', 'lorem-ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam viverra pharetra. Proin a...', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam viverra pharetra. Proin a lorem et diam sollicitudin auctor. Nunc congue blandit eros vel convallis. ', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&amp;s', '2020-04-03 00:18:25', NULL),
(10, 'Interdum et malesuada', 'interdum-et-malesuada', 'Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis eget nisl a quam luctus mattis...', 'Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis eget nisl a quam luctus mattis et at elit. Aliquam tincidunt rutrum pellentesque. Praesent eget justo velit. Nunc tristique quam eget risus dapibus sagittis. Morbi vitae tempor nunc. Aliquam tincidunt ligula non consectetur sagittis. Suspendisse elementum sollicitudin est, a iaculis ipsum volutpat non. Phasellus hendrerit lacus nibh, et condimentum arcu ullamcorper ut.', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&amp;s', '2020-04-03 00:43:48', NULL),
(11, 'In in varius', 'in-in-varius', 'In in varius metus, eget faucibus nulla. Vestibulum eget maximus nisi. Integer hendrerit congue r...', 'In in varius metus, eget faucibus nulla. Vestibulum eget maximus nisi. Integer hendrerit congue risus vitae egestas. Nunc molestie, nunc eu sollicitudin eleifend, orci magna rutrum dui, sit amet finibus nulla enim non urna.', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&amp;s', '2020-04-03 00:45:04', NULL),
(12, 'Maecenas tristique', 'maecenas-tristique', 'Maecenas tristique ultrices faucibus. Duis interdum mi quis pellentesque ultrices. Vestibulum luc...', 'Maecenas tristique ultrices faucibus. Duis interdum mi quis pellentesque ultrices. Vestibulum luctus neque non sem posuere, vel placerat risus feugiat.', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&amp;s', '2020-04-03 00:46:38', NULL),
(13, 'Morbi in felis', 'morbi-in-felis', 'Morbi in felis non odio vulputate posuere vitae quis elit. Fusce sem felis, varius eu odio eget, ...', 'Morbi in felis non odio vulputate posuere vitae quis elit. Fusce sem felis, varius eu odio eget, facilisis interdum arcu. Suspendisse aliquet ut tortor id congue. In ultricies magna id auctor finibus.', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&amp;s', '2020-04-03 00:48:42', NULL),
(14, 'Maecenas maximus tincidunt', 'maecenas-maximus-tincidunt', 'Maecenas maximus tincidunt mollis. Duis vitae ante sit amet nibh volutpat blandit quis ut lectus....', 'Maecenas maximus tincidunt mollis. Duis vitae ante sit amet nibh volutpat blandit quis ut lectus. Fusce aliquet velit id felis ullamcorper bibendum.', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&amp;s', '2020-04-03 00:49:09', NULL),
(15, 'Duis at blandit lorem', 'duis-at-blandit-lorem', 'Duis at blandit lorem, elementum vulputate felis. Fusce ac massa tempor, semper felis id, egestas...', 'Duis at blandit lorem, elementum vulputate felis. Fusce ac massa tempor, semper felis id, egestas libero. Cras nisl tellus, suscipit ut ipsum vel, ornare varius odio. Aenean metus dui, sollicitudin sed mollis sit amet, scelerisque sit amet ligula.', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&amp;s', '2020-04-03 00:49:51', NULL),
(16, 'Phasellus interdum', 'phasellus-interdum', 'Phasellus interdum, orci at ullamcorper blandit, dolor ante vestibulum nunc, eget tincidunt neque...', 'Phasellus interdum, orci at ullamcorper blandit, dolor ante vestibulum nunc, eget tincidunt neque elit sit amet ex. Proin enim orci, mattis at tristique ut, consequat at libero. Aenean venenatis, nisi non elementum sodales, metus mi porttitor tortor, sit amet aliquet elit leo vitae orci.', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP4XsQBgXMyTt1LXYulJWqv_W1G9Ca9RjIot_nX7TCK-iRBCpHuQ&amp;s', '2020-04-03 00:51:10', NULL),
(17, 'Quisque ex nunc edited', 'quisque-ex-nunc', 'Quisque ex nunc, dapibus ac volutpat et, viverra at ex.', 'Quisque ex nunc, dapibus ac volutpat et, viverra at ex. Vivamus tempor eget tortor et accumsan. Fusce lacus lectus, molestie vitae ex euismod, tincidunt interdum lacus.', 120, '', '2020-04-03 03:18:43', '2020-04-03 03:18:43');

-- --------------------------------------------------------

--
-- Структура таблицы `movie_sessions`
--

CREATE TABLE `movie_sessions` (
  `id` bigint(20) NOT NULL,
  `movie_id` bigint(20) NOT NULL,
  `start` timestamp NOT NULL DEFAULT current_timestamp(),
  `end` timestamp NOT NULL DEFAULT current_timestamp(),
  `room_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `movie_sessions`
--

INSERT INTO `movie_sessions` (`id`, `movie_id`, `start`, `end`, `room_id`, `created_at`, `deleted_at`) VALUES
(1, 1, '2020-04-05 21:26:15', '1970-01-01 01:32:50', 1, '2020-04-01 14:27:36', NULL),
(2, 3, '2020-04-01 16:30:00', '2020-04-01 18:05:00', 1, '2020-04-01 14:50:34', NULL),
(3, 1, '2020-04-02 20:21:10', '2020-04-01 20:22:10', 1, '2020-04-01 20:22:10', NULL),
(4, 2, '2020-04-03 20:21:10', '2020-04-01 20:22:10', 1, '2020-04-01 20:22:10', NULL),
(5, 10, '2020-04-04 16:00:00', '2020-04-04 16:00:00', 1, '2020-04-03 02:00:21', '2020-04-03 02:00:46'),
(6, 16, '2020-04-04 16:00:00', '2020-04-04 16:00:00', 1, '2020-04-03 02:10:38', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(3, 'guest'),
(2, 'manger');

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) NOT NULL,
  `name` varchar(16) NOT NULL,
  `rows` int(11) NOT NULL DEFAULT 5,
  `columns` int(11) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `rows`, `columns`) VALUES
(1, 'A', 5, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `session_registrations`
--

CREATE TABLE `session_registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `movie_session_id` bigint(20) UNSIGNED NOT NULL,
  `place_row` int(11) NOT NULL,
  `place_column` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `session_registrations`
--

INSERT INTO `session_registrations` (`id`, `email`, `phone`, `movie_session_id`, `place_row`, `place_column`, `created_at`) VALUES
(1, 'serhii.holovanenko@gmail.com', '+380508489086', 1, 1, 3, '2020-04-01 17:11:05'),
(2, 'someguy1@mail.com', '123456789012', 1, 0, 0, '2020-04-01 20:24:59'),
(3, 'someguy2@mail.com', '123456789012', 1, 0, 1, '2020-04-01 20:24:59'),
(4, 'someguy3@mail.com', '123443211234', 3, 2, 3, '2020-04-01 20:27:12'),
(5, 'someguy4@mail.com', '123443211234', 3, 1, 2, '2020-04-01 20:27:12'),
(6, 'someguy5@mail.com', '123443211234', 4, 1, 2, '2020-04-01 20:28:27'),
(7, 'someguy6@mail.com', '123443211234', 2, 3, 4, '2020-04-01 20:28:27'),
(8, 'someEmail@mail.com', '1234243124312', 3, 1, 0, '2020-04-02 18:34:19'),
(10, 'myEmail@mail.com', '123412341234', 4, 2, 0, '2020-04-02 19:13:30'),
(11, 'myEmail_1@mail.com', '123412341234', 4, 1, 0, '2020-04-02 19:21:31'),
(12, 'myEmail_2@mail.com', '123412341234', 4, 1, 0, '2020-04-02 19:22:52'),
(13, 'myEmail@mail.com', '123443211234', 4, 0, 0, '2020-04-02 19:25:56'),
(14, 'myEmail_2@mail.com', '123412341234', 4, 0, 4, '2020-04-02 19:44:42'),
(15, 'myEmail_3@mail.com', '1234243124312', 4, 2, 4, '2020-04-02 19:47:32'),
(16, 'myEmail_10@mail.com', '1234243124312', 4, 0, 6, '2020-04-02 20:10:22'),
(17, 'someEmail143134@mail.com', '5345143144543', 4, 4, 3, '2020-04-02 20:31:06'),
(18, 'myEmail@mail.com', '123412341234', 6, 2, 4, '2020-04-03 02:45:38');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `phone` varchar(22) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `password`, `name`, `email`, `phone`, `role`) VALUES
(1, '81dc9bdb52d04dc20036dbd8313ed055', 'admin', 'admin@gmail.com', '000000000000', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias_index` (`alias`);

--
-- Индексы таблицы `movie_sessions`
--
ALTER TABLE `movie_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `session_registrations`
--
ALTER TABLE `session_registrations`
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
-- AUTO_INCREMENT для таблицы `movies`
--
ALTER TABLE `movies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `movie_sessions`
--
ALTER TABLE `movie_sessions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `session_registrations`
--
ALTER TABLE `session_registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
