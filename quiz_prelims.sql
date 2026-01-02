-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 16, 2024 at 02:18 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_prelims`
--

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
CREATE TABLE IF NOT EXISTS `participants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lot_no` varchar(250) DEFAULT NULL,
  `participant1` varchar(250) DEFAULT NULL,
  `participant2` varchar(250) DEFAULT NULL,
  `score` int DEFAULT NULL,
  `time_taken` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int NOT NULL AUTO_INCREMENT,
  `question_name` varchar(300) DEFAULT NULL,
  `option1` varchar(150) DEFAULT NULL,
  `option2` varchar(150) DEFAULT NULL,
  `option3` varchar(150) DEFAULT NULL,
  `option4` varchar(150) DEFAULT NULL,
  `answer` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `question_name`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES
(1, 'A is thrice as good as workman as B and therefore is able to finish a job in 60 days less than B. Working together, they can do it in:', '20 days', '25 days', '30 days', '22.5 days', 'D'),
(2, 'There is 60% increase in an amount in 6 years at simple interest. What will be the compound interest of Rs. 12,000 after 3 years at the same rate?', 'Rs. 2160', 'Rs. 3120', 'Rs. 3972', 'Rs. 6240', 'C'),
(3, 'On selling 17 balls at Rs. 720, there is a loss equal to the cost price of 5 balls. The cost price of a ball is:', 'Rs. 45', 'Rs. 50', 'Rs. 55', 'Rs. 60', 'D'),
(4, 'A, B, C rent a pasture. A puts 10 oxen for 7 months, B puts 12 oxen for 5 months and C puts 15 oxen for 3 months for grazing. If the rent of the pasture is Rs. 175, how much must C pay as his share of rent?', 'Rs. 45', 'Rs. 50', 'Rs. 55', 'Rs. 60', 'A'),
(5, 'The sum of ages of 5 children born at the intervals of 3 years each is 50 years. What is the age of the youngest child?', '4 years', '8 years', '10 years', '7 years', 'A'),
(6, 'Find the greatest number that will divide 43, 91 and 183 so as to leave the same remainder in each case.', '4', '7', '9', '13', 'A'),
(7, 'There are two examinations rooms A and B. If 10 students are sent from A to B, then the number of students in each room is the same. If 20 candidates are sent from B to A, then the number of students in A is double the number of students in B. The number of students in room A is:', '20', '80', '100', '200', 'C'),
(8, 'A can contains a mixture of two liquids A and B in the ratio 7:5. When 9 litres of mixture are drawn off and the can is filled with B, the ratio of A and B becomes 7:9. How many litres of liquid A was contained by the can initially?', '10', '20', '21', '25', 'C'),
(9, 'What is the probability of getting a sum 9 from two throws of a dice?', '1/6', '1/8', '1/9', '1/12', 'C'),
(10, 'Ram has a brother Shyam. Ram is the son of Ramesh. Suresh is Ramesh’s father. How Shyam is related to Suresh?', 'son', 'Grandson', 'Brother', 'Grandfather', 'B'),
(11, 'Which of the following sorting procedure is the slowest?', 'Quick Sort', 'Heap Sort', 'Shell Sort', 'Bubble Sort', 'D'),
(12, 'Sparse Matrix have _________________', 'Many one entries', 'Many Zero entries', 'Higher Dimension', 'Only One Zero', 'B'),
(13, 'A Station in a network forwards incoming packets by placing them on its shortest output queue. Which routing algorithm is used?', 'Hot Potato Routing', 'Flooding', 'Static Routing', 'Delta Routing', 'A'),
(14, '_________________ allows devices on one network to communicate with devices on another network.', 'Bridge', 'Gateway', 'Hub', 'Server', 'B'),
(15, 'The Communication mode that supports data in both directions at the same time is ________', 'Multiplexer', 'Full Duplex', 'Demultiplexer', 'Simplex', 'B'),
(16, 'Which scheduling algorithm is designed to prevent indefinite process starvation?', 'First-Come, First-Served (FCFS)', 'Shortest Job First (SJF)', 'Round Robin (RR)', 'Priority Scheduling', 'C'),
(17, 'Which type of operating system is designed to handle time-critical operations?', 'Batch operating system', 'Time-sharing operating system', 'Real-time operating system', 'Distributed operating system', 'C'),
(18, 'Which of the following is a primary advantage of edge computing over traditional cloud computing?', 'Lower latency and faster response times', 'Unlimited storage capacity', 'Better long-term data archiving', 'Centralized data processing', 'A'),
(19, 'What does the term \"Internet of Things\" (IoT) primarily refer to?', 'The global internet infrastructure', 'A network of physical devices embedded with electronics to collect and exchange data', 'A new internet protocol', 'Cloud-based web services', 'B'),
(20, 'Which AI model architecture has revolutionized natural language processing tasks?', 'Convolutional Neural Networks (CNN)', 'Recurrent Neural Networks (RNN)', 'Transformers', 'Generative Adversarial Networks (GAN)', 'C'),
(21, 'What is the main benefit of edge AI?', 'Centralized processing', 'Reduced privacy', 'Increased latency', 'On-device data processing and analysis', 'D'),
(22, 'Which of the following is a key feature of Wi-Fi 6 (802.11ax)?', 'Lower speeds than Wi-Fi 5', 'Improved performance in crowded areas', 'Reduced range', 'Single-user MIMO only', 'B'),
(23, 'What is the output of System.out.println(5 + 5 + \"5\");?', '555', '15', '105', '55', 'C'),
(24, 'Which collection type allows duplicate elements and maintains insertion order?', 'HashSet', 'TreeSet', 'ArrayList', 'HashMap', 'C'),
(25, 'What is the purpose of the \'static\' keyword in Java?', 'To create an instance of a class', 'To declare a constant variable', 'To make a member belong to the class rather than an instance', 'To prevent a method from being overridden', 'C'),
(26, 'What does the __init__ method do in a Python class?', 'Initializes the class', 'Creates a new instance of the class', 'Destroys the instance of the class', 'Defines the attributes of the class instance when it\'s created', 'D'),
(27, 'What is the output of print(0 == False) in python?', '0', 'False', 'True', 'None', 'C'),
(28, 'What is the maximum theoretical data transfer rate of USB 3.0?', '480 Mbps', '1Gbps', '5 Gbps', '10 Gbps', 'C'),
(29, 'Which of the following is not a valid IPV4 address?', '192.168.1.1', '10.0.0.1', '172.16.0.1', '256.0.0.1', 'D'),
(30, 'What is the maximum number of hosts possible on a Class C network?', '254', '255', '256', '65,534', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'student', 'student', 'user'),
(2, 'asmam', 'asmam', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
