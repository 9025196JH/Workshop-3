-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 08 apr 2026 om 13:04
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techzone`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `inloggen_id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klachten`
--

CREATE TABLE `klachten` (
  `klacht_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `naam` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `beschrijving` text DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `inloggen_id` int(11) DEFAULT NULL,
  `admin_antwoord` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klachten`
--

INSERT INTO `klachten` (`klacht_id`, `product_id`, `naam`, `email`, `beschrijving`, `datum`, `inloggen_id`, `admin_antwoord`) VALUES
(13, 32, 'Jan de Vries', 'jan@test.nl', '	Mijn smartphone-scherm werkt niet goed. Het reageert traag en soms helemaal niet. Dit is echt frustrerend.', '2026-04-07', NULL, 'We hebben uw klacht ontvangen en nemen zo snel mogelijk contact met u op.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `product_id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `foto` varchar(500) DEFAULT NULL,
  `voorraad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`product_id`, `naam`, `categorie`, `prijs`, `foto`, `voorraad`) VALUES
(32, 'iPhone 15 Pro', 'Smartphones', 1199.00, 'img/iphone 15 pro.jpg', 10),
(33, 'Samsung Galaxy S24 Ultra', 'Smartphones', 949.00, 'img/samsung galaxy s24 ultra.webp', 15),
(34, 'Google Pixel 8', 'Smartphones', 799.00, 'img/Google Pixel 8.webp', 8),
(35, 'Xiaomi 14 Ultra', 'Smartphones', 899.00, 'img/Xiaomi 14 Ultra.jpg', 12),
(36, 'OnePlus 15', 'Smartphones', 800.00, 'img/OnePlus 15.jpg', 20),
(38, 'Dell XPS 13', 'Laptops', 1099.00, 'img/Dell XPS 13.jpg', 7),
(40, 'Lenovo ThinkPad X1', 'Laptops', 1399.00, 'img/Lenovo ThinkPad X1.jpg', 4),
(41, 'Asus Zenbook 14', 'Laptops', 899.00, 'img/Asus Zenbook 14.jpg', 9),
(42, 'iPad Pro 12.9', 'Tablets', 1099.00, 'img/iPad Pro 12.9.jpg', 11),
(43, 'Samsung Tab S9', 'Tablets', 799.00, 'img/Samsung Tab S9.jpg', 14),
(59, 'Iphone 17 pro max', 'Smartphones', 1500.00, 'img/Iphone 17 pro-max.jpg', 47),
(60, 'Iphone 17 pro max', 'Smartphones', 1499.00, 'img/iphone 17 pro max.webp', 39);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `beoordeling` int(11) NOT NULL,
  `opmerking` text NOT NULL,
  `datum` date NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `admin_antwoord` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reviews`
--

INSERT INTO `reviews` (`review_id`, `naam`, `beoordeling`, `opmerking`, `datum`, `product_id`, `admin_antwoord`) VALUES
(1, 'Jan de Vries', 1, 'Mijn smartphone-scherm werkt niet goed. Het reageert traag en soms helemaal niet. Dit is echt frustrerend.', '2026-03-31', 32, 'Bedankt voor uw feedback! We zullen onze service verbeteren.');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`inloggen_id`);

--
-- Indexen voor tabel `klachten`
--
ALTER TABLE `klachten`
  ADD PRIMARY KEY (`klacht_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_klachten_gebruikers` (`inloggen_id`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `inloggen_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `klachten`
--
ALTER TABLE `klachten`
  MODIFY `klacht_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT voor een tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `klachten`
--
ALTER TABLE `klachten`
  ADD CONSTRAINT `fk_klachten_gebruikers` FOREIGN KEY (`inloggen_id`) REFERENCES `gebruikers` (`inloggen_id`),
  ADD CONSTRAINT `fk_klachten_producten` FOREIGN KEY (`product_id`) REFERENCES `producten` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_producten` FOREIGN KEY (`product_id`) REFERENCES `producten` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
