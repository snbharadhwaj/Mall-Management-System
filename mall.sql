-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2022 at 07:28 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mall`
--

-- --------------------------------------------------------

--
-- Table structure for table `checking`
--

CREATE TABLE `checking` (
  `eid` varchar(20) NOT NULL,
  `ch_no` varchar(20) NOT NULL,
  `temp` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checking`
--

INSERT INTO `checking` (`eid`, `ch_no`, `temp`, `date`) VALUES
('e101001', 'ch101001005', '104', '18-12-2020'),
('e101003', 'ch101003001', '98', '18-12-2020'),
('e101003', 'ch101003003', '104', '2022-03-02'),
('e101003', 'ch101003004', '105', '2022-03-24'),
('e401001', 'ch401001002', '96', '12-12-2020'),
('e101001', 'e101001001', '94', '12-12-2020'),
('e401001', 'e401001001', '95', '12-12-2020'),
('e401001', 'e401001002', '95', '13-12-2020'),
('e401001', 'e401001003', '106', '18-12-2020');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` varchar(20) NOT NULL,
  `cname` varchar(20) NOT NULL,
  `sid` varchar(20) NOT NULL,
  `cphone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cname`, `sid`, `cphone`) VALUES
('c1010001', 'rammohan', 's101', '9876543210'),
('c1010003', 'vivekram', 's101', '9876543210'),
('c4010001', 'pooja', 's401', '9870654321');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `did` varchar(20) NOT NULL,
  `dname` varchar(20) NOT NULL,
  `dfloor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`did`, `dname`, `dfloor`) VALUES
('d001', 'maintainence', '5'),
('d002', 'Administration', '4'),
('d003', 'foodcourt', '4');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `eid` varchar(20) NOT NULL,
  `ename` varchar(20) NOT NULL,
  `ephone` varchar(20) NOT NULL,
  `eaddress` varchar(50) NOT NULL,
  `sid` varchar(20) NOT NULL,
  `did` varchar(20) NOT NULL,
  `desig` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `ename`, `ephone`, `eaddress`, `sid`, `did`, `desig`) VALUES
('e101001', 'srikanth', '9876543245', 'skanth@gmail.com', 's101', 'd002', 'manager'),
('e101003', 'vignesh', '9876543245', 'vigx@gmail.com', 's101', 'd002', 'administrator'),
('e101004', 'pooja', '9876543210', 'pooja@gmail.com', 's101', 'd002', 'assistant'),
('e401001', 'vivek', '9875643210', 'viv@gmail.com', 's401', 'd003', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `track_id` varchar(20) NOT NULL,
  `sid` varchar(20) NOT NULL,
  `arr_time` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`track_id`, `sid`, `arr_time`, `quantity`, `price`) VALUES
('t101001', 's101', '2022-03-09', '5', '6000'),
('t101002', 's101', '2022-03-12', '50', '10000'),
('t401001', 's401', '2022-03-21', '5', '9000'),
('t401005', 's401', '2022-03-02', '5', '6000');

--
-- Triggers `goods`
--
DELIMITER $$
CREATE TRIGGER `insert_price` BEFORE INSERT ON `goods` FOR EACH ROW BEGIN  
IF NEW.quantity<1 THEN SET NEW.price=0; 
END IF;  
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_quantity` BEFORE INSERT ON `goods` FOR EACH ROW BEGIN  
IF NEW.quantity< 1 THEN SET NEW.quantity=0; 
END IF;  
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `own_account`
--

CREATE TABLE `own_account` (
  `tras_id` varchar(20) NOT NULL,
  `sid` varchar(20) NOT NULL,
  `rent_amt` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `own_account`
--

INSERT INTO `own_account` (`tras_id`, `sid`, `rent_amt`, `date`) VALUES
('101001', 's101', '6099', '2022-03-09'),
('103001', 's103', '6000', '2022-03-16'),
('201001', 's201', '7500', '2022-03-13'),
('202001', 's202', '6000', '2022-03-30'),
('401001', 's401', '6000', '2022-03-14');

--
-- Triggers `own_account`
--
DELIMITER $$
CREATE TRIGGER `before_insert_rent_amt` BEFORE INSERT ON `own_account` FOR EACH ROW BEGIN  
IF NEW.rent_amt< 0 THEN SET NEW.rent_amt=0; 
END IF;  
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `sid` varchar(20) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `sfloor` varchar(20) NOT NULL,
  `sservice` varchar(20) NOT NULL,
  `did` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`sid`, `sname`, `sfloor`, `sservice`, `did`) VALUES
('s101', 'central', '1', '', 'd002'),
('s103', 'max', '1', '', 'd002'),
('s104', 'spar', '1', '', 'd002'),
('s201', 'digizone', '2', '', 'd002'),
('s202', 'tandoori', '2', '', 'd003'),
('s209', 'max', '2', '', 'd002'),
('s401', 'shakeon', '4', '', 'd003');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checking`
--
ALTER TABLE `checking`
  ADD PRIMARY KEY (`ch_no`),
  ADD KEY `eidfk` (`eid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`),
  ADD KEY `sidfk` (`sid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `sidfk` (`sid`),
  ADD KEY `didfk` (`did`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`track_id`),
  ADD KEY `sid_fk` (`sid`);

--
-- Indexes for table `own_account`
--
ALTER TABLE `own_account`
  ADD PRIMARY KEY (`tras_id`),
  ADD KEY `sidfk` (`sid`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `did` (`did`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
