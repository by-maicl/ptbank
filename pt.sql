-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Квт 01 2024 р., 22:59
-- Версія сервера: 8.0.30
-- Версія PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `pt`
--

-- --------------------------------------------------------

--
-- Структура таблиці `card`
--

CREATE TABLE `card` (
  `card_id` int NOT NULL,
  `card_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `card_user` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `card_number` int DEFAULT NULL,
  `card_balance` decimal(11,1) UNSIGNED DEFAULT '0.0',
  `card_design` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `card`
--

INSERT INTO `card` (`card_id`, `card_name`, `card_user`, `card_number`, `card_balance`, `card_design`) VALUES
(19, 'Скрепочный бизнес', 'Xenia', 1771, '169.5', 'des_red.svg'),
(45, 'MonoBank kids', 'Maicl_GraB', 1001, '79.4', 'des_green.svg'),
(46, 'ШизВагонЗавод', 'Maicl_GraB', 7777, '1135.5', 'des_pink.svg'),
(50, 'Деньги в тумбочке', 'jenkajmenka', 2112, '200.0', 'des_orange.svg'),
(51, 'Синева', 'Mykola_Hamster', 7888, '160.4', 'des_blue.svg'),
(52, 'Семейный счёт', 'Spacerar', 3810, '751.2', 'des_pink.svg'),
(53, 'penis', 'Siriti', 6726, '0.0', 'des_pink.svg'),
(54, 'Деньги в тумбочке', 'Siriti', 4280, '0.0', 'des_orange.svg');

-- --------------------------------------------------------

--
-- Структура таблиці `likes`
--

CREATE TABLE `likes` (
  `id` int NOT NULL,
  `object_id` int DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `likes_count` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `likes`
--

INSERT INTO `likes` (`id`, `object_id`, `username`, `likes_count`) VALUES
(1, 1, 'Maicl_GraB', 1),
(2, 1, 'Xenia', 1),
(4, 8, 'Mykola_Hamster', 1),
(5, 8, 'Maicl_GraB', 1),
(6, 7, 'Maicl_GraB', 1),
(8, 9, 'Maicl_GraB', 1),
(9, 9, 'Xenia', 1),
(10, 9, 'Mykola_Hamster', 1),
(11, 11, 'Maicl_GraB', 1),
(12, 11, 'Mykola_Hamster', 1),
(13, 14, 'Xenia', 1),
(15, 15, 'Xenia', 1),
(16, 11, 'Xenia', 1),
(18, 15, 'jenkajmenka', 1),
(19, 11, 'jenkajmenka', 1),
(20, 17, 'Maicl_GraB', 1),
(21, 17, 'jenkajmenka', 1),
(22, 17, 'Siriti', 1),
(23, 11, 'Siriti', 1),
(24, 17, 'Xenia', 1),
(35, 15, 'Maicl_GraB', 1),
(36, 14, 'Maicl_GraB', 1),
(37, 20, 'Maicl_GraB', 1),
(38, 23, 'Maicl_GraB', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `notification`
--

CREATE TABLE `notification` (
  `id` int NOT NULL,
  `object_id` int NOT NULL,
  `object_id2` int DEFAULT NULL,
  `user_from` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_to` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `type` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `text` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `notification`
--

INSERT INTO `notification` (`id`, `object_id`, `object_id2`, `user_from`, `user_to`, `status`, `type`, `text`, `date`) VALUES
(63, 15, NULL, 'Maicl_GraB', 'Xenia', 1, 'like', NULL, '22:01 01.04.2024'),
(64, 14, NULL, 'Maicl_GraB', 'Xenia', 1, 'like', NULL, '22:01 01.04.2024');

-- --------------------------------------------------------

--
-- Структура таблиці `penalty`
--

CREATE TABLE `penalty` (
  `penalt_id` int NOT NULL,
  `penalt_status` int NOT NULL DEFAULT '1',
  `penalt_from` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `penalt_card_from` int UNSIGNED NOT NULL,
  `penalt_to` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `penalt_sum` decimal(11,1) UNSIGNED NOT NULL DEFAULT '0.0',
  `penalt_text` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `penalt_date` varchar(32) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `penalty`
--

INSERT INTO `penalty` (`penalt_id`, `penalt_status`, `penalt_from`, `penalt_card_from`, `penalt_to`, `penalt_sum`, `penalt_text`, `penalt_date`) VALUES
(1, 0, 'Xenia', 1771, 'Maicl_GraB', '0.1', '2423423', '00:56 20.12.2023'),
(2, 0, 'Mykola_Hamster', 7888, 'Maicl_GraB', '10.0', 'Потоптал газон емае ааааа аа', '00:58 21.01.2024');

-- --------------------------------------------------------

--
-- Структура таблиці `petition`
--

CREATE TABLE `petition` (
  `id` int NOT NULL,
  `header` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `text` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `subscribe` int NOT NULL DEFAULT '0',
  `date` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `support` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `answer` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `answer_from` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `answer_date` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `petition`
--

INSERT INTO `petition` (`id`, `header`, `text`, `file`, `subscribe`, `date`, `username`, `status`, `support`, `answer`, `answer_from`, `answer_date`) VALUES
(15, 'Йоу', 'Навали стиля бро', 'Screenshot_2.png', 2, '23:52 10.01.2024', 'Maicl_GraB', 1, NULL, NULL, NULL, NULL),
(16, 'Раян', 'Гослинг', '8D9ZjM43DWdxxaeHkc3DQdSDg-Y-960.jpg', 2, '22:39 11.01.2024', 'jenkajmenka', 1, NULL, NULL, NULL, NULL),
(17, 'Відкрити сервер', 'Не має сечі терпіти ці борошна!!! Скільки можна вже чекати??? ЛЮДИ ХОЧУТЬ ГРАТИ В МАЙНКРАФТ!!!!!!!!!!!!!!11', 'd10e5bbfa7edccdc.png', 5, '23:15 23.01.2024', 'Maicl_GraB', 0, 'true', 'Скоро відкриється! Очікуйте та слідкуйте за новинами серверу.', 'Mykola_Hamster', '23:33 23.01.2024');

-- --------------------------------------------------------

--
-- Структура таблиці `petition_sub`
--

CREATE TABLE `petition_sub` (
  `id` int NOT NULL,
  `petition_id` int NOT NULL,
  `username` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `petition_sub`
--

INSERT INTO `petition_sub` (`id`, `petition_id`, `username`) VALUES
(37, 15, 'jenkajmenka'),
(38, 15, 'Maicl_GraB'),
(42, 17, 'Maicl_GraB'),
(43, 17, 'jenkajmenka'),
(44, 17, 'Spacerar'),
(45, 17, 'Siriti'),
(46, 17, 'Mykola_Hamster'),
(47, 16, 'Maicl_GraB'),
(48, 16, 'Siriti');

-- --------------------------------------------------------

--
-- Структура таблиці `post`
--

CREATE TABLE `post` (
  `post_id` int NOT NULL,
  `post_like` int DEFAULT '0',
  `post_date` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `post_from` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `post_text` varchar(5000) COLLATE utf8mb4_general_ci NOT NULL,
  `post_file` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `post`
--

INSERT INTO `post` (`post_id`, `post_like`, `post_date`, `post_from`, `post_text`, `post_file`) VALUES
(6, 0, '22:24 16.12.2023', 'Maicl_GraB', 'Привіт світ!', ''),
(8, 0, '00:16 17.12.2023', 'Mykola_Hamster', 'Моя перша публікація', '126934550_2841199342781311_7708419827655513375_n.jpg'),
(11, 0, '13:41 17.12.2023', 'Maicl_GraB', 'Роблю велике оновлення сайту та сподіваюсь встигнути до відкриття серверу UPD: сайт лайна, обрізав кота. Буду фіксити', 'car_prog.gif'),
(14, 0, '16:23 20.12.2023', 'Xenia', 'Я люблю Тома Кузова ', 'tomkruz_0001_4.jpg'),
(15, 0, '16:26 20.12.2023', 'Xenia', 'Что скажете?', '166128115613940459.jpg'),
(20, 0, '22:07 01.04.2024', 'Maicl_GraB', 'йоу', 'Снимок экрана 2023-10-28 113738.png'),
(22, 0, '22:18 01.04.2024', 'Maicl_GraB', 'йоу без Ксеничя', NULL),
(25, 0, '22:21 01.04.2024', 'Maicl_GraB', 'weferfg', 'designerskaa-ava.png');

-- --------------------------------------------------------

--
-- Структура таблиці `post_comm`
--

CREATE TABLE `post_comm` (
  `id` int NOT NULL,
  `post_id` int NOT NULL,
  `comm_from` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `comm_date` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `comm_text` varchar(500) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `trans`
--

CREATE TABLE `trans` (
  `trans_from` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `trans_to` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `card_from` int UNSIGNED NOT NULL,
  `card_to` int UNSIGNED NOT NULL,
  `trans_date` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `trans_sum` decimal(11,1) UNSIGNED NOT NULL,
  `trans_mess` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trans_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `trans`
--

INSERT INTO `trans` (`trans_from`, `trans_to`, `card_from`, `card_to`, `trans_date`, `trans_sum`, `trans_mess`, `trans_id`) VALUES
('Maicl_GraB', 'Xenia', 1001, 1771, '22:10 14.01.2024', '20.0', '', 15),
('Xenia', 'Maicl_GraB', 1771, 1001, '22:12 14.01.2024', '20.0', 'Вернула 💋', 16),
('Maicl_GraB', 'jenkajmenka', 7777, 2112, '22:16 14.01.2024', '200.0', 'За разработку', 17),
('Maicl_GraB', 'Mykola_Hamster', 7777, 7888, '22:39 14.01.2024', '150.4', '', 18),
('Spacerar', 'Maicl_GraB', 3810, 7777, '22:40 14.01.2024', '250.0', 'Инвестиция', 19),
('Maicl_GraB', 'Xenia', 1001, 1771, '22:43 14.01.2024', '50.0', '💋', 20),
('Xenia', 'Maicl_GraB', 1771, 1001, '22:46 14.01.2024', '45.0', '', 21),
('Maicl_GraB', 'Mykola_Hamster', 1001, 7888, '23:16 14.01.2024', '2.0', 'Тест', 22),
('Maicl_GraB', 'Xenia', 1001, 1771, '14:43 20.01.2024', '20.0', '❤️😍😘💖😼😻', 24),
('Maicl_GraB', 'Xenia', 1001, 1771, '00:43 21.01.2024', '0.1', 'Оплата штрафу #1', 34),
('Maicl_GraB', 'Mykola_Hamster', 1001, 7888, '00:43 21.01.2024', '10.0', '', 35),
('Maicl_GraB', 'Mykola_Hamster', 7777, 7888, '00:58 21.01.2024', '10.0', 'Оплата штрафу #2', 36),
('Maicl_GraB', 'Xenia', 1001, 1771, '00:58 21.01.2024', '0.1', 'Оплата штрафу #1', 37),
('Maicl_GraB', 'Xenia', 7777, 1771, '11:15 02.02.2024', '0.1', 'Оплата штрафу #1', 38),
('Maicl_GraB', 'Spacerar', 1001, 3810, '11:23 27.02.2024', '0.2', 'Премия', 39),
('Mykola_Hamster', 'Maicl_GraB', 7888, 1001, '22:53 31.03.2024', '12.0', '', 40);

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(32) COLLATE utf8mb4_general_ci DEFAULT 'user',
  `ava` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'ava_user.png',
  `back` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'back_user.png',
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `role`, `ava`, `back`, `description`) VALUES
(1, 'Maicl_GraB', '830817c55cc4eb838efcfbb36c7df3b1', 'admin', 'designerskaa-ava.png', 'photo_2023-10-15_20-58-07.jpg', 'Розробник сайту, адміністратор діскорду'),
(2, 'Xenia', '830817c55cc4eb838efcfbb36c7df3b1', 'moder', 'Снимок экрана 2023-10-28 113738.png', 'car_prog.gif', 'Де бісова кроляча лапка?!'),
(3, 'jenkajmenka', '830817c55cc4eb838efcfbb36c7df3b1', 'bank', 'санитар с кольцами.png', 'іді_нахуй.jpg', 'Евген'),
(4, 'Mykola_Hamster', '830817c55cc4eb838efcfbb36c7df3b1', 'admin', 'гейс.png', 'порох.png', 'Пенсил'),
(5, 'Siriti', '830817c55cc4eb838efcfbb36c7df3b1', 'user', 'ava_user.png', 'back_user.png', 'Люблю Кирилла'),
(6, 'Spacerar', '830817c55cc4eb838efcfbb36c7df3b1', 'bank', '242659527_382863729972513_1296781080050760736_n.jpg', 'GXCGd3eN3oA.jpg', 'Люблю Саню'),
(7, 'Пітухбанк', '830817c55cc4eb838efcfbb36c7df3b1', 'user', 'питухбанк.png', 'банк.png', 'Найкращий банк серверу');

-- --------------------------------------------------------

--
-- Структура таблиці `user_link`
--

CREATE TABLE `user_link` (
  `id` int NOT NULL,
  `login` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `link_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link_url` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `user_link`
--

INSERT INTO `user_link` (`id`, `login`, `link_name`, `link_url`) VALUES
(26, 'Maicl_GraB', 'ссылка', 'https://meet.google.com/jrz-zaqj-rnz?authuser=1'),
(28, 'Maicl_GraB', 'инст', 'https://www.instagram.com/maicl___/'),
(29, 'Siriti', 'ссылка', 'https://www.instagram.com/maicl___/');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`);

--
-- Індекси таблиці `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`penalt_id`);

--
-- Індекси таблиці `petition`
--
ALTER TABLE `petition`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `petition_sub`
--
ALTER TABLE `petition_sub`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Індекси таблиці `post_comm`
--
ALTER TABLE `post_comm`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `trans`
--
ALTER TABLE `trans`
  ADD PRIMARY KEY (`trans_id`);

--
-- Індекси таблиці `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id` (`id`);

--
-- Індекси таблиці `user_link`
--
ALTER TABLE `user_link`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT для таблиці `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблиці `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT для таблиці `penalty`
--
ALTER TABLE `penalty`
  MODIFY `penalt_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблиці `petition`
--
ALTER TABLE `petition`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблиці `petition_sub`
--
ALTER TABLE `petition_sub`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблиці `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблиці `post_comm`
--
ALTER TABLE `post_comm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `trans`
--
ALTER TABLE `trans`
  MODIFY `trans_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблиці `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблиці `user_link`
--
ALTER TABLE `user_link`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
