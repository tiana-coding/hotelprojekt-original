-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 24. Dez 2024 um 12:44
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
-- Datenbank: `hotelprojekt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `text`, `image`, `created_at`) VALUES
(1, 'Entspannung pur – Ihr Wellness-Erlebnis im Hotel Blick und Glück', 'Im hektischen Alltag ist es wichtiger denn je, sich Momente der Ruhe und Entspannung zu gönnen. Im Hotel Blick und Glück haben wir genau das Richtige für Sie vorbereitet. Unser hauseigenes Wellnesscenter bietet eine Vielzahl von Anwendungen, die Körper und Geist in Einklang bringen.\r\n\r\nBeginnen Sie Ihren Tag mit einer belebenden Yoga-Session in unserem lichtdurchfluteten Studio oder lassen Sie den Stress bei einer wohltuenden Massage hinter sich. Unsere erfahrenen Therapeuten stehen Ihnen mit individuellen Behandlungen zur Verfügung, die auf Ihre Bedürfnisse abgestimmt sind. Nach einer entspannenden Sitzung können Sie im Whirlpool relaxen oder einen Spaziergang durch unsere gepflegten Gartenanlagen genießen.\r\n\r\nFür das leibliche Wohl sorgen unsere gesunden und köstlichen Speisen im hoteleigenen Restaurant. Frische, regionale Zutaten und kreative Rezepte machen jedes Gericht zu einem Genuss. Lassen Sie sich von unserem Wellness-Angebot verwöhnen und tanken Sie neue Energie im Hotel Blick und Glück – Ihrem Rückzugsort für Körper und Seele.', '../uploads/thumbnails/3.jpg', '2024-12-24 03:37:04'),
(2, 'Gutes Essen macht gute Laune', 'Gutes Essen ist ein wichtiger Bestandteil eines gelungenen Aufenthalts, und im Hotel Blick und Glück legen wir besonderen Wert auf kulinarische Exzellenz. Unser Küchenteam zaubert täglich frische und abwechslungsreiche Gerichte, die keine Wünsche offenlassen.\r\n\r\nBeginnen Sie Ihren Tag mit einem reichhaltigen Frühstücksbuffet, das von regionalen Spezialitäten bis hin zu internationalen Köstlichkeiten alles bietet. Für das Mittag- und Abendessen bieten wir wechselnde Menüs, die saisonal angepasst werden und die besten Zutaten der Region hervorheben.\r\n\r\nBesonders stolz sind wir auf unsere Themenabende, bei denen Sie besondere kulinarische Erlebnisse genießen können. Ob mediterrane Nächte, asiatische Fusionsküche oder traditionelle deutsche Hausmannskost – lassen Sie sich von unseren kreativen Gerichten überraschen.', '../uploads/thumbnails/6.jpg', '2024-12-24 03:37:04');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `guests` int(11) NOT NULL,
  `breakfast` enum('mit','ohne') NOT NULL,
  `children` enum('kein','Kleinkinder','Kinder') NOT NULL,
  `pets` enum('keine','hund','katze','sonstige') NOT NULL,
  `parking` enum('ja','nein') NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('neu','bestätigt','storniert') DEFAULT 'neu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `room_id`, `username`, `check_in_date`, `check_out_date`, `guests`, `breakfast`, `children`, `pets`, `parking`, `notes`, `created_at`, `status`) VALUES
(24, 1, 'student4', '2024-12-29', '2024-12-30', 2, 'mit', 'kein', 'keine', 'ja', 'test1', '2024-12-24 01:58:19', 'neu'),
(25, 2, 'student4', '2024-12-30', '2024-12-31', 2, 'mit', 'kein', 'keine', 'ja', 'test2', '2024-12-24 01:58:55', 'neu'),
(26, 1, 'student4', '2024-12-26', '2024-12-28', 2, 'mit', 'kein', 'keine', 'ja', 'test3', '2024-12-24 02:08:45', 'neu'),
(27, 2, 'student4', '2024-12-26', '2024-12-28', 2, 'mit', 'kein', 'keine', 'ja', 'test3', '2024-12-24 02:13:16', 'neu'),
(28, 3, 'student4', '2024-12-26', '2024-12-28', 2, 'mit', 'kein', 'keine', 'ja', 'test3', '2024-12-24 02:15:15', 'neu');

--
-- Trigger `reservations`
--
DELIMITER $$
CREATE TRIGGER `after_reservation_delete` AFTER DELETE ON `reservations` FOR EACH ROW BEGIN
    -- Prüfen, ob noch Reservierungen für das Zimmer existieren
    IF NOT EXISTS (
        SELECT 1
        FROM reservations
        WHERE room_id = OLD.room_id
    ) THEN
        -- Setze das Zimmer auf verfügbar
        UPDATE rooms
        SET available = 1
        WHERE room_id = OLD.room_id;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_reservation_insert` AFTER INSERT ON `reservations` FOR EACH ROW BEGIN
    UPDATE rooms
    SET available = 0
    WHERE room_id = NEW.room_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price_per_night` decimal(10,2) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `rooms`
--

INSERT INTO `rooms` (`room_id`, `category`, `price_per_night`, `available`) VALUES
(1, 'Einzelzimmer', 80.00, 0),
(2, 'Doppelzimmer', 120.00, 0),
(3, 'Suite', 200.00, 0),
(4, 'Einzelzimmer', 80.00, 1),
(5, 'Doppelzimmer', 120.00, 1),
(6, 'Einzelzimmer', 80.00, 1),
(7, 'Doppelzimmer', 120.00, 1),
(8, 'Suite', 200.00, 1),
(9, 'Einzelzimmer', 50.00, 1),
(10, 'Einzelzimmer', 50.00, 1),
(11, 'Einzelzimmer', 50.00, 1),
(12, 'Einzelzimmer', 50.00, 1),
(13, 'Doppelzimmer', 80.00, 1),
(14, 'Doppelzimmer', 80.00, 1),
(15, 'Doppelzimmer', 80.00, 1),
(16, 'Doppelzimmer', 80.00, 1),
(17, 'Suite', 120.00, 1),
(18, 'Suite', 120.00, 1),
(19, 'Suite', 120.00, 1),
(20, 'Suite', 120.00, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(260) NOT NULL,
  `useremail` varchar(100) NOT NULL,
  `role` enum('user','admin','anonym') NOT NULL DEFAULT 'anonym',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `useremail`, `role`, `created_at`) VALUES
(3, 'jhbhjew', '$2y$10$ruE9cYrOUaoFiO.YEUHHd.KW0LjLVe1DkqrajfUlUIAcgxCzF9aIK', 'ndbew@bhjbdhj.com', 'user', '2024-12-20 01:09:34'),
(4, 'student1', '$2y$10$tWUbAfAoIbA9AOIXBDysK.n33dMBWReWnBAfAzA1fK4t5tZWYkoI2', 'student1@email.com', 'user', '2024-12-20 01:09:34'),
(5, 'student2', '$2y$10$Kl4Vc6xlesD0hlDQ1qhLueOrkIBSULHmQtIxUBgkqQQ/xNlKv48hW', 'student2@somedomain.at', 'user', '2024-12-20 01:09:34'),
(6, 'student3', '$2y$10$zj6V8DVuWhn1XStfi6UTweglu7Lr9Uc8jPXUABxjrVvwv8myLz33y', 'student3@somedomain.at', 'user', '2024-12-20 01:09:34'),
(7, 'student4', '$2y$10$ZhGf0rghKHPXup23aoX9LOv7YO1FzSK1FSjHBvy7uhGOxqOxYGzuO', 'student4@somedomain.at', 'user', '2024-12-20 01:09:34'),
(8, 'admin', '$2y$10$rnR3Qd0.LZ342E.pt3AGpui0GaKrozayoz57jyZmSSNl/KqdS7Pj.', 'admin@blickglueck.at', 'admin', '2024-12-21 15:37:53'),
(9, 'student5', '$2y$10$g3LGAG2o5mMBM407SL/QuO0AwK6YvWFnP.109n66atfjd.9jXKUGS', 'student5@somedomain.at', 'user', '2024-12-22 14:34:52'),
(10, 'student6', '$2y$10$5Q2e5xf1AvqNGYvtaMKPJO/geLccXn6bZgJ3PsyeenTPfzXnPz3Ze', 'student6@somedomain.at', 'user', '2024-12-23 20:21:01');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD UNIQUE KEY `unique_reservation` (`room_id`,`check_in_date`,`check_out_date`),
  ADD KEY `fk_username` (`username`);

--
-- Indizes für die Tabelle `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `useremail` (`useremail`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT für Tabelle `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
