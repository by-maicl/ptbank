-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: sql108.infinityfree.com
-- Час створення: Гру 23 2023 р., 03:38
-- Версія сервера: 10.4.17-MariaDB
-- Версія PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `epiz_34211839_pityhsk`
--

-- --------------------------------------------------------

--
-- Структура таблиці `card`
--

CREATE TABLE `card` (
  `card_id` int(11) NOT NULL,
  `card_name` text NOT NULL,
  `card_user` varchar(20) DEFAULT NULL,
  `card_number` int(4) DEFAULT NULL,
  `card_balance` decimal(11,1) UNSIGNED DEFAULT 0.0,
  `card_design` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `card`
--

INSERT INTO `card` (`card_id`, `card_name`, `card_user`, `card_number`, `card_balance`, `card_design`) VALUES
(1, '1612', 'wrakety31', 2073, '0.0', 'des_purple.svg'),
(2, '4376', 'Spacerar', 2747, '0.8', 'des_green.svg'),
(3, 'MonoBank kid', 'Maicl_GraB', 5013, '16.6', 'des_green.svg'),
(4, 'Ð—Ð°Ñ€Ð¿Ð»Ð°Ñ‚Ð° Ñ‚ÐµÑ…Ð½Ñ–Ñ‡Ð½Ð¾Ñ— Ð¿Ñ–Ð´Ñ‚Ñ€Ð¸Ð¼ÐºÐ¸', 'Mykola_Hamster', 8297, '2.2', 'des_green.svg'),
(7, 'Ð¿ÐµÐ½Ð¸Ñ', 'mewoka', 7612, '0.0', 'des_orange.svg'),
(8, 'Privat', 'Xenia', 9194, '0.0', 'des_purple.svg'),
(9, 'Jenkajmenka228', 'jenkajmenka228', 8305, '4.4', 'des_green.svg'),
(11, 'PityhBank', 'PityhBank', 5282, '0.0', 'des_green.svg'),
(12, 'Ñ‚Ð° Ð¿Ð¾Ñ…ÑƒÐ¹ ÐºÐ°Ðº', 'Pepsi', 3464, '0.0', 'des_purple.svg'),
(14, 'Ð‘Ñ–Ð·Ð½ÐµÑ Ñ€Ð°Ñ…ÑƒÐ½Ð¾Ðº Jenkajmenka228', 'jenkajmenka228', 3301, '0.0', 'des_purple.svg');

-- --------------------------------------------------------

--
-- Структура таблиці `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `object_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `likes_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `likes`
--

INSERT INTO `likes` (`id`, `object_id`, `username`, `likes_count`) VALUES
(3, 24, 'Xenia', 1),
(4, 17, 'Xenia', 1),
(6, 16, 'Xenia', 1),
(8, 19, 'Xenia', 1),
(11, 1, 'Xenia', 1),
(12, 9, 'Xenia', 1),
(16, 13, 'Xenia', 1),
(18, 24, 'Maicl_GraB', 1),
(22, 29, 'Xenia', 1),
(25, 29, 'Mykola_Hamster', 1),
(27, 31, 'Spacerar', 1),
(28, 31, 'Xenia', 1),
(30, 31, 'Maicl_GraB', 1),
(31, 33, 'Maicl_GraB', 1),
(32, 1, 'Maicl_GraB', 1),
(33, 33, 'Xenia', 1),
(35, 29, 'Maicl_GraB', 1),
(36, 33, 'jenkajmenka228', 1),
(37, 28, 'Xenia', 1),
(38, 33, 'Mykola_Hamster', 1),
(39, 33, 'Spacerar', 1),
(40, 34, 'Maicl_GraB', 1),
(41, 34, 'Mykola_Hamster', 1),
(42, 34, 'Spacerar', 1),
(43, 34, 'Pepsi', 1),
(44, 34, 'Xenia', 1),
(45, 35, 'Maicl_GraB', 1),
(46, 35, 'Mykola_Hamster', 1),
(47, 17, 'Maicl_GraB', 1),
(48, 28, 'Maicl_GraB', 1),
(49, 35, 'Xenia', 1),
(50, 35, 'Spacerar', 1),
(51, 36, 'jenkajmenka228', 1),
(52, 36, 'Mykola_Hamster', 1),
(54, 36, 'Spacerar', 1),
(59, 12, 'Spacerar', 1),
(60, 36, 'Maicl_GraB', 1),
(61, 37, 'Maicl_GraB', 1),
(62, 37, 'Mykola_Hamster', 1),
(63, 38, 'Maicl_GraB', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `object_id2` int(11) DEFAULT NULL,
  `user_from` varchar(250) DEFAULT NULL,
  `user_to` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `type` varchar(250) NOT NULL,
  `text` varchar(500) DEFAULT NULL,
  `date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `notification`
--

INSERT INTO `notification` (`id`, `object_id`, `object_id2`, `user_from`, `user_to`, `status`, `type`, `text`, `date`) VALUES
(1, 35, NULL, 'Mykola_Hamster', 'Maicl_GraB', 0, 'like', NULL, '21:12 08.09.2023'),
(2, 17, NULL, 'Maicl_GraB', 'Mykola_Hamster', 0, 'like', NULL, '21:21 08.09.2023'),
(3, 28, NULL, 'Maicl_GraB', 'Xenia', 0, 'like', NULL, '21:22 08.09.2023'),
(4, 35, NULL, 'Xenia', 'Maicl_GraB', 0, 'like', NULL, '21:35 08.09.2023'),
(5, 35, 18, 'Xenia', 'Maicl_GraB', 0, 'comm', 'Ð£Ñ€Ð°, Ð¼ÐµÐ³Ð° Ð¾Ð±Ð½Ð¾Ð²Ð° !!!', '21:36 08.09.2023'),
(6, 35, NULL, 'Spacerar', 'Maicl_GraB', 0, 'like', NULL, '21:56 08.09.2023'),
(7, 1, NULL, NULL, 'Maicl_GraB', 0, 'petition', NULL, '18:08 12.09.2023'),
(8, 1, NULL, NULL, 'Mykola_Hamster', 0, 'petition', NULL, '18:08 12.09.2023'),
(9, 1, NULL, NULL, 'Spacerar', 0, 'petition', NULL, '18:08 12.09.2023'),
(10, 1, NULL, NULL, 'jenkajmenka228', 0, 'petition', NULL, '18:08 12.09.2023'),
(11, 1, NULL, NULL, 'r1boulade', 1, 'petition', NULL, '18:08 12.09.2023'),
(12, 1, NULL, NULL, 'Maicl_GraB', 0, 'petition', NULL, '18:08 12.09.2023'),
(13, 1, NULL, NULL, 'Mykola_Hamster', 0, 'petition', NULL, '18:08 12.09.2023'),
(14, 1, NULL, NULL, 'Spacerar', 0, 'petition', NULL, '18:08 12.09.2023'),
(15, 1, NULL, NULL, 'jenkajmenka228', 0, 'petition', NULL, '18:08 12.09.2023'),
(16, 1, NULL, NULL, 'r1boulade', 1, 'petition', NULL, '18:08 12.09.2023'),
(19, 36, 19, 'Maicl_GraB', 'jenkajmenka228', 0, 'comm', 'ÐÐµÐ´ÑƒÑ€Ð½Ð¾', '15:00 13.09.2023'),
(25, 12, NULL, 'Spacerar', 'Mykola_Hamster', 0, 'like', NULL, '16:00 20.09.2023'),
(26, 36, NULL, 'Maicl_GraB', 'jenkajmenka228', 0, 'like', NULL, '22:13 20.09.2023'),
(27, 3, NULL, NULL, 'jenkajmenka228', 1, 'petition', NULL, '22:55 16.10.2023'),
(28, 3, NULL, NULL, 'Mykola_Hamster', 0, 'petition', NULL, '22:55 16.10.2023'),
(29, 3, NULL, NULL, 'Maicl_GraB', 0, 'petition', NULL, '22:55 16.10.2023'),
(30, 3, NULL, NULL, 'Spacerar', 0, 'petition', NULL, '22:55 16.10.2023'),
(31, 3, NULL, NULL, 'Xenia', 0, 'petition', NULL, '22:55 16.10.2023'),
(32, 3, NULL, NULL, 'jenkajmenka228', 1, 'petition', NULL, '22:55 16.10.2023'),
(33, 3, NULL, NULL, 'Mykola_Hamster', 0, 'petition', NULL, '22:55 16.10.2023'),
(34, 3, NULL, NULL, 'Maicl_GraB', 0, 'petition', NULL, '22:55 16.10.2023'),
(35, 3, NULL, NULL, 'Spacerar', 0, 'petition', NULL, '22:55 16.10.2023'),
(36, 3, NULL, NULL, 'Xenia', 0, 'petition', NULL, '22:55 16.10.2023'),
(37, 37, 20, 'Mykola_Hamster', 'Maicl_GraB', 0, 'comm', 'For real? ÐŸÑ€ÑÐ¼ Ñ€Ð¸Ð»? Ð¿Ð¾ Ð¿Ñ€Ð°Ð²Ð´Ðµ? ÑƒÐ²ÐµÑ€ÐµÐ½? Ð½Ðµ Ð´Ð¸Ð·Ð¸Ð½Ñ„Ð°? ', '14:43 18.10.2023'),
(38, 37, NULL, 'Mykola_Hamster', 'Maicl_GraB', 0, 'like', NULL, '18:46 18.10.2023'),
(39, 38, 21, 'Maicl_GraB', 'Mykola_Hamster', 0, 'comm', 'Ð´ÐµÐ½ÑŒÐ³Ð¸ Ñ€Ð°Ð·Ð²Ð¾Ñ€Ð¾Ð²Ð°Ð»Ð¸, ÐºÐ°Ðº Ð²ÑÐµÐ³Ð´Ð° (Ð¾Ñ‚Ð²ÐµÑ‚Ñ‹ Ð½Ð° ÐºÐ¾Ð¼Ð¼ÐµÐ½Ñ‚Ñ‹ Ð½Ðµ Ñ€Ð°Ð±Ð¾Ñ‚Ð°ÑŽÑ‚)', '21:01 27.11.2023'),
(40, 38, NULL, 'Maicl_GraB', 'Mykola_Hamster', 0, 'like', NULL, '21:01 27.11.2023');

-- --------------------------------------------------------

--
-- Структура таблиці `penalty`
--

CREATE TABLE `penalty` (
  `penalt_id` int(11) NOT NULL,
  `penalt_status` int(1) NOT NULL DEFAULT 1,
  `penalt_from` varchar(100) NOT NULL,
  `penalt_cardFrom` int(4) UNSIGNED NOT NULL,
  `penalt_to` varchar(100) NOT NULL,
  `penalt_sum` int(32) NOT NULL,
  `penalt_text` varchar(250) NOT NULL,
  `penalt_date` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблиці `petition`
--

CREATE TABLE `petition` (
  `id` int(11) NOT NULL,
  `header` varchar(100) NOT NULL,
  `text` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `file` varchar(250) NOT NULL,
  `subscribe` int(11) NOT NULL DEFAULT 0,
  `date` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `support` varchar(32) DEFAULT NULL,
  `answer` varchar(1000) DEFAULT NULL,
  `answer_from` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `petition`
--

INSERT INTO `petition` (`id`, `header`, `text`, `file`, `subscribe`, `date`, `username`, `status`, `support`, `answer`, `answer_from`) VALUES
(1, 'ÐÐ°Ð·Ð²Ð°Ñ‚ÑŒ Ð² Ñ‡ÐµÑÑ‚ÑŒ Ð•Ð³Ð¾Ñ€Ð° Ñ‡Ñ‚Ð¾-Ñ‚Ð¾ Ð² Ð¨Ð¸Ð·Ð°-ÑÐ¸Ñ‚Ð¸', 'Ð¯ Ð¿Ñ€ÐµÐ´Ð»Ð°Ð³Ð°ÑŽ Ð½Ð°Ð·Ð²Ð°Ñ‚ÑŒ Ð² Ñ‡ÐµÑÑ‚ÑŒ Ð•Ð³Ð¾Ñ€Ð° (Ð¾Ð½ Ð¶Ðµ Ð“ÑƒÐ´Ð±Ð¾Ð¹_Ð´Ðº) Ñ†ÐµÐ½Ñ‚Ñ€Ð°Ð»ÑŒÐ½ÑƒÑŽ ÑƒÐ»Ð¸Ñ†Ñƒ Ð¨Ð¸Ð·Ð°-ÑÐ¸Ñ‚Ð¸, Ð¸Ð»Ð¸ Ð»ÑŽÐ±ÑƒÑŽ Ð´Ñ€ÑƒÐ³ÑƒÑŽ. Ð­Ñ‚Ð¾ Ð¾Ñ‡ÐµÐ½ÑŒ Ð²Ð°Ð¶Ð½Ð¾, Ñ‚Ð°Ðº ÐºÐ°Ðº Ð•Ð³Ð¾Ñ€ - Ð»ÐµÐ³ÐµÐ½Ð´Ð° ÑÐµÑ€Ð²ÐµÑ€Ð° Ð¸ Ð¼Ñ‹ Ð´Ð¾Ð»Ð¶Ð½Ñ‹ Ð½Ðµ Ð·Ð°Ð±Ñ‹Ð²Ð°Ñ‚ÑŒ Ð¾Ð± ÑÑ‚Ð¾Ð¼!', '242659527_382863729972513_1296781080050760736_n.jpg', 5, '23:55 15.08.2023', 'Maicl_GraB', 0, 'true', 'Ð’ Ñ‡ÐµÑÑ‚ÑŒ Ð•Ð³Ð¾Ñ€Ð° Ð±ÑƒÐ´Ðµ Ð½Ð°Ð·Ð²Ð°Ð½Ð¾ Ð²ÑƒÐ»Ð¸Ñ†ÑŽ, Ñ‰Ð¾ Ð¿Ñ€Ð¾Ñ…Ð¾Ð´Ð¸Ñ‚ÑŒ Ð²Ñ–Ð´ ÐŸÑ€Ð¾Ð¼. Ð·Ð¾Ð½Ð¸ Ð´Ð¾ Ð¡Ñ‚Ð°Ñ€Ð¾Ð´Ð°Ð²Ð½ÑŒÐ¾-Ð£ÐºÑ€Ñ–Ð²ÑÑŒÐºÐ¾Ð³Ð¾ Ñ€Ð°Ð¹Ð¾Ð½Ñƒ.\r\nÐÐ°Ð·Ð²Ð° Ð±ÑƒÐ´Ðµ Ð·Ð²ÑƒÑ‡Ð°Ñ‚Ð¸ Ñ‚Ð°Ðº: Ð¿Ñ€Ð¾ÑÐ¿ÐµÐºÑ‚ Ñ–Ð¼ÐµÐ½Ñ– Ð“ÑƒÐ´Ð±Ð¾Ñ.', 'Maicl_GraB'),
(2, 'ÐÐ»ÑŒÑ‚ÐµÑ€Ð½Ð°Ñ‚Ð¸Ð²Ð° Ð¼Ð¾Ñ€ÑŽ', 'ÐŸÑ€ÐµÐ´Ð»Ð°Ð³Ð°ÑŽ Ð¿Ñ€Ð¾Ð²ÐµÑÑ‚Ð¸ Ñ€ÐµÐ»ÑŒÑÑ‹ Ð¿Ð¾ ÑÐ°Ð¼Ð¾Ð¼Ñƒ ÐºÐ¾Ñ€Ð¾Ñ‚ÐºÐ¾Ð¼Ñƒ Ð¿ÑƒÑ‚Ð¸ (ÐºÑ€Ð°ÑÐ½Ð°Ñ Ð»Ð¸Ð½Ð¸Ñ) Ð²Ð¼ÐµÑÑ‚Ð¾ Ð¿Ð¾ÑÑ‚Ñ€Ð¾Ð¹ÐºÐ¸ Ð½ÐµÐ²ÐµÑ€Ð¾ÑÑ‚Ð½Ð¾ Ð´Ð»Ð¸Ð½Ð½Ð¾Ð³Ð¾ Ð¼Ð¾ÑÑ‚Ð° Ñ‡ÐµÑ€ÐµÐ· Ð¼Ð¾Ñ€Ðµ Ð¸ Ð½ÐµÐ¾Ð¿Ñ€Ð°Ð²Ð´Ð°Ð½Ð½Ð¾ Ð´Ð¾Ð»Ð³Ð¾Ð¹ Ð¿Ð¾ÑÑ‚Ñ€Ð¾Ð¹ÐºÐ¸ ÐºÐ¾Ñ€Ð°Ð±Ð»Ñ', '2023-09-08_16.30.16.png', 4, '16:41 08.09.2023', 'jenkajmenka228', 1, NULL, NULL, NULL),
(3, 'Ðš Ð±Ð°Ð±ÑƒÑˆÐºÐµ Ð² ÑÐµÐ»Ð¾', 'ÐŸÑ€ÐµÐ´Ð»Ð°Ð³Ð°ÑŽ Ð¿ÑƒÑÑ‚Ð¸Ñ‚ÑŒ Ð¿Ð¾ÐµÐ·Ð´ Ð² \"ÐÐ¾Ð²Ð¾-ÐšÐ¸Ñ€Ð¸Ð»Ð»Ð¾Ð²ÑÐºÑƒÑŽ Ð¾Ð±Ð»Ð°ÑÑŒÐ±\" \"ÑÐµÐ»Ð¾ Ð§ÐµÑ€ÐºÐ°ÑˆÐ¸\". Ð¢Ð°Ð¼ Ð¿Ð»Ð°Ð½Ð¸Ñ€ÑƒÐµÑ‚ÑÑ Ð³Ð»Ð¾Ð±Ð°Ð»ÑŒÐ½Ð°Ñ ÑÑ‚Ñ€Ð¾Ð¹ÐºÐ° Ñ‚Ñ€ÑƒÑˆÐ½Ð¾Ð³Ð¾ Ñ…Ð¾Ñ…Ð»ÑÐ½ÑÐºÐ¾Ð³Ð¾ ÑÐµÐ»Ð° Ð´Ðµ ÐµÑÑ‚ÑŒ: ÑÐ²Ð¸Ð½ÑŒÐ¸, Ð¿ÑˆÐµÐ½Ð¸Ñ†Ð°, ÐºÐ°Ñ€Ñ‚Ð¾ÑˆÐºÐ°, ÑÐ°Ð¼Ð¾Ð³Ð¾Ð½ÐºÐ°. ÐŸÐ¾ Ð¾ÐºÐ¾Ð½Ñ‡Ð°Ð½Ð¸ÑŽ ÑÑ‚Ñ€Ð¾Ð¸Ñ‚ÐµÐ»ÑŒÐ½Ñ‹Ñ… Ñ€Ð°Ð±Ð¾Ñ‚ ÑÐ¶Ð¸Ð³Ð°ÑŽ Ð¾Ð³Ñ€Ð¾Ð¼Ð½Ð¾Ðµ ÑÐ¾Ð»Ð¾Ð¼ÐµÐ½Ð½Ð¾Ðµ Ñ‡ÑƒÑ‡ÐµÐ»Ð¾ ÑÐ²Ð¸Ð½ÑŒÐ¸ ', 'images (2).jpg', 5, '22:10 12.09.2023', 'jenkajmenka228', 0, 'true', 'Ð˜Ð´ÐµÑ ÑÑƒÐ¿ÐµÑ€, Ð¿Ð¾Ñ‡Ñ‚Ð¸ Ð¿Ñ€Ð¾Ð²ÐµÐ»Ð¸ ÑƒÐ¶Ðµ Ð¿Ð¾ÐºÐ° Ð¿ÐµÑ‚Ð¸Ñ†Ð¸Ñ Ð½Ð°Ð±Ð¸Ñ€Ð°Ð»Ð° Ð³Ð¾Ð»Ð¾ÑÐ°. ÐŸÑ€Ð¸ Ð·Ð°Ð¿ÑƒÑÐºÐµ ÑÐµÑ€Ð²ÐµÑ€Ð° Ð¶Ð´Ñƒ ÑÐ¶Ð¸Ð³Ð°Ð½Ð¸Ðµ Ñ‡ÑƒÑ‡ÐµÐ»Ð° ÑÐ²Ð¸Ð½ÑŒÐ¸', 'Maicl_GraB');

-- --------------------------------------------------------

--
-- Структура таблиці `petition_sub`
--

CREATE TABLE `petition_sub` (
  `id` int(11) NOT NULL,
  `petition_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `petition_sub`
--

INSERT INTO `petition_sub` (`id`, `petition_id`, `username`) VALUES
(1, 1, 'Maicl_GraB'),
(2, 1, 'Mykola_Hamster'),
(3, 1, 'Spacerar'),
(4, 1, 'jenkajmenka228'),
(5, 1, 'r1boulade'),
(6, 2, 'jenkajmenka228'),
(7, 3, 'jenkajmenka228'),
(8, 3, 'Mykola_Hamster'),
(9, 2, 'Mykola_Hamster'),
(10, 3, 'Maicl_GraB'),
(11, 3, 'Spacerar'),
(12, 2, 'Spacerar'),
(13, 3, 'Xenia'),
(14, 2, 'Maicl_GraB');

-- --------------------------------------------------------

--
-- Структура таблиці `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `post_like` int(11) DEFAULT 0,
  `post_date` varchar(32) NOT NULL,
  `post_from` varchar(20) NOT NULL,
  `post_text` varchar(5000) NOT NULL,
  `post_file` varchar(250) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `post`
--

INSERT INTO `post` (`post_id`, `post_like`, `post_date`, `post_from`, `post_text`, `post_file`) VALUES
(1, 0, '16:39 15.05.2023', 'Maicl_GraB', 'ÐŸÑ€Ð¸Ð²Ñ–Ñ‚ ÑÐ²Ñ–Ñ‚! Ð›Ð°ÑÐºÐ°Ð²Ð¾ Ð¿Ñ€Ð¾ÑÐ¸Ð¼Ð¾ Ð½Ð° Ð¾Ð½Ð»Ð°Ð¹Ð½ Ð¿Ð¾Ñ€Ñ‚Ð°Ð».\r\n\r\nÐ¯ÐºÑ‰Ð¾ Ð²Ð¸ Ð·Ð½Ð°Ð¹Ð´ÐµÑ‚Ðµ ÑÐºÑ–ÑÑŒ Ð¿Ð¾Ð¼Ð¸Ð»ÐºÐ¸, Ñ‚Ð¾ Ð¿Ð¸ÑˆÑ–Ñ‚ÑŒ Ñ—Ñ… Ð½Ð° Ñ„Ð¾Ñ€ÑƒÐ¼ Ð°Ð±Ð¾ ÑÑŽÐ´Ð¸ Ð² ÐºÐ¾Ð¼ÐµÐ½Ñ‚Ð°Ñ€Ñ–.', NULL),
(4, 0, '19:56 15.05.2023', 'Mykola_Hamster', '1.1 Ð·Ð°Ð²Ñ‚Ñ€Ð°. Ð¢Ð¾Ñ‡Ð½Ð¾ Ð½Ðµ Ñ€Ð¾Ð·Ð¿Ð¾Ð²ÑÑŽÐ´Ð¶ÑƒÑŽÑ‚ÑŒ Ð´ÐµÐ·Ñ–Ð½Ñ„Ð¾Ñ€Ð¼Ð°Ñ†Ñ–ÑŽ Ñƒ Ñ–Ð½Ñ‚ÐµÑ€Ð½ÐµÑ‚Ñ–.', ''),
(9, 0, '00:48 20.05.2023', 'Maicl_GraB', 'ÐžÐ½Ð¾Ð²Ð»ÐµÐ½Ð½Ñ ÑÐ°Ð¹Ñ‚Ñƒ 1.1:\r\n-Ð”Ð¾Ð´Ð°Ð½Ð° Ð²ÐºÐ»Ð°Ð´ÐºÐ° \"Ð“Ñ€Ð°Ð²Ñ†Ñ–\", Ð´Ðµ Ð¼Ð¾Ð¶Ð½Ð¾ Ð·Ð½Ð°Ð¹Ñ‚Ð¸ ÑÑ‚Ð¾Ñ€Ñ–Ð½ÐºÑƒ Ð±ÑƒÐ´ÑŒ-ÑÐºÐ¾Ð³Ð¾ Ð³Ñ€Ð°Ð²Ñ†Ñ;\r\n-Ð”Ð¾Ñ€Ð¾Ð±Ð»ÐµÐ½Ð° Ð²ÐºÐ»Ð°Ð´ÐºÐ° \"ÐœÐ¾Ñ ÑÑ‚Ð¾Ñ€Ñ–Ð½ÐºÐ°\". Ð¢ÐµÐ¿ÐµÑ€ÑŒ Ñ‚Ð°Ð¼ Ð²Ñ–Ð´Ð¾Ð±Ñ€Ð°Ð¶Ð°ÑŽÑ‚ÑŒÑÑ Ð²Ð°ÑˆÑ– Ð¿Ð¾ÑÑ‚Ð¸;', ''),
(11, 0, '02:09 25.05.2023', 'Mykola_Hamster', 'ðŸ¤¨', 'amongus.png'),
(12, 0, '18:24 29.05.2023', 'Mykola_Hamster', 'ÐÑƒ Ð²ÐµÑÑŒ ÑÐ°Ð¹Ñ‚ Ð¼Ð¾Ð¹ Ð»Ð¸Ñ‡Ð½Ñ‹Ð¹ Ð±Ð»Ð¾Ð³. ÐŸÐ¾ÐºÐ° Ñ‡Ñ‚Ð¾', 'cat-brain-cat.gif'),
(16, 0, '10:11 04.06.2023', 'Maicl_GraB', 'Ð¢Ð¸Ñ…Ð¸Ð¹ Ð¼Ð°Ð»ÐµÐ½ÑŒÐºÐ¸Ð¹ Ð³Ð¾Ñ€Ð¾Ð´...', '2023-06-03_14.18.31.png'),
(17, 0, '22:24 14.06.2023', 'Mykola_Hamster', 'ÐšÐ°Ð¿ÐµÑ†, ÑƒÐ¶Ðµ 4 Ð³Ð¾Ð´Ð° ÑÐµÑ€Ð²ÐµÑ€Ñƒ. ÐÑƒ Ð·Ð°ÐºÑ€Ñ‹Ð²Ð°Ñ‚ÑŒÑÑ Ð¿Ð»Ð°Ð½Ð¾Ð² Ð½ÐµÑ‚, Ð·Ð½Ð°Ñ‡Ð¸Ñ‚ Ð±ÑƒÐ´ÐµÑ‚ Ð²ÑÐµ 5. ', '4.png'),
(24, 0, '12:10 04.08.2023', 'Maicl_GraB', 'ÐžÐ½Ð¾Ð²Ð»ÐµÐ½Ð½Ñ ÑÐ°Ð¹Ñ‚Ñƒ 1.2: \r\nâ€¢ Ð¡Ð°Ð¹Ñ‚ Ð¿Ð¾Ð²Ð½Ñ–ÑÑ‚ÑŽ Ð°Ð´Ð°Ð¿Ñ‚Ð¾Ð²Ð°Ð½Ð¾ Ð¿Ñ–Ð´ Ñ‚ÐµÐ»Ñ„Ð¾Ð½;\r\nâ€¢ Ð—Ð¼Ñ–Ð½ÐµÐ½Ð¾ Ð»Ð¾Ð³Ð¾ ÑÐµÑ€Ð²ÐµÑ€Ñƒ;\r\nâ€¢ Ð—Ñ€Ð¾Ð±Ð»ÐµÐ½Ð¾ ÑˆÐ¸Ñ€ÑˆÐµ Ð¿Ð¾ÑÑ‚Ð¸ Ð½Ð° Ð³Ð¾Ð»Ð¾Ð²Ð½Ñ–Ð¹;\r\nâ€¢ Ð’Ð¸Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¾ Ð½ÐµÐ·Ð½Ð°Ñ‡Ð½Ñ– Ð±Ð°Ð³Ð¸;\r\n\r\nÐ¦ÐµÐ¹ Ð¿Ð¾ÑÑ‚ Ð±ÑƒÐ² Ð½Ð°Ð¿Ð¸ÑÐ°Ð½Ð¸Ð¹ Ð· Ñ‚ÐµÐ»ÐµÑ„Ð¾Ð½Ñƒ. Ð¯ÐºÑ‰Ð¾ Ð²Ð¸ Ð·Ð½Ð°Ð¹Ð´ÐµÑ‚Ðµ Ð±Ð°Ð³Ð¸, Ñ‚Ð¾ Ð¿Ð¸ÑˆÑ–Ñ‚ÑŒ Ñ—Ñ… Ð½Ð° Ñ„Ð¾Ñ€ÑƒÐ¼', 'e5f6925c044c4401.gif'),
(28, 0, '21:17 08.08.2023', 'Xenia', 'ÐœÐ¸ÑˆÐ° Ð¼Ð¾ÐºÑ€Ñ‹Ð¹ ', '20230808_201430.jpg'),
(29, 0, '16:36 15.08.2023', 'Maicl_GraB', 'Ð’ÐµÐ»Ð¸ÐºÐµ Ð¾Ð½Ð¾Ð²Ð»ÐµÐ½Ð½Ñ ÑÐ°Ð¹Ñ‚Ñƒ 1.3\r\nÐ¡Ð¿Ð¸ÑÐ¾Ðº Ð·Ð¼Ñ–Ð½:\r\nâ€¢ Ð”Ð¾Ð´Ð°Ð½Ð° Ð½Ð¾Ð²Ð° Ð²ÐºÐ»Ð°Ð´ÐºÐ° \"ÐŸÐµÑ‚Ð¸Ñ†Ñ–Ñ—\";\r\nâ€¢ Ð—Ð¼Ñ–Ð½ÐµÐ½Ð¾ Ñ€Ð¾Ð·Ð¼Ñ–Ñ€ Ð·Ð¾Ð±Ñ€Ð°Ð¶ÐµÐ½ÑŒ Ð½Ð° Ð³Ð¾Ð»Ð¾Ð²Ð½Ñ–Ð¹;\r\nâ€¢ ÐšÐ½Ð¾Ð¿ÐºÐ° \"ÐŸÐ°Ð½ÐµÐ»ÑŒ\" (Ð´Ð»Ñ Ð°Ð´Ð¼Ñ–Ð½Ñ–ÑÑ‚Ñ€Ð°Ñ‚Ð¾Ñ€Ñ–Ð²) Ð² Ð¼Ð¾Ð±Ñ–Ð»ÑŒÐ½Ñ–Ð¹ Ð²ÐµÑ€ÑÑ–Ñ— Ð¿ÐµÑ€ÐµÐ¼Ñ–Ñ‰ÐµÐ½Ð° Ð½Ð° \"ÐœÐ¾ÑŽ ÑÑ‚Ð¾Ñ€Ñ–Ð½ÐºÑƒ\";\r\nâ€¢ Ð—Ð¼Ñ–Ð½ÐµÐ½Ð¾ Ñ€Ð¾Ð·Ð¼Ñ–Ñ€ ÐºÐ½Ð¾Ð¿Ð¾Ðº Ð½Ð° \"ÐœÐ¾Ñ—Ð¹ ÑÑ‚Ð¾Ñ€Ñ–Ð½Ñ†Ñ–\" Ñ‚Ð° \"Ð‘Ð°Ð½Ðº\";\r\nâ€¢ Ð¤Ñ–ÐºÑ Ð´ÐµÑ„Ð¾Ñ€Ð¼Ð°Ñ†Ñ–Ñ— Ð·Ð¾Ð±Ñ€Ð°Ð¶ÐµÐ½ÑŒ Ñ‚Ð° Ð°Ð²Ð°Ñ‚Ð°Ñ€Ð¾Ðº;\r\nâ€¢ Ð ÐµÐ´Ð¸Ð·Ð°Ð¹Ð½ Ñ‚Ñ€Ð°Ð½Ð·Ð°ÐºÑ†Ñ–Ð¹ Ð±Ð°Ð½ÐºÑƒ;\r\nâ€¢ Ð ÐµÐ´Ð¸Ð·Ð°Ð¹Ð½ ÑˆÑ‚Ñ€Ð°Ñ„Ñ–Ð²;\r\nâ€¢ Ð¤Ñ–ÐºÑ ÐºÑƒÐ¿Ð¸ Ð·Ð½Ð°Ñ‡Ð½Ð¸Ñ…, Ð°Ð»Ðµ Ð½ÐµÐ¿Ð¾Ð¼Ñ–Ñ‚Ð½Ð¸Ñ… Ð±Ð°Ð³Ñ–Ð²;\r\n\r\nÐ† Ð½Ð°Ð¾ÑÑ‚Ð°Ð½Ð¾Ðº, Ð»Ð°Ð¹ÐºÐ¸ Ñ‚ÐµÐ¿ÐµÑ€ Ð¿Ñ€Ð°Ñ†ÑŽÑŽÑ‚ÑŒ!', 'photo_2023-08-15_16-36-15.jpg'),
(31, 0, '01:10 16.08.2023', 'Mykola_Hamster', 'â˜¢ï¸â¤ï¸', 'nuclear_love.gif'),
(33, 0, '11:38 18.08.2023', 'Maicl_GraB', 'ÐÐ´Ð¼Ð¸Ð½ ÑÐµÑ€Ð²ÐµÑ€Ð° Ð¿Ð¾Ð²ÐµÑÐ¸Ð»ÑÑ Ð² Ð¿Ð¾Ñ€Ñ‚Ñƒ.\r\nÐÐ¾Ð²Ñ‹Ð¹ Ð°Ð´Ð¼Ð¸Ð½ - Ð²Ñ€Ð°ÐºÐµÑ‚Ð¸, Ð¿Ð¾Ð·Ð´Ñ€Ð°Ð²Ð¸Ð¼!', 'Screenshot_2.png'),
(34, 0, '02:44 26.08.2023', 'Maicl_GraB', 'Ð›ÑŽÐ±Ð»ÑŽ ÐºÐ¾Ð¿Ð°Ñ‚ÑŒ Ð¸Ñ€Ð¾Ð»Ð¸Ñ‚Ñ‹, ÐºÐ¾Ð³Ð´Ð° Ð·Ð° Ñ‚Ð¾Ð±Ð¾Ð¹ Ð³Ð¾Ð½ÑÐµÑ‚ÑÑ 5 Ð¼Ð¸Ð¼Ð¾Ð², 2 ÑÐºÐ¾Ð»Ð¾Ð¿ÐµÐ½Ð´Ñ€Ñ‹, 7 ÐºÑ€Ð¸Ð¿ÐµÑ€Ð¾Ð², 4 ÑÐºÐµÐ»ÐµÑ‚Ð°. ÐŸÐ»ÑŽÑ Ð³ÐµÐ½ÐµÑ€Ð°Ñ†Ð¸Ñ ÐµÐ±Ð°Ð½ÑƒÑ‚Ð°Ñ (Ð½Ð¸Ñ‡ÐµÐ³Ð¾ Ð¿Ñ€Ð¾Ñ‚Ð¸Ð² Ð½Ðµ Ð¸Ð¼ÐµÑŽ)', 'IMG_20230826_024058_268.jpg'),
(35, 0, '21:04 08.09.2023', 'Maicl_GraB', 'ÐžÐ½Ð¾Ð²Ð»ÐµÐ½Ð½Ñ ÑÐ°Ð¹Ñ‚Ñƒ 1.4:\r\nâ€¢ Ð”Ð¾Ð´Ð°Ð½Ð¾ Ð¼Ð¾Ð¶Ð»Ð¸Ð²Ñ–ÑÑ‚ÑŒ Ð²Ñ–Ð´Ð¿Ð¾Ð²Ñ–ÑÑ‚Ð¸ Ð½Ð° Ð¿ÐµÑ‚Ð¸Ñ†Ñ–ÑŽ, Ñ‰Ð¾ Ð½Ð°Ð±Ñ€Ð°Ð»Ð° Ð½ÐµÐ¾Ð±Ñ…Ñ–Ð´Ð½Ñƒ ÐºÑ–Ð»ÑŒÐºÑ–ÑÑ‚ÑŒ Ð³Ð¾Ð»Ð¾ÑÑ–Ð² (Ð´Ð»Ñ Ð°Ð´Ð¼Ñ–Ð½Ñ–ÑÑ‚Ñ€Ð°Ñ‚Ð¾Ñ€Ñ–Ð² ÑÐ°Ð¹Ñ‚Ñƒ);\r\nâ€¢ Ð”Ð¾Ð´Ð°Ð½Ð¾ ÑÐ¿Ð¾Ð²Ñ–Ñ‰ÐµÐ½Ð½Ñ. Ð’Ð¾Ð½Ð¸ Ð±ÑƒÐ´ÑƒÑ‚ÑŒ Ð´Ð»Ñ: Ð»Ð°Ð¹ÐºÑ–Ð² Ñ‚Ð° ÐºÐ¾Ð¼ÐµÐ½Ñ‚Ð°Ñ€Ñ–Ð² Ð¿Ñ–Ð´ Ð²Ð°ÑˆÐ¸Ð¼Ð¸ Ð¿Ð¾ÑÑ‚Ð°Ð¼Ð¸, Ð½Ð¾Ð²Ð¸Ñ… ÑˆÑ‚Ñ€Ð°Ñ„Ñ–Ð², Ð¾Ð½Ð¾Ð²Ð»ÐµÐ½Ð½Ñ ÑÑ‚Ð°Ñ‚ÑƒÑÑƒ Ð¿ÐµÑ‚Ð¸Ñ†Ñ–Ð¹;\r\nâ€¢ ÐŸÐµÑ€ÐµÑ€Ð¾Ð±Ð»ÐµÐ½Ð¾ ÐºÐ¾Ð¼ÐµÐ½Ñ‚Ð°Ñ€Ñ– Ð¿Ñ–Ð´ Ð¿Ð¾ÑÑ‚Ð°Ð¼Ð¸;\r\nâ€¢ Ð—Ð¼Ñ–Ð½ÐµÐ½Ð¾ Ñ„Ð¾Ñ€Ð¼Ñƒ Ð°Ð²Ñ‚Ð¾Ñ€Ð¸Ð·Ð°Ñ†Ñ–Ñ— Ñ‚Ð° Ñ€ÐµÑ”ÑÑ‚Ñ€Ð°Ñ†Ñ–Ñ— Ñ‚Ð° Ð²Ð¸Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¾ Ð±Ð°Ð³Ð¸ Ð¿Ñ€Ð¸ Ñ€ÐµÑ”ÑÑ‚Ñ€Ð°Ñ†Ñ–Ñ—.\r\n\r\nP.S. Spacerar ÑÐ¿Ñ–Ð²Ñ‡ÑƒÐ²Ð°ÑŽ Ð· Ñ€Ð¾Ð·Ñ€Ð¾Ð±ÐºÐ¾ÑŽ Ð±Ð¾Ñ‚Ð° Ð´Ð»Ñ Ð´Ñ–ÑÐºÐ¾Ñ€Ð´Ñƒ', '2023-07-13_22.33.32.png'),
(36, 0, '22:15 12.09.2023', 'jenkajmenka228', 'Ð¿Ñ€Ð¾ÐµÐºÑ‚ Ñ…Ð°Ñ‚Ñ‹ Ð¼Ð°Ð·Ð°Ð½ÐºÐ¸ Ð´Ð»Ñ ÑÐµÐ»Ð° \"Ð§ÐµÑ€ÐºÐ°ÑˆÐ¸\"  \"ÐÐ¾Ð²Ð¾-ÐšÐ¸Ñ€Ð¸Ð»Ð»Ð¾Ð²ÑÐºÐ°Ñ \" Ð¾Ð±Ð»Ð°ÑÑ‚ÑŒ', '2023-09-12_21.55.43.png'),
(37, 0, '09:44 15.10.2023', 'Maicl_GraB', 'ÐÑ–Ñ‡Ð¾Ð³Ð¾ Ð½Ðµ Ð²Ñ–Ð´Ð±ÑƒÐ²Ð°Ñ”Ñ‚ÑŒÑÑ', ''),
(38, 0, '23:18 25.11.2023', 'Mykola_Hamster', 'Ð‘Ñ‹Ð» Ð»Ð¸ Ð±Ð¾Ñ‚ Ñ€ÐµÐ°Ð»ÑŒÐ½Ñ‹Ð¼ Ð¸Ð»Ð¸ Ð²Ñ‹Ð´ÑƒÐ¼ÐºÐ¾Ð¹ Ð²ÑÐµÐ²Ñ‹ÑˆÐ½Ð¸Ñ… ÑÐ¸Ð»?  ', '');

-- --------------------------------------------------------

--
-- Структура таблиці `post_comm`
--

CREATE TABLE `post_comm` (
  `id` int(250) NOT NULL,
  `post_id` int(250) NOT NULL,
  `comm_from` varchar(250) NOT NULL,
  `comm_date` varchar(250) NOT NULL,
  `comm_text` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `post_comm`
--

INSERT INTO `post_comm` (`id`, `post_id`, `comm_from`, `comm_date`, `comm_text`) VALUES
(1, 4, 'Maicl_GraB', '22:41 15.05.2023', 'Ð¢Ð°Ðº Ð¶Ðµ Ð¸ Ñ ÑÐ°Ð¹Ñ‚Ð¾Ð¼'),
(2, 12, 'Maicl_GraB', '17:23 30.05.2023', 'ÐŸÐ¾ÐºÐ° Ñ‡Ñ‚Ð¾'),
(4, 16, 'Mykola_Hamster', '12:35 10.06.2023', 'Ð›ÐµÑ‚Ð°ÑŽÑ‰Ð°Ñ Ð±Ð»ÑÑ‚ÑŒ Ð»Ð¸ÑÑ‚Ð²Ð° '),
(5, 17, 'Maicl_GraB', '11:00 15.06.2023', 'Ð¡ÑŽÐ´Ð°Ð°Ð°'),
(10, 0, 'Xenia', '17:04 10.08.2023', ''),
(11, 28, 'Maicl_GraB', '16:43 15.08.2023', 'Ð§Ñ‚Ð¾ Ð·Ð° ÑÐ»Ð¸Ð²'),
(12, 31, 'Maicl_GraB', '09:24 16.08.2023', 'Ð–Ð´Ñƒ Ð² Ð½Ð¾Ð²Ð¾Ð¹ Ð¾Ð±Ð½Ð¾Ð²Ðµ'),
(17, 34, 'Mykola_Hamster', '22:35 26.08.2023', 'Ð¡ÐºÐ¾Ð»Ð¾Ð¿Ð¸Ð´Ð¾Ñ€Ð¾Ð² ÐºÐ°Ðº-Ñ‚Ð¾ Ð¼Ð°Ð»Ð¾. Ð¡ÐºÐ¾Ñ€Ð¾ Ð¸ÑÐ¿Ñ€Ð°Ð²Ð»ÑŽ '),
(18, 35, 'Xenia', '21:36 08.09.2023', 'Ð£Ñ€Ð°, Ð¼ÐµÐ³Ð° Ð¾Ð±Ð½Ð¾Ð²Ð° !!!'),
(19, 36, 'Maicl_GraB', '15:00 13.09.2023', 'ÐÐµÐ´ÑƒÑ€Ð½Ð¾'),
(20, 37, 'Mykola_Hamster', '14:43 18.10.2023', 'For real? ÐŸÑ€ÑÐ¼ Ñ€Ð¸Ð»? Ð¿Ð¾ Ð¿Ñ€Ð°Ð²Ð´Ðµ? ÑƒÐ²ÐµÑ€ÐµÐ½? Ð½Ðµ Ð´Ð¸Ð·Ð¸Ð½Ñ„Ð°? '),
(21, 38, 'Maicl_GraB', '21:01 27.11.2023', 'Ð´ÐµÐ½ÑŒÐ³Ð¸ Ñ€Ð°Ð·Ð²Ð¾Ñ€Ð¾Ð²Ð°Ð»Ð¸, ÐºÐ°Ðº Ð²ÑÐµÐ³Ð´Ð° (Ð¾Ñ‚Ð²ÐµÑ‚Ñ‹ Ð½Ð° ÐºÐ¾Ð¼Ð¼ÐµÐ½Ñ‚Ñ‹ Ð½Ðµ Ñ€Ð°Ð±Ð¾Ñ‚Ð°ÑŽÑ‚)');

-- --------------------------------------------------------

--
-- Структура таблиці `trans`
--

CREATE TABLE `trans` (
  `trans_from` varchar(20) NOT NULL,
  `trans_to` varchar(20) NOT NULL,
  `card_from` int(4) UNSIGNED NOT NULL,
  `card_to` int(4) UNSIGNED NOT NULL,
  `trans_date` varchar(32) NOT NULL,
  `trans_summa` decimal(11,1) UNSIGNED NOT NULL,
  `trans_mess` text DEFAULT NULL,
  `trans_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `trans`
--

INSERT INTO `trans` (`trans_from`, `trans_to`, `card_from`, `card_to`, `trans_date`, `trans_summa`, `trans_mess`, `trans_id`) VALUES
('PityhBank', 'Maicl_GraB', 0, 5013, '15:08 17.08.2023', '2.0', 'ÐŸÐ¾Ð¿Ð¾Ð²Ð½ÐµÐ½Ð½Ñ Ñ€Ð°Ñ…ÑƒÐ½ÐºÑƒ. Ð‘Ð°Ð½ÐºÑ–Ñ€ Maicl_GraB', 1),
('Maicl_GraB', 'Mykola_Hamster', 5013, 8297, '00:40 18.08.2023', '1.0', 'Ð Ð°Ð·Ð¼ÐµÐ½', 2),
('PityhBank', 'Maicl_GraB', 0, 5013, '01:29 21.08.2023', '2.0', 'ÐŸÐ¾Ð¿Ð¾Ð²Ð½ÐµÐ½Ð½Ñ Ñ€Ð°Ñ…ÑƒÐ½ÐºÑƒ. Ð‘Ð°Ð½ÐºÑ–Ñ€ Maicl_GraB', 3),
('PityhBank', 'Mykola_Hamster', 0, 8297, '01:30 21.08.2023', '6.0', 'ÐŸÐ¾Ð¿Ð¾Ð²Ð½ÐµÐ½Ð½Ñ Ñ€Ð°Ñ…ÑƒÐ½ÐºÑƒ. Ð‘Ð°Ð½ÐºÑ–Ñ€ Maicl_GraB', 4),
('Maicl_GraB', 'jenkajmenka228', 5013, 8305, '01:39 21.08.2023', '0.4', 'Ð—Ð°ÐºÐ°Ð· Ð² ÐºÐ°Ñ„Ðµ', 5),
('Mykola_Hamster', 'Spacerar', 8297, 2747, '13:59 25.08.2023', '0.8', 'ÐŸÐ¾Ñ€Ð¾Ñ…Ð¾Ð²Ð°Ñ ÑÐ´ÐµÐ»ÐºÐ°', 6),
('PityhBank', 'Maicl_GraB', 0, 5013, '00:47 26.08.2023', '14.0', 'ÐŸÐ¾Ð¿Ð¾Ð²Ð½ÐµÐ½Ð½Ñ Ñ€Ð°Ñ…ÑƒÐ½ÐºÑƒ. Ð‘Ð°Ð½ÐºÑ–Ñ€ Maicl_GraB', 7),
('Mykola_Hamster', 'jenkajmenka228', 8297, 8305, '21:35 08.09.2023', '4.0', 'ÐšÐ¾Ñ„Ðµ', 8);

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `role` varchar(32) DEFAULT 'user',
  `ava` varchar(250) NOT NULL DEFAULT 'ava_user.png',
  `description` varchar(250) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'Тут буде ваш опис профілю'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `role`, `ava`, `description`) VALUES
(1, 'r1boulade', 'f21ffc0003502f61e290f5d51f3c6b2c', 'user', 'ava_user.png', 'Тут буде ваш опис профілю'),
(2, 'Spacerar', 'd577842192a5cc455514ba95818c80ef', 'user', 'photo_2023-05-15_18-05-37.jpg', 'Ð¡Ð°Ð½Ñ Ð¿ÐµÐ´Ð¸Ðº'),
(3, 'wrakety31', '28128d734d9ba952acde92fdf72ec623', 'user', 'IMG_20230117_221104_408.jpg', 'Ð‘ÐµÐ·Ð¾Ð±Ð¸Ð´ Ð´Ð¾ÑÐºÐ° Ð·Ð° Ñ‡Ð°Ñ€ÐºÑƒ'),
(4, 'Maicl_GraB', '7ec5f14a2c0e9c9e80005fe65c1f3643', 'admin', '20230801_083409.jpg', 'Ð Ð¾Ð·Ñ€Ð¾Ð±Ð½Ð¸Ðº ÑÐ°Ð¹Ñ‚Ñƒ, Ð°Ð´Ð¼Ñ–Ð½Ñ–ÑÑ‚Ñ€Ð°Ñ‚Ð¾Ñ€ Ð´Ñ–ÑÐºÐ¾Ñ€Ð´Ñƒ ðŸ˜Ž'),
(5, 'Mykola_Hamster', '7c48684eeae85daff69deac5fde17a97', 'admin', 'FdI9ZMiaEAIL957.png', 'Jedyny pracownik wsparcia technicznego ðŸ‡µðŸ‡± ðŸ‡µðŸ‡± ðŸ‡µðŸ‡±.'),
(6, 'Deko', NULL, 'user', 'ava_user.png', 'Тут буде ваш опис профілю'),
(7, 'Sirop99', NULL, 'user', 'ava_user.png', 'Тут буде ваш опис профілю'),
(8, 'Xenia', '830817c55cc4eb838efcfbb36c7df3b1', 'user', '20230722_002716.jpg', 'ÐœÐ¾Ð»Ð¾Ð´ÐµÐ½ÑŒÐºÐ°Ñ ÑÑ‚ÑƒÐ´ÐµÐ½Ñ‚Ð¾Ñ‡ÐºÐ° '),
(9, 'jenkajmenka228', '5da4bf12d7d00a3702e466f695b120c5', 'user', 'Screenshot_20230815-175613_TikTok.jpg', '??? ???? ??? ???? ???????'),
(10, 'Pepsi', '0791e2bf1ba562dd98a8a1c4be75d6ab', 'user', 'photo_2023-01-23_09-27-52.jpg', 'ÐÐ° Ð°Ð²Ðµ ÐºÑ€Ð°Ñˆ \r\n'),
(11, 'mewoka', 'c0283ae80b3fc3b1012e0a8fa8eef55b', 'user', 'photo_2023-01-25_12-58-12.jpg', 'Ð“Ð¾Ð²Ð½Ð¾ Ð·Ð°Ð»ÑƒÐ¿Ð° Ð¿ÐµÐ½Ð¸Ñ Ñ…ÐµÑ€ Ð³Ð¾Ð»Ð¾Ð²ÐºÐ° Ñ…ÑƒÐ¹ Ð±Ð»ÑÐ´Ð¸Ð½Ð°'),
(12, 'lil_dwarf0', NULL, 'user', 'ava_user.png', 'Тут буде ваш опис профілю'),
(15, 'PityhBank', 'f16cdd1c22e00803d3de399fe24e87fb', 'user', 'Ð¿Ð¸Ñ‚ÑƒÑ…Ð±Ð°Ð½Ðº.png', 'ÐŸÑ–Ñ‚ÑƒÑ…Ð±Ð°Ð½Ðº');

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
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблиці `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT для таблиці `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблиці `penalty`
--
ALTER TABLE `penalty`
  MODIFY `penalt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `petition`
--
ALTER TABLE `petition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `petition_sub`
--
ALTER TABLE `petition_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблиці `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблиці `post_comm`
--
ALTER TABLE `post_comm`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблиці `trans`
--
ALTER TABLE `trans`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблиці `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
