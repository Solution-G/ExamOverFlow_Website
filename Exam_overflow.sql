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
    `profession` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `image` VARCHAR(255) NOT NULL
);