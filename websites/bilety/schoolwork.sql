-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 25 Paź 2020, 14:43
-- Wersja serwera: 5.7.24
-- Wersja PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `schoolwork`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cities`
--

CREATE TABLE `cities` (
  `id_city` int(11) NOT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `cities`
--

INSERT INTO `cities` (`id_city`, `city_name`, `longitude`, `latitude`) VALUES
(1, 'Szczecin', 53.26, 14.32),
(2, 'Gdańsk', 54.2, 18.38),
(3, 'Olsztyn', 53.47, 20.3),
(4, 'Białystok', 53.08, 23.08),
(5, 'Warszawa', 52.13, 21),
(6, 'Poznań', 52.24, 16.56),
(7, 'Gorzów Wielkopolski', 52.43, 15.14),
(8, 'Zielona Góra', 51.56, 15.3),
(9, 'Wrocław', 51.06, 17.01),
(10, 'Opole', 50.39, 17.55),
(11, 'Łódź', 51.46, 19.27),
(12, 'Katowice', 50.15, 19.01),
(13, 'Kielce', 50.53, 20.37),
(14, 'Kraków', 50.03, 19.56),
(15, 'Lublin', 51.14, 22.34),
(16, 'Rzeszów', 50.02, 22);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_city1` int(11) NOT NULL,
  `id_city2` int(11) NOT NULL,
  `price` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id_order`, `id_city1`, `id_city2`, `price`, `date`) VALUES
(1, 2, 4, 1395, '2020-12-31'),
(4, 2, 16, 1434.78, '2021-03-05'),
(6, 1, 2, 10, '2020-12-12'),
(7, 4, 13, 1197.03, '2020-10-15');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orderuser`
--

CREATE TABLE `orderuser` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `orderuser`
--

INSERT INTO `orderuser` (`id_order`, `id_user`) VALUES
(6, 1),
(1, 2),
(7, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `u_password` varchar(20) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `username`, `u_password`, `is_admin`) VALUES
(1, 'maciek', 'Jeden2Trzy', 0),
(2, 'admin', 'admin', 1),
(3, 'maciek007', 'haslo007', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id_city`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `orders_ibfk_1` (`id_city1`),
  ADD KEY `orders_ibfk_2` (`id_city2`);

--
-- Indeksy dla tabeli `orderuser`
--
ALTER TABLE `orderuser`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `orderuser_ibfk_2` (`id_user`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `name` (`username`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `cities`
--
ALTER TABLE `cities`
  MODIFY `id_city` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_city1`) REFERENCES `cities` (`id_city`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_city2`) REFERENCES `cities` (`id_city`);

--
-- Ograniczenia dla tabeli `orderuser`
--
ALTER TABLE `orderuser`
  ADD CONSTRAINT `orderuser_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderuser_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
