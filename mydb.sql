-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2017 at 05:11 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('mamun', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `product_id` int(8) NOT NULL,
  `current_price` int(8) NOT NULL,
  `sold` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `current_price`, `sold`) VALUES
(8, 0, 6, 46720, 0),
(9, 1, 7, 50033, 1),
(10, 4, 8, 1925000, 1),
(11, 1, 9, 13633, 1),
(12, 3, 10, 3210, 1),
(13, 4, 11, 22400, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `name` varchar(100) NOT NULL,
  `id` int(8) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(8) NOT NULL,
  `sold` tinyint(1) NOT NULL DEFAULT '0',
  `starting_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ending_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`name`, `id`, `image`, `description`, `price`, `sold`, `starting_time`, `ending_time`) VALUES
('iPhone 7', 7, 'i7.jpg', 'Description: \r\nDisplay: LED-backlit IPS LCD, capacitive touchscreen, 16M colors Os: iOS 10.0.1, upgradable to iOS 11.1 MEMORY	Card slot	No Internal 32/128/256 GB, GB, 2 GB RAM CAMERA	Primary	12 MP, f/1.8, 28mm, phase detection autofocus, OIS, quad-LED (dual tone) flash, check quality Features	1/3\" sensor size, geo-tagging, simultaneous 4K video and 8MP image recording, touch focus, face/smile detection, HDR (photo/panorama) Sensors	Fingerprint (front-mounted), accelerometer, gyro, proximity, compass, barometer BATTERY	Non-removable Li-Ion 1960 mAh battery (7.45 Wh) Talk time	Up to 14 h (3G) Music play	Up to 40 h', 45433, 1, '2017-11-11 18:10:00', '2017-11-15 18:00:00'),
('TOYOTA FIELDER, G-AERO TOURER, 2012', 8, 'fi.jpg', 'TOYOTA FIELDER, G-AERO TOURER\r\nYEAR MODEL: 2012\r\nENGINE CAPACITY: 1500 CC\r\nPUSH START\r\nFITTINGS: FOG, AERO, TV, R/R, R/SP, TV, PW, F OP/AUTO COLOR: BLACK', 1875000, 1, '2017-11-14 18:57:00', '2017-11-15 07:59:00'),
('Nokia 1100', 9, 'nokia.jpg', 'The Nokia 1100 is a basic GSM mobile phone produced by Nokia. Over 250 million 1100s have been sold since its launch in late 2003', 3333, 1, '2017-11-14 20:01:00', '2017-11-15 06:59:00'),
('samsung galaxy s6', 10, 'sam.jpg', 'DISPLAY	Type	Super AMOLED capacitive touchscreen, 16M colors\r\nSize	5.1 inches, 71.5 cm2 (~70.7% screen-to-body ratio)\r\nResolution	1440 x 2560 pixels, 16:9 ratio (~577 ppi density)\r\nMultitouch	Yes\r\nProtection	Corning Gorilla Glass 4\r\n 	- TouchWiz UI\r\nPLATFORM	OS	Android 5.0.2 (Lollipop), upgradable to 7.0 (Nougat)\r\nChipset	Exynos 7420 Octa\r\nCPU	Octa-core (4x2.1 GHz Cortex-A57 & 4x1.5 GHz Cortex-A53)\r\nGPU	Mali-T760MP8\r\nMEMORY	Card slot	No\r\nInternal	32/64/128 GB, 3 GB RAM\r\nCAMERA	Primary	16 MP, f/1.9, 28mm, OIS, autofocus, LED flash, check quality\r\nFeatures	1/2.6\" sensor size, 1.12 Âµm pixel size, geo-tagging, touch focus, face detection, Auto HDR, panorama', 2710, 1, '2017-11-14 20:12:00', '2017-11-14 21:00:00'),
(' Luxury Rolex Watch', 11, 'wa.jpg', 'Luxury watches are amazing, and I prefer them, really, they are expensive, but they are luxury, stylish, adorable for both women and men.', 21300, 1, '2017-11-14 18:00:00', '2017-11-15 06:00:00'),
('anjjd', 12, 'allion.jpg', 'jhewfkerhfker', 1223345, 0, '2017-11-15 04:00:00', '2017-11-14 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(8) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `mobile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `mobile`) VALUES
(1, 'Mamun', 'Hossain', 'mamun', 'm@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2324356),
(2, 'ataul', 'ali', 'at', 'at@gmail.com', '15f58d42e61d496225cb2cdaca06467e', 12345),
(3, 'Atik', 'hasan', 'Atik', 'a@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1223435),
(4, 'Nazmul', 'huda', 'Nazmul', 'n@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 233245345),
(5, 'Sabbir', 'rahman', 'Sabbir', 's@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 12345),
(6, 'Manik', 'ali', 'Manik', 'ma@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 12357);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
