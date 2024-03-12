-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 06:08 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meczykiblog`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `submission_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `text`, `submission_date`) VALUES
(1, 'Test 1', 'hello world', '2024-03-21'),
(2, 'Test 2', 'Lorem ipsum', '2024-03-10'),
(3, 'Test 3', 'What\'s my name', '2024-03-09'),
(4, 'Test 4', 'DOlor', '2024-03-08'),
(5, 'Test 5', 'Ipsum', '2024-03-08'),
(6, 'Test 6', 'próba', '2024-03-09'),
(7, '7', '77', '2024-03-10'),
(8, '8', 'test 8', '2024-03-10'),
(9, '9', 'test 364637', '2024-03-08');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `article_authors`
--

CREATE TABLE `article_authors` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article_authors`
--

INSERT INTO `article_authors` (`id`, `article_id`, `author_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 2),
(4, 3, 1),
(5, 3, 10),
(6, 4, 1),
(7, 4, 7),
(8, 5, 9),
(9, 6, 8),
(10, 7, 8),
(11, 8, 8),
(12, 8, 9),
(13, 9, 1),
(14, 9, 8),
(15, 9, 9);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Jan Kowalski'),
(2, 'Anna Nowak'),
(3, 'Katarzyna Dąbrowska'),
(4, 'Marek Wójcik'),
(5, 'Agnieszka Kozłowska'),
(6, 'Tomasz Zając'),
(7, 'Małgorzata Mazur'),
(8, 'Marcin Krawczyk'),
(9, 'Joanna Pawlak'),
(10, '!111');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `article_authors`
--
ALTER TABLE `article_authors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_article_id` (`article_id`),
  ADD KEY `fk_author_id` (`author_id`);

--
-- Indeksy dla tabeli `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `article_authors`
--
ALTER TABLE `article_authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article_authors`
--
ALTER TABLE `article_authors`
  ADD CONSTRAINT `article_authors_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `article_authors_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `fk_article_id` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `fk_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
