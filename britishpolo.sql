-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2021 at 10:24 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `britishpolo`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(60) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fname`, `email`, `subject`, `message`, `date_time`) VALUES
(4, 'SRI VISHNU  PARTHIPAN', 'srivishnu2k@gmail.com', 'Accidently purchased the bag', 'I want refund!', '2021-08-04 04:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `desc_n` varchar(150) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `class` char(1) NOT NULL,
  `image_url` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `desc_n`, `price`, `class`, `image_url`) VALUES
(1, 'Lancaster Polo Candy Tote Handbag', '-1 Main Zip Closure\r\n-2 Main Magnetic Closure\r\n-Body Strap Detachable & Adjustable\r\n-1 Short Handle', '229.00', '0', 'menu_1627983179.jpg'),
(2, 'British Polo Britt Layer Handbag', '-1 Backside Pocket Compartment\r\n-1 Long body strap Detachable and -Adjustable\r\n-1 Top Handle\r\n1 Brand tag Keychain', '169.00', '', 'menu_1627983236.jpg'),
(3, 'British Polo Layla Handbag', '-Material Type: PU leather\r\n-1 Backside Zipper Pocket\r\n-1 Long body strap Detachable and Adjustable\r\n-1 Shoulder Strap', '129.00', '', 'menu_1627983325.jpg'),
(4, 'Lancaster Polo Florist Mix Handbag', '-1 Long Cross Body Strap Detachable and Adjustable\r\n-1 Short Handle\r\n-1 Keychain\r\n-4 Bottom Protect Studs', '119.70', '1', 'menu_1627983421.jpg'),
(5, 'Lancaster Polo Florence Handbag', '-1 Long Cross Body Strap Detachable and Adjustable\r\n-1 Short Handle with Adjustable\r\n-1 Keychain\r\n-4 Bottom Protect Studs', '128.00', '', 'menu_1627983491.jpg'),
(6, 'British Polo Curvy-Laura Handbag', '-2 Straps: 1 Shoulder Strap & 1 Long Cross Body Strap\r\n-1 Back External Zip Pocket\r\n-1 Dangling Keychain\r\n-4 Bottom Studs', '129.00', '', 'menu_1627985524.jpg'),
(7, 'British Polo Classic Bucket Bag', '-Magnetic & Zip-Top Closure\r\n-Fabric Lining\r\n-Middle Zip Compartment\r\n-Comes With an Additional Strap For Versatility', '119.00', '', 'menu_1627985466.jpg'),
(8, 'British Polo Bling Sling Bag', '-Material Type: PU leather\r\n-1 Front Zip Compartment\r\n-1 Back Zip Compartment\r\n-1 Internal Pocket', '88.90', '', 'menu_1627985390.jpg'),
(9, 'British Polo Arrow Handbag', '-3 Main Compartments\r\n-1 Zip Pocket\r\n-1 Multi-function Pocket\r\n-1 Long Cross Body Strap', '99.00', '1', 'menu_1627985327.jpg'),
(10, 'British Polo Mitsui Backpack', '-1 Zip pocket\r\n-1 Flap Cover Magnetic Closure\r\n-1 Both side Multi Function Pocket\r\n-Backpack Strap with Adjustable', '129.00', '', 'menu_1627985239.jpg'),
(11, 'British Polo Aroma Backpack', '-Material Type: PU leather\r\n-Zipper closure\r\n-Magnetic Closure\r\n-Internal Zip pocket', '99.00', '', 'menu_1627985151.jpg'),
(12, 'British Polo Davina Set', '1) Handbag - Main Zipper Closure & Long Cross Body Strap 2)Sling Bag - 1 Crossbody Strap 3) Pouch - Internal Pocket & Internal Zip Pocket', '200.00', '', 'menu_1627985071.jpg'),
(13, 'British Polo Dorothy Handbag Set', '1) Handbag - Main Zipper Closure & Long Cross Body Strap\r\n2)Sling Bag - 1 Crossbody Strap\r\n3) Pouch - Internal Pocket & Internal Zip Pocket', '189.90', '', 'menu_1627984933.png'),
(14, 'British Polo Amy Handbag Set', '1) Handbag - Main Zipper Closure & Long Cross Body Strap\r\n2)Sling Bag - 1 Crossbody Strap\r\n3) Pouch - Internal Pocket & Internal Zip Pocket', '329.00', '', 'menu_1627983911.jpg'),
(15, 'British Polo Concentric-Bailey Handbag Set', '1) Handbag - Main Zipper Closure & Long Cross Body Strap\r\n2)Sling Bag - 1 Crossbody Strap\r\n3) Pouch - Internal Pocket & Internal Zip Pocket', '299.00', '', 'menu_1627984725.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(80) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `billing_details` varchar(300) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `active`) VALUES
(1, 'srivishnu2k@gmail.com', '$2y$10$G9Cqe7bdq4pH1169ZEXq9uVQJFCdZcmD7qmKN6ZxBhOMtGPkGqM.y', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
