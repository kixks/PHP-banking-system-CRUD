-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2022 at 07:41 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'jaworski', 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_address` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `total_credit` int(11) NOT NULL,
  `total_debit` int(11) NOT NULL,
  `net_balance` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `sex`, `mobile_number`, `email`, `full_address`, `zip_code`, `date_of_birth`, `branch`, `password`, `customer_id`, `total_credit`, `total_debit`, `net_balance`, `date_created`) VALUES
(13, 'skember', 'Married', '123', '123', 'asd123', '123', '2022-10-05', 'Tagum', '123', '1011176', 5000, 13000, 2000, '2022-10-05'),
(14, 'ayayay', 'Married', '123', '123', '123123', '123', '2022-10-05', 'Tagum', '123', '1011670', 4000, 0, 4000, '2022-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `passbook_1011176`
--

CREATE TABLE `passbook_1011176` (
  `id` int(255) NOT NULL,
  `Transaction_id` varchar(255) DEFAULT NULL,
  `Transaction_date` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Cr_amount` varchar(255) DEFAULT NULL,
  `Dr_amount` varchar(255) DEFAULT NULL,
  `Net_Balance` varchar(255) DEFAULT NULL,
  `Remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passbook_1011176`
--

INSERT INTO `passbook_1011176` (`id`, `Transaction_id`, `Transaction_date`, `Description`, `Cr_amount`, `Dr_amount`, `Net_Balance`, `Remark`) VALUES
(1, '882516044', '05/10/22 06:34:45 PM', 'Account Opening', '0', '0', '0', NULL),
(2, '522994916', '05/10/22 06:35:03 PM', 'Cash Deposit', '4500', '0', '4500', 'Cash Deposit'),
(3, '596874169', '05/10/22 06:35:20 PM', 'Cash Deposit', '500', '0', '5000', 'Cash Deposit'),
(4, '765806964', '05/10/22 07:10:11 PM', 'Cash Withdrawal', '0', '1000', '4000', 'Cash Withdrawal'),
(5, '828130588', '05/10/22 07:25:15 PM', 'Cash Deposit', '8000', '0', '7000', 'Cash Deposit'),
(6, '572958339', '05/10/22 10:20:08 PM', 'Cash Withdrawal', '0', '11000', '4000', 'Cash Withdrawal'),
(7, '186702874', '05/10/22 10:20:39 PM', 'Cash Withdrawal', '0', '12000', '3000', 'Cash Withdrawal'),
(8, '432147433', '05/10/22 10:33:59 PM', 'Other Bank Transfer', '0', '13000', '2000', 'Other Bank Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `passbook_1011670`
--

CREATE TABLE `passbook_1011670` (
  `id` int(255) NOT NULL,
  `Transaction_id` varchar(255) DEFAULT NULL,
  `Transaction_date` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Cr_amount` varchar(255) DEFAULT NULL,
  `Dr_amount` varchar(255) DEFAULT NULL,
  `Net_Balance` varchar(255) DEFAULT NULL,
  `Remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passbook_1011670`
--

INSERT INTO `passbook_1011670` (`id`, `Transaction_id`, `Transaction_date`, `Description`, `Cr_amount`, `Dr_amount`, `Net_Balance`, `Remark`) VALUES
(1, '935583556', '05/10/22 07:26:51 PM', 'Account Opening', '0', '0', '0', NULL),
(2, '572958339', '05/10/22 10:20:08 PM', 'Cash Withdrawal', '3000', '0', '3000', 'Cash Withdrawal'),
(3, '186702874', '05/10/22 10:20:39 PM', 'Cash Withdrawal', '4000', '0', '4000', 'Cash Withdrawal');

-- --------------------------------------------------------

--
-- Table structure for table `pending_accounts`
--

CREATE TABLE `pending_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_address` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `application_num` varchar(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passbook_1011176`
--
ALTER TABLE `passbook_1011176`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passbook_1011670`
--
ALTER TABLE `passbook_1011670`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_accounts`
--
ALTER TABLE `pending_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `passbook_1011176`
--
ALTER TABLE `passbook_1011176`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `passbook_1011670`
--
ALTER TABLE `passbook_1011670`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pending_accounts`
--
ALTER TABLE `pending_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
