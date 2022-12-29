-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-12-29 12:05:48
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `myeschooldb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `apartment`
--

CREATE TABLE `apartment` (
  `id` char(4) NOT NULL,
  `name` char(10) NOT NULL,
  `director` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `apartment`
--

INSERT INTO `apartment` (`id`, `name`, `director`) VALUES
('D001', '資工系', '李主任'),
('D002', '資管系', '林主任');

-- --------------------------------------------------------

--
-- 資料表結構 `course`
--

CREATE TABLE `course` (
  `id` char(4) NOT NULL,
  `name` char(10) NOT NULL,
  `credits` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `course`
--

INSERT INTO `course` (`id`, `name`, `credits`) VALUES
('C001', '資料庫系統', 4),
('C002', '手機程式', 4),
('C003', '機器人程式', 3),
('C004', '物聯網技術', 4),
('C005', '大數據分析', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `course_log`
--

CREATE TABLE `course_log` (
  `student_id` char(5) NOT NULL,
  `course_id` char(4) NOT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `course_log`
--

INSERT INTO `course_log` (`student_id`, `course_id`, `score`) VALUES
('S0001', 'C002', NULL),
('S0001', 'C003', NULL),
('S0002', 'C002', NULL),
('S0002', 'C003', NULL),
('S0002', 'C005', NULL),
('S0005', 'C003', NULL),
('S0005', 'C004', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `student`
--

CREATE TABLE `student` (
  `id` char(5) NOT NULL,
  `name` char(4) NOT NULL,
  `apartment_id` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `student`
--

INSERT INTO `student` (`id`, `name`, `apartment_id`) VALUES
('S0001', '一心', 'D001'),
('S0002', '二聖', 'D001'),
('S0003', '三多', 'D002'),
('S0004', '四維', 'D002'),
('S0005', '五福', 'D002');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `course_log`
--
ALTER TABLE `course_log`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- 資料表索引 `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `course_log`
--
ALTER TABLE `course_log`
  ADD CONSTRAINT `course_log_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `course_log_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
