-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Maj 2019, 12:21
-- Wersja serwera: 10.1.38-MariaDB
-- Wersja PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `seo`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accounts`
--

CREATE TABLE `accounts` (
  `login` varchar(20) NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `accounts`
--

INSERT INTO `accounts` (`login`, `pass`) VALUES
('admin', 'admin'),
('Java', 'Script'),
('John', 'Wick'),
('Leon', 'Zawodowiec'),
('login', 'haslo'),
('SYMFONY', 'HASLO_SYMFONY');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `changes`
--

CREATE TABLE `changes` (
  `change_id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `changes`
--

INSERT INTO `changes` (`change_id`, `name`) VALUES
(2, 'Wgranie sitemap na server'),
(3, 'Zamiana Http na https'),
(4, 'Dodanie do stron nag?ówka h1'),
(5, 'Dodanie do stron meta title'),
(6, 'Dodanie do strony meta description'),
(7, 'Zmiana na stronie meta title'),
(8, 'Zmiana na stronie meta description'),
(9, 'Dodanie do grafiki podpisu title'),
(10, 'Dodanie do grafiki podpisu alt'),
(11, 'Kompresja grafiki'),
(12, 'Dodanie google search console'),
(13, 'Dodanie google anatitycs'),
(14, 'Stworzenie google moja firma'),
(15, 'Zamiana adresów url - mod_rewrite');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `changes_site_changes`
--

CREATE TABLE `changes_site_changes` (
  `change_id` int(11) NOT NULL,
  `site_changes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `changes_site_changes`
--

INSERT INTO `changes_site_changes` (`change_id`, `site_changes_id`) VALUES
(2, 1),
(3, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190428180001', '2019-04-28 18:04:05');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sites`
--

CREATE TABLE `sites` (
  `site_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `name` text NOT NULL,
  `mail` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `sites`
--

INSERT INTO `sites` (`site_id`, `url`, `name`, `mail`) VALUES
(1, 'url', 'name', NULL),
(2, 'onet.pl', 'onet', NULL),
(3, 'wp.pl', 'wp', NULL),
(4, 'fb', 'fb', NULL),
(5, 'nkjnkjnkjn', 'jnknk', 'nkjnkjnkjn'),
(6, 'nkjnkjnkjn', 'jnknk', 'nkjnkjnkjn'),
(7, 'Nowa strona url', 'Nowa strona name', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `site_changes`
--

CREATE TABLE `site_changes` (
  `site_changes_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `changeDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `site_changes`
--

INSERT INTO `site_changes` (`site_changes_id`, `site_id`, `changeDate`) VALUES
(1, 1, '2019-03-12'),
(2, 1, '2019-04-15'),
(3, 2, '2018-01-01'),
(4, 1, '2991-01-01'),
(5, 1, '2991-01-01'),
(6, 1, '2991-01-01'),
(7, 1, '2019-05-24'),
(8, 1, '2019-05-24'),
(9, 1, '2019-05-24');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`login`);

--
-- Indeksy dla tabeli `changes`
--
ALTER TABLE `changes`
  ADD PRIMARY KEY (`change_id`);

--
-- Indeksy dla tabeli `changes_site_changes`
--
ALTER TABLE `changes_site_changes`
  ADD KEY `change_id` (`change_id`),
  ADD KEY `site_changes_id` (`site_changes_id`);

--
-- Indeksy dla tabeli `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indeksy dla tabeli `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`site_id`);

--
-- Indeksy dla tabeli `site_changes`
--
ALTER TABLE `site_changes`
  ADD PRIMARY KEY (`site_changes_id`),
  ADD KEY `site_id` (`site_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `changes`
--
ALTER TABLE `changes`
  MODIFY `change_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `sites`
--
ALTER TABLE `sites`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `site_changes`
--
ALTER TABLE `site_changes`
  MODIFY `site_changes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `changes_site_changes`
--
ALTER TABLE `changes_site_changes`
  ADD CONSTRAINT `changes_site_changes_ibfk_1` FOREIGN KEY (`change_id`) REFERENCES `changes` (`change_id`),
  ADD CONSTRAINT `changes_site_changes_ibfk_2` FOREIGN KEY (`site_changes_id`) REFERENCES `site_changes` (`site_changes_id`);

--
-- Ograniczenia dla tabeli `site_changes`
--
ALTER TABLE `site_changes`
  ADD CONSTRAINT `site_changes_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`site_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
