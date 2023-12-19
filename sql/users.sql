-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 19, 2023 lúc 05:16 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `testphp`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `birthday` date DEFAULT NULL,
  `job` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `hobby` varchar(100) DEFAULT NULL,
  `forgotToken` varchar(50) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `COUNT` int(11) DEFAULT 0,
  `src_avt` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `user_id`, `email`, `PASSWORD`, `NAME`, `birthday`, `job`, `location`, `hobby`, `forgotToken`, `create_at`, `update_at`, `COUNT`, `src_avt`, `gender`) VALUES
('kienquoc1', 14, 'kienquoc1@gmail.com', '$2y$10$OMxLjUUKWe3NWhxIxaaik.Jhe4ohW6u.nDifIJtys9sgvYBTU9uem', 'Kien Quoc', '2002-09-23', 'Student', 'Ho Chi Minh City', 'Play football', '5f094f063ec8c81276747b887ea096d656caf019', '2023-12-19 22:31:14', '2023-12-19 16:37:10', 0, 'uploads/avt-kienquoc1', 'Male');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
