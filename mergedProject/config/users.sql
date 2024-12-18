-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 18. Dez 2024 um 17:35
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `users`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(260) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `useremail` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `useremail`) VALUES
(1, 'student', 'topSecretPassword123', 'student@somedomain.at'),
(3, 'jhbhjew', '$2y$10$ruE9cYrOUaoFiO.YEUHHd.KW0LjLVe1DkqrajfUlUIAcgxCzF9aIK', 'ndbew@bhjbdhj.com'),
(4, 'student1', '$2y$10$tWUbAfAoIbA9AOIXBDysK.n33dMBWReWnBAfAzA1fK4t5tZWYkoI2', 'student1@email.com'),
(5, 'student2', '$2y$10$Kl4Vc6xlesD0hlDQ1qhLueOrkIBSULHmQtIxUBgkqQQ/xNlKv48hW', 'student2@somedomain.at'),
(6, 'student3', '$2y$10$zj6V8DVuWhn1XStfi6UTweglu7Lr9Uc8jPXUABxjrVvwv8myLz33y', 'student3@somedomain.at');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
