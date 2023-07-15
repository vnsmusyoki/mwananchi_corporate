-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2023 at 08:42 AM
-- Server version: 8.0.33
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmers`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `admin_full_name` varchar(50) NOT NULL,
  `admin_phone_number` varchar(10) NOT NULL,
  `admin_email_address` varchar(50) NOT NULL,
  `admin_residence` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_full_name`, `admin_phone_number`, `admin_email_address`, `admin_residence`) VALUES
(1, 'admin', '0788998877', 'admin@gmail.com', 'residence is here');

-- --------------------------------------------------------

--
-- Table structure for table `artificial_insemination`
--

CREATE TABLE `artificial_insemination` (
  `artificial_insemination_id` int NOT NULL,
  `artificial_insemination_officer_id` int NOT NULL,
  `artificial_insemination_location_id` int NOT NULL,
  `artificial_insemination_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `artificial_insemination_details` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `artificial_insemination`
--

INSERT INTO `artificial_insemination` (`artificial_insemination_id`, `artificial_insemination_officer_id`, `artificial_insemination_location_id`, `artificial_insemination_date`, `artificial_insemination_details`) VALUES
(3, 1, 1, '2023-07-22 06:46:00', 'kfrkfmkrfmr updated');

-- --------------------------------------------------------

--
-- Table structure for table `communication`
--

CREATE TABLE `communication` (
  `communication_id` int NOT NULL,
  `communication_sender_id` int NOT NULL,
  `communication_receiver_id` int NOT NULL,
  `communication_receiver_content` varchar(5000) NOT NULL,
  `communication_send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `communication_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `communication`
--

INSERT INTO `communication` (`communication_id`, `communication_sender_id`, `communication_receiver_id`, `communication_receiver_content`, `communication_send_date`, `communication_status`) VALUES
(1, 1, 2, 'checking message', '2023-07-15 07:37:55', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `farmer_id` int NOT NULL,
  `farmer_name` varchar(100) NOT NULL,
  `farmer_location` varchar(100) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `email_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`farmer_id`, `farmer_name`, `farmer_location`, `contact_number`, `email_address`) VALUES
(2, 'testing account', 'dmkded', '0987587686', 'farmer@gmail.com'),
(3, 'firnfrkmfr', 'kmkm', '7698758678', 'lko@gmail.com'),
(4, 'test farmer', 'located next to homestead', '0987654354', 'testfarmer@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_locations`
--

CREATE TABLE `farmer_locations` (
  `farmer_locations_id` int NOT NULL,
  `farmer_locations_farmer_id` int NOT NULL,
  `farmer_locations_latitude` varchar(50) NOT NULL,
  `farmer_locations_longitude` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farmer_locations`
--

INSERT INTO `farmer_locations` (`farmer_locations_id`, `farmer_locations_farmer_id`, `farmer_locations_latitude`, `farmer_locations_longitude`) VALUES
(1, 2, '12.76', '17.7');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int NOT NULL,
  `login_username` varchar(50) NOT NULL,
  `login_password` varchar(50) NOT NULL,
  `login_rank` varchar(50) NOT NULL,
  `login_admin_id` int DEFAULT NULL,
  `login_farmer_id` int DEFAULT NULL,
  `login_officer_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_username`, `login_password`, `login_rank`, `login_admin_id`, `login_farmer_id`, `login_officer_id`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin', 1, NULL, NULL),
(2, 'intrudersd', '5f4dcc3b5aa765d61d8327deb882cf99', 'farmer', NULL, 3, NULL),
(3, 'officer', '5f4dcc3b5aa765d61d8327deb882cf99', 'farmer', NULL, NULL, 1),
(4, 'testfarmer', '5f4dcc3b5aa765d61d8327deb882cf99', 'farmer', NULL, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `milk_delivery`
--

CREATE TABLE `milk_delivery` (
  `milk_delivery_id` int NOT NULL,
  `milk_delivery_farmer_id` int NOT NULL,
  `milk_delivery_quantity` varchar(50) NOT NULL,
  `milk_delivery_quality` varchar(50) NOT NULL,
  `milk_delivery_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pay_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `milk_delivery`
--

INSERT INTO `milk_delivery` (`milk_delivery_id`, `milk_delivery_farmer_id`, `milk_delivery_quantity`, `milk_delivery_quality`, `milk_delivery_date`, `pay_status`) VALUES
(4, 2, '6', 'Best', '2023-07-15 08:19:17', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payments_id` int NOT NULL,
  `payments_farmer_id` int NOT NULL,
  `payments_delivery_id` int NOT NULL,
  `payments_amount` int NOT NULL,
  `payments_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payments_balance` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payments_id`, `payments_farmer_id`, `payments_delivery_id`, `payments_amount`, `payments_date`, `payments_balance`) VALUES
(2, 2, 4, 360, '2023-07-15 08:19:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `vaccination_id` int NOT NULL,
  `vaccination_officer_id` int NOT NULL,
  `vaccination_location_id` int NOT NULL,
  `vaccination_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vaccination_details` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vaccination`
--

INSERT INTO `vaccination` (`vaccination_id`, `vaccination_officer_id`, `vaccination_location_id`, `vaccination_date`, `vaccination_details`) VALUES
(1, 1, 1, '2023-07-22 07:16:00', 'please be available updated');

-- --------------------------------------------------------

--
-- Table structure for table `veterinary_officers`
--

CREATE TABLE `veterinary_officers` (
  `veterinary_officers_id` int NOT NULL,
  `veterinary_officers_officer_name` varchar(50) NOT NULL,
  `veterinary_officers_contact_number` varchar(500) NOT NULL,
  `veterinary_officers_email_address` varchar(500) NOT NULL,
  `veterinary_officers_address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `veterinary_officers`
--

INSERT INTO `veterinary_officers` (`veterinary_officers_id`, `veterinary_officers_officer_name`, `veterinary_officers_contact_number`, `veterinary_officers_email_address`, `veterinary_officers_address`) VALUES
(1, 'officers officer', '9857689645', 'officer@gmail.com', 'dmkeme ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `artificial_insemination`
--
ALTER TABLE `artificial_insemination`
  ADD PRIMARY KEY (`artificial_insemination_id`),
  ADD KEY `artificial_insemination_officer_id` (`artificial_insemination_officer_id`),
  ADD KEY `artificial_insemination_location_id` (`artificial_insemination_location_id`);

--
-- Indexes for table `communication`
--
ALTER TABLE `communication`
  ADD PRIMARY KEY (`communication_id`),
  ADD KEY `communication_receiver_id` (`communication_receiver_id`),
  ADD KEY `communication_ibfk_2` (`communication_sender_id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`farmer_id`);

--
-- Indexes for table `farmer_locations`
--
ALTER TABLE `farmer_locations`
  ADD PRIMARY KEY (`farmer_locations_id`),
  ADD KEY `farmer_locations_farmer_id` (`farmer_locations_farmer_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `login_admin_id` (`login_admin_id`),
  ADD KEY `login_farmer_id` (`login_farmer_id`),
  ADD KEY `login_officer_id` (`login_officer_id`);

--
-- Indexes for table `milk_delivery`
--
ALTER TABLE `milk_delivery`
  ADD PRIMARY KEY (`milk_delivery_id`),
  ADD KEY `milk_delivery_farmer_id` (`milk_delivery_farmer_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payments_id`),
  ADD KEY `payments_delivery_id` (`payments_delivery_id`),
  ADD KEY `payments_farmer_id` (`payments_farmer_id`);

--
-- Indexes for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD PRIMARY KEY (`vaccination_id`),
  ADD KEY `vaccination_location_id` (`vaccination_location_id`),
  ADD KEY `vaccination_officer_id` (`vaccination_officer_id`);

--
-- Indexes for table `veterinary_officers`
--
ALTER TABLE `veterinary_officers`
  ADD PRIMARY KEY (`veterinary_officers_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artificial_insemination`
--
ALTER TABLE `artificial_insemination`
  MODIFY `artificial_insemination_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `communication`
--
ALTER TABLE `communication`
  MODIFY `communication_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `farmer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farmer_locations`
--
ALTER TABLE `farmer_locations`
  MODIFY `farmer_locations_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `milk_delivery`
--
ALTER TABLE `milk_delivery`
  MODIFY `milk_delivery_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payments_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vaccination`
--
ALTER TABLE `vaccination`
  MODIFY `vaccination_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `veterinary_officers`
--
ALTER TABLE `veterinary_officers`
  MODIFY `veterinary_officers_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `communication`
--
ALTER TABLE `communication`
  ADD CONSTRAINT `communication_ibfk_1` FOREIGN KEY (`communication_receiver_id`) REFERENCES `farmers` (`farmer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `communication_ibfk_2` FOREIGN KEY (`communication_sender_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `farmer_locations`
--
ALTER TABLE `farmer_locations`
  ADD CONSTRAINT `farmer_locations_ibfk_1` FOREIGN KEY (`farmer_locations_farmer_id`) REFERENCES `farmers` (`farmer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`login_admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`login_farmer_id`) REFERENCES `farmers` (`farmer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `login_ibfk_3` FOREIGN KEY (`login_officer_id`) REFERENCES `veterinary_officers` (`veterinary_officers_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `milk_delivery`
--
ALTER TABLE `milk_delivery`
  ADD CONSTRAINT `milk_delivery_ibfk_1` FOREIGN KEY (`milk_delivery_farmer_id`) REFERENCES `farmers` (`farmer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`payments_delivery_id`) REFERENCES `milk_delivery` (`milk_delivery_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`payments_farmer_id`) REFERENCES `farmers` (`farmer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD CONSTRAINT `vaccination_ibfk_1` FOREIGN KEY (`vaccination_location_id`) REFERENCES `farmer_locations` (`farmer_locations_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vaccination_ibfk_2` FOREIGN KEY (`vaccination_officer_id`) REFERENCES `veterinary_officers` (`veterinary_officers_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
