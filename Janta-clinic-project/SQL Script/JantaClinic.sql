-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: host.docker.internal
-- Generation Time: Sep 08, 2024 at 05:11 AM
-- Server version: 10.11.8-MariaDB
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `JantaClinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `Address`
--

CREATE TABLE `Address` (
  `Address_ID` int(11) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `Patient_ID_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Address`
--

INSERT INTO `Address` (`Address_ID`, `street`, `city`, `state`, `zipcode`, `Patient_ID_FK`) VALUES
(2, '123 Main St', 'Springfield', 'IL', '627045', 2),
(6, 'Panshwati colony', 'Muzaffarpur', 'Bihar', '842008', 6),
(7, 'Anand ram nagar ', 'Muzaffarpur', 'Kerala', '349999', 7),
(8, 'Mahindra colony', 'Muzaffarpur', 'Bihar', '388844', 8),
(9, 'Buxer jila', 'Champaran', 'Bihar', '344222', 9),
(10, 'Sg bihar colony', 'Patna', 'Bihar', '877333', 10),
(11, 'c++ street road no 1', 'Delhi', 'Bihar', '938488', 11),
(12, 'Anand nagar', 'Patna', 'Bihar', '929999', 12),
(14, 'Nothing street', 'goa', 'Kerala', '244444', 14),
(15, 'Anand nagar', 'Bubneswar', 'Orissa', '244444', 15),
(16, 'Anand nagar', 'Muazaffrpur', 'Bihar', '244444', 16),
(17, 'Sahib building', 'Shilong', 'AP', '999999', 17),
(18, 'Rajendra nagar', 'Ranchi', 'Jarkhand', '208308', 18),
(24, 'Yadav nagar', 'Muzaffarpur', 'BIhar', '124422', 24),
(25, 'Peepal farm', 'Naugashia', 'Bihar', '121241', 25),
(27, 'Commerce classes', 'Nawada', 'Bihar', '312312', 27),
(28, 'Nagar road', 'Bhagalpur', 'Bihar', '231231', 28),
(29, 'delhi street', 'Chandigarh', 'Punjab', '123123', 29),
(30, 'Anand nagar', 'Muzaffarpur', 'Bihar', '321312', 30),
(31, 'White street', 'Dallas', 'Texas', '231231', 31),
(32, 'Gobi chawk', 'Chakiya', 'Bihar', '312331', 32),
(33, 'Nath nagar', 'Kagria', 'Bihar', '234234', 33);

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `Admin_ID` int(11) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`Admin_ID`, `password`) VALUES
(911, '123');

-- --------------------------------------------------------

--
-- Table structure for table `Appointment`
--

CREATE TABLE `Appointment` (
  `Appointment_ID` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `appointment_date` date NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `Patient_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Appointment`
--

INSERT INTO `Appointment` (`Appointment_ID`, `status`, `doctor`, `appointment_date`, `reason`, `Patient_FK`) VALUES
(22, 'Scheduled', 'Nikesh D. Johnson', '2024-08-23', 'Follow-up Appointment', 2),
(23, 'Completed', 'Sima Devi Yadav', '2024-08-28', 'New Symptom or Concern', 6),
(26, 'Completed', 'Nikesh D. Johnson', '2024-08-23', 'New Symptom or Concern', 18),
(27, 'Completed', 'Nikki Bhushan Singh', '2024-08-22', 'Routine Check-up', 6),
(33, 'Scheduled', 'Nikesh D. Johnson', '2024-08-29', 'Follow-up Appointment', 8),
(34, 'Completed', 'Nikesh D. Johnson', '2024-08-30', 'Routine Check-up', 7),
(35, 'Completed', 'Nikesh D. Johnson', '2024-08-31', 'New Symptom or Concern', 28),
(36, 'Scheduled', 'Manju kumar Devi', '2024-08-31', 'Routine Check-up', 27),
(37, 'Scheduled', 'Jamie Cami Brown', '2024-08-30', 'New Symptom or Concern', 9),
(38, 'Completed', 'Jamie Cami Brown', '2024-08-30', 'New Symptom or Concern', 15),
(39, 'Completed', 'Nikesh D. Johnson', '2024-08-30', 'Routine Check-up', 24),
(40, 'Scheduled', 'Stendra Singh Prasad', '2024-08-30', 'Follow-up Appointment', 17),
(41, 'Completed', 'Sima Devi Yadav', '2024-08-30', 'Medical Procedure', 12),
(42, 'Scheduled', 'Manju kumar Devi', '2024-09-02', 'Routine Check-up', 30),
(43, 'Completed', 'Manju kumar Devi', '2024-09-02', 'Routine Check-up', 24),
(44, 'Completed', 'Manju kumar Devi', '2024-09-03', 'New Symptom or Concern', 32),
(45, 'Scheduled', 'Jamie Cami Brown', '2024-09-03', 'Follow-up Appointment', 18),
(46, 'Scheduled', 'Manju kumar Devi', '2024-09-19', 'Follow-up Appointment', 11),
(47, 'Scheduled', 'Jamie Cami Brown', '2024-09-06', 'Medical Procedure', 33);

-- --------------------------------------------------------

--
-- Table structure for table `Billing`
--

CREATE TABLE `Billing` (
  `Billing_ID` int(11) NOT NULL,
  `Appointment_FK` int(11) NOT NULL,
  `Patient_FK` int(11) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `billing_date` date NOT NULL,
  `payment_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Billing`
--

INSERT INTO `Billing` (`Billing_ID`, `Appointment_FK`, `Patient_FK`, `total_amount`, `billing_date`, `payment_status`) VALUES
(54, 22, 2, 2100.00, '2024-08-23', 'Paid'),
(59, 27, 6, 3600.00, '2024-08-22', 'Unpaid'),
(61, 23, 6, 2100.00, '2024-08-30', 'Paid'),
(62, 26, 18, 2100.00, '2024-08-30', 'Paid'),
(63, 39, 24, 1100.00, '2024-08-30', 'Paid'),
(64, 43, 24, 2900.00, '2024-09-02', 'Unpaid'),
(65, 44, 32, 1700.00, '2024-09-03', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `Billing_Service`
--

CREATE TABLE `Billing_Service` (
  `Billing_Service_ID` int(11) NOT NULL,
  `Billing_id` int(11) DEFAULT NULL,
  `Service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Billing_Service`
--

INSERT INTO `Billing_Service` (`Billing_Service_ID`, `Billing_id`, `Service_id`) VALUES
(58, 54, 1),
(59, 54, 2),
(60, 54, 4),
(71, 59, 1),
(72, 59, 2),
(73, 59, 4),
(74, 59, 6),
(75, 59, 8),
(76, 59, 10),
(81, 61, 1),
(82, 61, 2),
(83, 61, 4),
(84, 62, 1),
(85, 62, 2),
(86, 62, 4),
(87, 63, 1),
(88, 63, 2),
(89, 63, 6),
(90, 64, 1),
(91, 64, 2),
(92, 64, 4),
(93, 64, 6),
(94, 64, 8),
(95, 65, 2),
(96, 65, 4),
(97, 65, 6);

-- --------------------------------------------------------

--
-- Table structure for table `Doctor`
--

CREATE TABLE `Doctor` (
  `Doctor_ID` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `year_of_exp` int(11) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `joining_data` date NOT NULL,
  `phone_number` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Doctor`
--

INSERT INTO `Doctor` (`Doctor_ID`, `first_name`, `middle_name`, `last_name`, `email`, `qualification`, `year_of_exp`, `specialization`, `joining_data`, `phone_number`) VALUES
(2, 'Jane', 'B.', 'Smith', 'jane.smith@example.com', 'MD', 8, 'Neurology', '2014-07-21', '0987654321'),
(3, 'Jamie', 'Cami', 'Brown', 'emily.brown@example.com', 'MS', 5, 'Pediatrics', '2018-01-30', '1231231234'),
(4, 'Nikesh', 'D.', 'Johnson', 'michael.johnson@example.com', 'DM', 15, 'Orthopedics', '2009-11-10', '938604899'),
(13, 'Manju', 'kumar', 'Devi', 'manju@exapmpl.com', 'MBBS', 3, 'Psychiatrist', '2024-08-21', '8928742'),
(18, 'Sima', 'Devi', 'Yadav', 'sima@example.com', 'MBBS', 10, 'Dermatologist', '2024-08-23', '939938282'),
(19, 'Nikki', 'Bhushan', 'Singh', 'nikka@example.com', 'MBBS MD', 6, 'Cardiologist', '2024-08-13', '9288484'),
(22, 'Stendra', 'Singh', 'Prasad', 'satendra@example.com', 'MBBS MD', 10, 'Cardiologist', '2024-08-11', '74849939'),
(23, 'Ansh', 'Singh', 'Kumar', 'ansh@example.com', 'MBBS MD', 4, 'Dermatologist', '2024-08-14', '38388393');

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

CREATE TABLE `Patient` (
  `Patient_ID` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `weight` int(11) NOT NULL,
  `bmi` float DEFAULT NULL,
  `blood_group` varchar(3) NOT NULL,
  `medical_history` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`Patient_ID`, `first_name`, `middle_name`, `last_name`, `age`, `gender`, `weight`, `bmi`, `blood_group`, `medical_history`) VALUES
(2, 'John', 'Singh', 'Doe', 30, 'Male', 75, 23.5, 'O+', 'No known allergies yet'),
(6, 'Nitish ', '', 'Prasad', 25, 'Male', 67, 89.64, 'B-', 'Not any serious allergies'),
(7, 'Dean', '', 'Ambrose', 35, 'Other', 55, 89.4, 'AB+', 'Don\'t have any kind of specific alleges, but have chicken box in past'),
(8, 'Ashmit', '', 'Rishu', 22, 'Male', 63, 71.9, 'AB-', 'Heartstroke several time , seviour fevour sometimes'),
(9, 'Zakir', '', 'Khan', 24, 'Male', 68, 93.4, 'O+', 'Several heartstroke, high fever in night'),
(10, 'Gesu', '', 'Devi', 44, 'Female', 67, 78.9, 'AB+', 'Not yet'),
(11, 'Nandini', '', 'Yadav', 25, 'Female', 87, 92.5, 'A+', 'nothing'),
(12, 'Lakshi', '', 'singh', 44, 'Female', 55, 78.4, 'A-', ' nothing'),
(14, 'Otril', '', 'Plus', 25, 'Male', 55, 87.5, 'AB+', 'Nothing serious'),
(15, 'Tuktuk', '', 'Singh', 33, 'Male', 32, 71.9, 'O-', 'nothing'),
(16, 'Enginner', '', 'Sahab', 89, 'Male', 78, 89.4, 'B+', 'nothing'),
(17, 'Murlidhar', '', 'Singh', 33, 'Female', 44, 90.4, 'O+', 'NOTHING'),
(18, 'Rajendra', '', 'Prasad', 33, 'Female', 76, 89.5, 'O+', 'Nothing'),
(24, 'Ashmit', '', 'khan', 22, 'Male', 72, 89.3, 'B+', 'Diabetic and high blood pressure'),
(25, 'Murlidhar', 'Enginner', 'Singh', 45, 'Male', 62, 33.2, 'A-', 'Nothing serious just arthiritis'),
(27, 'Vivo', '', 'Kumar', 22, 'Female', 233, 71.9, 'A-', 'Study here'),
(28, 'Manju', 'Singh', 'Devi', 44, 'Male', 222, 82.4, 'AB+', 'Age added'),
(29, 'Glucose', '', 'Devi', 45, 'Female', 222, 78.8, 'A-', 'Nothing serious'),
(30, 'Ram', 'chandra', 'Prasad', 44, 'Male', 67, 78.4, 'B+', 'Nothing'),
(31, 'Register', '', 'Kumar', 23, 'Female', 22, 71.9, 'B+', 'Nothing serious'),
(32, 'Anand', '', 'Kumar', 45, 'Male', 72, 78.4, 'B+', 'Nothing serious'),
(33, 'Shree', '', 'Devi', 45, 'Female', 72, 89.44, 'B+', 'Several heart stokes , diabetic patient');

-- --------------------------------------------------------

--
-- Table structure for table `Services`
--

CREATE TABLE `Services` (
  `Service_ID` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `charge` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Services`
--

INSERT INTO `Services` (`Service_ID`, `service_name`, `detail`, `charge`) VALUES
(1, 'Complete Blood Count ', 'Comprehensive blood analysis this', 600.00),
(2, 'Urine Analysis', 'Checks for infections, kidney function, etc.', 300.00),
(4, 'X-Ray (Chest)', 'Imaging of the chest', 1200.00),
(6, 'Blood Sugar Test', 'Measures blood glucose level', 200.00),
(8, 'Liver Function Test (LFT)', 'Assesses liver health', 600.00),
(10, 'Thyroid Profile', 'Evaluates thyroid function', 700.00);

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE `Staff` (
  `Staff_ID` int(11) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `middle_name` varchar(40) DEFAULT NULL,
  `last_name` varchar(40) NOT NULL,
  `role` varchar(50) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` varchar(250) DEFAULT NULL,
  `hire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Staff`
--

INSERT INTO `Staff` (`Staff_ID`, `first_name`, `middle_name`, `last_name`, `role`, `phone_number`, `email`, `password_hash`, `hire_date`) VALUES
(2, 'Jane', '', 'Smith', 'Nurse', '0987654321', 'jane.smith@example.com', '$2y$10$JFOJI0Ep7F0bsNDsyF.U2esiDD3pLRiY2H0fFQsHxNhTkmP7TiR.O', '2023-02-20'),
(3, 'Emily', 'B', 'Johnson', 'Nurse', '1122334455', 'emily.johnson@example.com', '$2y$10$MOy/sbQFxaM3aW36iXDi3eE5GjLWTgY5Mal8FYgmKqTBKLoSfVQRC', '2023-03-10'),
(4, 'Michael', 'Kumar', 'Brown', 'Pharmacist', '6677889900', 'michael.brown@example.com', '$2y$10$FE2Pz5dbFwZSZoESo2PfOeEnxyIQhMATG0ZzZqXzoYkoq1S4FlLfi', '2023-04-05'),
(5, 'Sarah', 'C', 'Davis', 'Administrator', '1234555334', 'sarah.davis@example.com', '$2y$10$L.MTLQutwexk5dzw/zrji.M2Zd1CsfSNJKurZqmlJLmq4mc0dJl0e', '2023-05-25'),
(6, 'Sanju', '', 'Devi', 'Pharmacist', '244899294', 'sanju@example.com', '$2y$10$Be.vR5UmUQO34SW22Ho.w.M7kwy7lxk5wGWLxVtWsrFfaRTBzWtkO', '2024-08-15'),
(7, 'Ankit', 'Singh', 'Kumar', 'Lab Technician', '234552335', 'ankit@example.com', '$2y$10$FGoYJzqRjR3t4Z1c302Qju3uxLWnZWx1hUGHtK577eewuocQrHH4m', '2024-08-22'),
(9, 'manju', '', 'Devi', 'Receptionist', '3115353555', 'manju@example.com', '$2y$10$8Oe/fomZJC5.P4O4hcQEaeDNkibMk1bqtjVKPKdBHcBX9j1moKqw6', '2024-08-29'),
(11, 'Sanju', '', 'Khan', 'Receptionist', '1927109733', 'sanju@examplesecond.com', '$2y$10$5TVBorj3LDwJ9YeDVmzmIuDL90w7wXzbcZXueFRM0l/OAl4Eu70AK', '2024-08-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`Address_ID`),
  ADD KEY `Patient_ID_FK` (`Patient_ID_FK`);

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD PRIMARY KEY (`Appointment_ID`),
  ADD KEY `Patient_FK` (`Patient_FK`);

--
-- Indexes for table `Billing`
--
ALTER TABLE `Billing`
  ADD PRIMARY KEY (`Billing_ID`),
  ADD KEY `Appointment_FK` (`Appointment_FK`),
  ADD KEY `Patient_FK` (`Patient_FK`);

--
-- Indexes for table `Billing_Service`
--
ALTER TABLE `Billing_Service`
  ADD PRIMARY KEY (`Billing_Service_ID`),
  ADD KEY `Billing_id` (`Billing_id`),
  ADD KEY `Service_id` (`Service_id`);

--
-- Indexes for table `Doctor`
--
ALTER TABLE `Doctor`
  ADD PRIMARY KEY (`Doctor_ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `Patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`Patient_ID`);

--
-- Indexes for table `Services`
--
ALTER TABLE `Services`
  ADD PRIMARY KEY (`Service_ID`);

--
-- Indexes for table `Staff`
--
ALTER TABLE `Staff`
  ADD PRIMARY KEY (`Staff_ID`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Address`
--
ALTER TABLE `Address`
  MODIFY `Address_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `Appointment`
--
ALTER TABLE `Appointment`
  MODIFY `Appointment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `Billing`
--
ALTER TABLE `Billing`
  MODIFY `Billing_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `Billing_Service`
--
ALTER TABLE `Billing_Service`
  MODIFY `Billing_Service_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `Doctor`
--
ALTER TABLE `Doctor`
  MODIFY `Doctor_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `Patient`
--
ALTER TABLE `Patient`
  MODIFY `Patient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `Services`
--
ALTER TABLE `Services`
  MODIFY `Service_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Staff`
--
ALTER TABLE `Staff`
  MODIFY `Staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Address`
--
ALTER TABLE `Address`
  ADD CONSTRAINT `Address_ibfk_1` FOREIGN KEY (`Patient_ID_FK`) REFERENCES `Patient` (`Patient_ID`);

--
-- Constraints for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD CONSTRAINT `Appointment_ibfk_1` FOREIGN KEY (`Patient_FK`) REFERENCES `Patient` (`Patient_ID`);

--
-- Constraints for table `Billing`
--
ALTER TABLE `Billing`
  ADD CONSTRAINT `Billing_ibfk_1` FOREIGN KEY (`Appointment_FK`) REFERENCES `Appointment` (`Appointment_ID`),
  ADD CONSTRAINT `Billing_ibfk_2` FOREIGN KEY (`Patient_FK`) REFERENCES `Patient` (`Patient_ID`);

--
-- Constraints for table `Billing_Service`
--
ALTER TABLE `Billing_Service`
  ADD CONSTRAINT `Billing_Service_ibfk_1` FOREIGN KEY (`Billing_id`) REFERENCES `Billing` (`Billing_ID`),
  ADD CONSTRAINT `Billing_Service_ibfk_2` FOREIGN KEY (`Service_id`) REFERENCES `Services` (`Service_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
