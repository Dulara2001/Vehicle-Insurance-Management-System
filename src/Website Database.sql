-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 07:40 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vims`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(500) NOT NULL,
  `PL` tinyint(4) NOT NULL,
  `ImgLocation` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Username`, `Password`, `PL`, `ImgLocation`) VALUES
('Admin', '$2y$10$HKlF4zKrsmoNyRB15tGrjOHTxP/02AUHA8GJKUNixNFCWbSy3cSwi', 3, './profileImages/Admin.jfif'),
('AJLUCI', '$2y$10$BNX/j9HATmspUSys1EEU1OnQyX6ylf5CnK6w3MF5subOPk44xynvy', 2, './profileImages/AJLUCI.jfif'),
('Chanthuka', '$2y$10$1DcDTOhAwNt8l4QubWJRBeZuBYAbdDm2QJpVZoTH.I3NGR7R5Z9ce', 2, './profileImages/Chanthuka.jfif'),
('Gayathri', '$2y$10$IHMfNQwYW3ClniYYcJHIw.R.Mitr9aOl/kHEVyJ7z.COAMJMDj3ZK', 2, './profileImages/Gayathri.png'),
('Sajindu01', '$2y$10$5zyqA98W5GmTAc2hY/0k5.lLStoKlrY3oZ0wQGAZCKqhAdBdIbDou', 2, './profileImages/Sajindu01.png'),
('test01', '$2y$10$PQF9/0JgmnAaU81WL6wZBOo9kx.Ju1KJvx3K5AlugnQredvIHhRpy', 1, './profileImages/test01.png');

-- --------------------------------------------------------

--
-- Table structure for table `claim_request`
--

CREATE TABLE `claim_request` (
  `ClaimRequestID` int(6) NOT NULL,
  `NIC` varchar(13) NOT NULL,
  `PolicyID` varchar(4) NOT NULL,
  `RegNo` varchar(8) NOT NULL,
  `ChassisNo` varchar(17) NOT NULL,
  `AccidentDate` date NOT NULL,
  `AccidentTime` time DEFAULT NULL,
  `Place` varchar(200) NOT NULL,
  `NoOfOccupants` tinyint(4) NOT NULL,
  `PRStatus` varchar(15) NOT NULL,
  `Additional_info` varchar(400) DEFAULT NULL,
  `PRLocation` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claim_request`
--

INSERT INTO `claim_request` (`ClaimRequestID`, `NIC`, `PolicyID`, `RegNo`, `ChassisNo`, `AccidentDate`, `AccidentTime`, `Place`, `NoOfOccupants`, `PRStatus`, `Additional_info`, `PRLocation`) VALUES
(9, '200048738277', 'P002', 'BBB-9090', 'CN462734697823647', '2021-10-07', '11:52:00', 'Piliyandala', 2, 'Yes', '', './PoliceReports/PR_1_200048738277.docx'),
(10, '197243248523V', 'P002', 'CBG-6810', 'CN653278473892758', '2021-10-09', '19:06:00', 'Mount Lavinia', 4, 'Yes', '', './PoliceReports/PR_10_197243248523V.docx'),
(11, '200114345682', 'P001', 'CEB-8503', 'CN459276439677486', '2021-10-10', '20:38:00', 'suwarapola', 2, 'No', '', ''),
(12, '200107100036', 'P001', 'AAA-1111', 'CN543685762379567', '2021-10-10', '20:44:00', 'Katubedda', 4, 'No', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `NIC` varchar(13) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `NameWithInitials` varchar(40) NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `PassportID` varchar(8) DEFAULT NULL,
  `DOB` date NOT NULL,
  `Occupation` varchar(50) DEFAULT NULL,
  `Salary` decimal(8,2) NOT NULL,
  `WorkAddress` varchar(200) NOT NULL,
  `HomeAddress` varchar(200) DEFAULT NULL,
  `Email` varchar(320) NOT NULL,
  `FixedLine` varchar(14) NOT NULL,
  `Preferred_contact` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`NIC`, `Username`, `NameWithInitials`, `CustomerName`, `Gender`, `PassportID`, `DOB`, `Occupation`, `Salary`, `WorkAddress`, `HomeAddress`, `Email`, `FixedLine`, `Preferred_contact`) VALUES
('197243248523V', 'Gayathri', 'S.G.D.Swaris', 'Gayathri Dilrukshi', 'Female', 'J432432', '0002-08-24', 'Principal Service', '50000.00', '', '252/5, Pinlinda Rd, Suwarapola, Piliyandala', 'dilrukshigayathri@yahoo.com', '0112617289', 'E-mail'),
('200048738277', 'Sajindu01', 'S.Shamalka', 'Sajindu Shamalka', 'Male', 'J0099876', '2000-11-09', 'Wali goda dameema', '200000.00', '', 'Piliyandala', 'sajindushamalka@gmail.com', '0112345678', 'E-mail'),
('200107100036', 'AJLUCI', 'W.M.A.J.Wijesinghe', 'Arana Jayavihan', 'Male', 'J432432', '2001-03-11', 'Assistant Manager', '80000.00', '', '252/5, Pinlinda Rd, Suwarapola, Piliyandala', 'aranajayavihan@gmail.com', '0112617289', 'Mobile'),
('200114345682', 'Chanthuka', 'UBGC abhayathunga', 'chanthuka abhayathunga', 'Male', '', '2001-06-29', 'Student', '50000.00', '', '252/b, Pinlinda Rd, Suwarapola, Piliyandala', 'chanthukarc@gmail.com', '0112604531', 'Mobile');

-- --------------------------------------------------------

--
-- Table structure for table `customercontact`
--

CREATE TABLE `customercontact` (
  `NIC` varchar(13) NOT NULL,
  `ContactNo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customercontact`
--

INSERT INTO `customercontact` (`NIC`, `ContactNo`) VALUES
('197243248523V', '0702143578'),
('197243248523V', '0718031196'),
('200048738277', '0764535672'),
('200107100036', '+94764152204'),
('200107100036', '0718083772'),
('200114345682', '+94765258255');

-- --------------------------------------------------------

--
-- Table structure for table `customer_policy`
--

CREATE TABLE `customer_policy` (
  `NIC` varchar(13) NOT NULL,
  `PolicyID` varchar(4) NOT NULL,
  `RegNo` varchar(8) NOT NULL,
  `Start_date` date NOT NULL,
  `Expiry_date` date NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Validity` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_policy`
--

INSERT INTO `customer_policy` (`NIC`, `PolicyID`, `RegNo`, `Start_date`, `Expiry_date`, `Type`, `Validity`) VALUES
('197243248523V', 'P002', 'CBG-6810', '2021-10-10', '2022-04-04', 'Comprehensive', 'VALID'),
('200048738277', 'P002', 'BBB-9090', '2021-10-09', '2022-11-09', 'Comprehensive', 'VALID'),
('200107100036', 'P001', 'AAA-1111', '2021-10-09', '2021-10-30', 'Third Party', 'VALID'),
('200114345682', 'P001', 'CEB-8503', '2021-10-10', '2021-10-21', 'Third Party', 'VALID');

-- --------------------------------------------------------

--
-- Table structure for table `customer_vehicle`
--

CREATE TABLE `customer_vehicle` (
  `NIC` varchar(13) NOT NULL,
  `RegNo` varchar(8) NOT NULL,
  `ChassisNo` char(17) NOT NULL,
  `EngineNo` varchar(17) NOT NULL,
  `Value` decimal(10,2) NOT NULL,
  `Model` varchar(70) NOT NULL,
  `Myear` year(4) NOT NULL,
  `NoOfSeats` tinyint(3) DEFAULT NULL,
  `FuelType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_vehicle`
--

INSERT INTO `customer_vehicle` (`NIC`, `RegNo`, `ChassisNo`, `EngineNo`, `Value`, `Model`, `Myear`, `NoOfSeats`, `FuelType`) VALUES
('197243248523V', 'CBG-6810', 'CN653278473892758', 'EN742938748397298', '5000000.00', 'Toyota Vits 2018', 2018, 4, 'Gasoline'),
('200048738277', 'BBB-9090', 'CN462734697823647', 'EN753987483924308', '10000000.00', 'Ford Shelby Cobra', 2010, 2, 'Gasoline'),
('200107100036', 'AAA-1111', 'CN543685762379567', 'EN483927483204738', '250000.00', 'Bajaj CT100', 2005, 2, 'Gasoline'),
('200114345682', 'CEB-8503', 'CN459276439677486', 'EN572957374843726', '100000.00', 'bajaj 3 stroke', 2019, 3, 'Gasoline');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Username` varchar(50) NOT NULL,
  `Rating` int(1) NOT NULL,
  `Feedback` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Username`, `Rating`, `Feedback`) VALUES
('AJLUCI', 5, 'Awesome website!!! Simple yet functional'),
('Gayathri', 4, 'Simple and Easy'),
('Sajindu01', 4, 'Quick and Easy!!!'),
('test01', 3, 'This is a test!!!');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `InquiryID` int(8) NOT NULL,
  `PolicyID` varchar(4) NOT NULL,
  `FullName` varchar(70) NOT NULL,
  `Email` varchar(320) NOT NULL,
  `ContactNo` varchar(12) NOT NULL,
  `Additional_info` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`InquiryID`, `PolicyID`, `FullName`, `Email`, `ContactNo`, `Additional_info`) VALUES
(1, 'P002', 'Arana Jayavihan', 'it21038150@my.sliit.lk', '+94760417781', ' Can I know the minimal validity period of the policy?'),
(3, 'P001', 'Justin Timberlake', 'justintimberlake@gmail.com', '0761324223', ''),
(4, 'P001', 'Nickey Lauda', 'laudanickey@gmail.com', '+02341564345', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(8) NOT NULL,
  `NIC` varchar(13) NOT NULL,
  `PolicyID` varchar(4) NOT NULL,
  `RegNo` varchar(8) NOT NULL,
  `Amount` decimal(9,2) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `CardType` varchar(30) NOT NULL,
  `CardNumber` varchar(12) NOT NULL,
  `ExpiryDate` date NOT NULL,
  `CVC` tinyint(4) NOT NULL,
  `Date_Time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `NIC`, `PolicyID`, `RegNo`, `Amount`, `Type`, `CardType`, `CardNumber`, `ExpiryDate`, `CVC`, `Date_Time`) VALUES
(9, '200107100036', 'P001', 'AAA-1111', '25000.00', 'Annual', 'Visa', '4321-4567-12', '2023-03-03', 127, '2021-10-10 12:09:10'),
(10, '200048738277', 'P002', 'BBB-9090', '50000.00', 'Annual', 'Visa', '4321-4567-12', '2023-03-03', 123, '2021-10-10 01:24:03'),
(11, '197243248523V', 'P002', 'CBG-6810', '50000.00', 'Annual', 'Master Card', '4221-8083-77', '2022-12-10', 127, '2021-10-10 07:04:10'),
(12, '197243248523V', 'P002', 'CBG-6810', '3500.00', 'Renewal', 'Master Card', '4321-4567-12', '2025-05-05', 127, '2021-10-10 07:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `PolicyID` varchar(4) NOT NULL,
  `PolicyName` varchar(50) NOT NULL,
  `RenewAmount` decimal(7,2) NOT NULL,
  `AnnualAmount` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`PolicyID`, `PolicyName`, `RenewAmount`, `AnnualAmount`) VALUES
('P001', 'Motorcycles and Three wheelers', '2500.00', '25000.00'),
('P002', 'Cars and Mini Vans', '3500.00', '50000.00'),
('P003', 'Vans and SUVs', '4500.00', '75000.00'),
('P004', 'Heavy Vehicles', '6500.00', '120000.00'),
('P005', 'Vehicles on Rent', '5500.00', '100000.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `claim_request`
--
ALTER TABLE `claim_request`
  ADD PRIMARY KEY (`ClaimRequestID`),
  ADD KEY `CR_FK1` (`NIC`,`PolicyID`,`RegNo`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`NIC`,`Username`),
  ADD KEY `C_FK` (`Username`);

--
-- Indexes for table `customercontact`
--
ALTER TABLE `customercontact`
  ADD PRIMARY KEY (`NIC`,`ContactNo`);

--
-- Indexes for table `customer_policy`
--
ALTER TABLE `customer_policy`
  ADD PRIMARY KEY (`NIC`,`PolicyID`,`RegNo`) USING BTREE,
  ADD KEY `CP_FK1` (`NIC`,`RegNo`),
  ADD KEY `CP_FK2` (`PolicyID`);

--
-- Indexes for table `customer_vehicle`
--
ALTER TABLE `customer_vehicle`
  ADD PRIMARY KEY (`NIC`,`RegNo`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Username`,`Rating`,`Feedback`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`InquiryID`),
  ADD KEY `I_FK1` (`PolicyID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`) USING BTREE;

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`PolicyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claim_request`
--
ALTER TABLE `claim_request`
  MODIFY `ClaimRequestID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `InquiryID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `claim_request`
--
ALTER TABLE `claim_request`
  ADD CONSTRAINT `CR_FK1` FOREIGN KEY (`NIC`,`PolicyID`,`RegNo`) REFERENCES `customer_policy` (`NIC`, `PolicyID`, `RegNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `C_FK` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customercontact`
--
ALTER TABLE `customercontact`
  ADD CONSTRAINT `CC_FK` FOREIGN KEY (`NIC`) REFERENCES `customer` (`NIC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_policy`
--
ALTER TABLE `customer_policy`
  ADD CONSTRAINT `CP_FK1` FOREIGN KEY (`NIC`,`RegNo`) REFERENCES `customer_vehicle` (`NIC`, `RegNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CP_FK2` FOREIGN KEY (`PolicyID`) REFERENCES `policy` (`PolicyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_vehicle`
--
ALTER TABLE `customer_vehicle`
  ADD CONSTRAINT `CV_FK1` FOREIGN KEY (`NIC`) REFERENCES `customer` (`NIC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `FK_1` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD CONSTRAINT `I_FK1` FOREIGN KEY (`PolicyID`) REFERENCES `policy` (`PolicyID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
