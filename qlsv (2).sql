-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 25, 2023 lúc 09:45 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlsv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dangky`
--

CREATE TABLE `dangky` (
  `iddk` int(11) NOT NULL,
  `sotien` double DEFAULT NULL,
  `hinhthuc` varchar(50) DEFAULT NULL,
  `noidung` text DEFAULT NULL,
  `namhoc` varchar(20) DEFAULT NULL,
  `nganhang` varchar(50) DEFAULT NULL,
  `idu` int(11) DEFAULT NULL,
  `hocky` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dangky`
--

INSERT INTO `dangky` (`iddk`, `sotien`, `hinhthuc`, `noidung`, `namhoc`, `nganhang`, `idu`, `hocky`) VALUES
(3, 720000, 'online', '20004247 VoMinhTuyen HK2022-2023', '2022-2023', 'BIDV', 1, 'He');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangvien`
--

CREATE TABLE `giangvien` (
  `idgv` int(11) NOT NULL,
  `tengv` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `giangvien`
--

INSERT INTO `giangvien` (`idgv`, `tengv`) VALUES
(1, 'Phan Anh Cang');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocphan`
--

CREATE TABLE `hocphan` (
  `idhp` int(11) NOT NULL,
  `mahp` varchar(20) NOT NULL,
  `tenhp` varchar(100) NOT NULL,
  `tinchi` int(11) DEFAULT NULL,
  `idgv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hocphan`
--

INSERT INTO `hocphan` (`idhp`, `mahp`, `tenhp`, `tinchi`, `idgv`) VALUES
(1, 'TH1601', 'Thực tập tốt nghiệp', 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tensv` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `message`
--

INSERT INTO `message` (`id`, `user_id`, `tensv`, `email`, `number`, `message`) VALUES
(1, 4, 'Nguyễn Tấn Phước', 'pn617234@gmail.com', '123', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thoikhoabieu`
--

CREATE TABLE `thoikhoabieu` (
  `idtkb` int(11) NOT NULL,
  `idhp` int(11) DEFAULT NULL,
  `idgv` int(11) DEFAULT NULL,
  `ngaybatdau` date DEFAULT NULL,
  `ngayketthuc` date DEFAULT NULL,
  `phonghoc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thoikhoabieu`
--

INSERT INTO `thoikhoabieu` (`idtkb`, `idhp`, `idgv`, `ngaybatdau`, `ngayketthuc`, `phonghoc`) VALUES
(1, 1, 1, '2023-07-24', '2023-08-27', 'SV LH GV hướng dẫn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `tensv` varchar(50) NOT NULL,
  `mssv` varchar(20) DEFAULT NULL,
  `cccd` varchar(20) DEFAULT NULL,
  `lop` varchar(20) DEFAULT NULL,
  `khoa` varchar(20) DEFAULT NULL,
  `namhoc` varchar(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `tensv`, `mssv`, `cccd`, `lop`, `khoa`, `namhoc`, `email`, `password`, `user_type`, `image`) VALUES
(1, 'Võ Minh Tuyến', '20004247', '086202000323', '1CTT20A2', '45', '2020 - 2024', 'tuyen@gmail.com', '123456', 'user', 'eye.png'),
(2, 'Tuyến Võ', '', '', '', '', '', 'tuyenad@gmail.com', '123', 'admin', 'eye.png'),
(3, 'Phước Nguyễn', NULL, NULL, NULL, NULL, NULL, 'phuocad@gmail.com', '123', 'admin', 'naruto.jpg'),
(4, 'Nguyễn Tấn Phước', '20004158', '331950311', '1CTT20A2', '1CTT20A2', '2020 - 2024', 'pn617234@gmail.com', '123', 'user', 'naruto.jpg'),
(7, 'Lộc', '331950311', '331950311', '1CTT20A1', '45', '2023 - 2024', 'loc@gmail.com', '123', 'user', 'download.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dangky`
--
ALTER TABLE `dangky`
  ADD PRIMARY KEY (`iddk`),
  ADD KEY `FK_dk_users` (`idu`);

--
-- Chỉ mục cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`idgv`);

--
-- Chỉ mục cho bảng `hocphan`
--
ALTER TABLE `hocphan`
  ADD PRIMARY KEY (`idhp`),
  ADD KEY `FK_hocphan_gv` (`idgv`);

--
-- Chỉ mục cho bảng `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_m_u` (`user_id`);

--
-- Chỉ mục cho bảng `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD PRIMARY KEY (`idtkb`),
  ADD KEY `FK_tkb_hp` (`idhp`),
  ADD KEY `FK_tkb_gv` (`idgv`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password` (`password`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dangky`
--
ALTER TABLE `dangky`
  MODIFY `iddk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  MODIFY `idgv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hocphan`
--
ALTER TABLE `hocphan`
  MODIFY `idhp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  MODIFY `idtkb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dangky`
--
ALTER TABLE `dangky`
  ADD CONSTRAINT `FK_dk_users` FOREIGN KEY (`idu`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `hocphan`
--
ALTER TABLE `hocphan`
  ADD CONSTRAINT `FK_hocphan_gv` FOREIGN KEY (`idgv`) REFERENCES `giangvien` (`idgv`);

--
-- Các ràng buộc cho bảng `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_m_u` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD CONSTRAINT `FK_tkb_gv` FOREIGN KEY (`idgv`) REFERENCES `giangvien` (`idgv`),
  ADD CONSTRAINT `FK_tkb_hp` FOREIGN KEY (`idhp`) REFERENCES `hocphan` (`idhp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
