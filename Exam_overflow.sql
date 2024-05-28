--
-- Database: `Exam_overflow`
--
-- --------------------------------------------------------
--
-- Table structure for table `users`
USE exam_overflow;
CREATE TABLE IF NOT EXISTS users (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    gender VARCHAR(50) NOT NULL,
    grade VARCHAR(50) NOT NULL,
    stream VARCHAR(50) NOT NULL,
    image VARCHAR(255) NOT NULL
);
-- Table structure for table `admin`
CREATE TABLE IF NOT EXISTS `admin` (
    `id` VARCHAR(50) PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `image` VARCHAR(255) NOT NULL
);
-- Dumping data for table `admin`
-- pass = admin
INSERT INTO `admin` (`id`, `name`, `email`, `password`, `image`)
VALUES (
        'xUcccfAXFF0swLSkKCc9',
        'Admin',
        'admin@gmail.com',
        'd033e22ae348aeb5660fc2140aec35850c4da997',
        'TuA7B1b5SU7drnPFCTNV.jpg'
    );