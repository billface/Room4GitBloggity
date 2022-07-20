-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: shareddb-z.hosting.stackcp.net
-- Generation Time: Jul 20, 2022 at 01:08 PM
-- Server version: 10.4.14-MariaDB-log
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `room4Two-3136353c69`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `blogHeading` text DEFAULT NULL,
  `blogText` text DEFAULT NULL,
  `blogDate` datetime DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `blogModDate` datetime DEFAULT NULL,
  `metaDescription` text DEFAULT NULL,
  `blogVideo` text DEFAULT NULL,
  `blogImageName` int(255) DEFAULT NULL,
  `blogFileName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `blogHeading`, `blogText`, `blogDate`, `authorId`, `blogModDate`, `metaDescription`, `blogVideo`, `blogImageName`, `blogFileName`) VALUES
(56, 'Instructions', 'Go to add a new blog. \r\nThen Register. \r\nThen Log In. \r\nThen add a new blog. \r\nThen be thanked : )\r\nThen comment on other blogs\r\n', '2022-01-10 12:16:18', 3, '2022-01-10 12:17:37', NULL, NULL, NULL, NULL),
(57, 'its not very good yet', 'I just want to see if the basic functionality works on other browsers etc', '2022-01-10 12:20:29', 3, NULL, NULL, NULL, NULL, NULL),
(58, 'Gaming', 'Yaâ€™ll gone (pft) make me act a fool, (pft) up in here, (pft) up inâ€…here!â€…(pft) Yaâ€™ll gone (pft)â€…make me loose my (pft) cool,â€…up in here, (pft) up in here! (pft) Yaâ€™ll gone make (pft) me bust a (pft) smack, up in here, (pft) up in here! (pft) Yaâ€™ll gone make (pft) my fingers snap, (pft) up in here, (pft) up in here! (pft) Why should I battle a crusty old man When you canâ€™t even defeat a little weak Peter Pan Ya lucky this is (pft) only a beatbox (pft) battle Cause in a real battle (pft) I make ya feel rattled Look at him, (pft) he only got one planet, (pft) I got the whole Galaxy (pft) under my dependence, (pft) Youâ€™re gonna beg (pft) when you bleed and die, (pft) As you realize (pft) destiny arrived Yaâ€™ll gone (pft) make me AHBRTT AHGHHBABEBETAEBFHGAHFHBRTHBRTTTBRTTT Yaâ€™ll gone (pft) make me AHBRTT ABHTETETFBEBATEABTGTEHUAHBRHTBRHT Yaâ€™ll gone (pft) make me AHBHEHH BHRBHBAUTBAHBAUHBRHBRTTBRTT Yaâ€™ll gone (pft) make me AHBRTT SSAHBEHBEBTBSSHFBETHUFDHAHDBHTBHTT BMFAFETTYFETTYBMBM DON- DON\'T STOP BMFETTYBM DON- BMFAPFTDAH BMFAFETTYFETTYBMBM DON- DON\'T STOP BMH LET ME SHOW YOU HOW TO SCRATCH IT BMFABETEHETHETETBETBEBATBEBABETBMFABETATAHETETBETGABETEBBTEABTHABHRTBHRTHEHAHBMBETTBABTBETAEBTETBHTEHABHETAHETABM Either way, destiny still arrives BEEHYUHMM', '2022-01-10 12:28:35', 5, NULL, NULL, NULL, NULL, NULL),
(59, 'Qanon and pepsi', '2 eggs 120degrees til simmer ðŸ‘Œ', '2022-01-10 12:34:44', 4, NULL, NULL, NULL, NULL, NULL),
(60, 'Qanon and pepsi', '2 eggs 120degrees til simmer ðŸ‘Œ', '2022-01-10 12:34:47', 4, NULL, NULL, NULL, NULL, NULL),
(61, 'Random quotes', 'How pathetically scanty my self-knowledge is compared with, say, my knowledge of my roomâ€¦. There is no such thing as observation of the inner world, as there is of the outer world.', '2022-01-10 18:41:00', 6, NULL, NULL, NULL, NULL, NULL),
(62, 'Random quotes', 'Lifeâ€™s splendour forever lies in wait about each one of us in all its fullness, but veiled from view, deep down, invisible, far off. It is there, though, not hostile, not reluctant, not deaf. If you summon it by the right word, by its right name, it will come.', '2022-01-10 18:43:24', 6, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
