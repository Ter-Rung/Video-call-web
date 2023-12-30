-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 20, 2023 lúc 10:14 AM
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
  `gender` varchar(50) DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `user_id`, `email`, `PASSWORD`, `NAME`, `birthday`, `job`, `location`, `hobby`, `forgotToken`, `create_at`, `update_at`, `COUNT`, `src_avt`, `gender`, `role`) VALUES
('admin', 37, 'admin@gmail.com', '$2y$10$wSu3aS/bbFJfnAggzl.NnuZMiHa9F.he9bb44ElGgmQfdV9K2Vz5y', 'Admin', NULL, 'Nghiên cứu', 'HCM', NULL, NULL, '2023-12-20 16:09:13', NULL, 0, NULL, NULL, 'Admin'),
('kienquoc', 33, 'kienquoc@gmail.com', '$2y$10$q6TAClsKaAxJWmxcSNhe5.P8T6vyyKwLNv/LES5WnOJiBwVWONIfK', 'Kien Quoc', NULL, 'Nghiên cứu', 'HCM', NULL, NULL, '2023-12-20 15:54:51', NULL, 0, NULL, NULL, 'User'),
('kienquoc1', 14, 'kienquoc1@gmail.com', '$2y$10$OMxLjUUKWe3NWhxIxaaik.Jhe4ohW6u.nDifIJtys9sgvYBTU9uem', 'Kien Quoc', '2002-09-23', 'Student', 'Ho Chi Minh City', 'Play football', '5f094f063ec8c81276747b887ea096d656caf019', '2023-12-19 22:31:14', '2023-12-19 16:37:10', 0, 'uploads/avt-kienquoc1', 'Male', 'User'),
('kienquoc10', 23, 'kienquoc10@gmail.com', '$2y$10$3nr1ZrQyVM4.XvxRmvFKTu77siYd8H5kcNjEI4kcTXH.aNGdDCQg2', 'kienquoc', NULL, 'Nghiên cứu', 'HCM', 'Array', NULL, '2023-12-20 12:41:14', NULL, 0, NULL, NULL, 'User'),
('kienquoc11', 24, 'kienquoc11@gmail.com', '$2y$10$vH1/vjlNJYRpHJtxW0mikeTyB2biWQlbOWPHhRwnJPKtEUW8EIIEG', 'kienquoc', NULL, 'Nghiên cứu', 'HCM', 'Array', NULL, '2023-12-20 12:42:51', NULL, 0, NULL, NULL, 'User'),
('kienquoc12', 25, 'kienquoc12@gmail.com', '$2y$10$/8V2hY.wkibb99qlxAaTQuD4DqD378CdW9gHMxLgzH1WJ.5x4MKW2', 'kienquoc', NULL, 'Nghiên cứu', 'HCM', 'Array', NULL, '2023-12-20 12:53:47', NULL, 0, NULL, NULL, 'User'),
('kienquoc123', 28, 'kienquoc123@gmail.com', '$2y$10$C5DaQg78BHnLLw5bP/ZNNu7Y4UT7GWRnsvWsb3O5ZjZw2FNmgOJSG', 'Tran Kien Quoc', NULL, 'Nghiên cứu', 'HCM', 'Bóng đá', NULL, '2023-12-20 15:46:56', NULL, 0, NULL, 'Male', 'User'),
('kienquoc1234', 29, 'kienquoc1234@gmail.com', '$2y$10$Ller3xPU4OKs6nY2H6aCsOCtxx44X9Cp2ppLEuOZXEvHvSGCX/RDC', 'kienquoc', '2002-09-23', 'Nghiên cứu', 'HCM', NULL, NULL, '2023-12-20 15:47:39', NULL, 0, NULL, 'Male', 'User'),
('kienquoc13', 26, 'kienquoc13@gmail.com', '$2y$10$T7zOIUg0pNt6m8L2Pk9EvuLO8RGu6gI0zY/ThR8givFF5GCjPF1b2', 'kienquoc', NULL, 'Nghiên cứu', 'HN', 'Bóng đá,Bóng rổ,Bóng chuyền', NULL, '2023-12-20 12:56:29', NULL, 0, NULL, NULL, 'User'),
('kienquoc14', 27, 'kienquoc14@gmai.com', '$2y$10$cIKn765ntS2aQEYxPLiU1OJv9pkHIsgVKGKqmNo1u9piCyQeMIdXC', 'kienquoc', NULL, 'Nghiên cứu', 'HCM', 'Bóng rổ', NULL, '2023-12-20 12:56:57', NULL, 0, NULL, NULL, 'User'),
('kienquoc2', 16, 'kienquoc2@gmail.com', '$2y$10$Xa9qWABppBlbeyCL024RsOe0/AHFooyDvJJwEy5KvmhcXKNbnQkkq', 'kienquoc', '2002-09-23', 'Student', 'HCM city', 'Play Football', NULL, '2023-12-20 11:35:11', NULL, 0, NULL, 'on', 'User'),
('kienquoc23', 30, 'kienquoc23@gmail.com', '$2y$10$/.J5eULvgLYQhnDsblaJvenCP12/tPZ/Eliqgn/X/2K4vpPDiaIGa', 'KienQuoc', '2002-09-23', 'Nghiên cứu', 'HCM', NULL, NULL, '2023-12-20 15:48:42', NULL, 0, NULL, 'Male', 'User'),
('kienquoc230902', 35, 'kienquoc23092002@gmail.com', '$2y$10$OKV3Njqpg2/usz.a/OMQH.UbiRR1VZS903Wj8YYFS3hViZ00Bi3Zy', 'kienquoc', NULL, 'Nghiên cứu', 'HCM', NULL, NULL, '2023-12-20 15:58:00', NULL, 0, NULL, NULL, 'User'),
('kienquoc2309023', 36, 'kienquoc230920023@gmail.com', '$2y$10$KLOvyJ7fv4t4aUPDY43Q/.KeSkOaxs9bbVFLxvs5oMuivaaDg6Ssq', 'kienquoc', NULL, 'Nghiên cứu', 'HCM', 'Bóng đá,Bóng rổ,Bóng chuyền', NULL, '2023-12-20 15:58:23', NULL, 0, NULL, NULL, 'User'),
('kienquoc234', 31, 'kienquoc234@gmail.com', '$2y$10$XroV.XNK8DbEPVgsh8.fI.gLqJaw5q/5Kg7piBVRFMHLyIlNZ/Jra', 'kienquoc234', NULL, 'Nghiên cứu', 'HCM', NULL, NULL, '2023-12-20 15:49:46', NULL, 0, NULL, NULL, 'User'),
('kienquoc2345', 32, 'kienquoc2345@gmail.com', '$2y$10$P7ef/S7h5TrSKae2juVPxunerNIImWHPMr.x6OmvjFpMvMcO5ttb6', 'kien quoc', NULL, 'Nghiên cứu', 'HCM', NULL, NULL, '2023-12-20 15:51:06', NULL, 0, NULL, NULL, 'User'),
('kienquoc23456', 34, 'kienquoc23456@gmail.com', '$2y$10$phomTWtxeHiK40xvF7oaBu0Zf19wwWQaq1bJicUIo4RadUAoDg46.', 'kien quoc', NULL, 'Nghiên cứu', 'HCM', 'Array', NULL, '2023-12-20 15:55:30', NULL, 0, NULL, NULL, 'User'),
('kienquoc3', 17, 'kienquoc3@gmail.com', '$2y$10$dT82Rw4pLzc0eVnrToXYUuJnOSNBQerzUZwcYilj6lu8lcAhLuFX2', 'kienquoc', '2002-09-23', NULL, NULL, NULL, NULL, '2023-12-20 11:36:32', NULL, 0, NULL, 'Male', 'User'),
('kienquoc4', 18, 'kienquoc4@gmail.com', '$2y$10$28/5Lsr/lpJ1wqhBiDi3qODQBMS.L2vziv.x52tvPSPLh8QVZzuAe', 'kienquoc', '2002-09-23', 'HCM', NULL, 'Bóng rổ', NULL, '2023-12-20 12:24:05', NULL, 0, NULL, 'Male', 'User'),
('kienquoc6', 19, 'kienquoc6@gmail.com', '$2y$10$wH1tRO8G/VouH2k52hvjp.CzW45BvkCAC5Nuo3YTObHcaSss6nV6y', 'kienquoc', '2002-09-23', 'Kinh doanh', 'HCM', 'Bóng chuyền', NULL, '2023-12-20 12:27:11', NULL, 0, NULL, 'Male', 'User'),
('kienquoc7', 20, 'kienquoc7@gmail.com', '$2y$10$cCODEusb5BFJt2zAlvh3ieuW17x2brqP9JOg9mj6sE96.IRpPh.3y', 'Kienquoc', '2002-09-23', 'Văn phòng', 'HCM', 'Bóng chuyền', NULL, '2023-12-20 12:30:11', NULL, 0, NULL, 'Male', 'User'),
('kienquoc8', 21, 'kienquoc8@gmail.com', '$2y$10$0Xx.s9zXj1ZIPMn9ivBSHepu/GOmUa15wyu8QyPcE.zyoEJKu6DbG', 'Tran Kien Quoc', NULL, 'Nghiên cứu', 'HCM', 'Cầu lông', NULL, '2023-12-20 12:31:00', NULL, 0, NULL, 'Male', 'User'),
('kienquoc9', 22, 'kienquoc9@gmail.com', '$2y$10$bcCZlbg76JpPOkEiJmAKJeKzuSTb533egtdNb8AqxIqFLDkcyHiCm', 'kienquoc', NULL, 'Nghiên cứu', 'HCM', 'Array', NULL, '2023-12-20 12:36:42', NULL, 0, NULL, 'Male', 'User');

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
