-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 31 mrt 2026 om 14:56
-- Serverversie: 8.0.30
-- PHP-versie: 8.1.10

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
  `inloggen_id` int NOT NULL,
  `naam` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `wachtwoord` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klachten`
--

CREATE TABLE `klachten` (
  `klacht_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `naam` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `beschrijving` text,
  `datum` date DEFAULT NULL,
  `inloggen_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klachten`
--

INSERT INTO `klachten` (`klacht_id`, `product_id`, `naam`, `email`, `beschrijving`, `datum`, `inloggen_id`) VALUES
(5, 1, 'Jan de Vries', 'jan@email.nl', 'Scherm werkt niet goed', '2026-03-31', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `product_id` int NOT NULL,
  `naam` varchar(100) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `voorraad` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`product_id`, `naam`, `categorie`, `prijs`, `foto`, `voorraad`) VALUES
(1, 'Laptop Pro', 'Laptops', 999.99, 'Laptop.jpg', 23),
(2, 'Smartphone X', 'Smartphones', 599.99, 'mobiel.jpg', 80),
(3, 'Tablet Air', 'Tablets', 449.99, 'tablet.jpg', 37);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int NOT NULL,
  `naam` varchar(100) NOT NULL,
  `beoordeling` int NOT NULL,
  `opmerking` text NOT NULL,
  `datum` date NOT NULL,
  `product_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reviews`
--

INSERT INTO `reviews` (`review_id`, `naam`, `beoordeling`, `opmerking`, `datum`, `product_id`) VALUES
(1, 'Jan de Vries', 1, 'Mijn smartphone-scherm werkt niet goed. Het reageert traag en soms helemaal niet. Dit is echt frustrerend.', '2026-03-31', NULL);

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
  MODIFY `inloggen_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `klachten`
--
ALTER TABLE `klachten`
  MODIFY `klacht_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `klachten`
--
ALTER TABLE `klachten`
  ADD CONSTRAINT `fk_klachten_gebruikers` FOREIGN KEY (`inloggen_id`) REFERENCES `gebruikers` (`inloggen_id`),
  ADD CONSTRAINT `klachten_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `producten` (`product_id`);

--
-- Beperkingen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `producten` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
