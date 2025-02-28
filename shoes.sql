-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 03:10 PM
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
-- Database: `shoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `IdNguoiDung` int(11) NOT NULL,
  `TenTK` varchar(50) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `QuyenQuanTri` int(11) NOT NULL DEFAULT 0,
  `SDT` varchar(10) NOT NULL,
  `DiaChi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`IdNguoiDung`, `TenTK`, `Email`, `MatKhau`, `QuyenQuanTri`, `SDT`, `DiaChi`) VALUES
(6, 'customer2', 'customer2@gmail.com', 'shoes', 1, '', 'abcbcc'),
(7, 'customer2', 'customer2@gmail.com', 'shoes', 0, '2131232311', 'abcbccd'),
(13, 'customer1', 'customer1@gmail.com', 'shoes', 0, '2131232311', '12331 abc'),
(14, 'customer3', 'customer3@gmail.com', 'shoes', 0, '300239012', 'Ha tay'),
(15, 'nxh', 'nxh@gmail.com', 'shoes', 0, '093823138', 'Vinh Phuc'),
(16, 'customer4', 'customer4@gmail.com', 'shoes', 0, '08327321', 'Viet Nam'),
(17, 'customer6', 'customer6@gmail.com', 'shoes', 0, '0092323132', 'Ha Noi'),
(18, 'customer7', 'customer7@gmail.com', 'shoes', 0, '032948284', 'Ha Noi'),
(19, 'customer5', 'customer5@gmail.com', 'shoes', 0, '0238842323', 'Address 5'),
(20, 'hoang', 'hoang@gmail.com', 'shoes', 0, '037568403', 'thon Cat Ngoi, Xa Cat Que, Hoai Duc, Ha Noi'),
(21, 'huong', 'huong@gmail.com', 'shoes', 0, '085734833', 'Vinh Phuc que toi'),
(22, 'bakihanma', 'bakihanma@gmail.com', 'shoes', 0, '0388238232', 'Tokyo'),
(23, 'tokitaohma', 'tokitaohma@gmail.com', 'shoes', 0, '0548433822', 'Japan'),
(24, 'clarkkent', 'clarkkent@gmail.com', 'shoes', 0, '085573232', 'Gotham city'),
(25, 'kalel', 'kalel@gmail.com', 'shoes', 0, '0873443232', 'Crypton'),
(26, 'chipheo', 'pheovanchi@gmail.com', 'shoes', 0, '0847342233', 'lang Vu Dai'),
(27, 'bakien', 'bakien@gmail.com', 'shoes', 0, '084377423', 'lang Vu Dai'),
(28, 'fawe', 'nkh9102003@gmail.com', '11111111', 0, '0943834321', 'fawefwe');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `IdSP` int(11) NOT NULL,
  `TenSP` varchar(255) NOT NULL,
  `AnhSP` varchar(255) NOT NULL,
  `Gia` int(11) NOT NULL,
  `IdThuongHieu` int(11) NOT NULL,
  `MoTa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`IdSP`, `TenSP`, `AnhSP`, `Gia`, `IdThuongHieu`, `MoTa`) VALUES
(13, 'Air Jordan 1 Mocha', '755658.jpg', 2500000, 2, 'cung duoc'),
(14, 'Air Jordan 1  Retro High Shadow', '856292.webp', 2000000, 2, 'binh thuong '),
(15, 'Air Jordan 4 Black Cat', '393118.jpg', 1300500, 2, 'tam trung'),
(16, 'Air Jordan 1 University Blue	', '252489.jpg', 1200000, 2, 'giay co cao'),
(17, 'Air Jordan 4 Oreo', 'img01 (5).webp', 6000000, 2, 'Giay sieu xin'),
(18, 'Air Jordan 1 Electro Orange	', 'aj1.webp', 6500000, 2, 'giay cho nguoi giau'),
(25, 'New Balance 530 Silver Line', 'new balance 530 silver line.jpg', 6500000, 8, 'Giay chat'),
(26, 'Air Force 1 Triple White', 'Nike-Air-Force-1-Low-Triple-White.jpg', 2000000, 1, 'giay xin'),
(27, 'New Balance Aime Leon Dore White Green', 'new balance 550 aime leon dore white green.jpg', 5000000, 8, 'giay sieu chat'),
(28, 'New Balance 990 Grey', 'new balance 990 grey.jpg', 5200000, 8, 'giay ngon'),
(29, 'Air Force 1 Travis Scott Edition', 'Airforce 1 Travis Scott.jpg', 5500000, 1, 'giay vip'),
(30, 'Vans Sk8 Hi', '224161.jpeg', 4500000, 9, 'giay ngau'),
(31, 'Vans Old Skool', '116166.jpg', 4500000, 9, 'giay sieu ngau'),
(32, 'Converse Run Star Hike ', '928421.jpeg', 4700000, 10, 'giay teu'),
(33, 'Converse High X CDG', '366835.jpg', 4200000, 10, 'giay sieu teu'),
(34, 'Adidas Stan Smith White', '661ca82401980Stan Smith WHitw.jpg', 321, 5, 'giay sang chanh');

-- --------------------------------------------------------

--
-- Table structure for table `thuonghieu`
--

CREATE TABLE `thuonghieu` (
  `IdThuongHieu` int(11) NOT NULL,
  `ThuongHieu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thuonghieu`
--

INSERT INTO `thuonghieu` (`IdThuongHieu`, `ThuongHieu`) VALUES
(1, 'Nike'),
(2, 'Air Jordan'),
(5, 'Adidas'),
(8, 'New Balance'),
(9, 'Vans'),
(10, 'Converse');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`IdNguoiDung`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`IdSP`),
  ADD KEY `category_id` (`IdThuongHieu`);

--
-- Indexes for table `thuonghieu`
--
ALTER TABLE `thuonghieu`
  ADD PRIMARY KEY (`IdThuongHieu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `IdNguoiDung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `IdSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `thuonghieu`
--
ALTER TABLE `thuonghieu`
  MODIFY `IdThuongHieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`IdThuongHieu`) REFERENCES `thuonghieu` (`IdThuongHieu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
