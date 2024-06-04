-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 09:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `exam_overflow`
--
-- --------------------------------------------------------
--
-- Table structure for table `admin`
--
CREATE TABLE `admin` (
    `id` varchar(50) NOT NULL,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `image` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `admin`
--
INSERT INTO `admin` (`id`, `name`, `email`, `password`, `image`)
VALUES (
        'DH61ZNPmKJxhhcTBhpYz',
        'Abdulbaset Adem',
        'jhonbycot@gmail.com',
        '601f1889667efaebb33b8c12572835da3f027f78',
        '0TU5FJ7hqTsWMnhiv2Kf.jpg'
    ),
    (
        'xUcccfAXFF0swLSkKCc9',
        'Abdulbaset Adem',
        'admin@gmail.com',
        'd033e22ae348aeb5660fc2140aec35850c4da997',
        'TuA7B1b5SU7drnPFCTNV.jpg'
    );
-- --------------------------------------------------------
--
-- Table structure for table `feedback`
--
CREATE TABLE `feedback` (
    `id` int(11) NOT NULL,
    `name` varchar(50) NOT NULL,
    `email` varchar(50) NOT NULL,
    `message` text NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `feedback`
--
INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `created_at`)
VALUES (
        1,
        'Abdulbaset Adem',
        'abdulbasetadem@gmail.com',
        'akrem',
        '2024-06-02 08:38:32'
    ),
    (
        3,
        'Abdulbaset Adem',
        'abdulbasetadem@gmail.com',
        'akrem js ALTER TABLE feedback DROP COLUMN number;\r\nALTER TABLE feedback DROP COLUMN number;\r\nALTER TABLE feedback DROP COLUMN number;\r\nALTER TABLE feedback DROP COLUMN number;\r\nALTER TABLE feedback DROP COLUMN number;\r\nALTER TABLE feedback DROP COLUMN number;\r\nALTER TABLE feedback DROP COLUMN number;\r\nALTER TABLE feedback DROP COLUMN number;\r\nALTER TABLE feedback DROP COLUMN number;\r\nALTER TABLE feedback DROP COLUMN number;\r\nALTER TABLE feedback DROP COLUMN number;\r\nALTER TABLE feedback DROP COLUMN number;\r\n',
        '2024-06-03 04:59:40'
    );
-- --------------------------------------------------------
--
-- Table structure for table `materials`
--
CREATE TABLE `materials` (
    `id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `grade` varchar(10) NOT NULL,
    `file` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `materials`
--
INSERT INTO `materials` (`id`, `name`, `grade`, `file`)
VALUES (1, 'math', '12', 'ASTU E-Student.pdf'),
    (2, 'math', '11', 'codeblocks.exe'),
    (3, 'math', '11', 'codeblocks.exe'),
    (4, 'bio', '9', 'cb_console_runner.exe');
-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE `users` (
    `id` varchar(255) NOT NULL,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `gender` varchar(50) NOT NULL,
    `grade` varchar(50) NOT NULL,
    `stream` varchar(50) NOT NULL,
    `image` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `users`
--
INSERT INTO `users` (
        `id`,
        `name`,
        `email`,
        `password`,
        `gender`,
        `grade`,
        `stream`,
        `image`
    )
VALUES (
        'VidHxA9ZartGoCR6u5FW',
        'Akrem',
        'abdulbasetadem@gmail.com',
        '601f1889667efaebb33b8c12572835da3f027f78',
        'male',
        '9',
        'Natural',
        'fWA5IV6izgz8XzvuxPa0.jpg'
    );
--
-- Indexes for dumped tables
--
--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `email` (`email`);
--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `email` (`email`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 12;
--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 5;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;