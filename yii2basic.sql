-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Час створення: Трв 03 2018 р., 20:21
-- Версія сервера: 5.5.28-log
-- Версія PHP: 5.4.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `yii2basic`
--

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `pr_id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_name` varchar(55) NOT NULL,
  `pr_description` varchar(222) NOT NULL,
  `pr_price` float NOT NULL,
  `pr_image` varchar(111) NOT NULL,
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `products`
--

INSERT INTO `products` (`pr_id`, `pr_name`, `pr_description`, `pr_price`, `pr_image`) VALUES
(1, 'Obolon', 'Beer, 1.5L', 14.33, ''),
(2, 'Staropramen', 'Premium Beer, 0.5L', 21.55, ''),
(3, 'Stella_Artua', 'Premium Beer,1L', 19.99, '');

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `language` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `language`, `role`) VALUES
(2, 'dimaC', '31tQ5V8KnfTNcUgtG_m4KGrq7VzWT5Yx', '$2y$13$HdH0DXe9nljtyQJhZB5mSe3DJTyCO2/cVOMShI6AhklnpFqW3wwG6', NULL, 'dimabb@ukr.net', 10, 1479825809, 1479825809, '', 1),
(5, 'admin', '31tQ5V8KnfTNcUgtG_m4KGrq7VzWT5Yx', '21232f297a57a5a743894a0e4a801fc3', NULL, 'div@ukr.net', 10, 1479825809, 1479825809, '', 1),
(6, 'vasya', 'RoXl2y00WvbUf5to8OE5BM8zRc67oaHl', '$2y$13$6VnuKgZn1M2qlsqyTalzFOS8ry29RcQUlZBTbaFZsEAXY9GhTL8iO', NULL, 'vasya@ukr.net', 10, 1480424366, 1480424366, '', 1),
(7, 'Dima', '4X4DbeEdn915IVT_FmFPBpR6qs5_MsOX', '$2y$13$PHT78wkiGaLTCK55xkA4pOfA6wdcHZY5ePBqp5QS1g0tpUg/gV3vu', NULL, 'dima@ukr.net', 10, 1480425059, 1480425059, 'English', 2),
(8, 'Olya', 'jTwwTgdQP7Gl9cENo2C7hHIksx18k6Fc', '$2y$13$8dK54whWt7/RbFgdh.plt.fhxEJzS9UL.gNP9NugirkvQ9iT2MIo6', NULL, 'olya@ukr.net', 10, 1481009972, 1481009972, '', 1),
(9, 'Vova', 'zXDZcPxT53b6VKsGV0iJpPqhToVxh23p', '$2y$13$5Dr2nKcONEgZ3Kyy5y.kLerUKeuJT7XM/PbyZd8hcCaplaFT6vhVC', NULL, 'vova@ukr.net', 10, 1481037492, 1481037492, '', 1),
(10, 'demo', 'ZKqvV1zvTJbcPKWmxonBEM5ZcsmiScng', '$2y$13$jtuRkRd0itW7zMXF3SVG8ucKFDgboI8xodzlUhHW6.nXjAxMOZhze', NULL, 'demo@ukr.net', 10, 1485526673, 1485526673, '', 1),
(11, 'geo', 'dPF5DuylVgDfC9lB-MfAcZG8fYIe7JiO', '$2y$13$69kfbNhhoYhiRWxQl9.WaebBokzp7.S5BjBD9zj9u3iCSECTmDVdC', NULL, 'geo@ukr.net', 10, 1486637441, 1486637441, '', 1),
(12, 'Olya55', 'ID2KsTLlTUvE6wNyzY0hDI7qfTHne1KK', '$2y$13$CWEyvSe4nTcuVAAxYKhZ4.lIrD.PBvmFiuZNdUxUi9zlDraEcfbRe', NULL, 'dima@ukr.net555', 10, 1490965273, 1490965273, 'English', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
