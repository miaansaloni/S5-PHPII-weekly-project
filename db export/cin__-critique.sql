-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 17, 2024 alle 16:36
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ciné-critique`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `director` varchar(100) NOT NULL,
  `year` varchar(20) NOT NULL,
  `summary` mediumtext NOT NULL,
  `review` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `posts`
--

INSERT INTO `posts` (`id`, `title`, `director`, `year`, `summary`, `review`) VALUES
(1, 'Parasite', ' Bong Joon-ho', '2019', 'In \"Parasite,\" directed by Bong Joon-ho, a poor family, the Kims, cunningly infiltrate themselves into the lives of the wealthy Park family. As their symbiotic relationship evolves, secrets and lies threaten to unravel their carefully constructed facade, leading to a shocking and violent confrontation.', '\"Parasite\" is a masterful exploration of social class and inequality, skillfully blending dark comedy, suspense, and drama. Bong Joon-ho\'s direction is impeccable, drawing viewers into a gripping narrative that keeps them on the edge of their seats. The performances are outstanding across the board, with each actor bringing depth and nuance to their roles. The film\'s sharp commentary on wealth disparity and the lengths people will go to in pursuit of a better life resonates long after the credits roll. \"Parasite\" is a cinematic tour de force that deserves every accolade it has received.'),
(4, 'Inception', 'Christopher Nolan', '2010', 'Directed by Christopher Nolan, \"Inception\" follows Dom Cobb, a skilled thief who specializes in the art of extraction—stealing valuable secrets from deep within the subconscious during the dream state. Cobb is offered a chance at redemption with a seemingly impossible task: instead of stealing an idea, he must plant one. As Cobb and his team navigate the intricate layers of dreams within dreams, they face increasingly perilous challenges and question the nature of reality itself.', 'Directed by Christopher Nolan, \"Inception\" follows Dom Cobb, a skilled thief who specializes in the art of extraction—stealing valuable secrets from deep within the subconscious during the dream state. Cobb is offered a chance at redemption with a seemingly impossible task: instead of stealing an idea, he must plant one. As Cobb and his team navigate the intricate layers of dreams within dreams, they face increasingly perilous challenges and question the nature of reality itself.'),
(5, 'The Shawshank Redemption', 'Frank Darabont', '1994', 'Based on a novella by Stephen King, \"The Shawshank Redemption,\" directed by Frank Darabont, tells the story of Andy Dufresne, a banker who is sentenced to life in Shawshank State Penitentiary for the murder of his wife and her lover, a crime he claims he did not commit. Inside the brutal confines of the prison, Andy forms an unlikely friendship with fellow inmate Ellis \"Red\" Redding. Through perseverance, ingenuity, and unwavering hope, Andy navigates the complexities of prison life while secretly planning his escape.', '\"The Shawshank Redemption\" is a timeless tale of resilience, friendship, and the enduring power of the human spirit. Frank Darabont\'s direction is understated yet impactful, allowing the story and characters to take center stage. Tim Robbins delivers a hauntingly poignant performance as Andy Dufresne, while Morgan Freeman shines as the wise and introspective Red. The film\'s themes of redemption and the triumph of hope over despair resonate deeply with audiences, making it a beloved classic. With its poignant storytelling, memorable performances, and powerful message of hope, \"The Shawshank Redemption\" stands as a testament to the enduring power of cinema.'),
(6, 'Echoes of Eternity', 'Sofia Ramirez', '2023', 'Set in the heart of the Swiss Alps, a young violinist, Anna, finds herself grappling with her own mind and the shadows of the past as she strives to perfect her musical talent. With the support of her mentor, the legendary violinist Daniel, Anna embarks on a thrilling and therapeutic journey through music and nature. However, as dark secrets come to light and fate presents her with an impossible choice, Anna must find the inner strength to confront her destiny and seek redemption through the notes of a violin.', '\"Echoes of Eternity\" is a visually stunning film that masterfully blends the beauty of classical music with the grandeur of nature. Sofia Ramirez sensitively directs this poignant tale of personal growth and inner healing. The film perfectly captures the essence of human struggle and resilience, while the cast delivers touching performances, particularly Anna Kendrick\'s compelling portrayal of Anna. With a soul-stirring soundtrack and a gripping plot that keeps the viewer glued to the screen, \"Echoes of Eternity\" is an unforgettable cinematic experience that leaves a lasting impression.');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `adminUser` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `adminUser`, `password`) VALUES
(1, 'mia.ansaloni', 'Password'),
(2, 'User2', '123'),
(5, 'User8', '000');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`adminUser`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
