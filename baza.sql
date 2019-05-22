-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1:3307
-- Čas nastanka: 14. feb 2019 ob 18.31
-- Različica strežnika: 8.0.13
-- Različica PHP: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `davcna_blagajna`
--
CREATE DATABASE IF NOT EXISTS `davcna_blagajna` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci;
USE `davcna_blagajna`;

-- --------------------------------------------------------

--
-- Struktura tabele `admin`
--

CREATE TABLE `admin` (
  `ID_admin` int(10) UNSIGNED NOT NULL,
  `users_ID_users` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `admin`
--

INSERT INTO `admin` (`ID_admin`, `users_ID_users`) VALUES
(2, 4);

-- --------------------------------------------------------

--
-- Struktura tabele `drink`
--

CREATE TABLE `drink` (
  `ID_drink` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `drink_type_ID_drink_type` int(10) UNSIGNED NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `drink`
--

INSERT INTO `drink` (`ID_drink`, `name`, `drink_type_ID_drink_type`, `price`) VALUES
(1, 'Ledeni čaj - breskev 0.1L', 1, 2.2),
(2, 'Jagoda 0.1L', 1, 0.95),
(3, 'Voda z okusom 0.5L', 1, 1.9),
(4, 'Juice 0.1L', 1, 0.8),
(5, 'Jabolčni sok 0.1L', 1, 0.8),
(6, 'Coca cola 0.25L', 2, 2.2),
(7, 'Fanta 0.25L', 2, 2.2),
(8, 'Sprite 0.25L', 2, 2.2),
(9, 'Schweppes tonic', 2, 2.2),
(10, 'Cockta 0.25L', 2, 2.2),
(11, 'Union 0.33L', 3, 2),
(12, 'Union 0.5L', 3, 2.5),
(13, 'Jabolčni tat 0.5L', 3, 2.6),
(14, 'Laško 0.33L', 3, 2),
(15, 'Laško 0.5L', 3, 2.5),
(16, 'Jack daniels 0.03L', 4, 2.7),
(17, 'Ballantines 0.03L', 4, 2.5),
(18, 'Jagermeister', 4, 2.7),
(19, 'Keglevich 0.03L', 4, 2.2),
(20, 'J&B 0.03L', 4, 2.5),
(21, 'Čaj', 5, 1.2),
(22, 'Cappucino', 5, 1.5),
(23, 'Espresso', 5, 1),
(24, 'Kava z mlekom', 5, 1.1),
(25, 'Bela kava', 5, 1.6);

-- --------------------------------------------------------

--
-- Struktura tabele `drink_orderd`
--

CREATE TABLE `drink_orderd` (
  `ID_drink_orderd` int(11) NOT NULL,
  `order_ID_order` int(10) UNSIGNED NOT NULL,
  `drink_ID_drink` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `drink_orderd`
--

INSERT INTO `drink_orderd` (`ID_drink_orderd`, `order_ID_order`, `drink_ID_drink`, `quantity`) VALUES
(1, 3, 17, 2);

-- --------------------------------------------------------

--
-- Struktura tabele `drink_type`
--

CREATE TABLE `drink_type` (
  `ID_drink_type` int(10) UNSIGNED NOT NULL,
  `type` varchar(45) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `drink_type`
--

INSERT INTO `drink_type` (`ID_drink_type`, `type`) VALUES
(1, 'negazirana_pijaca'),
(2, 'gazirana_pijaca'),
(3, 'alkoholna_pijaca'),
(4, 'zganje'),
(5, 'topli_napitki');

-- --------------------------------------------------------

--
-- Struktura tabele `food`
--

CREATE TABLE `food` (
  `ID_food` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `food_type_ID_food_type` int(10) UNSIGNED NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `food`
--

INSERT INTO `food` (`ID_food`, `name`, `food_type_ID_food_type`, `price`) VALUES
(1, 'Cezarjeva', 4, 4.4),
(2, 'Piščančja', 4, 6.9),
(3, 'Mešana', 4, 4),
(4, 'Grška', 4, 4.9),
(5, 'Italijanska', 4, 4.9),
(6, 'Goveja', 2, 2.9),
(7, 'Gobova', 2, 2.9),
(8, 'Zelenjavna', 2, 3.5),
(9, 'Ribja', 2, 3.5),
(10, 'Piščančja', 2, 2.9),
(11, 'Zrezek na žaru', 3, 6.9),
(12, 'Patata con pollo', 3, 7.8),
(13, 'Lignji na žaru', 3, 9.3),
(14, 'Špageti bolognese', 3, 5.9),
(15, 'Mesna lazanja', 3, 6.9),
(16, 'Vroče maline', 5, 3.5),
(17, 'Palačinke z nutello', 5, 2.7),
(18, 'Tiramisu', 5, 3.5),
(19, 'Jabolčni zavitek', 5, 3.5),
(20, 'Gibanica', 5, 3.5),
(21, 'Narezek', 1, 12),
(22, 'Bakalar', 1, 6.9),
(23, 'Goveji carpaccio', 1, 9.5),
(24, 'Hobotnica v solati', 1, 9.6),
(25, 'Polenta z jurčki', 1, 4.5);

-- --------------------------------------------------------

--
-- Struktura tabele `food_orderd`
--

CREATE TABLE `food_orderd` (
  `ID_food_orderd` int(11) NOT NULL,
  `order_ID_order` int(10) UNSIGNED NOT NULL,
  `food_ID_food` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `food_orderd`
--

INSERT INTO `food_orderd` (`ID_food_orderd`, `order_ID_order`, `food_ID_food`, `quantity`) VALUES
(1, 3, 12, 1),
(2, 3, 12, 1),
(3, 3, 15, 1),
(4, 3, 15, 1);

-- --------------------------------------------------------

--
-- Struktura tabele `food_type`
--

CREATE TABLE `food_type` (
  `ID_food_type` int(10) UNSIGNED NOT NULL,
  `type` varchar(45) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `food_type`
--

INSERT INTO `food_type` (`ID_food_type`, `type`) VALUES
(1, 'predjed'),
(2, 'juha'),
(3, 'glavna_jed'),
(4, 'solata'),
(5, 'sladica');

-- --------------------------------------------------------

--
-- Struktura tabele `order`
--

CREATE TABLE `order` (
  `ID_order` int(10) UNSIGNED NOT NULL,
  `time` timestamp(2) NOT NULL DEFAULT CURRENT_TIMESTAMP(2) ON UPDATE CURRENT_TIMESTAMP(2),
  `completed` tinyint(4) NOT NULL,
  `price_all` float NOT NULL,
  `users_ID_users` int(10) UNSIGNED NOT NULL,
  `table_ID_table` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `order`
--

INSERT INTO `order` (`ID_order`, `completed`, `price_all`, `users_ID_users`, `table_ID_table`) VALUES
(1, 1, 1200, 5, 1),
(2, 1, 100, 1, 2),
(3, 0, 31.9, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabele `table`
--

CREATE TABLE `table` (
  `ID_table` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `table`
--

INSERT INTO `table` (`ID_table`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

CREATE TABLE `users` (
  `ID_users` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `user_password` varchar(150) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `firstname` varchar(45) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `lastname` varchar(45) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `user_tel` varchar(45) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `user_mail` varchar(45) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`ID_users`, `user_name`, `user_password`, `firstname`, `lastname`, `user_tel`, `user_mail`) VALUES
(1, 'jernej', '$5$round=5000$kWQiVufcf7hwrMaQVzgRUXH9O1E27PyY2rpvS8AtgmA', 'jernej', 'zupi', '133', 'neki@neki.com'),
(4, 'tadej', '$5$round=5000$Ls.Dcf1q6eZpLQu71k72PuK3.fhJtYxLE6eZz.1x.BC', 'tadej', 'vac', '112', 'neki1@neki.com'),
(5, 'andrej', '$5$round=5000$Um.yFCPcVH.Y2zl2vKxaJNbldvZ4LKLi090XWo4yOZ/', 'andrej', 'avbelj', '911', 'neki2@neki.com'),
(6, 'andrejavbelj', '$5$round=5000$Um.yFCPcVH.Y2zl2vKxaJNbldvZ4LKLi090XWo4yOZ/', 'Andrej', 'Avbelj', '4004', 'neki@gjd.com'),
(7, 'rtzht', '$5$round=5000$cW5bzjRgrP1bAvjVJnLRWVdZZUUzr1xrApxWx1oqrR8', 'neki', 'jernej', 'htrj', 'fhtr@ghiith.vog'),
(8, 'jutek', '$5$round=5000$Km4Nl7FTtVV.RLZnd1XDHiytMR4MFJIoTgHzqDRkD50', 'jthrh', 'jzuzu', '755', 'hfgj@rht'),
(9, 'htzjuzk', '$5$round=5000$keJGDtl75OszCjKmaC1HEhK4qhhb3JFiCYzdpokl9D3', 'rez6u', 'tzi', '5646', 'hjzfkjuz@hg'),
(10, 'kur', '$5$round=5000$eKH.Az0Q/WeK5A17rY6n6ehFbXR/b6dsx7zIj99Uk/D', 'zjuzki', 'kkjuez', 'jh', 'ggjj{@fg'),
(11, 'kkkkkkiuz', '$5$round=5000$UQ04ltXoouVVNogiJYrkIiKDsEf4OZc8Fdd41cT4uA9', 'hrtjzuk', 'kzi', '56465', 'hgkj{@reh'),
(12, 'ghjj', '$5$round=5000$YuxHk3BMDQeXW72V5E5lHcwLc45t8y6nmmgtTbhWe46', 'jztjnt', 'jzzthjn', 'tzrzhz', 'ghj{@6zt'),
(13, 'jkuz', '$5$round=5000$MDG9AH/g4PJTl0w2YH/Xgvt4VV4baoPk331cGK7q2R2', 'jhuk', 'kuzjkuz', 'ztjnzt', 'grhb@regt'),
(14, 'kduzj', '$5$round=5000$zen8cZ6Ito2Y19VddN8MjpB/a/Gj28fUCMyOYyVN240', 'rzuz', 'kuzi', 'u567', 'jggk@hrt'),
(15, 'andrejavb', '$5$round=5000$Um.yFCPcVH.Y2zl2vKxaJNbldvZ4LKLi090XWo4yOZ/', 'Andrej', 'Avbelj', '12345', 'neki@gjd.com');

-- --------------------------------------------------------

--
-- Struktura tabele `waiting`
--

CREATE TABLE `waiting` (
  `ID_waiting` int(10) UNSIGNED NOT NULL,
  `users_ID_users` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `waiting`
--

INSERT INTO `waiting` (`ID_waiting`, `users_ID_users`) VALUES
(7, 4),
(8, 6),
(9, 7),
(10, 8),
(11, 9),
(12, 10),
(13, 11),
(14, 12),
(15, 13),
(16, 14),
(17, 15);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_admin`,`users_ID_users`),
  ADD KEY `fk_admin_users1_idx` (`users_ID_users`);

--
-- Indeksi tabele `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`ID_drink`,`drink_type_ID_drink_type`),
  ADD KEY `fk_drink_drink_type_idx` (`drink_type_ID_drink_type`);

--
-- Indeksi tabele `drink_orderd`
--
ALTER TABLE `drink_orderd`
  ADD PRIMARY KEY (`ID_drink_orderd`),
  ADD UNIQUE KEY `ID_drink_orderd` (`ID_drink_orderd`),
  ADD KEY `fk_order_has_drink_type_order1_idx` (`order_ID_order`),
  ADD KEY `fk_drink_orderd_drink1_idx` (`drink_ID_drink`);

--
-- Indeksi tabele `drink_type`
--
ALTER TABLE `drink_type`
  ADD PRIMARY KEY (`ID_drink_type`);

--
-- Indeksi tabele `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`ID_food`,`food_type_ID_food_type`),
  ADD KEY `fk_drink_drink_type_idx` (`food_type_ID_food_type`);

--
-- Indeksi tabele `food_orderd`
--
ALTER TABLE `food_orderd`
  ADD PRIMARY KEY (`ID_food_orderd`),
  ADD UNIQUE KEY `ID_food_orderd` (`ID_food_orderd`),
  ADD KEY `fk_order_has_food_type_order1_idx` (`order_ID_order`),
  ADD KEY `fk_food_orderd_food1_idx` (`food_ID_food`);

--
-- Indeksi tabele `food_type`
--
ALTER TABLE `food_type`
  ADD PRIMARY KEY (`ID_food_type`);

--
-- Indeksi tabele `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`ID_order`,`users_ID_users`,`table_ID_table`),
  ADD KEY `fk_order_users1_idx` (`users_ID_users`),
  ADD KEY `fk_order_table1_idx` (`table_ID_table`);

--
-- Indeksi tabele `table`
--
ALTER TABLE `table`
  ADD PRIMARY KEY (`ID_table`);

--
-- Indeksi tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_users`);

--
-- Indeksi tabele `waiting`
--
ALTER TABLE `waiting`
  ADD PRIMARY KEY (`ID_waiting`,`users_ID_users`),
  ADD KEY `fk_waiting_users1_idx` (`users_ID_users`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT tabele `drink`
--
ALTER TABLE `drink`
  MODIFY `ID_drink` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT tabele `drink_orderd`
--
ALTER TABLE `drink_orderd`
  MODIFY `ID_drink_orderd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT tabele `drink_type`
--
ALTER TABLE `drink_type`
  MODIFY `ID_drink_type` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT tabele `food`
--
ALTER TABLE `food`
  MODIFY `ID_food` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT tabele `food_orderd`
--
ALTER TABLE `food_orderd`
  MODIFY `ID_food_orderd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT tabele `food_type`
--
ALTER TABLE `food_type`
  MODIFY `ID_food_type` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT tabele `order`
--
ALTER TABLE `order`
  MODIFY `ID_order` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT tabele `table`
--
ALTER TABLE `table`
  MODIFY `ID_table` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT tabele `users`
--
ALTER TABLE `users`
  MODIFY `ID_users` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT tabele `waiting`
--
ALTER TABLE `waiting`
  MODIFY `ID_waiting` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_users1` FOREIGN KEY (`users_ID_users`) REFERENCES `users` (`id_users`);

--
-- Omejitve za tabelo `drink`
--
ALTER TABLE `drink`
  ADD CONSTRAINT `fk_drink_drink_type` FOREIGN KEY (`drink_type_ID_drink_type`) REFERENCES `drink_type` (`id_drink_type`);

--
-- Omejitve za tabelo `drink_orderd`
--
ALTER TABLE `drink_orderd`
  ADD CONSTRAINT `fk_drink_orderd_drink1` FOREIGN KEY (`drink_ID_drink`) REFERENCES `drink` (`id_drink`),
  ADD CONSTRAINT `fk_order_has_drink_type_order1` FOREIGN KEY (`order_ID_order`) REFERENCES `order` (`id_order`);

--
-- Omejitve za tabelo `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `fk_drink_drink_type0` FOREIGN KEY (`food_type_ID_food_type`) REFERENCES `food_type` (`id_food_type`);

--
-- Omejitve za tabelo `food_orderd`
--
ALTER TABLE `food_orderd`
  ADD CONSTRAINT `fk_food_orderd_food1` FOREIGN KEY (`food_ID_food`) REFERENCES `food` (`id_food`),
  ADD CONSTRAINT `fk_order_has_food_type_order1` FOREIGN KEY (`order_ID_order`) REFERENCES `order` (`id_order`);

--
-- Omejitve za tabelo `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_table1` FOREIGN KEY (`table_ID_table`) REFERENCES `table` (`id_table`),
  ADD CONSTRAINT `fk_order_users1` FOREIGN KEY (`users_ID_users`) REFERENCES `users` (`id_users`);

--
-- Omejitve za tabelo `waiting`
--
ALTER TABLE `waiting`
  ADD CONSTRAINT `fk_waiting_users1` FOREIGN KEY (`users_ID_users`) REFERENCES `users` (`id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
