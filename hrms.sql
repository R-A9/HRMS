-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2024 at 03:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(50) NOT NULL,
  `flname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `resume` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `contno` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `flname`, `email`, `date`, `resume`, `role`, `contno`, `status`) VALUES
(1, 'Moral, Andrie', 'moralandrie@gmail.com', '2024-07-16', 'uploads/google.pdf', 'Senior Backend', '+639031192857', 'Rejected'),
(2, 'Dawal, Giullian Marco C.', 'dawalgiullian@gmail.com', '2024-07-31', 'uploads/23.pdf', 'Junior Programmer', '+639031192957', 'Approved'),
(3, 'sdfasdfasdf', 'asdfasdfasdf', '2024-07-03', 'asdfasdfsdf', 'asdfsdf', 'asdfasdfa', 'Approved'),
(5, 'John Doe', 'johndoe@example.com', '2024-07-01', '', 'Admin', '123-456-7890', 'Approved'),
(6, 'Jane Smith', 'janesmith@example.com', '2024-07-02', '', 'User', '123-456-7891', 'Approved'),
(7, 'Michael Johnson', 'michaelj@example.com', '2024-07-03', '', 'User', '123-456-7892', 'Approved'),
(8, 'Emily Davis', 'emilyd@example.com', '2024-07-04', '', 'Moderator', '123-456-7893', 'Approved'),
(9, 'David Brown', 'davidbrown@example.com', '2024-07-05', '', 'Admin', '123-456-7894', 'Rejected'),
(10, 'Jessica Wilson', 'jessicaw@example.com', '2024-07-06', '', 'User', '123-456-7895', 'Approved'),
(11, 'Christopher Taylor', 'christophert@example.com', '2024-07-07', '', 'User', '123-456-7896', 'Approved'),
(12, 'Amanda Miller', 'amandam@example.com', '2024-07-08', '', 'Moderator', '123-456-7897', 'pending'),
(13, 'Daniel Anderson', 'daniela@example.com', '2024-07-09', '', 'User', '123-456-7898', 'pending'),
(14, 'Sarah Thomas', 'saraht@example.com', '2024-07-10', '', 'Admin', '123-456-7899', 'pending'),
(15, 'Matthew Martinez', 'matthewm@example.com', '2024-07-11', '', 'User', '123-456-7900', 'pending'),
(16, 'Ashley Garcia', 'ashleyg@example.com', '2024-07-12', '', 'User', '123-456-7901', 'pending'),
(17, 'Joshua Rodriguez', 'joshuar@example.com', '2024-07-13', '', 'Moderator', '123-456-7902', 'pending'),
(18, 'Megan Lee', 'meganl@example.com', '2024-07-14', '', 'User', '123-456-7903', 'pending'),
(19, 'Andrew Walker', 'andreww@example.com', '2024-07-15', '', 'User', '123-456-7904', 'pending'),
(20, 'Lauren Hall', 'laurenh@example.com', '2024-07-16', '', 'Admin', '123-456-7905', 'pending'),
(21, 'Brandon Allen', 'brandonall@example.com', '2024-07-17', '', 'User', '123-456-7906', 'pending'),
(22, 'Olivia Young', 'oliviay@example.com', '2024-07-18', '', 'Moderator', '123-456-7907', 'pending'),
(23, 'Ethan King', 'ethank@example.com', '2024-07-19', '', 'User', '123-456-7908', 'pending'),
(24, 'Hannah Wright', 'hannahw@example.com', '2024-07-20', '', 'User', '123-456-7909', 'pending'),
(25, 'Ryan Hill', 'ryanh@example.com', '2024-07-21', '', 'Admin', '123-456-7910', 'pending'),
(26, 'Natalie Scott', 'natalies@example.com', '2024-07-22', '', 'User', '123-456-7911', 'pending'),
(27, 'Nathan Green', 'nathang@example.com', '2024-07-23', '', 'User', '123-456-7912', 'pending'),
(28, 'Victoria Adams', 'victoriaa@example.com', '2024-07-24', '', 'Moderator', '123-456-7913', 'pending'),
(29, 'Benjamin Nelson', 'benjaminn@example.com', '2024-07-25', '', 'User', '123-456-7914', 'pending'),
(30, 'Samantha Carter', 'samanthac@example.com', '2024-07-26', '', 'User', '123-456-7915', 'pending'),
(31, 'Alexander Mitchell', 'alexanderm@example.com', '2024-07-27', '', 'Admin', '123-456-7916', 'pending'),
(32, 'Emma Perez', 'emmap@example.com', '2024-07-28', '', 'User', '123-456-7917', 'pending'),
(33, 'Joseph Roberts', 'josephr@example.com', '2024-07-29', '', 'Moderator', '123-456-7918', 'pending'),
(34, 'Alyssa Turner', 'alyssat@example.com', '2024-07-30', '', 'User', '123-456-7919', 'pending'),
(35, 'Gabriel Phillips', 'gabrielp@example.com', '2024-07-31', '', 'User', '123-456-7920', 'pending'),
(36, 'Sophia Campbell', 'sophiac@example.com', '2024-08-01', '', 'Admin', '123-456-7921', 'pending'),
(37, 'Mason Parker', 'masonp@example.com', '2024-08-02', '', 'User', '123-456-7922', 'pending'),
(38, 'Abigail Evans', 'abigaile@example.com', '2024-08-03', '', 'Moderator', '123-456-7923', 'pending'),
(39, 'Logan Edwards', 'logane@example.com', '2024-08-04', '', 'User', '123-456-7924', 'pending'),
(40, 'Isabella Collins', 'isabellac@example.com', '2024-08-05', '', 'User', '123-456-7925', 'pending'),
(41, 'James Stewart', 'jamesst@example.com', '2024-08-06', '', 'Admin', '123-456-7926', 'pending'),
(42, 'Ella Sanchez', 'ellas@example.com', '2024-08-07', '', 'User', '123-456-7927', 'pending'),
(43, 'Elijah Morris', 'elijahm@example.com', '2024-08-08', '', 'User', '123-456-7928', 'pending'),
(44, 'Avery Morris', 'averym@example.com', '2024-08-09', '', 'Moderator', '123-456-7929', 'pending'),
(45, 'Madison Scott', 'madisons@example.com', '2024-08-10', '', 'User', '123-456-7930', 'pending'),
(46, 'Lucas Moore', 'lucasm@example.com', '2024-08-11', '', 'User', '123-456-7931', 'pending'),
(47, 'John Doe', 'john.doe@example.com', '2023-01-15', '', 'admin', '1234567890', 'pending'),
(48, 'Jane Smith', 'jane.smith@example.com', '2023-02-10', '', 'user', '0987654321', 'pending'),
(49, 'Alice Johnson', 'alice.johnson@example.com', '2023-03-05', '', 'moderator', '1122334455', 'pending'),
(50, 'Bob Brown', 'bob.brown@example.com', '2023-04-20', '', 'user', '2233445566', 'pending'),
(51, 'Charlie Black', 'charlie.black@example.com', '2023-05-25', '', 'admin', '3344556677', 'pending'),
(52, 'John Doe', 'john.doe@example.com', '2023-01-15', '', 'admin', '1234567890', 'pending'),
(53, 'Jane Smith', 'jane.smith@example.com', '2023-02-10', '', 'user', '0987654321', 'pending'),
(54, 'Alice Johnson', 'alice.johnson@example.com', '2023-03-05', '', 'moderator', '1122334455', 'pending'),
(55, 'Bob Brown', 'bob.brown@example.com', '2023-04-20', '', 'user', '2233445566', 'pending'),
(56, 'Charlie Black', 'charlie.black@example.com', '2023-05-25', '', 'admin', '3344556677', 'pending'),
(57, 'David Green', 'david.green@gmail.com', '2023-01-16', '', 'Software Developer', '1234509876', 'pending'),
(58, 'Emma White', 'emma.white@yahoo.com', '2023-02-11', '', 'System Administrator', '9876543210', 'pending'),
(59, 'Liam Miller', 'liam.miller@protonmail.com', '2023-03-06', '', 'Network Engineer', '3456789012', 'pending'),
(60, 'Sophia Taylor', 'sophia.taylor@hotmail.com', '2023-04-21', '', 'Database Administrator', '2345678901', 'pending'),
(61, 'James Anderson', 'james.anderson@gmail.com', '2023-05-26', '', 'DevOps Engineer', '4567890123', 'pending'),
(62, 'Olivia Martinez', 'olivia.martinez@yahoo.com', '2023-01-17', '', 'IT Support Specialist', '5678901234', 'pending'),
(63, 'Benjamin Jackson', 'benjamin.jackson@protonmail.com', '2023-02-12', '', 'Security Analyst', '6789012345', 'pending'),
(64, 'Isabella Thomas', 'isabella.thomas@hotmail.com', '2023-03-07', '', 'Cloud Architect', '7890123456', 'pending'),
(65, 'Alexander Wilson', 'alexander.wilson@gmail.com', '2023-04-22', '', 'Data Scientist', '8901234567', 'pending'),
(66, 'Mia Moore', 'mia.moore@yahoo.com', '2023-05-27', '', 'Full Stack Developer', '9012345678', 'pending'),
(67, 'Ethan Harris', 'ethan.harris@protonmail.com', '2023-01-18', '', 'Machine Learning Engineer', '1234567890', 'pending'),
(68, 'Ava Martin', 'ava.martin@hotmail.com', '2023-02-13', '', 'Systems Analyst', '0987654321', 'pending'),
(69, 'Michael Lee', 'michael.lee@gmail.com', '2023-03-08', '', 'IT Project Manager', '1122334455', 'pending'),
(70, 'Emily Brown', 'emily.brown@yahoo.com', '2023-04-23', '', 'Cybersecurity Specialist', '2233445566', 'pending'),
(71, 'William Walker', 'william.walker@protonmail.com', '2023-05-28', '', 'Network Administrator', '3344556677', 'pending'),
(72, 'Charlotte Hall', 'charlotte.hall@hotmail.com', '2023-01-19', '', 'Business Analyst', '4455667788', 'pending'),
(73, 'Daniel Allen', 'daniel.allen@gmail.com', '2023-02-14', '', 'Web Developer', '5566778899', 'pending'),
(74, 'Amelia Young', 'amelia.young@yahoo.com', '2023-03-09', '', 'IT Consultant', '6677889900', 'pending'),
(75, 'Matthew King', 'matthew.king@protonmail.com', '2023-04-24', '', 'Software Engineer', '7788990011', 'pending'),
(76, 'Harper Scott', 'harper.scott@hotmail.com', '2023-05-29', '', 'Data Analyst', '8899001122', 'pending'),
(77, 'Joseph Wright', 'joseph.wright@gmail.com', '2023-01-20', '', 'Technical Support Engineer', '9900112233', 'pending'),
(78, 'Abigail Lewis', 'abigail.lewis@yahoo.com', '2023-02-15', '', 'IT Coordinator', '1010101010', 'pending'),
(79, 'Elijah Hill', 'elijah.hill@protonmail.com', '2023-03-10', '', 'System Analyst', '2020202020', 'pending'),
(80, 'Sofia Green', 'sofia.green@hotmail.com', '2023-04-25', '', 'Network Technician', '3030303030', 'pending'),
(81, 'Logan Adams', 'logan.adams@gmail.com', '2023-05-30', '', 'Infrastructure Engineer', '4040404040', 'pending'),
(82, 'Grace Nelson', 'grace.nelson@yahoo.com', '2023-01-21', '', 'IT Auditor', '5050505050', 'pending'),
(83, 'Lucas Baker', 'lucas.baker@protonmail.com', '2023-02-16', '', 'Help Desk Technician', '6060606060', 'approved'),
(84, 'Avery Campbell', 'avery.campbell@hotmail.com', '2023-03-11', '', 'IT Director', '7070707070', 'pending'),
(85, 'Jackson Mitchell', 'jackson.mitchell@gmail.com', '2023-04-26', '', 'IT Specialist', '8080808080', 'pending'),
(86, 'Ella Perez', 'ella.perez@yahoo.com', '2023-05-31', '', 'Network Specialist', '9090909090', 'pending'),
(87, 'Oliver Roberts', 'oliver.roberts@protonmail.com', '2023-01-22', '', 'Cloud Engineer', '1111111111', 'pending'),
(88, 'Scarlett Turner', 'scarlett.turner@hotmail.com', '2023-02-17', '', 'IT Manager', '2222222222', 'pending'),
(89, 'Henry Phillips', 'henry.phillips@gmail.com', '2023-03-12', '', 'Network Security Engineer', '3333333333', 'pending'),
(90, 'Lily Parker', 'lily.parker@yahoo.com', '2023-04-27', '', 'Technical Writer', '4444444444', 'pending'),
(91, 'Sebastian Evans', 'sebastian.evans@protonmail.com', '2023-06-01', '', 'Application Developer', '5555555555', 'pending'),
(92, 'Aria Edwards', 'aria.edwards@hotmail.com', '2023-01-23', '', 'IT Operations Manager', '6666666666', 'pending'),
(93, 'Aiden Collins', 'aiden.collins@gmail.com', '2023-02-18', '', 'Software Architect', '7777777777', 'pending'),
(94, 'Ella Ramirez', 'ella.ramirez@yahoo.com', '2023-03-13', '', 'Network Analyst', '8888888888', 'pending'),
(95, 'Daniel Cooper', 'daniel.cooper@protonmail.com', '2023-04-28', '', 'Cloud Consultant', '9999999999', 'pending'),
(96, 'Evelyn Ward', 'evelyn.ward@hotmail.com', '2023-06-02', '', 'Cybersecurity Engineer', '1010101011', 'pending'),
(97, 'Jacob Bell', 'jacob.bell@gmail.com', '2023-01-24', '', 'Data Engineer', '2020202021', 'pending'),
(98, 'Madison Flores', 'madison.flores@yahoo.com', '2023-02-19', '', 'IT Support Technician', '3030303031', 'pending'),
(99, 'Samuel Rogers', 'samuel.rogers@protonmail.com', '2023-03-14', '', 'Network Architect', '4040404041', 'pending'),
(100, 'Victoria Murphy', 'victoria.murphy@hotmail.com', '2023-04-29', '', 'Systems Engineer', '5050505051', 'pending'),
(101, 'Balls, Wilson', 'ballstorture@gmail.com', '2024-08-01', '', 'Cybersecurity Advisor', '+639042296969', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` int(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `contno` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `email`, `password`, `name`, `role`, `contno`) VALUES
(1, 'johndoe@example.com', '1234', 'John Doe', 'Employee', '555-0100'),
(2, 'janesmith@example.com', '1234', 'Jane Smith', 'Employee', '555-0101'),
(3, 'michaeljohnson@example.com', '1234', 'Michael Johnson', 'Employee', '555-0102'),
(4, 'emilydavis@example.com', '1234', 'Emily Davis', 'HR', '555-0103'),
(5, 'robertbrown@example.com', '1234', 'Robert Brown', 'Employee', '555-0104'),
(6, 'sarahwilson@example.com', '1234', 'Sarah Wilson', 'Employee', '555-0105'),
(7, 'davidlee@example.com', '1234', 'David Lee', 'Employee', '555-0106'),
(8, 'laurawhite@example.com', '1234', 'Laura White', 'HR', '555-0107'),
(9, 'jamesharris@example.com', '1234', 'James Harris', 'Employee', '555-0108'),
(10, 'jessicaking@example.com', '1234', 'Jessica King', 'Employee', '555-0109');

-- --------------------------------------------------------

--
-- Table structure for table `leaveapp`
--

CREATE TABLE `leaveapp` (
  `id` int(255) NOT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `reason` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaveapp`
--

INSERT INTO `leaveapp` (`id`, `sdate`, `edate`, `reason`, `employee_name`, `status`) VALUES
(2, '2024-07-29', '2024-08-23', '123', 'Dindo, Dominguez', 'declined'),
(3, '2024-08-07', '2024-09-06', 'Yes', 'Dindo, Dominguez', 'declined'),
(4, '2024-08-01', '2024-08-22', '1234', 'Lucas Baker', 'declined'),
(5, '2024-08-01', '2024-08-31', '1234', 'Lucas Baker', 'approved'),
(6, '2024-08-01', '2024-09-07', 'Vhouratte', 'Dindo, Dominguez', 'declined'),
(7, '2024-08-01', '2024-08-24', 'f', 'Dindo, Dominguez', 'approved'),
(8, '2024-08-01', '2024-08-15', '1', 'Lucas Baker', 'declined'),
(9, '2024-08-01', '2024-08-31', 'Mental wellness break', 'Michael Johnson', 'declined'),
(10, '2024-08-01', '2024-08-31', '1234', 'Michael Johnson', 'approved'),
(11, '2024-08-12', '2024-08-30', '121234', 'Michael Johnson', 'declined'),
(12, '2024-08-02', '2024-08-31', '12', 'Michael Johnson', 'declined'),
(13, '2012-12-12', '2043-12-12', '124125', 'Michael Johnson', 'approved'),
(14, '1212-12-12', '1211-12-12', '1212', 'Michael Johnson', 'declined'),
(15, '2024-08-08', '2024-08-14', '12', 'Michael Johnson', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `viol`
--

CREATE TABLE `viol` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `viol`
--

INSERT INTO `viol` (`id`, `name`, `title`, `description`, `date`) VALUES
(1, 'John Doe', 'Late Arrival', 'Employee consistently arrives late to work by 15-30 minutes.', '2024-07-01'),
(2, 'Jane Smith', 'Harassment Complaint', 'Reported inappropriate behavior from a colleague during work hours.', '2024-07-05'),
(3, 'Michael Johnson', 'Absenteeism', 'Unapproved absence from work for three consecutive days.', '2024-07-10'),
(4, 'Emily Davis', 'Unprofessional Behavior', 'Use of offensive language during a team meeting.', '2024-07-15'),
(5, 'Robert Brown', 'Violation of Company Policy', 'Unauthorized access to confidential company data.', '2024-07-20'),
(6, 'Sarah Wilson', 'Misuse of Company Resources', 'Using company equipment for personal tasks during work hours.', '2024-07-25'),
(7, 'David Lee', 'Dress Code Violation', 'Repeated violations of the company’s dress code policy.', '2024-08-01'),
(8, 'Laura White', 'Missed Deadlines', 'Consistent failure to meet project deadlines.', '2024-08-05'),
(9, 'James Harris', 'Discrimination Complaint', 'Reported discriminatory remarks from a supervisor.', '2024-08-10'),
(10, 'Jessica King', 'Insubordination', 'Refusal to follow a direct order from a manager.', '2024-08-15'),
(11, 'Liming, Lian', 'Foul Language', 'Liming used derogatory and offensive comments towards a coworker.', '2024-08-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `leaveapp`
--
ALTER TABLE `leaveapp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `viol`
--
ALTER TABLE `viol`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `leaveapp`
--
ALTER TABLE `leaveapp`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `viol`
--
ALTER TABLE `viol`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
