-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2018 at 03:01 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studygroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `user` varchar(15) NOT NULL,
  `subject` int(8) NOT NULL,
  `school` int(8) NOT NULL,
  `time` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `convo`
--

CREATE TABLE `convo` (
  `id` int(20) NOT NULL,
  `user1` varchar(15) DEFAULT NULL,
  `user2` varchar(15) DEFAULT NULL,
  `groups` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `convo`
--

INSERT INTO `convo` (`id`, `user1`, `user2`, `groups`) VALUES
(1, 'TheCodeCowboy', 'ChuckNorris', NULL),
(2, NULL, NULL, 1),
(3, NULL, NULL, 2),
(4, 'smithers', 'TheCodeCowboy', NULL),
(5, 'TheCodeCowboy', 'testNull', NULL),
(6, 'TheCodeCowboy', 'UserInterface', NULL),
(7, 'TheCodeCowboy', 'shreya_thumma', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follower` varchar(15) NOT NULL,
  `following` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`follower`, `following`) VALUES
('shreya_thumma', 'ChuckNorris'),
('smithers', 'TestTroy'),
('smithers', 'TheCodeCowboy'),
('smithers', 'UserInterface'),
('tee', 'ChuckNorris'),
('tee', 'shreya_thumma'),
('TheCodeCowboy', 'ChuckNorris'),
('TheCodeCowboy', 'testNull');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(20) NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'Test Group'),
(2, 'group 2'),
(3, NULL),
(4, NULL),
(5, NULL),
(6, NULL),
(7, NULL),
(8, 'this'),
(9, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `learning`
-- (See below for the actual view)
--
CREATE TABLE `learning` (
`ID` int(3)
,`subject` int(8)
,`name` varchar(25)
);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `groups` int(20) NOT NULL,
  `user` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`groups`, `user`) VALUES
(1, 'smithers'),
(1, 'testNull'),
(1, 'TestTroy'),
(1, 'TheCodeCowboy'),
(1, 'UserInterface'),
(2, 'testNull'),
(2, 'TheCodeCowboy'),
(3, 'TheCodeCowboy'),
(4, 'TheCodeCowboy'),
(5, 'TheCodeCowboy'),
(6, 'ChuckNorris'),
(7, 'smithers'),
(8, 'smithers'),
(9, 'ChuckNorris'),
(9, 'shreya_thumma'),
(9, 'tee');

-- --------------------------------------------------------

--
-- Table structure for table `pm`
--

CREATE TABLE `pm` (
  `id` int(20) NOT NULL,
  `convo` int(20) NOT NULL,
  `sender` varchar(15) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pm`
--

INSERT INTO `pm` (`id`, `convo`, `sender`, `text`) VALUES
(1, 1, 'TheCodeCowboy', 'yo'),
(2, 2, 'TheCodeCowboy', 'yo: version 2'),
(4, 3, 'TheCodeCowboy', 'hi'),
(19, 3, 'TheCodeCowboy', 'test'),
(20, 2, 'smithers', 'test'),
(21, 2, 'smithers', 'test'),
(22, 1, 'TheCodeCowboy', 'whats up?'),
(23, 1, 'TheCodeCowboy', 'test'),
(24, 4, 'smithers', 'hey'),
(25, 5, 'TheCodeCowboy', 'yo'),
(26, 6, 'TheCodeCowboy', 'wazzup'),
(27, 2, 'TheCodeCowboy', 'hey'),
(28, 7, 'TheCodeCowboy', 'it works'),
(29, 1, 'TheCodeCowboy', 'hey'),
(30, 7, 'TheCodeCowboy', 'hey! what\'s up ?');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `ID` int(8) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`ID`, `name`) VALUES
(1, 'Troy University'),
(2, 'Georgia Tech'),
(3, 'Florida State'),
(4, 'Emory University');

-- --------------------------------------------------------

--
-- Table structure for table `strength`
--

CREATE TABLE `strength` (
  `Username` varchar(15) NOT NULL,
  `subject` int(8) NOT NULL,
  `topic` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `strength`
--

INSERT INTO `strength` (`Username`, `subject`, `topic`) VALUES
('ChuckNorris', 1, 1),
('ChuckNorris', 1, 2),
('ChuckNorris', 1, 5),
('ChuckNorris', 1, 6),
('ChuckNorris', 1, 7),
('ChuckNorris', 1, 10),
('ChuckNorris', 3, 3),
('ChuckNorris', 3, 23),
('ChuckNorris', 3, 24),
('ChuckNorris', 4, 4),
('ChuckNorris', 4, 8),
('ChuckNorris', 4, 9),
('ChuckNorris', 4, 11),
('ChuckNorris', 8, 14),
('ChuckNorris', 8, 16),
('ChuckNorris', 8, 18),
('ChuckNorris', 8, 20),
('ChuckNorris', 8, 22),
('NullTest', 1, 2),
('shreya_thumma', 1, 2),
('shreya_thumma', 1, 7),
('shreya_thumma', 5, 26),
('shreya_thumma', 11, 30),
('smithers', 1, 2),
('smithers', 1, 7),
('tee', 1, 1),
('tee', 1, 6),
('TheCodeCowboy', 1, 1),
('TheCodeCowboy', 1, 6),
('TheCodeCowboy', 1, 10),
('TheCodeCowboy', 2, 2),
('TheCodeCowboy', 3, 3),
('TheCodeCowboy', 3, 23),
('TheCodeCowboy', 8, 14),
('TheCodeCowboy', 8, 16),
('TheCodeCowboy', 8, 22),
('TheCodeCowboy', 9, 12),
('UserInterface', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `ID` int(8) NOT NULL,
  `name` varchar(25) NOT NULL,
  `department` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`ID`, `name`, `department`) VALUES
(1, 'Web Based Development', 'Computer Science'),
(2, 'Concepts of AI', 'Computer Science'),
(3, 'Analysis of Algorithms', 'Computer Science'),
(4, 'Software Engineering', 'Computer Science'),
(5, 'Calculus I', 'Math'),
(6, 'Calculus II', 'Math'),
(7, 'Spanish I', 'Spanish'),
(8, 'Spanish II', 'Spanish'),
(9, 'Operating Systems', 'Computer Science'),
(10, 'Applied Discrete Math', 'Math'),
(11, 'Microeconomics', 'Business');

-- --------------------------------------------------------

--
-- Table structure for table `taking`
--

CREATE TABLE `taking` (
  `user` varchar(15) NOT NULL,
  `subject` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taking`
--

INSERT INTO `taking` (`user`, `subject`) VALUES
('ChuckNorris', 1),
('ChuckNorris', 3),
('ChuckNorris', 4),
('ChuckNorris', 8),
('NullTest', 1),
('shreya_thumma', 1),
('shreya_thumma', 5),
('shreya_thumma', 11),
('smithers', 1),
('smithers', 2),
('tee', 1),
('TheCodeCowboy', 1),
('TheCodeCowboy', 2),
('TheCodeCowboy', 3),
('TheCodeCowboy', 8),
('TheCodeCowboy', 9),
('UserInterface', 1);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `ID` int(3) NOT NULL,
  `subject` int(8) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`ID`, `subject`, `name`) VALUES
(1, 1, 'PHP'),
(1, 2, 'Graph traversal'),
(2, 1, 'HTML'),
(2, 2, 'Knowledge bases'),
(3, 3, 'Dynamic Programming'),
(4, 4, 'Android Development'),
(5, 1, 'Python'),
(6, 1, 'SQL'),
(7, 1, 'CSS'),
(8, 4, 'SQL'),
(9, 4, 'JAVA'),
(10, 1, 'XML'),
(11, 4, 'XML'),
(12, 9, 'Deadlock'),
(13, 7, 'Vocabulary'),
(14, 8, 'Vocabulary'),
(15, 7, 'Conjugation'),
(16, 8, 'Conjugation'),
(17, 7, 'Listening'),
(18, 8, 'Listening'),
(19, 7, 'Reading'),
(20, 8, 'Reading'),
(21, 7, 'Speaking'),
(22, 8, 'Speaking'),
(23, 3, 'Greedy Algorithms'),
(24, 3, 'Telescoping'),
(25, 4, 'API'),
(26, 5, 'Limits'),
(27, 7, 'Writing'),
(28, 10, 'Logic'),
(29, 10, 'Set theory'),
(30, 11, 'Demand/Supply');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `First Name` varchar(15) NOT NULL,
  `Last Name` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `school` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `First Name`, `Last Name`, `email`, `school`) VALUES
('ChuckNorris', 'Chuck', 'Chuck', 'Norris', 'ChuckNorris@ChuckNor', NULL),
('NullTest', '123', 'Null', 'Test', 'Null@gmail.com', NULL),
('shreya_thumma', 'shreyathumma', 'Shreya', 'Thumma', 'kthumma@troy.edu', 1),
('smithers', '123', 'John', 'Smith', 'smithdude@aol.com', 2),
('tee', '123', 'tarance', 'thompson', 'tarance16@gmail.com', 1),
('testNull', '123', 'Test', 'Null', 'test2@gmail.com', NULL),
('TestTroy', '123', 'Test', 'Troy', 'test1@troy.edu', 1),
('TheCodeCowboy', '12345', 'Travis', 'Maupin', 'tmaupin@troy.edu', 1),
('UserInterface', '123', 'User', 'Interface', 'UI@GT.edu', 2);

-- --------------------------------------------------------

--
-- Table structure for table `weakness`
--

CREATE TABLE `weakness` (
  `Username` varchar(15) NOT NULL,
  `subject` int(8) NOT NULL,
  `topic` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weakness`
--

INSERT INTO `weakness` (`Username`, `subject`, `topic`) VALUES
('shreya_thumma', 1, 1),
('smithers', 1, 1),
('smithers', 1, 5),
('tee', 1, 2),
('tee', 1, 7),
('TheCodeCowboy', 1, 2),
('TheCodeCowboy', 1, 5),
('TheCodeCowboy', 1, 7),
('TheCodeCowboy', 3, 24),
('TheCodeCowboy', 8, 18),
('TheCodeCowboy', 8, 20);

-- --------------------------------------------------------

--
-- Structure for view `learning`
--
DROP TABLE IF EXISTS `learning`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `learning`  AS  select `a`.`ID` AS `ID`,`a`.`subject` AS `subject`,`a`.`name` AS `name` from (`topic` `a` join `taking` `b`) where (`a`.`subject` = `b`.`subject`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`user`,`subject`,`school`,`time`),
  ADD KEY `school` (`school`),
  ADD KEY `subject` (`subject`);

--
-- Indexes for table `convo`
--
ALTER TABLE `convo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1` (`user1`),
  ADD KEY `user2` (`user2`),
  ADD KEY `groups` (`groups`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follower`,`following`),
  ADD KEY `following` (`following`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`groups`,`user`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `pm`
--
ALTER TABLE `pm`
  ADD PRIMARY KEY (`id`,`convo`),
  ADD KEY `convo` (`convo`),
  ADD KEY `sender` (`sender`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`ID`,`name`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `strength`
--
ALTER TABLE `strength`
  ADD PRIMARY KEY (`Username`,`subject`,`topic`),
  ADD KEY `topic` (`topic`),
  ADD KEY `strength_ibfk_3` (`subject`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `taking`
--
ALTER TABLE `taking`
  ADD PRIMARY KEY (`user`,`subject`),
  ADD KEY `subject` (`subject`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`ID`,`subject`),
  ADD KEY `subject` (`subject`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `UNIQUE` (`email`),
  ADD KEY `school` (`school`);

--
-- Indexes for table `weakness`
--
ALTER TABLE `weakness`
  ADD PRIMARY KEY (`Username`,`subject`,`topic`),
  ADD KEY `topic` (`topic`),
  ADD KEY `weakness_ibfk_3` (`subject`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `convo`
--
ALTER TABLE `convo`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pm`
--
ALTER TABLE `pm`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`Username`),
  ADD CONSTRAINT `class_ibfk_2` FOREIGN KEY (`school`) REFERENCES `school` (`ID`),
  ADD CONSTRAINT `class_ibfk_3` FOREIGN KEY (`subject`) REFERENCES `subject` (`ID`);

--
-- Constraints for table `convo`
--
ALTER TABLE `convo`
  ADD CONSTRAINT `convo_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `convo_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `convo_ibfk_3` FOREIGN KEY (`groups`) REFERENCES `groups` (`id`);

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`following`) REFERENCES `user` (`username`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `member_ibfk_2` FOREIGN KEY (`groups`) REFERENCES `groups` (`id`);

--
-- Constraints for table `pm`
--
ALTER TABLE `pm`
  ADD CONSTRAINT `pm_ibfk_1` FOREIGN KEY (`convo`) REFERENCES `convo` (`id`),
  ADD CONSTRAINT `pm_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `user` (`username`);

--
-- Constraints for table `strength`
--
ALTER TABLE `strength`
  ADD CONSTRAINT `strength_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `strength_ibfk_2` FOREIGN KEY (`topic`) REFERENCES `topic` (`ID`),
  ADD CONSTRAINT `strength_ibfk_3` FOREIGN KEY (`subject`) REFERENCES `subject` (`ID`);

--
-- Constraints for table `taking`
--
ALTER TABLE `taking`
  ADD CONSTRAINT `taking_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `taking_ibfk_2` FOREIGN KEY (`subject`) REFERENCES `subject` (`ID`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`subject`) REFERENCES `subject` (`ID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`school`) REFERENCES `school` (`ID`);

--
-- Constraints for table `weakness`
--
ALTER TABLE `weakness`
  ADD CONSTRAINT `weakness_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `weakness_ibfk_2` FOREIGN KEY (`topic`) REFERENCES `topic` (`ID`),
  ADD CONSTRAINT `weakness_ibfk_3` FOREIGN KEY (`subject`) REFERENCES `subject` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
