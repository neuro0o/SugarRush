-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 03:44 AM
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
-- Database: `sugarrush`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blogID` int(11) NOT NULL,
  `blogTitle` varchar(255) NOT NULL,
  `blogEntry` varchar(10000) NOT NULL,
  `blogImg` varchar(100) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `blogDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blogID`, `blogTitle`, `blogEntry`, `blogImg`, `createdBy`, `blogDate`) VALUES
(1, 'Sneak Peek: Our New Dessert Wonderland Is Taking Shape!', 'Hey there fellow sweet enthusiasts! Sugar Rush will soon sprinkle its sweetness in a brand-new city - Kota Kinabalu, Sabah! Imagine walls adorned with whimsical dessert art, and cozy nooks perfect for sipping hot chocolate. Our concept design for this new outlet is inspired by Sugar Rush\'s mission to be your happy place! Get ready to step into your sweetest daydream! We\'ll be sharing updates soon!', 'blogUploads/concept_design.jpg', 1, '2024-12-31'),
(2, 'Sugar Rush’s New Home: A Cozy Peek Inside', 'Our newest outlet is almost ready, and we can\'t wait for you to see it! Picture a warm, inviting space filled with pastel hues, dessert-scented air, and the happiest vibes in town. We\'re setting the stage for all your sweet memories and dessert-filled adventures. Stay tuned for the grand opening -- because your daily dose of happiness is about to get a new address!', 'blogUploads/interior.jpg', 1, '2025-01-04'),
(3, 'Zesty Love: Lemon Raspberry Cheesecake Is on Its Way!', 'At Sugar Rush, we\'re always cooking up new ways to make your taste buds dance with joy! Our next star is a dreamy Lemon Raspberry Cheesecake! A perfect balance of Zesty lemon and sweet, juicy raspberries atop a velvety cream cheese base. It\'s a hug for your soul in dessert form. Stay tuned, dessert lovers -- it\'s coming soon to sprinkle your day with sunshine!', 'blogUploads/Lemon_Raspberry_Cheesecake.jpg', 2, '2025-01-02'),
(4, 'Happiness in a Bowl!', 'What\'s better than churros? What\'s better than ice cream? Putting them together, of course! Meet our soon-to-be-revealed Churro Ice Cream Bowl -- a crispy, cinnamon-sugar churro cradling scoops of creamy, dreamy ice cream. It\'s dessert innovation, Sugar Rush style! Keep an eye out for this bowl of happiness -- it\'s guaranteed to melt your heart (and your sweet tooth!).', 'blogUploads/Churro_Icecream_Bowls.jpg', 2, '2025-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL,
  `categoryDesc` varchar(100) NOT NULL,
  `createDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `categoryDesc`, `createDate`) VALUES
(1, 'Cake', 'A sweet baked good made from flour, sugar, eggs, and butter.', '2024-12-15 11:33:24'),
(2, 'Cookie', 'A small, sweet, baked treat typically flat and round, and can be soft or crispy.', '2024-12-15 11:34:08'),
(3, 'Beverage', 'A drink of any type.', '2024-12-15 11:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productImg` varchar(100) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `productQty` int(11) NOT NULL,
  `productPrice` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productImg`, `categoryID`, `productQty`, `productPrice`) VALUES
(1, 'Chocolate Cake', 'uploads/chocolate_cake.jpg', 1, 68, 12.00),
(2, 'Summer Berries Cheesecake', 'uploads/summerBerry_cheesecake.jpg', 1, 68, 15.00),
(3, 'Cupcake', 'uploads/cupcakes.jpg', 1, 67, 8.50),
(4, 'Almond White Chocolate Matcha Cookie', 'uploads/almond_white_chocolate_matcha_cookie.jpg', 2, 28, 7.50),
(5, 'Chocolate Almond Espresso Cookie', 'uploads/chocolate_almond_espresso_cookie.jpg', 2, 70, 7.50),
(6, 'Gingerbread', 'uploads/gingerbread_cookie.jpg', 2, 35, 5.50),
(7, 'Strawberries & Cream Frappuccino', 'uploads/strawberries_cream_frappuccino.jpg', 3, 66, 10.50),
(8, 'Brown Sugar Bubble Tea', 'uploads/brown_sugar_bubble_tea.jpg', 3, 69, 9.80),
(9, 'Biscoff Iced Latte', 'uploads/biscoff_iced_latte.jpg', 3, 68, 9.00);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `purchaseDate` date NOT NULL DEFAULT current_timestamp(),
  `purchaseAmt` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseID`, `userID`, `purchaseDate`, `purchaseAmt`) VALUES
(1, 3, '2025-01-07', 144.00),
(2, 3, '2025-01-07', 59.30),
(3, 4, '2025-01-07', 48.00),
(4, 4, '2025-01-07', 165.00),
(5, 4, '2025-01-07', 90.00),
(6, 5, '2025-01-07', 123.00),
(7, 4, '2025-01-08', 27.50);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_detail`
--

CREATE TABLE `purchase_detail` (
  `lineID` int(11) NOT NULL,
  `purchaseID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `purchaseQty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_detail`
--

INSERT INTO `purchase_detail` (`lineID`, `purchaseID`, `productID`, `purchaseQty`) VALUES
(1, 1, 4, 15),
(2, 1, 7, 3),
(3, 2, 1, 2),
(4, 2, 8, 1),
(5, 2, 3, 3),
(6, 3, 2, 2),
(7, 3, 9, 2),
(8, 4, 6, 30),
(9, 5, 4, 12),
(10, 6, 4, 15),
(11, 6, 7, 1),
(12, 7, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewID` int(11) NOT NULL,
  `reviewText` text NOT NULL,
  `rating` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `purchaseID` int(11) NOT NULL,
  `reviewBy` int(11) NOT NULL,
  `reviewDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewID`, `reviewText`, `rating`, `productID`, `purchaseID`, `reviewBy`, `reviewDate`) VALUES
(1, 'Love the strawberries!', 4, 7, 1, 3, '2025-01-07'),
(2, 'Perfectly baked!', 5, 4, 1, 3, '2025-01-07'),
(3, 'Too sweet, maybe tone down the sugar measurements? But overall still good!', 3, 1, 2, 3, '2025-01-07'),
(4, 'Small portion.', 3, 8, 2, 3, '2025-01-07'),
(5, 'PERFECT!', 5, 3, 2, 3, '2025-01-07'),
(6, 'Quite small portion, maybe use bigger cup next?', 3, 9, 3, 4, '2025-01-07'),
(7, 'Not a fan of cheese, but this is well made!', 3, 2, 3, 4, '2025-01-07'),
(8, 'The design is very cuteee!', 4, 6, 4, 4, '2025-01-07'),
(9, 'Too bitter for my taste....', 2, 4, 5, 4, '2025-01-07'),
(10, 'Matcha is love, matcha is live!!', 4, 4, 6, 5, '2025-01-07'),
(11, 'The product is exactly like the picture. Very cute, very appetizing!', 4, 7, 6, 5, '2025-01-07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userPwd` varchar(255) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `regDate` date NOT NULL DEFAULT current_timestamp(),
  `userRoles` int(2) NOT NULL DEFAULT 2 COMMENT '1 - System Admin, 2 - Normal User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userName`, `userPwd`, `userEmail`, `regDate`, `userRoles`) VALUES
(1, 'owner', '$2y$10$84gP282VDcZKCnqh8MmTBeDgGd1R7adpYM9cV9Z7tRnxHBECjeNCu', 'owner@email.com', '2024-12-25', 1),
(2, 'admin', '$2y$10$PLSMWEZP.WZjv/ceYfMEUuuf.Bn0SicuA54DrbfrODkRduxEtbOQi', 'admin@email.com', '2024-12-27', 1),
(3, 'neuro', '$2y$10$XE9f.Wpj8KkSIgXcmIeDR.IYJqioTDGGlerqiMdZBIjZLnI0tPI2a', 'neuro@email.com', '2025-01-31', 2),
(4, 'bella', '$2y$10$T0pzP1gY54KGOonj7.eN.O9IrrK0ODCvZw3IWjISYajisoena12TO', 'bella@email.com', '2025-01-07', 2),
(5, 'fina', '$2y$10$s0NhU0JOcVXOGQqtoV5q7eIT3BoXoKKx4YF7tOlUKzLYRYW71pvXi', 'fina@email.com', '2025-01-07', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blogID`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD PRIMARY KEY (`lineID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `reservationID` (`purchaseID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `userID` (`reviewBy`),
  ADD KEY `productID` (`productID`),
  ADD KEY `review_ibfk_3` (`purchaseID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchase_detail`
--
ALTER TABLE `purchase_detail`
  MODIFY `lineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD CONSTRAINT `purchase_detail_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_detail_ibfk_2` FOREIGN KEY (`purchaseID`) REFERENCES `purchase` (`purchaseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`reviewBy`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`purchaseID`) REFERENCES `purchase` (`purchaseID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
