-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 12:09 PM
-- Server version: 11.4.5-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gcc-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_content`
--

CREATE TABLE `about_content` (
  `id` int(11) NOT NULL,
  `type` enum('description','vision','mission','quality_policy') NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_content`
--

INSERT INTO `about_content` (`id`, `type`, `title`, `content`, `display_order`, `created_at`, `updated_at`) VALUES
(1, 'description', 'Main Description', 'The Guidance and Counseling Center at Western Mindanao State University is a vital support unit dedicated to addressing the psychological, emotional, and personal development needs of students and staff. It is one of the key services that contribute to the overall health and well-being of the WMSU community.', 1, '2025-05-16 01:10:58', '2025-05-16 01:10:58'),
(2, 'vision', 'Our Vision', 'By 2040, WMSU is a Smart Research University generating competent professionals and global citizens engendered by the knowledge from sciences and liberal education, empowering communities, promoting peace, harmony, and cultural diversity.', 2, '2025-05-16 01:10:58', '2025-05-16 01:10:58'),
(3, 'mission', 'Our Mission', 'WMSU commits to create a vibrant atmosphere of learning where science, technology, innovation, research, the arts and humanities, and community engagement flourish, and produce world-class professionals committed to sustainable development and peace.', 3, '2025-05-16 01:10:58', '2025-05-16 01:10:58'),
(4, 'quality_policy', 'Quality Policy', 'The Western Mindanao State University is committed to deliver academic excellence, to produce globally competitive human resources, and to conduct innovative research for sustainable development beyond the ASEAN region. It is defined as a Smart Research University, that adapts to the changing landscape of the stakeholders\' needs.\n\nWMSU also commits to continually enhance its Quality Management System by integrating risk-based thinking into all processes to achieve intended results and guarantee customer satisfaction in compliance with applicable quality assurance standards.', 4, '2025-05-16 01:10:58', '2025-05-16 01:10:58');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `appointment_type` enum('counseling','assessment') NOT NULL,
  `requested_date` date NOT NULL,
  `requested_time` enum('8am - 9am','9am - 10am','10am - 11am','2pm - 3pm','3pm - 4pm','4pm - 5pm') NOT NULL,
  `status` enum('pending','approved','rescheduled','evaluated','completed','cancelled','declined') DEFAULT 'pending',
  `Staff_id` int(11) DEFAULT NULL,
  `Director_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `client_id`, `appointment_type`, `requested_date`, `requested_time`, `status`, `Staff_id`, `Director_id`, `created_at`) VALUES
(59, 109, 'counseling', '2025-05-14', '2pm - 3pm', 'approved', NULL, 101, '2025-05-12 16:48:05'),
(60, 122, 'assessment', '2025-05-16', '3pm - 4pm', 'approved', 96, 101, '2025-05-12 17:52:45'),
(61, 122, 'counseling', '2025-05-23', '2pm - 3pm', 'approved', 96, NULL, '2025-05-12 18:12:38'),
(62, 120, 'counseling', '2025-05-14', '3pm - 4pm', 'completed', 96, NULL, '2025-05-12 19:20:55'),
(63, 120, 'assessment', '2025-05-23', '3pm - 4pm', '', 97, 99, '2025-05-12 19:21:12'),
(64, 123, 'assessment', '2025-05-23', '2pm - 3pm', 'pending', NULL, NULL, '2025-05-20 08:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `type` enum('facebook','email','description') NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `icon` varchar(50) NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `type`, `title`, `value`, `icon`, `display_order`, `created_at`, `updated_at`) VALUES
(1, 'description', 'Contact Description', 'The Guidance and Counseling Center For any concerns, just contact us through our official page or email. Completion of the Personal Data Form and Counseling Form is required before sessions.', '', 1, '2025-05-16 01:06:25', '2025-05-16 01:06:25'),
(2, 'facebook', 'Facebook Page', 'WMSU Guidance and Counseling Center', 'fab fa-facebook', 2, '2025-05-16 01:06:25', '2025-05-16 01:06:25'),
(3, 'email', 'Email Address', 'gcc@wmsu.edu.ph', 'fas fa-envelope', 3, '2025-05-16 01:06:25', '2025-05-16 01:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_image` varchar(255) DEFAULT 'default-profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `profile_image`) VALUES
(27, 109, 'soyou.jpg'),
(28, 119, 'joy.jpg'),
(29, 122, 'joy.jpg'),
(30, 123, 'kalea.jpg'),
(277, 378, 'default-profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `shifting`
--

CREATE TABLE `shifting` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `current_course` varchar(255) NOT NULL DEFAULT 'None',
  `wmsu_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_to_shift` varchar(100) NOT NULL,
  `reason_to_shift` longtext NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `grades` varchar(255) DEFAULT NULL,
  `cor` varchar(255) DEFAULT NULL,
  `cet_result` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','declined','evaluated','completed','rejected') DEFAULT 'pending',
  `approved_by` int(11) DEFAULT NULL,
  `submitted_at` datetime DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shifting`
--

INSERT INTO `shifting` (`id`, `first_name`, `middle_name`, `last_name`, `current_course`, `wmsu_id`, `user_id`, `course_to_shift`, `reason_to_shift`, `picture`, `grades`, `cor`, `cet_result`, `status`, `approved_by`, `submitted_at`, `created_at`) VALUES
(28, 'Josefa', '', 'Llanes Escoda', 'Computer Science', '20230001', 119, 'Nursing', 'kapagod', 'uploads/shifting/joy.jpg', 'uploads/shifting/COR-202320241.pdf', 'uploads/shifting/COR-202320241.pdf', 'uploads/shifting/COR-202320241.pdf', 'pending', NULL, '2025-05-13 00:18:43', '2025-05-12 16:18:43'),
(29, 'Gregoria', '', 'De Jesus', 'Business', '20230005', 123, 'Information Technology', 'wala', 'uploads/shifting/joy.jpg', 'uploads/shifting/COR-202320241.pdf', 'uploads/shifting/COR-202320241.pdf', 'uploads/shifting/COR-202320241.pdf', 'completed', 101, '2025-05-13 00:57:46', '2025-05-12 16:57:46'),
(30, 'Apolinario', 'LABANG', 'Mabini', 'Education', '20230004', 122, 'Information Technology', 'dd', 'uploads/shifting/joy.jpg', 'uploads/shifting/COR-202320241.pdf', 'uploads/shifting/COR-202320241.pdf', 'uploads/shifting/COR-202320241.pdf', 'completed', 101, '2025-05-13 01:52:09', '2025-05-12 17:52:09'),
(31, 'Antonio', '', 'Luna', 'Engineering', '20230002', 120, 'Information Technology', 'pagod', 'uploads/shifting/soyou.jpg', 'uploads/shifting/COR-202320241.pdf', 'uploads/shifting/COR-202320241.pdf', 'uploads/shifting/COR-202320241.pdf', 'declined', 96, '2025-05-13 03:20:34', '2025-05-12 19:20:34'),
(32, 'Josefa', '', 'Llanes Escoda', 'Computer Science', '20230001', 119, 'BSCS', 'dasd', 'uploads/shifting/IMG_20240909_125612_848.jpg', 'uploads/shifting/HH.pdf', 'uploads/shifting/Last Name.pdf', 'uploads/shifting/PP.pdf', 'completed', 101, '2025-05-15 19:20:25', '2025-05-15 11:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `campus` enum('main','esu') NOT NULL,
  `category` enum('director','counselor','staff','coordinator') NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `school` varchar(100) DEFAULT NULL,
  `course_grade` varchar(100) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `role` enum('Admin','Staff','Director','Faculty','High School Student','Faculty','Outside Client','College Student') NOT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `wmsu_id` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `school`, `course_grade`, `sex`, `age`, `role`, `contact_number`, `address`, `civil_status`, `occupation`, `wmsu_id`, `email`, `password`) VALUES
(89, 'Juan', NULL, 'Dela Cruz', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, NULL, NULL, NULL, 'a1@admin.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(90, 'Maria', NULL, 'Santos', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, NULL, NULL, NULL, 'a2@admin.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(91, 'Pedro', NULL, 'Reyes', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, NULL, NULL, NULL, 'a3@admin.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(92, 'Sofia', NULL, 'Aquino', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, NULL, NULL, NULL, 'a4@admin.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(93, 'Andres', NULL, 'Bonifacio', NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, NULL, NULL, NULL, 'a5@admin.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(94, 'Luzviminda', NULL, 'Garcia', NULL, NULL, NULL, NULL, 'Staff', NULL, NULL, NULL, NULL, NULL, 's1@staff.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(95, 'Ricardo', NULL, 'Dizon', NULL, NULL, NULL, NULL, 'Staff', NULL, NULL, NULL, NULL, NULL, 's2@staff.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(96, 'Corazon', NULL, 'Mendoza', NULL, NULL, NULL, NULL, 'Staff', NULL, NULL, NULL, NULL, NULL, 's3@staff.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(97, 'Eduardo', NULL, 'Fernandez', NULL, NULL, NULL, NULL, 'Staff', NULL, NULL, NULL, NULL, NULL, 's4@staff.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(98, 'Isabel', NULL, 'Romualdez', NULL, NULL, NULL, NULL, 'Staff', NULL, NULL, NULL, NULL, NULL, 's5@staff.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(99, 'Ramon', NULL, 'Magsaysay', NULL, NULL, NULL, NULL, 'Director', NULL, NULL, NULL, NULL, NULL, 'd1@director.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(100, 'Imelda', NULL, 'Marcos', NULL, NULL, NULL, NULL, 'Director', NULL, NULL, NULL, NULL, NULL, 'd2@director.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(101, 'Jose', NULL, 'Rizal', NULL, NULL, NULL, NULL, 'Director', NULL, NULL, NULL, NULL, NULL, 'd3@director.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(102, 'Gabriela', NULL, 'Silang', NULL, NULL, NULL, NULL, 'Director', NULL, NULL, NULL, NULL, NULL, 'd4@director.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(103, 'Ferdinand', NULL, 'Lapu-Lapu', NULL, NULL, NULL, NULL, 'Director', NULL, NULL, NULL, NULL, NULL, 'd5@director.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(104, 'Consuelo', NULL, 'Alvarez', NULL, NULL, NULL, NULL, 'Faculty', NULL, NULL, NULL, NULL, NULL, 'f1@faculty.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(105, 'Teodoro', NULL, 'Agoncillo', NULL, NULL, NULL, NULL, 'Faculty', NULL, NULL, NULL, NULL, NULL, 'f2@faculty.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(106, 'Lourdes', NULL, 'Castillo', NULL, NULL, NULL, NULL, 'Faculty', NULL, NULL, NULL, NULL, NULL, 'f3@faculty.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(107, 'Gregorio', NULL, 'Del Pilar', NULL, NULL, NULL, NULL, 'Faculty', NULL, NULL, NULL, NULL, NULL, 'f4@faculty.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(108, 'Leona', NULL, 'Florentino', NULL, NULL, NULL, NULL, 'Faculty', NULL, NULL, NULL, NULL, NULL, 'f5@faculty.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(109, 'Jose', NULL, 'Abad Santos', NULL, NULL, NULL, NULL, 'High School Student', NULL, NULL, NULL, NULL, NULL, 'h1@hs.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(110, 'Melchora', NULL, 'Aquino', NULL, NULL, NULL, NULL, 'High School Student', NULL, NULL, NULL, NULL, NULL, 'h2@hs.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(111, 'Emilio', NULL, 'Jacinto', NULL, NULL, NULL, NULL, 'High School Student', NULL, NULL, NULL, NULL, NULL, 'h3@hs.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(112, 'Trinidad', NULL, 'Tecson', NULL, NULL, NULL, NULL, 'High School Student', NULL, NULL, NULL, NULL, NULL, 'h4@hs.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(113, 'Mariano', NULL, 'Ponce', NULL, NULL, NULL, NULL, 'High School Student', NULL, NULL, NULL, NULL, NULL, 'h5@hs.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(114, 'Manuel', NULL, 'Quezon', NULL, NULL, NULL, NULL, 'Outside Client', NULL, NULL, NULL, NULL, NULL, 'c1@client.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(115, 'Aurora', NULL, 'Aragon', NULL, NULL, NULL, NULL, 'Outside Client', NULL, NULL, NULL, NULL, NULL, 'c2@client.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(116, 'Carlos', NULL, 'Romulo', NULL, NULL, NULL, NULL, 'Outside Client', NULL, NULL, NULL, NULL, NULL, 'c3@client.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(117, 'Jovita', NULL, 'Fuentes', NULL, NULL, NULL, NULL, 'Outside Client', NULL, NULL, NULL, NULL, NULL, 'c4@client.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(118, 'Arturo', NULL, 'Tolentino', NULL, NULL, NULL, NULL, 'Outside Client', NULL, NULL, NULL, NULL, NULL, 'c5@client.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(119, 'Josefa', NULL, 'Llanes Escoda', 'wmsu', 'Computer Science', 'female', 20, 'College Student', NULL, NULL, NULL, NULL, '20230001', 'cs1@student.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(120, 'Antonio', NULL, 'Luna', 'wmsu', 'Engineering', 'male', 21, 'College Student', NULL, NULL, NULL, NULL, '20230002', 'cs2@student.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(121, 'Marcela', NULL, 'Agoncillo', 'wmsu', 'Nursing', 'female', 19, 'College Student', NULL, NULL, NULL, NULL, '20230003', 'cs3@student.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(122, 'Apolinario', 'LABANG', 'Mabini', 'wmsu', 'Education', 'male', 22, 'College Student', '2123456789', 'zc', 'single', 'fff', '20230004', 'cs4@student.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(123, 'Gregoria', 'labang', 'DeJesus', 'wmsu', 'Business', 'female', 20, 'College Student', '2123456789', 'zcc', 'single', 'tambay', '202300059', 'cs5@student.com', '$2y$10$ktFxqXK.gzk3i79ApTmUFuUSPYTfNjMynQyL5.XWvcLTIiPQbLTh6'),
(131, 'Ralph', 'Monzales', 'Candido', 'Western Mindanao State University', 'BSN', 'Male', 19, 'College Student', '09774531012', 'San Jose Cawa-cawa', 'Single', 'Student', '202301236', 'hz202301236@wmsu.edu.ph', '$2y$10$Shu2TDMohWaHzXjrdxpFjeKli2AYDLukLNDrYQESy6TYGfnj/zJHy'),
(378, 'Dhaifz', NULL, 'Administrator', 'WMSU', 'N/A', NULL, NULL, 'Admin', '00000000000', NULL, NULL, NULL, NULL, 'admin@gmail.com', '$2y$10$tefaTYPrUTaEg42QKHGdtu9iN6CpCSwseYiTffR8ZRhuIcxW6hqZC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_content`
--
ALTER TABLE `about_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `staff_id` (`Staff_id`),
  ADD KEY `director_id` (`Director_id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `shifting`
--
ALTER TABLE `shifting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shifting_ibfk_1` (`user_id`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_content`
--
ALTER TABLE `about_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT for table `shifting`
--
ALTER TABLE `shifting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=379;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`Staff_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`Director_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shifting`
--
ALTER TABLE `shifting`
  ADD CONSTRAINT `shifting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shifting_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
