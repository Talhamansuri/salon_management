-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 04:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `DOB` date NOT NULL,
  `contact` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `admin_img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `first_name`, `last_name`, `gender`, `DOB`, `contact`, `email`, `password`, `admin_img`) VALUES
(5, 'Furkan', 'shaikh', 'Male', '2003-10-08', 8401238840, 'furkan123@gmail.com', 'fume2138', 'images/admin/01c751482ef7c4f5e93f3539efd27f6f.jpg'),
(33, 'sandeep', 'pal', 'Male', '2024-03-20', 9664561379, 'sandeeep@gmail.com', 'sandip123', 'images/admin/d37b020e87945ad7f245e48df752ed03.jpg'),
(34, 'talah', 'mansuri', 'Male', '2003-09-01', 6354375270, 'talhamansuri1999@gmail.com', 'talha123', 'images/admin/a7b40f09e269c0c5b89be6a3fe989b92.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `appointment_id` int(10) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `service` int(11) NOT NULL,
  `message` varchar(50) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_appointment`
--

INSERT INTO `tbl_appointment` (`appointment_id`, `first_name`, `last_name`, `gender`, `email`, `contact`, `service`, `message`, `appointment_date`, `status`, `customer_id`) VALUES
(1, 'talah', 'mansuri', 'Male', 'rekha@gmail.com', 4568521238, 11, ' ', '2024-01-16 19:57:00', 'Completed', 0),
(2, 'sandeep', 'pal', 'Male', 'sandeeep@gmail.com', 4568529871, 13, ' ', '2024-01-10 19:57:00', 'Completed', 5),
(3, 'rekha', 'parmar', 'Female', 'rekha@gmail.com', 4568521239, 15, ' ', '2024-04-18 19:58:00', 'Cancelled', 0),
(4, 'vrushti', 'parmar', 'Female', 'vrushti101@gmail.com', 4568521239, 17, ' ', '2024-01-27 01:02:00', 'Pending', 5),
(5, 'sandeep', 'parmar', 'Male', 'glamsalon001@gmail.c', 1234567890, 18, ' ', '2024-01-20 19:02:00', 'Cancelled', 0),
(8, 'furkan', 'khan', 'Female', 'sandeeep@gmail.com', 9685452510, 19, 'hi this itn te ', '2024-02-19 23:30:00', 'Pending', 0),
(9, 'sandeep', 'pal', 'Male', 'furkanshai123@gmail.', 8401234568, 20, 'this is test ', '2024-04-18 12:08:00', 'Cancelled', 5),
(10, 'furkan ', 'shaikh', 'Male', 'furkanshaikh6411@gma', 9685452510, 11, 'this is testing msg ignore it ', '2024-02-13 13:09:00', 'Completed', 5),
(11, 'sandip', 'pal', 'Male', 'sandip123@gmail.com', 8524563212, 25, 'test ', '2024-02-26 15:38:00', 'Pending', 5),
(12, 'sandip', 'pal', 'Male', 'sandip123@gmail.com', 8524563212, 22, 'test ', '2024-04-24 15:38:00', 'Cancelled', 86),
(13, 'tasin', 'shaikh', 'Male', 'tasinajmeri006@gmail', 8565452585, 14, 'tresting ', '2024-02-27 16:02:00', 'Cancelled', 0),
(14, 'Anas', 'parmar', 'Male', 'sandeeep@gmail.com', 4568529871, 14, 'test ', '2024-03-16 22:35:00', 'Cancelled', 0),
(15, 'Anas', 'parmar', 'Male', 'sandeeep@gmail.com', 4568529871, 12, 'test  ', '2024-03-16 22:35:00', 'Completed', 0),
(16, 'tasin', 'shaikh', 'Male', 'tasinajmeri006@gmail', 8565452585, 13, 'tresting  ', '2024-02-27 16:02:00', 'Completed', 0),
(17, 'furkan ', 'shaikh', 'Female', 'furkanshaikh6411@gmail.com', 9685452510, 13, 'this is testing msg ignore it  ', '2024-02-13 13:09:00', 'Completed', 0),
(18, 'rekha', 'parmar', 'Female', 'talah@gmail.com', 9685452510, 11, 'test ', '2024-03-20 12:36:00', 'Completed', 0),
(19, 'safaegag', 'agaga', 'Female', 'asdd@gmail.com', 4568521238, 13, 'ffg ', '2024-03-21 02:55:00', 'Completed', 0),
(20, 'furkan', 'pal', 'Male', 'furkan123@gmail.com', 1234567890, 12, 'testing ', '2024-03-22 02:41:00', 'Completed', 0),
(21, 'sandip', 'pal', 'Male', 'furkan123@gmail.com', 9685452510, 12, 'testing ', '2024-03-20 05:52:00', 'Pending', 0),
(22, 'furkan', 'khan', 'Male', 'furkan123@gmail.com', 8524569541, 17, ' ', '2024-03-21 01:52:00', 'Pending', 0),
(23, 'sandeep', 'pal', 'Male', 'sandeeep@gmail.com', 9685452510, 23, 'best service require ', '2024-03-22 14:15:00', 'Pending', 81),
(24, 'sandeep', 'pal', 'Male', 'sandeeep@gmail.com', 9685452510, 17, 'best service require ', '2024-03-22 14:15:00', 'Cancelled', 81),
(25, 'sandeep', 'pal', 'Male', 'sandeeep@gmail.com', 9685452510, 11, 'best service require ', '2024-03-22 14:15:00', 'Cancelled', 81),
(26, 'rekha', 'parmar', 'Female', 'test@gmail.vcom', 8524569541, 13, 'test ', '2024-03-22 14:02:00', 'Cancelled', 0),
(27, 'mansi', 'rathor', 'Female', 'mansi@gmail.com', 9685452510, 11, ' ', '2024-03-20 15:42:00', 'Pending', 0),
(28, 'furkan', 'shaikh', 'Male', 'furkan123@gmail.com', 8401238842, 15, ' ', '2024-03-20 15:26:00', 'Pending', 0),
(29, 'sandeep', 'pal', 'Male', 'sandeeep@gmail.com', 4568521239, 28, ' ', '2024-03-23 16:26:00', 'Pending', 0),
(30, 'reshma', 'ansari', 'Female', 'reshma123@gmail.com', 4567432344, 20, ' ', '2024-03-22 18:22:00', 'Cancelled', 86),
(31, 'Anas', 'shah', 'Male', 'furkan123@gmail.com', 4568521239, 13, ' ', '2024-03-20 18:45:00', 'Pending', 0),
(32, 'talah', 'mansuri', 'Male', 'talah@gmail.com', 4568529871, 11, ' ', '2024-03-23 13:44:00', 'Pending', 86),
(33, 'roshni', 'ansari', 'Female', 'roshni@gmail.com', 85425963578, 12, 'NA ', '2024-03-22 21:39:00', 'Pending', 0),
(34, 'sandeep', 'khan', 'Female', 'sandeeep@gmail.com', 9685452510, 25, ' ', '2024-04-25 15:14:00', 'Pending', 0),
(35, 'talah', 'mansuri', 'Male', 'talhamansuri1999@gmail.com', 7845965822, 32, ' ', '2024-04-25 12:05:00', 'Pending', 86),
(36, 'talah', 'mansuri', 'Male', 'talhamansuri1999@gmail.com', 7845965822, 32, ' ', '2024-04-25 12:05:00', 'Cancelled', 86),
(37, 'furkan', 'shaikh', 'Male', 'furkan123@gmail.com', 4568521239, 20, ' ', '2024-04-25 18:35:00', 'Pending', 86),
(38, 'talha', 'mansuri', 'Male', 'talhamansuri1999@gmail.com', 6354375270, 11, 'test ', '2024-05-08 23:34:00', 'Pending', 86),
(39, 'talha', 'mansuri', 'Male', 'talhamansuri1999@gmail.com', 6354375270, 11, 'test ', '2024-05-08 23:34:00', 'Pending', 86),
(40, 'talha', 'mansuri', 'Male', 'talhamansuri1999@gmail.com', 6354375270, 14, 'test for reset\r\n ', '2024-05-08 22:35:00', 'Pending', 86),
(41, 'talha', 'mansuri', 'Male', 'talhamansuri1999@gmail.com', 6354375270, 29, '..... ', '2024-12-11 19:30:00', 'Pending', 0),
(42, 'talha', 'mansuri', 'Male', 'talhamansuri1999@gmail.com', 6354375270, 29, '..... ', '2024-12-11 19:30:00', 'Pending', 0),
(43, 'talha', 'mansuri', 'Male', 'talhamansuri1999@gmail.com', 6354375270, 31, '.. ', '2024-12-11 19:34:00', 'Pending', 0),
(44, 'talha', 'mansuri', 'Male', 'talhamansuri1999@gmail.com', 6354375270, 26, '.. ', '2024-12-11 19:40:00', 'Pending', 86),
(45, 'talha', 'mansuri', 'Male', 'talhamansuri1999@gmail.com', 6354375270, 27, '... ', '2024-12-11 19:41:00', 'Pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `contact_id` int(11) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `contact_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`contact_id`, `customer_name`, `email`, `contact`, `message`, `contact_date`) VALUES
(1, 'oppo', '0', 9685452510, 'test', '2024-03-20 12:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `contact` bigint(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `cust_img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `first_name`, `last_name`, `gender`, `DOB`, `contact`, `email`, `password`, `cust_img`) VALUES
(76, 'Priya', 'Patel', 'Female', '2024-03-22', 9938259210, 'priyapate145l@exampl', 'priyanka@123', 'images/customer/a975934bb378afc4ca8c133df451f56e.jpg'),
(77, 'Rohan', 'Shah', 'Male', '2024-03-20', 886669610, 'rohanshah99@gmail.co', 'rohan@shah', 'images/customer/7ebc1dbc1119226a49ffd7e1aa93d0d6.jpg'),
(78, 'Nisha', 'Sharma', 'Female', '2024-03-21', 9316953911, 'nishash128@gmail.com', 'nishu@90', 'images/customer/87ff14780b70043d7a2e2d21fcdb26c1.jpg'),
(79, 'Rahul', 'Singh', 'Male', '2024-03-21', 9925103879, 'rahulsh560@gmail.com', '134#rahul', 'images/customer/a7b40f09e269c0c5b89be6a3fe989b92.jpg'),
(80, 'Amit', 'Verma', 'Male', '2024-03-20', 9874513795, 'amit642@gmail.com', 'amit@895', 'images/customer/b9e0e30ac1ec95077b7e1d0abd250e5d.jpg'),
(81, 'sandeep', 'Rajput', 'Male', '2024-03-20', 9925961310, 'sandeepp84@gmail.com', 'sandeep@1239', 'images/customer/01c751482ef7c4f5e93f3539efd27f6f.jpg'),
(82, 'Sneha', 'Sharma', 'Female', '2024-03-21', 9825983001, 'snehashar129@gmail.c', 'snehasha@90', 'images/customer/016a34bbf9dc95a43f2003c78964a543.jpg'),
(83, 'Deepak', 'Patel', 'Male', '2024-03-20', 7487865500, 'deepaksingh006@gmail', 'deep@190', 'images/customer/63f531e84f6a30df939f06edef46ead1.jpg'),
(84, 'Ashish', 'Gupta', 'Male', '2024-03-21', 9898956226, 'ashish895@gmail.com', 'ashish@120', 'images/customer/71ef4f1d1042314423a60f4d1e7b8d82.jpg'),
(85, 'Riya', 'Singhania', 'Female', '2024-03-20', 9328001210, 'riyasighania905@gmai', 'riya@1201', 'images/customer/36f0c69fccfd2113b617c371f0969dfe.jpg'),
(86, 'sandeep', 'pal', 'Male', '2004-08-16', 9685452510, 'test123@gmail.com', 'test456', 'images/customer/01c751482ef7c4f5e93f3539efd27f6f.jpg'),
(87, 'test', 'test', 'Female', '2005-05-12', 8524569541, 'test@gmail.vcom', '458525', 'images/customer/4c54dd0932c788df77ace9ae53f6ff39.jpg'),
(88, 'furkan', 'shaikh', 'Male', '2003-10-08', 9685452510, 'furkan123@gmail.com', 'furkan123', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `emp_id` int(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `employee_img` varchar(200) NOT NULL,
  `address` varchar(50) NOT NULL,
  `designation` varchar(10) NOT NULL,
  `salary` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`emp_id`, `fname`, `lname`, `gender`, `email`, `password`, `contact`, `employee_img`, `address`, `designation`, `salary`) VALUES
(11, 'Priya', 'Patel', 'Female', 'priyapatel98@gmail.c', 'priy@123', 9876543210, 'images/employees/016a34bbf9dc95a43f2003c78964a543.jpg', '456, Rajput Nagar, Navrangpura, Ahmedabad', 'Manager', 25000),
(12, 'Rahul', 'Sharma', 'Male', 'rahulsh56@gmail.com', 'sharma@909', 8765432109, 'images/employees/d37b020e87945ad7f245e48df752ed03.jpg', '789, Shanti Park Society, Ghatlodia, Ahmedabad', 'Employee', 20000),
(13, 'Nisha', 'Verma', 'Female', 'nishaverma6543@gmail', 'nishu@98', 5432109876, 'images/employees/e8bbcc4d69807c2f3902080a4a2c8d95.jpg', '101, Himalaya Flats, Naranpura, Ahmedabad', 'Manager', 18000),
(14, 'Deepak', 'Rajput', 'Male', 'deepakrajput@gmail.c', 'rajput@789', 9925389210, 'images/employees/b9e0e30ac1ec95077b7e1d0abd250e5d.jpg', '234, Swaminarayan Society, Sabarmati, Ahmedabad', 'Clerk', 17000),
(15, 'Ayesha', 'Patel', 'Female', 'ayeshapl01@gmail.com', 'patel@12', 9996645613, 'images/employees/36f0c69fccfd2113b617c371f0969dfe.jpg', '890, Krishna Nagar, Maninagar, Ahmedabad', 'Sales man', 18000),
(16, 'Sanjay', 'Gupta', 'Male', 'sanjaygupta009@gmail', '123@gupta', 987654321, 'images/employees/71ef4f1d1042314423a60f4d1e7b8d82.jpg', '321, Nirmal Residency, Chandkheda, Ahmedabad', 'Sales man', 17000),
(17, 'Ankit', 'Singh', 'Male', 'ankitsingh564@gmail.', 'ankitsin@1210', 6543210987, 'images/employees/01c751482ef7c4f5e93f3539efd27f6f.jpg', '210, Anand Nagar, Naroda, Ahmedabad', 'Manager', 25000),
(18, 'Sonal', 'Verma', 'Female', 'sonal124@gmail.com', 'sonal178verma', 9054132610, 'images/employees/a975934bb378afc4ca8c133df451f56e.jpg', '987, Aakruti Society, Bopal, Ahmedabad', 'Employee', 18000),
(20, 'Anas', 'Rangrej', 'Male', 'anasran97@gmail.com', 'anasali@87', 7861002327, 'images/employees/7ebc1dbc1119226a49ffd7e1aa93d0d6.jpg', '567, Vasna Road, Paldi, Ahmedabad', 'Manager', 18000),
(22, 'sandeep', 'pal', 'Male', 'sandeeep@gmail.com', 'sandeep', 4568529871, 'images/employees/4c54dd0932c788df77ace9ae53f6ff39.jpg', 'isanpur', 'Sales man', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `customer_name`, `email`, `date`, `comments`) VALUES
(1, 'sunil', 'vijay12@gmail.com', '2024-02-11', 'ndjwnfhgnewjdnajSnabhea');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `order_add` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `pin_code` int(11) NOT NULL,
  `order_notes` text NOT NULL,
  `order_date` datetime NOT NULL,
  `order_amt` int(11) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `customer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `first_name`, `last_name`, `email`, `contact`, `order_add`, `city`, `state`, `country`, `pin_code`, `order_notes`, `order_date`, `order_amt`, `payment_status`, `order_status`, `customer_id`) VALUES
(15, 'talah', 'mansuri', 'talah@gmail.com', 8524569541, 'ormon cityahmedaad', 'ahmedabad', 'gujarat', 'india', 458556, 'this is test 25', '2024-03-18 05:08:43', 2097, 'Completed', 'Completed', 86),
(18, 'furkan', 'shaikh', 'furkan123@gmail.com', 9685452510, 'danilimdaberal market', 'ahmedabad', 'gujarat', 'india', 458556, '', '2024-03-20 07:55:42', 2097, 'Cancelled', 'Completed', 86),
(21, 'talah', 'shaikh', 'test@gmail.vcom', 9685452510, 'danilimda', 'ahmedabad', 'gujarat', 'india', 452652, '', '2024-04-22 09:44:44', 1197, 'Pending', 'Pending', 86),
(22, 'talah', 'shaikh', 'test@gmail.vcom', 9685452510, 'danilimda', 'ahmedabad', 'gujarat', 'india', 452652, '', '2024-04-22 09:46:47', 1197, 'Pending', 'Cancelled', 86),
(23, 'talah', 'shaikh', 'test@gmail.vcom', 9685452510, 'danilimda', 'ahmedabad', 'gujarat', 'india', 452652, '', '2024-04-22 09:48:17', 1197, 'Pending', 'Completed', 86),
(27, 'furkan', 'shaikh', 'furkan123@gmail.com', 4568521238, 'danilimda', 'ahmedabad', 'gujarat', 'india', 458522, '', '2024-04-23 10:27:15', 1690, 'Pending', 'Cancelled', 86),
(28, 'sandip', 'shaikh', 'furkan123@gmail.com', 8524569541, 'danilimda', 'ahmedabad', 'gujarat', 'india', 458565, '', '2024-04-23 11:03:40', 845, 'Completed', 'Pending', 86),
(29, 'talha', 'man', 'talhamansuri1999@gmail.com', 6354375270, 'lala', 'ahmedabd', 'gujarat', 'india', 380028, 'test', '2024-05-04 16:06:07', 959, 'Pending', 'Pending', 86);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `order_details_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`order_details_id`, `order_id`, `quantity`, `price`, `product_id`) VALUES
(1, 18, 2, 549, 17),
(2, 18, 1, 999, 25),
(4, 15, 3, 699, 29),
(5, 15, 2, 549, 17),
(6, 18, 3, 699, 27),
(7, 21, 3, 399, 18),
(11, 27, 2, 845, 19),
(12, 28, 1, 845, 19),
(13, 29, 1, 959, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(10) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount` int(10) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `payment_date`, `amount`, `payment_type`, `order_id`, `customer_id`) VALUES
(12, '2024-04-23 07:22:34', 12000, 'upi', 18, 12),
(13, '2024-04-23 08:26:01', 0, 'COD', 0, 0),
(14, '2024-04-23 08:27:21', 1690, 'COD', 27, 86),
(15, '2024-04-23 08:29:47', 1690, 'COD', 27, 86),
(16, '2024-04-23 08:31:26', 1690, 'UPI', 0, 86),
(17, '2024-04-23 09:03:46', 845, 'Card', 28, 86),
(18, '2024-05-04 14:06:14', 959, 'COD', 29, 86);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(35) NOT NULL,
  `description` varchar(150) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `stock` varchar(20) NOT NULL,
  `product_img` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `description`, `product_quantity`, `stock`, `product_img`, `product_price`, `category_id`) VALUES
(17, 'Argan Oil Shampoo', 'Nourish and hydrate your hair with our Argan Oil Shampoo. Formulated with natural argan oil extract to leave your hair feeling soft, smooth, and manag', 20, 'In stock', 'images/product_img/1.0.jpg', 549, 1),
(18, 'Hydrating Facial Serum', 'Revitalize your skin with our Hydrating Facial Serum. Packed with vitamins and antioxidants, this serum deeply hydrates and improves skin texture, lea', 250, 'Out of stock', 'images/product_img/2.webp', 399, 2),
(19, 'Professional Hair Dryer', 'Achieve salon-quality results at home with our Professional Hair Dryer. Featuring multiple heat and speed settings, this dryer delivers fast drying an', 50, 'In stock', 'images/product_img/3.webp', 845, 3),
(21, 'Exfoliating Body Scrub', 'Transform your skin with our Exfoliating Body Scrub. Infused with natural exfoliants and essential oils, this scrub gently buffs away dead skin cells,', 250, 'In stock', 'images/product_img/5.webp', 449, 5),
(24, 'Curl Enhancing Mousse', 'Define and enhance your natural curls with our Curl Enhancing Mousse. This lightweight formula provides long-lasting hold and adds volume for bouncy, ', 400, 'Out of stock', 'images/product_img/9.jpg', 959, 1),
(25, 'Heat Protectant Spray', 'Shield your hair from heat damage with our Heat Protectant Spray. This lightweight spray forms a protective barrier around each strand to prevent brea', 150, 'In stock', 'images/product_img/12.webp', 999, 1),
(26, 'Soothing Aloe Vera Gel', 'Calm and hydrate irritated skin with our Soothing Aloe Vera Gel. Made with pure aloe vera extract, this gel soothes sunburns, insect bites, and minor ', 100, 'In stock', 'images/product_img/13.webp', 759, 2),
(27, 'Nourishing Hair Mask', 'Restore moisture and shine to dry, damaged hair with our Nourishing Hair Mask. Infused with argan oil and keratin, this mask deeply nourishes and repa', 500, 'Out of stock', 'images/product_img/14.webp', 699, 1),
(28, 'Facial Cleansing Brush', 'Deep clean your pores with our Facial Cleansing Brush. This waterproof brush gently exfoliates and removes dirt, oil, and makeup residue for clearer, ', 850, 'Out of stock', 'images/product_img/15.webp', 450, 2),
(29, 'Anti-Aging Night Cream', 'Rejuvenate your skin while you sleep with our Anti-Aging Night Cream. Formulated with retinol and hyaluronic acid, this cream reduces the appearance o', 215, 'In stock', 'images/product_img/16.webp', 699, 2),
(30, 'Volumizing Hair Spray', 'Add volume and hold to your hair with our Volumizing Hair Spray. This lightweight formula provides long-lasting lift and control without weighing hair', 100, 'In stock', 'images/product_img/17.webp', 990, 1),
(31, 'Matte Lipstick Set', 'Achieve a bold, matte lip with our Matte Lipstick Set. This set includes a range of vibrant shades with a creamy, long-lasting formula for intense col', 250, 'In stock', 'images/product_img/18.webp', 990, 8),
(32, 'Firming Body Lotion', 'Tighten and tone your skin with our Firming Body Lotion. Enriched with collagen and elastin, this lotion improves skin elasticity and texture for smoo', 100, 'In stock', 'images/product_img/19.jpg', 598, 5),
(33, 'Hair Repair Serum', 'Repair and strengthen damaged hair with our Hair Repair Serum. Formulated with keratin and amino acids, this serum seals split ends and prevents futur', 80, 'In stock', 'images/product_img/20.webp', 2500, 1),
(34, 'Clarifying Shampoo', ' Remove buildup and impurities from your hair with our Clarifying Shampoo. Formulated with tea tree oil and peppermint extract, this shampoo detoxifie', 280, 'In stock', 'images/product_img/23.jpg', 699, 1),
(35, 'Hydrating Sheet Mask', 'Hydrate and nourish your skin with our Hydrating Sheet Mask. Infused with hyaluronic acid and botanical extracts, this mask restores moisture and impr', 600, 'Out of stock', 'images/product_img/24.jpg', 250, 2),
(36, 'Curl Defining Cream', 'Define and enhance your curls with our Curl Defining Cream. This lightweight formula smooths frizz and adds definition for soft, bouncy curls that las', 850, 'Out of stock', 'images/product_img/25.jpg', 655, 1),
(37, 'Replenishing Lip Balm', 'Nourish and protect your lips with our Replenishing Lip Balm. Enriched with shea butter and coconut oil, this balm hydrates dry, chapped lips and lock', 200, 'In stock', 'images/product_img/26.jpg', 499, 9),
(38, 'Anti-Dandruff Scalp Treatment', 'Soothe and treat dandruff-prone scalp with our Anti-Dandruff Scalp Treatment. Formulated with salicylic acid and tea tree oil, this treatment exfoliat', 100, 'In stock', 'images/product_img/27.webp', 2800, 1),
(39, 'Hair Thickening Sham', 'Add volume and thickness to fine, limp hair with our Hair Thickening Shampoo. Formulated with biotin and collagen, this shampoo boosts hair density an', 300, 'In stock', 'images/product_img/29.jpg', 745, 1),
(40, 'Brightening Eye Cream', 'Brighten and depuff tired eyes with our Brightening Eye Cream. Enriched with vitamin C and caffeine, this cream reduces dark circles and under-eye bag', 50, 'In stock', 'images/product_img/30.jpg', 1200, 7),
(41, 'Moisturizing Body Wash', 'Cleanse and moisturize your skin with our Moisturizing Body Wash. Enriched with shea butter and vitamin E, this creamy formula nourishes and hydrates ', 800, 'Out of stock', 'images/product_img/32.jpg', 595, 5),
(42, 'Firm Hold Hairspray', 'Lock your style in place with our Firm Hold Hairspray. This fast-drying formula provides long-lasting hold and control without stiffness or flaking fo', 600, 'Out of stock', 'images/product_img/34.webp', 900, 1),
(46, 'Texturizing Sea Salt', 'Achieve effortless beach waves with our Texturizing Sea Salt Spray. \r\n', 600, 'In stock', 'images/product_img/46.webp', 583, 1),
(47, 'Firm Hold Gel', 'Achieve sleek, sculpted hairstyles with our Firm Hold Gel. This alcohol-free formula provides long-lasting hold and control without flaking or stiffne', 150, 'In stock', 'images/product_img/51.0.jpg', 795, 1),
(48, 'Soothing Sunburn Gel', 'Relieve pain and inflammation from sunburn with our Soothing Sunburn Gel. Infused with aloe vera and menthol, this gel cools and hydrates sun-damaged ', 0, 'Out of stock', 'images/product_img/52.webp', 415, 2),
(49, 'Hydrating Sleep Mask', 'Restore moisture and radiance to your skin overnight with our Hydrating Sleep Mask. Infused with hyaluronic acid and botanical extracts, this mask rep', 500, 'In stock', 'images/product_img/54.webp', 450, 2),
(50, 'Gentle Exfoliating Scrub', ' Brighten and smooth your complexion with our Gentle Exfoliating Scrub. Formulated with microbeads and fruit enzymes, this scrub gently buffs away dea', 100, 'In stock', 'images/product_img/55.jpg', 849, 2),
(52, 'Shine-Enhancing Hair Oil', 'Add shine and smoothness to your hair with our Shine-Enhancing Hair Oil. Infused with argan oil and vitamin E, this lightweight oil tames frizz and ad', 510, 'In stock', 'images/product_img/57.jpg', 1100, 1),
(53, 'Pore-Refining Toner', 'Minimize pores and balance oil production with our Pore-Refining Toner. Formulated with witch hazel and salicylic acid, this toner removes excess oil ', 100, 'In stock', 'images/product_img/58.webp', 949, 2),
(54, 'Body Contouring Cream', 'Sculpt and tone your body with our Body Contouring Cream. Enriched with caffeine and green tea extract, this cream reduces cellulite and firms skin fo', 0, 'Out of stock', 'images/product_img/59.webp', 1750, 5),
(56, 'Soothing Aftersun Lotion', 'Hydrate and soothe sun-damaged skin with our Soothing Aftersun Lotion. Enriched with aloe vera and coconut oil, this lotion calms redness and replenis', 20, 'In stock', 'images/product_img/60.0.jpg', 1385, 2),
(57, 'Styling Cream', 'Create effortless, tousled styles with our Styling Cream. This lightweight formula adds texture and definition for a lived-in look with flexible hold ', 100, 'In stock', 'images/product_img/61.jpg', 2149, 1),
(58, 'Hydrating Lip Scrub', 'Exfoliate and smooth dry, chapped lips with our Hydrating Lip Scrub. Formulated with sugar crystals and shea butter, this scrub gently buffs away dead', 60, 'In stock', 'images/product_img/62.webp', 415, 9),
(59, 'Spot Correcting Serum', 'Fade dark spots and hyperpigmentation with our Spot Correcting Serum. Infused with niacinamide and vitamin C, this serum evens skin tone and brightens', 120, 'In stock', 'images/product_img/63.webp', 695, 2),
(60, 'Curl-Defining Gel', 'Define and control your curls with our Curl-Defining Gel. This non-sticky formula smooths frizz and adds definition for soft, bouncy curls that last a', 0, 'Out of stock', 'images/product_img/64.jpg', 2500, 3),
(61, 'Purifying Charcoal Cleanser', 'Cleanse and detoxify your skin with our Purifying Charcoal Cleanser. Formulated with activated charcoal and tea tree oil, this cleanser removes impuri', 600, 'In stock', 'images/product_img/65.webp', 890, 2),
(62, 'Texturizing Dry Shampoo', 'Refresh and add volume to your hair with our Texturizing Dry Shampoo. This powder formula absorbs oil and adds texture for tousled, second-day hair wi', 100, 'In stock', 'images/product_img/66.jpg', 1105, 1),
(63, 'Nourishing Hand Cream', 'Soften and hydrate dry hands with our Nourishing Hand Cream. Enriched with shea butter and almond oil, this cream absorbs quickly to soothe and replen', 0, 'Out of stock', 'images/product_img/67.webp', 349, 12),
(67, 'Replenishing Body Oil', 'Hydrate and nourish your skin with our Replenishing Body Oil. Enriched with argan oil and vitamin E, this lightweight oil absorbs quickly to soften an', 100, 'In stock', 'images/product_img/69.jpg', 2149, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_category`
--

CREATE TABLE `tbl_product_category` (
  `category_id` int(20) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product_category`
--

INSERT INTO `tbl_product_category` (`category_id`, `category_name`) VALUES
(1, 'Hair Care'),
(2, 'Skin Care'),
(3, ' Hair Tools'),
(4, ' Nail Care'),
(5, 'Body Care'),
(6, 'Makeup Tools'),
(7, 'Eye Care'),
(8, 'Makeup'),
(9, 'Lip Care'),
(10, 'Foot Care'),
(11, 'Mens Care'),
(12, 'Hand Care');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE `tbl_service` (
  `service_id` int(10) NOT NULL,
  `service_name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `service_charge` int(10) NOT NULL,
  `service_type` varchar(20) NOT NULL,
  `service_img` varchar(100) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`service_id`, `service_name`, `description`, `service_charge`, `service_type`, `service_img`, `category_id`) VALUES
(11, 'Haircut', 'Classic haircut tailored to your style.', 150, 'Male', 'images/service/1.jpg', 11),
(13, 'Hot Towel Shave', 'Traditional shave with hot towels and soothing balms.', 250, 'Male', 'images/service/3.jpg', 0),
(14, 'Scalp Massage ', 'Relaxing massage to rejuvenate the scalp.', 200, 'Male', 'images/service/4.jpg', 0),
(15, 'Mens Manicure', 'Nail shaping, cuticle care, and hand massage.', 150, 'Male', 'images/service/5.jpg', 0),
(17, 'Highlights', 'Adding dimension and depth to the hair.', 350, 'Male', 'images/service/9.jpg', 11),
(19, 'Waxing (Body)', 'Hair removal for various body areas...', 450, 'Male', 'images/service/10.jpg', 11),
(20, 'Facial', ' Cleansing, exfoliation, and moisturizing treatment for the face.', 550, 'Male', 'images/service/13.jpg', 11),
(21, 'Hair Styling', 'Styling with products for a polished look.', 300, 'Male', 'images/service/12.jpg', 11),
(22, ' Body Massage', 'Full-body massage for relaxation and muscle relief.', 700, 'Male', 'images/service/18.jpg', 11),
(24, 'Hair Wash & Blow Dry', 'Shampoo, conditioning, and blowout styling.', 1100, 'Female', 'images/service/22.jpg', 11),
(25, 'Updo Hairstyle', 'Elegant hair styling for special occasions.', 1500, 'Female', 'images/service/23.jpg', 11),
(26, 'Women Hair Color', 'Customized color application for vibrant hair.', 1600, 'Female', 'images/service/25.jpg', 11),
(27, 'Highlights & Lowligh', 'Adding dimension with highlights and lowlights.', 1200, 'Female', 'images/service/24.jpg', 11),
(28, 'Hair Extensions (Cli', 'Temporary extensions for instant length and volume.', 1800, 'Female', 'images/service/26.jpg', 11),
(29, 'Brazilian Blowout', 'Smoothing treatment for frizz-free hair.', 2050, 'Female', 'images/service/27.jpg', 11),
(30, ' Women Manicure', 'Nail shaping, cuticle care, and polish application.', 1700, 'Female', 'images/service/28.jpg', 11),
(31, 'Women Pedicure', 'Foot soak, exfoliation, nail care, and massage.', 2000, 'Female', 'images/service/29.jpg', 11),
(32, 'Body Waxing (Full Le', 'Hair removal for full legs.', 800, 'Female', 'images/service/33.jpg', 11),
(33, ' Eyelash Tinting', 'Darkening the color of eyelashes with tint.', 450, 'Female', 'images/service/37.jpg', 11),
(34, 'Facial (Deep Cleansi', 'Deep cleansing treatment for clearer skin.', 1200, 'Female', 'images/service/42.jpg', 11),
(35, 'Foot Reflexology', 'Pressure point massage on the feet for overall wellness.', 800, 'Female', 'images/service/48.jpg', 11),
(36, 'Hair Color', 'Subtle color enhancement or full coverage.', 450, 'Male', 'images/service/7.0.jpg', 11),
(37, 'Beard Trim', 'Precision trimming and shaping of the beard.', 150, 'Male', 'images/service/beard trim.jpg', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_category`
--

CREATE TABLE `tbl_service_category` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_service_category`
--

INSERT INTO `tbl_service_category` (`category_id`, `category_name`) VALUES
(11, 'Hair'),
(12, 'Facial'),
(13, 'Massage'),
(14, 'Nails'),
(15, 'Skin Care'),
(16, 'Waxing'),
(17, 'Eyes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`customer_id`, `product_id`) VALUES
(68, 2),
(68, 8),
(86, 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`order_details_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_service`
--
ALTER TABLE `tbl_service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_service_category`
--
ALTER TABLE `tbl_service_category`
  ADD PRIMARY KEY (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `appointment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `emp_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_service`
--
ALTER TABLE `tbl_service`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_service_category`
--
ALTER TABLE `tbl_service_category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
