-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 04:47 AM
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
-- Database: `betacinema_clone`
--

-- --------------------------------------------------------

--
-- Table structure for table `cinemas`
--

CREATE TABLE `cinemas` (
  `CinemaID` int(11) NOT NULL,
  `CinemaName` varchar(50) NOT NULL,
  `Address` text NOT NULL,
  `Location` varchar(50) NOT NULL,
  `Pic` text NOT NULL,
  `Map` text NOT NULL,
  `GiaVe` text NOT NULL,
  `Hotline` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cinemas`
--

INSERT INTO `cinemas` (`CinemaID`, `CinemaName`, `Address`, `Location`, `Pic`, `Map`, `GiaVe`, `Hotline`) VALUES
(1, 'Beta Nha Trang', '10 Hoàng Hoa Thám, phường Lộc Thọ, TP Nha Trang, tỉnh Khánh Hòa.', 'Khánh Hoà', 'https://files.betacorp.vn/media/images/2024/04/05/1165aa02-3b37-4fe2-8237-c65b6f584a8d-144948-050424-38.jpeg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3898.98884118032!2d109.19125987496825!3d12.249034188003858!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31706781803f3585%3A0x96ed6a252df8d7ce!2zMTAgxJAuIEhvw6BuZyBIb2EgVGjDoW0sIEzhu5ljIFRo4buNLCBOaGEgVHJhbmcsIEtow6FuaCBIw7JhIDY1MDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1731569908811!5m2!1svi!2s', 'https://files.betacorp.vn/cms/images/2024/04/03/bang-gia-ve-nt-ve-2d-va-3d-1920x2400-151318-030424-10.png', '0399475165'),
(2, 'Beta Thanh Xuân', 'Tầng hầm B1, tòa nhà Golden West, Số 2 Lê Văn Thiêm, Nhân Chính, Thanh Xuân, Hà Nội  (cách đường Lê Văn Lương 80m, đối diện số 56 Lê Văn Thiêm) ', 'Hà Nội', 'https://files.betacorp.vn/media/images/2024/04/05/f03ec357-4c2a-4618-bca3-c81e6dc7f38f-145111-050424-90.jpeg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7571503036174!2d105.79956767516394!3d21.0023696806403!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad5ac9beb0bd%3A0xc4069a08defd1deb!2sChung%20c%C6%B0%20Golden%20West!5e0!3m2!1svi!2s!4v1731570165376!5m2!1svi!2s', 'https://files.betacorp.vn/cms/images/2024/04/03/bang-gia-ve-tx-ve-2d-va-3d-1920x2400-150646-030424-93.png', '0824812878'),
(3, 'Beta Mỹ Đình', 'Tầng hầm B1, tòa nhà Golden Palace, đường Mễ Trì, quận Nam Từ Liêm, Hà Nội', 'Hà Nội', 'https://files.betacorp.vn/media/images/2024/04/05/f03ec357-4c2a-4618-bca3-c81e6dc7f38f-145111-050424-90.jpeg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.5233881558574!2d105.77231507516426!3d21.01173398063335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313453209305f15b%3A0xef45eb492b0d2577!2zQmV0YSBDaW5lbWFzIE3hu7kgxJDDrG5o!5e0!3m2!1svi!2s!4v1731570223739!5m2!1svi!2s', 'https://files.betacorp.vn/cms/images/2024/04/03/bang-gia-ve-md-ve-2d-va-3d-1920x2400-1-151421-030424-73.png', '0866154610'),
(4, 'Beta Trần Quang Khải', 'Tầng 2, Trung tâm văn hóa đa năng IMC, 62 đường Trần Quang Khải, Phường Tân Định, Quận 1, Thành phố Hồ Chí Minh ', 'TP. Hồ Chí Minh', 'https://files.betacorp.vn/media/images/2024/04/05/baaffbf4-e510-4125-935f-2f644ef7d6b9-135617-050424-86.jpeg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.244695016377!2d106.6914625749453!3d10.792561589357106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752948ca60f5e1%3A0x42809199e4fe4dd!2zVHJ1bmcgVMOibSBWxINuIEjDs2EgxJBhIE7Eg25nIGlNQw!5e0!3m2!1svi!2s!4v1731570267518!5m2!1svi!2s', 'https://files.betacorp.vn/cms/images/2024/04/03/bang-gia-ve-imc-tqk-ve-2d-va-3d-1920x2400-144501-030424-13.png', '1900638362'),
(5, 'Beta Quang Trung', 'số 645 Quang Trung, Phường 11, Quận Gò Vấp, Thành phố Hồ Chí Minh', 'TP. Hồ Chí Minh', 'https://files.betacorp.vn/media/images/2024/04/05/a899ce96-07e0-432a-8961-c43eb6b77ae4-143443-050424-84.png', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.680976117912!2d106.65826207494598!3d10.835707989316612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529a770bc1fd9%3A0x4929aeac98d08c96!2zNjQ1IMSQLiBRdWFuZyBUcnVuZywgUGjGsOG7nW5nIDExLCBHw7IgVuG6pXAsIEjhu5MgQ2jDrSBNaW5oIDcwMDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1731570299895!5m2!1svi!2s', 'https://files.betacorp.vn/media/images/2024/04/23/bang-gia-ve-qt-2-ve-2d-va-3d-1920x2400-101513-230424-98.png', '0706075509');

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `HallID` int(11) NOT NULL,
  `HallName` varchar(50) NOT NULL,
  `SeatCount` int(11) NOT NULL,
  `CinemaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`HallID`, `HallName`, `SeatCount`, `CinemaID`) VALUES
(1, 'P1', 20, 1),
(2, 'P2', 20, 1),
(5, 'P1', 20, 2),
(6, 'P2', 20, 2),
(8, 'P1', 20, 3),
(9, 'P2', 20, 3),
(12, 'P1', 20, 4),
(13, 'P2', 20, 4),
(14, 'P1', 20, 5),
(15, 'P2', 20, 5);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `MoviesID` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Genre` varchar(50) NOT NULL,
  `Duration` int(11) NOT NULL,
  `ReleaseDate` date NOT NULL,
  `Pic` text NOT NULL,
  `Trailer` text NOT NULL,
  `status` enum('Phim đang chiếu','Phim sắp chiếu') NOT NULL DEFAULT 'Phim đang chiếu',
  `SpecialShow` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`MoviesID`, `Title`, `Type`, `Genre`, `Duration`, `ReleaseDate`, `Pic`, `Trailer`, `status`, `SpecialShow`) VALUES
(1, 'Red One: Mật Mã Đỏ', '2D Phụ đề', 'Hài hước, Hành động', 123, '2024-11-15', 'https://files.betacorp.vn/media%2fimages%2f2024%2f11%2f04%2f400x633%2D15%2D134009%2D041124%2D68.jpg', 'https://www.youtube.com/watch?v=m6MF1MqsDhc', 'Phim đang chiếu', '1'),
(2, 'Thần Dược', '2D Phụ đề', 'Kinh dị, Tâm lý', 138, '2024-11-01', 'https://files.betacorp.vn/media%2fimages%2f2024%2f10%2f23%2f011124%2Dthan%2Dduoc%2D150349%2D231024%2D98.png', 'https://www.youtube.com/watch?v=dNwuFYhwTAk&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim đang chiếu', '1'),
(3, 'Venom: Kèo Cuối', '2D Phụ đề', 'Khoa học, viễn tưởng', 109, '2024-10-25', 'https://files.betacorp.vn/media%2fimages%2f2024%2f09%2f19%2fscreenshot%2D2024%2D09%2D19%2D150036%2D150139%2D190924%2D38.png', 'https://www.youtube.com/watch?time_continue=1&v=b1Yqng0uSWM&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim đang chiếu', '1'),
(4, 'Ngày Xưa Có Một Chuyện Tình', '2D Phụ đề', 'Tình cảm', 135, '2024-10-25', 'https://files.betacorp.vn/media%2fimages%2f2024%2f10%2f23%2f011124%2Dsneak%2Dngay%2Dxua%2Dco%2Dmot%2Dchuyen%2Dtinh%2D135154%2D231024%2D14.png', 'https://www.youtube.com/watch?v=IcpKkCzvcU4&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim đang chiếu', '1'),
(5, 'Linh Miêu', '2D Phụ đề', 'Kinh dị', 110, '2024-11-22', 'https://files.betacorp.vn/media%2fimages%2f2024%2f10%2f14%2f400x633%2D114106%2D141024%2D83.jpg', 'https://www.youtube.com/watch?v=4oxoPMxBO6s&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim đang chiếu', '0'),
(6, 'Tee Yod: Quỷ Ăn Tạng Phần 2', '2D Phụ đề', 'Kinh dị', 111, '2024-10-18', 'https://files.betacorp.vn/media%2fimages%2f2024%2f10%2f15%2f400wx633h%2D3%2D163518%2D151024%2D56.jpg', 'https://www.youtube.com/watch?v=Tx5JuN-5n8U&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim đang chiếu', '1'),
(7, 'Cười Xuyên Biên Giới', '2D Phụ đề', 'Hài hước', 113, '2024-11-15', 'https://files.betacorp.vn/media%2fimages%2f2024%2f11%2f08%2f400wx633h%2D1%2D154452%2D081124%2D12.jpg', 'https://www.youtube.com/watch?v=_IK-eb2AbKQ&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim đang chiếu', '0'),
(8, 'Học Viện Anh Hùng: You are Next', '2D Phụ đề', 'Hoạt hình', 110, '2024-11-15', 'https://files.betacorp.vn/media%2fimages%2f2024%2f10%2f15%2fscreenshot%2D2024%2D10%2D15%2D145811%2D145844%2D151024%2D25.png', 'https://www.youtube.com/watch?v=O_JcwpDergM', 'Phim đang chiếu', '1'),
(9, 'Cu Li Không Bao Giờ Khóc', '2D Phụ đề', 'Kịch', 93, '2024-11-15', 'https://files.betacorp.vn/media%2fimages%2f2024%2f10%2f22%2fscreenshot%2D2024%2D10%2D22%2D134228%2D134311%2D221024%2D56.png', 'https://www.youtube.com/watch?v=kMjlJkmt5nk&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim sắp chiếu', '1'),
(10, 'Rebellious', '2D Phụ đề', 'Hoạt hình', 94, '2024-11-15', 'https://files.betacorp.vn/media%2fimages%2f2024%2f10%2f16%2fscreenshot%2D2024%2D10%2D16%2D151244%2D151347%2D161024%2D13.png', 'https://www.youtube.com/watch?v=98GOZuXSWLY&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim sắp chiếu', '1'),
(11, 'Võ Sĩ Giác Đấu II', '2D Phụ đề', 'Hành động, Hài hước', 120, '2024-11-15', 'https://files.betacorp.vn/media%2fimages%2f2024%2f10%2f23%2f151124%2Dgladiator%2Dii%2D135227%2D231024%2D46.jpg', 'https://www.youtube.com/watch?v=4rgYUipGJNo&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim sắp chiếu', '1'),
(12, 'Wicked', '2D Phụ đề', 'Âm Nhạc, Phiêu lưu', 160, '2024-11-22', 'https://files.betacorp.vn/media%2fimages%2f2024%2f10%2f24%2fwicked%2Dforest%2Dduo%2D4x5%2D130600%2D241024%2D57.jpg', 'https://www.youtube.com/watch?time_continue=1&v=6COmYeLsz4c&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim sắp chiếu', '1'),
(13, 'Chiến Địa Tử Thi', '2D Phụ đề', 'Hành động, Kinh dị', 110, '2024-11-29', 'https://files.betacorp.vn/media%2fimages%2f2024%2f08%2f21%2fposter%2Dchien%2Ddia%2Dtu%2Dthi%2D110045%2D210824%2D25.jpg', 'https://www.youtube.com/watch?v=U4xymqKFehY&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim sắp chiếu', '1'),
(14, 'Hành Trình Của Moana 2', '2D Phụ đề', 'Phiêu lưu, Hoạt hình', 100, '2024-11-29', 'https://files.betacorp.vn/media%2fimages%2f2024%2f10%2f15%2fscreenshot%2D2024%2D10%2D15%2D135233%2D135334%2D151024%2D46.png', 'https://www.youtube.com/watch?v=hDZ7y8RP5HE&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim sắp chiếu', '1'),
(15, 'Công Tử Bạc Liêu', '2D Phụ đề', 'Tâm lý, Hài hước', 100, '2024-12-06', 'https://files.betacorp.vn/media%2fimages%2f2024%2f10%2f16%2f400wx633h%2D162649%2D161024%2D28.jpg', 'https://www.youtube.com/watch?v=bmkR2EY_hcY&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim sắp chiếu', '1'),
(16, 'Chúa Tể Của Những Chiếc Nhẫn: ...', '2D Phụ đề', 'Hành động, Phiêu lưu, Thần thoại', 130, '2024-12-13', 'https://files.betacorp.vn/media%2fimages%2f2024%2f10%2f21%2fscreenshot%2D2024%2D10%2D21%2D140406%2D140455%2D211024%2D18.png', 'https://www.youtube.com/watch?v=ST08liEjNsw&embeds_referring_euri=https%3A%2F%2Fbetacinemas.vn%2F&source_ve_path=Mjg2NjY', 'Phim sắp chiếu', '1');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `PaymentDate` date NOT NULL DEFAULT current_timestamp(),
  `PaymentMethod` varchar(50) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `MovieTitle` varchar(100) NOT NULL,
  `CinemaName` varchar(50) NOT NULL,
  `ShowDate` date NOT NULL,
  `HallName` varchar(20) NOT NULL,
  `StartTime` time NOT NULL,
  `Seats` varchar(100) NOT NULL,
  `TotalPrice` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `PaymentDate`, `PaymentMethod`, `UserID`, `MovieTitle`, `CinemaName`, `ShowDate`, `HallName`, `StartTime`, `Seats`, `TotalPrice`) VALUES
(10, '2024-11-14', 'Thanh toán tại Beta', 8, 'Red One: Mật Mã Đỏ', 'Beta Nha Trang', '2024-11-24', 'P2', '13:50:00', 'C1, C2, C3', 210000),
(28, '2024-11-15', 'Thanh toán tại Beta', 8, 'Red One: Mật Mã Đỏ', 'Beta Nha Trang', '2024-11-27', 'P2', '13:50:00', 'D1, D2, D3', 360000),
(63, '2024-11-25', 'Thanh toán tại Beta', NULL, 'Red One: Mật Mã Đỏ', 'Beta Thanh Xuân', '2024-11-26', 'P2', '20:00:00', 'C1, C2, C3, C4, C5', 350000),
(66, '2024-11-25', 'Thanh toán tại Beta', 9, 'Red One: Mật Mã Đỏ', 'Beta Nha Trang', '2024-11-26', 'P2', '13:50:00', 'A1, A2, A4, A5, B3', 225000),
(67, '2024-11-25', 'Thanh toán tại Beta', 9, 'Red One: Mật Mã Đỏ', 'Beta Nha Trang', '2024-11-26', 'P2', '13:50:00', 'D1, D2, D3, D4, D5', 600000),
(68, '2024-11-25', 'Thanh toán tại Beta', 9, 'Linh Miêu', 'Beta Thanh Xuân', '2024-11-30', 'P2', '17:00:00', 'C1, C2, C4, C5', 280000),
(69, '2024-11-25', 'Thanh toán tại Beta', 9, 'Red One: Mật Mã Đỏ', 'Beta Thanh Xuân', '2024-11-26', 'P2', '13:50:00', 'A2, A3, A4', 135000),
(70, '2024-11-25', 'Thanh toán tại Beta', 9, 'Red One: Mật Mã Đỏ', 'Beta Nha Trang', '2024-11-26', 'P2', '20:00:00', 'B2, B3, B4', 135000),
(71, '2024-11-25', 'Thanh toán tại Beta', 9, 'Red One: Mật Mã Đỏ', 'Beta Nha Trang', '2024-11-25', 'P1', '22:00:00', 'A2, A3, A4', 135000),
(72, '2024-11-26', 'Thanh toán tại Beta', 17, 'Cười Xuyên Biên Giới', 'Beta Trần Quang Khải', '2024-11-30', 'P2', '17:00:00', 'C2, C3, C4', 210000),
(73, '2024-11-26', 'Thanh toán tại Beta', 17, 'Ngày Xưa Có Một Chuyện Tình', 'Beta Thanh Xuân', '2024-11-27', 'P1', '13:50:00', 'D3, D4, D5', 360000),
(77, '2024-11-26', 'Thanh toán tại Beta', NULL, 'Ngày Xưa Có Một Chuyện Tình', 'Beta Nha Trang', '2024-11-26', 'P2', '19:00:00', 'D1, D2, D4, D3, D5', 600000);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `SeatID` int(11) NOT NULL,
  `SeatNumber` varchar(25) NOT NULL,
  `VIP` enum('0','1') NOT NULL DEFAULT '0',
  `Couple` enum('0','1') NOT NULL DEFAULT '0',
  `HallID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`SeatID`, `SeatNumber`, `VIP`, `Couple`, `HallID`) VALUES
(1, 'A1', '0', '0', 1),
(2, 'A2', '0', '0', 1),
(3, 'A3', '0', '0', 1),
(31, 'A4', '0', '0', 1),
(32, 'A5', '0', '0', 1),
(33, 'B1', '0', '0', 1),
(34, 'B2', '0', '0', 1),
(35, 'B3', '0', '0', 1),
(36, 'B4', '0', '0', 1),
(37, 'B5', '0', '0', 1),
(38, 'C1', '1', '0', 1),
(39, 'C2', '1', '0', 1),
(40, 'C3', '1', '0', 1),
(41, 'C4', '1', '0', 1),
(42, 'C5', '1', '0', 1),
(43, 'D1', '0', '1', 1),
(44, 'D2', '0', '1', 1),
(45, 'D3', '0', '1', 1),
(46, 'D4', '0', '1', 1),
(47, 'D5', '0', '1', 1),
(68, 'A1', '0', '0', 2),
(69, 'A2', '0', '0', 2),
(70, 'A3', '0', '0', 2),
(71, 'A4', '0', '0', 2),
(72, 'A5', '0', '0', 2),
(73, 'B1', '0', '0', 2),
(74, 'B2', '0', '0', 2),
(75, 'B3', '0', '0', 2),
(76, 'B4', '0', '0', 2),
(77, 'B5', '0', '0', 2),
(78, 'C1', '1', '0', 2),
(79, 'C2', '1', '0', 2),
(80, 'C3', '1', '0', 2),
(81, 'C4', '1', '0', 2),
(82, 'C5', '1', '0', 2),
(83, 'D1', '0', '1', 2),
(84, 'D2', '0', '1', 2),
(85, 'D3', '0', '1', 2),
(86, 'D4', '0', '1', 2),
(87, 'D5', '0', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `show_times`
--

CREATE TABLE `show_times` (
  `ShowtimeID` int(11) NOT NULL,
  `ShowDate` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `MovieID` int(11) NOT NULL,
  `HallID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `show_times`
--

INSERT INTO `show_times` (`ShowtimeID`, `ShowDate`, `StartTime`, `EndTime`, `MovieID`, `HallID`) VALUES
(1, '2024-11-26', '13:50:00', '15:53:00', 1, 2),
(2, '2024-11-26', '19:00:00', '21:03:00', 1, 1),
(3, '2024-11-26', '20:00:00', '22:03:00', 1, 2),
(4, '2024-11-26', '22:10:00', '00:13:00', 1, 2),
(6, '2024-11-27', '13:50:00', '15:53:00', 1, 2),
(7, '2024-11-27', '19:00:00', '21:03:00', 1, 1),
(9, '2024-11-28', '13:50:00', '15:53:00', 1, 2),
(10, '2024-11-28', '19:00:00', '21:03:00', 1, 1),
(11, '2024-11-29', '13:50:00', '15:53:00', 1, 1),
(12, '2024-11-29', '19:00:00', '21:03:00', 1, 2),
(13, '2024-11-29', '20:00:00', '22:03:00', 1, 1),
(14, '2024-11-29', '22:10:00', '00:13:00', 1, 1),
(15, '2024-11-30', '13:50:00', '15:53:00', 1, 1),
(16, '2024-11-30', '19:00:00', '21:03:00', 1, 2),
(17, '2024-12-01', '13:50:00', '15:53:00', 1, 2),
(18, '2024-12-01', '19:00:00', '21:03:00', 1, 1),
(19, '2024-11-30', '17:00:00', '19:18:00', 2, 2),
(20, '2024-11-30', '20:00:00', '22:18:00', 2, 1),
(21, '2024-12-01', '17:00:00', '19:18:00', 2, 1),
(22, '2024-12-01', '20:00:00', '22:18:00', 2, 2),
(25, '2024-11-30', '17:00:00', '18:49:00', 3, 1),
(26, '2024-11-30', '20:00:00', '21:49:00', 3, 2),
(27, '2024-12-01', '17:00:00', '18:49:00', 3, 1),
(28, '2024-12-01', '20:00:00', '21:49:00', 3, 1),
(29, '2024-11-26', '14:00:00', '16:15:00', 4, 1),
(30, '2024-11-26', '19:00:00', '21:15:00', 4, 2),
(31, '2024-11-26', '20:00:00', '22:15:00', 4, 1),
(32, '2024-11-26', '22:10:00', '00:25:00', 4, 2),
(33, '2024-11-27', '13:50:00', '16:05:00', 4, 1),
(34, '2024-11-27', '19:00:00', '21:15:00', 4, 2),
(35, '2024-11-28', '13:50:00', '16:05:00', 4, 1),
(36, '2024-11-28', '19:00:00', '21:15:00', 4, 2),
(37, '2024-11-29', '13:50:00', '16:05:00', 4, 2),
(38, '2024-11-29', '19:00:00', '21:15:00', 4, 1),
(39, '2024-11-29', '20:00:00', '22:15:00', 4, 2),
(40, '2024-11-29', '22:10:00', '00:25:00', 4, 2),
(41, '2024-11-30', '13:50:00', '16:05:00', 4, 2),
(42, '2024-11-30', '19:00:00', '21:15:00', 4, 1),
(43, '2024-12-01', '13:50:00', '16:05:00', 4, 1),
(44, '2024-12-01', '19:00:00', '21:15:00', 4, 2),
(45, '2024-11-30', '17:00:00', '18:50:00', 5, 2),
(46, '2024-11-30', '20:00:00', '21:50:00', 5, 1),
(47, '2024-12-01', '17:00:00', '18:50:00', 5, 2),
(48, '2024-12-01', '20:00:00', '21:50:00', 5, 2),
(49, '2024-11-30', '17:00:00', '18:51:00', 6, 1),
(50, '2024-11-30', '20:00:00', '21:51:00', 6, 2),
(51, '2024-12-01', '17:00:00', '18:51:00', 6, 1),
(52, '2024-12-01', '20:00:00', '21:51:00', 6, 1),
(53, '2024-11-30', '17:00:00', '18:53:00', 7, 2),
(54, '2024-11-30', '20:00:00', '21:53:00', 7, 1),
(55, '2024-12-01', '17:00:00', '18:53:00', 7, 2),
(56, '2024-12-01', '20:00:00', '21:53:00', 7, 2),
(57, '2024-11-30', '17:00:00', '18:50:00', 8, 1),
(58, '2024-11-30', '20:00:00', '21:50:00', 8, 2),
(59, '2024-12-01', '17:00:00', '18:50:00', 8, 1),
(60, '2024-12-01', '20:00:00', '21:50:00', 8, 1),
(63, '2024-11-25', '22:00:00', '12:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Fullname` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Pass_word` varchar(100) NOT NULL,
  `Dob` date NOT NULL,
  `Sex` enum('Nam','Nữ','Khác') NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Role` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Fullname`, `Email`, `Pass_word`, `Dob`, `Sex`, `Phone`, `Role`) VALUES
(8, 'Admin', 'toan.nh.63cntt@ntu.edu.vn', '$2y$10$JZpN51oBCeJ3lklaJDhHf.LxHPRgeQD96Vv0DZkuRO.UK2DIQ8Sg6', '1999-09-09', 'Nam', '999999999', '0'),
(9, 'Nguyen Huy Toan', 'nguyenhuytoan1432k3@gmail.com', '$2y$10$diq/yh9KEFPnU8sTQvA30OsN/XEPXNtPY5eEopQNH4.348u3lPWtq', '2024-11-24', 'Nam', '0935941419', '1'),
(17, 'Triều', 'hoangtrieu020903@gmail.com', '$2y$10$Y0OaS7/pti8V4JGrNkvPuOZIQSPsSB/dUn4evJDtau4i8ndV.VX6K', '2003-09-02', 'Nam', '123456789', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cinemas`
--
ALTER TABLE `cinemas`
  ADD PRIMARY KEY (`CinemaID`);

--
-- Indexes for table `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`HallID`),
  ADD KEY `CinemaID` (`CinemaID`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`MoviesID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`SeatID`),
  ADD KEY `HallID` (`HallID`);

--
-- Indexes for table `show_times`
--
ALTER TABLE `show_times`
  ADD PRIMARY KEY (`ShowtimeID`),
  ADD KEY `MovieID` (`MovieID`),
  ADD KEY `HallID` (`HallID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cinemas`
--
ALTER TABLE `cinemas`
  MODIFY `CinemaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `halls`
--
ALTER TABLE `halls`
  MODIFY `HallID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `MoviesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `SeatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `show_times`
--
ALTER TABLE `show_times`
  MODIFY `ShowtimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `halls`
--
ALTER TABLE `halls`
  ADD CONSTRAINT `FK_Halls_Cinemas` FOREIGN KEY (`CinemaID`) REFERENCES `cinemas` (`CinemaID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `FK_Payments_Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE SET NULL;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `FK_Seat_Halls` FOREIGN KEY (`HallID`) REFERENCES `halls` (`HallID`);

--
-- Constraints for table `show_times`
--
ALTER TABLE `show_times`
  ADD CONSTRAINT `FK_Showtimes_Halls` FOREIGN KEY (`HallID`) REFERENCES `halls` (`HallID`),
  ADD CONSTRAINT `FK_Showtimes_Movies` FOREIGN KEY (`MovieID`) REFERENCES `movies` (`MoviesID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
