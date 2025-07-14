-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 06:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('M','F','O') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `phone`, `dob`, `gender`) VALUES
(5, 'Christi', 'Fernandes', 'christieee01@gmail.com', '9579286178', '2025-07-03', 'F'),
(7, 'Alice', 'Smith', 'alice.smith@example.com', '9876543210', '1995-04-12', 'F'),
(8, 'Bob', 'Johnson', 'bob.johnson@example.com', '9123456789', '1990-11-23', 'M'),
(9, 'Clar', 'Lee', 'clara.lee@example.com', '9988776655', '1992-01-15', 'F'),
(10, 'David', 'Morris', 'david.morris@example.com', '9345678901', '1988-06-30', 'M'),
(11, 'Emily', 'Davis', 'emily.davis@example.com', '9090909090', '1997-09-25', 'F'),
(13, 'Grace', 'Bennett', 'grace.bennett@example.com', '9871122334', '1993-07-08', 'F'),
(14, 'Harry', 'Clark', 'harry.clark@example.com', '9001234567', '1991-10-02', 'M'),
(15, 'Irene', 'Hughes', 'irene.hughes@example.com', '9988776651', '1996-12-19', 'F'),
(16, 'Jake', 'Turner', 'jake.turner@example.com', '9345678910', '1989-08-21', 'M'),
(18, '', '', '', '', '0000-00-00', ''),
(19, '', '', '', '', '0000-00-00', ''),
(20, '', '', '', '', '0000-00-00', ''),
(22, '', '', '', '', '0000-00-00', ''),
(23, '', '', '', '', '0000-00-00', ''),
(26, 'kjfsc', 'm kn mk', 'christieee01@gmail.com', '9579286178', '2025-07-06', 'F'),
(27, 'Alice', 'Johnson', 'christie.ferns36@gmail.com', '1234567890', '2025-07-07', 'F'),
(28, 'Alice', 'Johnson', 'christie.ferns36@gmail.com', '1234567890', '2025-07-07', 'F'),
(29, 'Alice', 'm kn mk', 'christie.ferns36@gmail.com', '1234567890', '2025-06-30', 'F'),
(30, 'Alice', 'm kn mk', 'christie.ferns36@gmail.com', '1234567890', '2025-06-30', 'F'),
(31, 'Alice', 'm kn mk', 'christie.ferns36@gmail.com', '1234567890', '2025-06-30', 'F'),
(32, 'Alice', 'm kn mk', 'christie.ferns36@gmail.com', '1234567890', '2025-06-30', 'F'),
(33, 'Alice', 'Smith', 'boolas2@f.com', '1234567890', '2025-07-06', 'F'),
(34, 'Alice', 'Smith', 'boolas2@f.com', '1234567890', '2025-07-06', 'F'),
(35, 'Alice', 'Smith', 'boolas2@f.com', '9579286178', '2025-07-06', 'F'),
(36, 'Alice', 'Smith', 'boolas2@f.com', '9579286178', '2025-07-06', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `skill` varchar(50) DEFAULT NULL,
  `proficiency_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `emp_id`, `skill`, `proficiency_level`) VALUES
(3, 28, 'dhsbcsj', 'Beginner'),
(4, 28, 'vndkf', 'Beginner'),
(5, 30, 'dhsbcsj', 'Intermediate'),
(6, 32, 'dhsbcsj', 'Intermediate'),
(7, 34, 'next new skill', 'Beginner'),
(8, 36, 'dhsbcsj', 'Beginner'),
(9, 36, 'qsewcb', 'Intermediate'),
(34, 7, 'abcd', 'Beginner'),
(51, 8, 'JavaScript', 'Intermediate'),
(52, 9, 'JavaScript', 'Intermediate'),
(53, 9, 'JavaScript', 'Intermediate'),
(55, 11, 'JavaScript', 'Intermediate'),
(56, 11, 'JavaScript', 'Intermediate'),
(57, 11, 'JavaScript', 'Intermediate'),
(65, 13, 'abcd', 'Advanced'),
(81, 15, 'dhsbcsj', 'Advanced'),
(83, 14, 'JavaScript', 'Intermediate'),
(87, 16, 'JavaScript', 'Advanced'),
(95, 10, 'hghvb ', 'Intermediate'),
(97, 8, 'JavaScript', 'Beginner'),
(100, 5, 'abcd', 'Beginner'),
(101, 5, 'abcd', 'Beginner'),
(102, 5, 'hghvb ', 'Intermediate'),
(111, 29, 'hghvb ', 'Beginner'),
(143, 35, 'new skill', 'Intermediate'),
(271, 33, 'working new skill', 'Intermediate');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
