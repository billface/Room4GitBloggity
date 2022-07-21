-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: shareddb-z.hosting.stackcp.net
-- Generation Time: Jul 21, 2022 at 12:07 PM
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
CREATE DATABASE IF NOT EXISTS `room4Two-3136353c69` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `room4Two-3136353c69`;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `permissions` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `email`, `password`, `permissions`) VALUES
(1, 'Philip Davies', 'philipdorknessdavies@gmail.com', NULL, 0),
(2, 'David Philips', 'bill_face@hotmail.com', NULL, 0),
(3, 'Phil', 'piratemac541@gmail.com', '$2y$10$F70XsH2dq4MAvlqFIvTr4O2hcMsXbFZvDbgCJsOzytg36cqrdc9.y', 0),
(4, 'John smith', 'kendoturtle@gmail.com', '$2y$10$48TGXs6a3hOCfc7TEweYzudL3Vce8y0bDQsCF29LuR96KdgcjDUpW', 0),
(5, 'Joe Mama', 'oniomnimon@gmail.com', '$2y$10$wK3A2VaOmsCduCVeZeMjhOx1MswwVajqooJw4C91lQFsy1y4cRnQm', 0),
(6, 'Tina O\'Toole', 'kitkitdavies@gmail.com', '$2y$10$QrLwn8Mg8/swCNDpRRwtd.ZDvAlcaxuEUubWhOr052s.k0xrtDWkK', 0),
(7, 'Testy', 'testytester@gmail.com', '$2y$10$Gjo9MSg5C42em5gY5PVuY.7MqwcjeXwNFCS4291L1o2X9fWABRoSm', 7);

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
  `blogImageName` varchar(255) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `blogcat`
--

CREATE TABLE `blogcat` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_cat_join`
--

CREATE TABLE `blog_cat_join` (
  `blogId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `commText` text DEFAULT NULL,
  `commDate` date DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `commBlogId` int(11) DEFAULT NULL,
  `commModDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `commText`, `commDate`, `authorId`, `commBlogId`, `commModDate`) VALUES
(30, 'Another Comment. edited', '2021-12-10', 2, 2, '2021-12-13 14:21:51'),
(79, 'adding a comment on 3', '2021-12-23', 2, 49, NULL),
(80, 'adding another comment on 3 to edit', '2021-12-23', 2, 49, '2021-12-23 13:14:19'),
(83, 'adding another comment on 2???', '2021-12-23', 2, 2, '2021-12-23 13:19:47'),
(84, 'Addding a comment, that I can edit', '2021-12-24', 2, 50, '2021-12-24 11:18:24'),
(85, 'adding a comment to edit', '2021-12-30', 2, 1, '2021-12-30 16:06:11'),
(88, 'Adding a comment', '2022-01-10', 2, 53, NULL),
(89, 'Adding a comment', '2022-01-10', 2, 53, NULL),
(90, 'adding another comment', '2022-01-10', 2, 53, NULL),
(93, 'This is a serious blog, for serious people. Any further cartoon references will be moderated', '2022-01-10', 3, 58, NULL),
(94, '??', '2022-01-10', 3, 59, NULL),
(95, 'Great, do you get am email when i send this?', '2022-05-27', 7, 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `eventHeading` varchar(255) DEFAULT NULL,
  `eventText` varchar(255) DEFAULT NULL,
  `eventDate` datetime DEFAULT NULL,
  `eventImageName` varchar(255) DEFAULT NULL,
  `eventFileName` varchar(255) DEFAULT NULL,
  `authorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `itemHeading` varchar(255) DEFAULT NULL,
  `itemText` varchar(255) DEFAULT NULL,
  `itemImageName` varchar(255) DEFAULT NULL,
  `itemFileName` varchar(255) DEFAULT NULL,
  `itemPrice` int(11) NOT NULL DEFAULT 0,
  `authorId` int(11) DEFAULT NULL,
  `outOfStock` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `itemHeading`, `itemText`, `itemImageName`, `itemFileName`, `itemPrice`, `authorId`, `outOfStock`) VALUES
(1, 'Apples', '<p>These are particularly lovely apples</p>', 'apples', 'apples.jpeg', 1, 7, 1),
(2, 'Banana', '<p>a big one</p>', 'banana', 'banana.jpeg', 0, 7, 0),
(3, 'Grapes', '<p>mmmh</p>', 'grapes', 'grapes.jpeg', 1, 7, 0),
(4, 'edcedcecd', '<p>e2cecdedc</p>', 'edxxdexde', NULL, 1, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemdesc`
--

CREATE TABLE `itemdesc` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemdesc`
--

INSERT INTO `itemdesc` (`id`, `name`) VALUES
(1, 'Rotten'),
(2, 'Ripe');

-- --------------------------------------------------------

--
-- Table structure for table `itemsize`
--

CREATE TABLE `itemsize` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemsize`
--

INSERT INTO `itemsize` (`id`, `name`) VALUES
(1, 'Big'),
(2, 'Little');

-- --------------------------------------------------------

--
-- Table structure for table `item_desc_join`
--

CREATE TABLE `item_desc_join` (
  `itemId` int(11) NOT NULL,
  `descId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_desc_join`
--

INSERT INTO `item_desc_join` (`itemId`, `descId`) VALUES
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `item_size_join`
--

CREATE TABLE `item_size_join` (
  `itemId` int(11) NOT NULL,
  `sizeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_size_join`
--

INSERT INTO `item_size_join` (`itemId`, `sizeId`) VALUES
(2, 1),
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE `meta` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `pageHeading` varchar(255) DEFAULT NULL,
  `pageText` varchar(255) DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `metaDescription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `pageHeading`, `pageText`, `authorId`, `metaDescription`) VALUES
(1, 'Home Page', 'This is the home page', 7, 'homepage'),
(2, 'About Page', 'This is the about page', 7, 'aboutpage');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogcat`
--
ALTER TABLE `blogcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_cat_join`
--
ALTER TABLE `blog_cat_join`
  ADD PRIMARY KEY (`blogId`,`categoryId`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemdesc`
--
ALTER TABLE `itemdesc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemsize`
--
ALTER TABLE `itemsize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_desc_join`
--
ALTER TABLE `item_desc_join`
  ADD PRIMARY KEY (`itemId`,`descId`);

--
-- Indexes for table `item_size_join`
--
ALTER TABLE `item_size_join`
  ADD PRIMARY KEY (`itemId`,`sizeId`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `blogcat`
--
ALTER TABLE `blogcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `itemdesc`
--
ALTER TABLE `itemdesc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `itemsize`
--
ALTER TABLE `itemsize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
