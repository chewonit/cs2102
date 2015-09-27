-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2015 at 08:38 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs2102`
--

-- --------------------------------------------------------

--
-- Table structure for table `demo`
--

CREATE TABLE IF NOT EXISTS `demo` (
  `Id` varchar(50) NOT NULL,
  `Name` varchar(256) NOT NULL,
  `Title` varchar(256) NOT NULL,
  `Description` mediumtext NOT NULL,
  `Location` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `demo`
--

INSERT INTO `demo` (`Id`, `Name`, `Title`, `Description`, `Location`) VALUES
('01186988', 'Booz Allen Hamilton', 'General Management Consulting Professional Job', 'Serve as part of Booz Allen-s Association of Southeast Asian Nations (ASEAN).business. Deliver strategy and business consulting in a targeted ASEAN region sector, including government, ICT, energy and utilities, financial services, healthcare, transportation, infrastructure, public safety, or defense. Manage and lead consulting teams on engagements. Produce client-ready deliverables. Formulate and present client recommendations. Conduct business development and identify new clients and client opportunities. Prepare presentations and proposals.', 'Singapore'),
('01196416', 'Booz Allen Hamilton', 'Admin Operations Manager Job', 'Oversee and manage the infrastructure operations for the ASEAN regional office, based in Singapore, including supporting any expansion efforts as occurs when moving into other new locations within the region', 'Singapore'),
('215867', 'Globecomm', 'Sales Engineer', 'This role will support Globecomm sales organization in developing technical solutions for IP networks. The Solutions Engineer performs requirements definition, design, equipment specification, pricing and documentation in collaboration with in-house engineering & program staff and potentially with customer staff. The Sales Engineer will principally support developing compelling solutions for government and commercial proposal activities. The Sales Engineer must be able to organize & author proposal sections w/text & graphics based on identified solutions. The candidate must be able to effectively interact with customers & vendors in accomplishing work objectives.', 'Singapore'),
('9192', 'Aruba Networks', 'Systems Engineer', 'The Systems Engineer (SE) will be responsible for managing pre-sales technical / functional support to prospective clients and customers while ensuring customer satisfaction, and work with Arubas Territory Managers to qualify opportunities and convert leads into successful engagements.', 'Singapore'),
('oJbA1fwf', 'Bit9. Inc.', 'Regional Account Manager', 'Recognized as a “Top Place to Work”, Bit9 + Carbon Black offers the most complete software solution to prevent, detect and respond to cyber-attacks. Our entire team – from sales reps, to engineers, to intelligence experts – works hard in a collaborative, all-inclusive environment where good ideas and a positive attitude are the currency of success. If you are ready to make an impact at one of the fastest-growing companies in information security, we want to talk.', 'Singapore'),
('onwG1fwk', 'Intercontinental Exchange', 'Database Administrator', 'The Database Administrator is responsible for designing, testing, implementing, protecting, operating, and maintaining the organization’s databases supporting numerous applications across multiple technology platforms and database technologies.', 'Singapore');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(32) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(2, 'demo@demo.com', 'b4af804009cb036a4ccdc33431ef9ac9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `demo`
--
ALTER TABLE `demo`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(32) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
