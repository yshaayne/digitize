-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.11.5-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for fms
CREATE DATABASE IF NOT EXISTS `fms` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `fms`;

-- Dumping structure for table fms.documents
CREATE TABLE IF NOT EXISTS `documents` (
  `doc_id` int(10) NOT NULL AUTO_INCREMENT,
  `doc_user` varchar(50) NOT NULL DEFAULT '',
  `doc_name` varchar(255) NOT NULL,
  `doc_folder` int(10) NOT NULL,
  `doc_desc` longtext NOT NULL,
  `doc_path` varchar(255) NOT NULL,
  `doc_size` varchar(255) NOT NULL,
  `doc_date` datetime NOT NULL DEFAULT current_timestamp(),
  `doc_access` int(10) DEFAULT NULL,
  `doc_isdelete` tinyint(4) DEFAULT 0,
  `doc_type` varchar(10) DEFAULT 'txt',
  `doc_office` int(11) DEFAULT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table fms.documents: ~6 rows (approximately)
INSERT INTO `documents` (`doc_id`, `doc_user`, `doc_name`, `doc_folder`, `doc_desc`, `doc_path`, `doc_size`, `doc_date`, `doc_access`, `doc_isdelete`, `doc_type`, `doc_office`) VALUES
	(90, 'ISUC-0000300', 'doc1', 66, 'doc1 desc                                                    \r\n                                                ', 'Sample_documents_1713699218.docx', '11778', '2024-04-21 19:33:38', NULL, 0, 'docx', 13),
	(92, 'ISUC-0000300', 'doc2', 66, 'doc2 desc                                                    \r\n                                                ', 'sample_1713699766.pptx', '32642', '2024-04-21 19:42:46', NULL, 0, 'pptx', 13),
	(94, 'ISUC-0000300', 'doc33', 66, '   doc3 desc                                                 \r\n                                                ', 'sample_1713699816.xlsx', '8281', '2024-04-21 19:43:36', NULL, 0, 'xlsx', 13),
	(95, 'ISUC-0000300', 'doc4', 66, 'doc4 desc                                                    \r\n                                                ', 'VOUCHER_SIR_ROSARIO_1713700146.pdf', '1162535', '2024-04-21 19:49:05', NULL, 0, 'pdf', 13),
	(96, 'ISUC-0000300', 'doc5', 66, 'doc5 desc', 'vouchers_isucabagan_roll370_1713700165.csv', '14485', '2024-04-21 19:49:24', NULL, 0, 'csv', 13),
	(97, 'ISUC-0000300', 'doc1', 67, 'doc1                                                    \r\n                                                ', 'Sample_documents_1713700754.docx', '11778', '2024-04-21 19:59:13', NULL, 0, 'docx', 13),
	(98, 'ISUC-0001087', 'sample', 74, ' sample                                                   \r\n                                                ', 'VOUCHER_SIR_ROSARIO_1713710815.pdf', '1162535', '2024-04-21 22:46:55', NULL, 0, 'pdf', 13),
	(99, 'ISUC-0000300', 'sample 2', 74, '  sample 2                                                  \r\n                                                ', 'sample_1713710960.pptx', '32642', '2024-04-21 22:49:19', NULL, 0, 'pptx', 13);

-- Dumping structure for table fms.folders
CREATE TABLE IF NOT EXISTS `folders` (
  `folder_id` int(10) NOT NULL AUTO_INCREMENT,
  `folder_user` varchar(50) NOT NULL DEFAULT '',
  `folder_name` varchar(255) NOT NULL,
  `folder_lock` int(10) NOT NULL,
  `folder_office` int(10) NOT NULL,
  `folder_date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`folder_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table fms.folders: ~9 rows (approximately)
INSERT INTO `folders` (`folder_id`, `folder_user`, `folder_name`, `folder_lock`, `folder_office`, `folder_date`) VALUES
	(66, 'ISUC-0000300', 'folder 1', 0, 13, '2024-04-19'),
	(67, 'ISUC-0000300', 'folder 2', 0, 13, '2024-04-19'),
	(68, 'ISUC-0000300', 'folder 3', 0, 13, '2024-04-19'),
	(69, 'ISUC-0000300', 'folder 4', 0, 13, '2024-04-19'),
	(70, 'ISUC-0000300', 'folder 5', 0, 13, '2024-04-19'),
	(71, 'ISUC-0000300', 'folder 6', 0, 13, '2024-04-19'),
	(72, 'ISUC-0000300', 'folder 7', 0, 13, '2024-04-19'),
	(73, 'ISUC-0000300', 'folder 8', 0, 13, '2024-04-19'),
	(74, 'ISUC-0001087', 'MIST folder', 0, 13, '2024-04-21'),
	(75, 'ISUC-0261', 'head folder', 0, 1, '2024-04-21'),
	(76, 'ISUC-0261', 'new', 0, 1, '2024-04-21'),
	(77, 'ISUC-0261', 'new 2', 0, 1, '2024-04-21'),
	(78, 'ISUC-0261', 'new 3', 0, 1, '2024-04-21'),
	(79, 'ISUC-0261', 'new 4', 0, 13, '2024-04-21'),
	(80, 'ISUC-0001087', 'alex', 0, 13, '2024-04-21');

-- Dumping structure for table fms.friends
CREATE TABLE IF NOT EXISTS `friends` (
  `frd_id` int(10) NOT NULL AUTO_INCREMENT,
  `frd_user` int(10) NOT NULL,
  `frd_friend` int(10) NOT NULL,
  `frd_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`frd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table fms.friends: ~0 rows (approximately)

-- Dumping structure for table fms.friend_requests
CREATE TABLE IF NOT EXISTS `friend_requests` (
  `fr_id` int(10) NOT NULL AUTO_INCREMENT,
  `fr_from` int(10) NOT NULL,
  `fr_to` int(10) NOT NULL,
  `fr_status` int(10) NOT NULL,
  `fr_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`fr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table fms.friend_requests: ~0 rows (approximately)

-- Dumping structure for table fms.sharefolder
CREATE TABLE IF NOT EXISTS `sharefolder` (
  `sf_id` int(10) NOT NULL AUTO_INCREMENT,
  `sf_user` int(10) NOT NULL,
  `sf_name` varchar(255) NOT NULL,
  `sf_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table fms.sharefolder: ~0 rows (approximately)

-- Dumping structure for table fms.sharefolder_documents
CREATE TABLE IF NOT EXISTS `sharefolder_documents` (
  `sfdoc_id` int(10) NOT NULL AUTO_INCREMENT,
  `sfdoc_user` int(10) NOT NULL,
  `sfdoc_sfid` int(10) NOT NULL,
  `sfdoc_docid` int(10) NOT NULL,
  `sfdoc_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sfdoc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table fms.sharefolder_documents: ~0 rows (approximately)

-- Dumping structure for table fms.sharefolder_members
CREATE TABLE IF NOT EXISTS `sharefolder_members` (
  `member_id` int(10) NOT NULL AUTO_INCREMENT,
  `member_sf` int(10) NOT NULL,
  `member_userid` int(10) NOT NULL,
  `member_added` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table fms.sharefolder_members: ~0 rows (approximately)

-- Dumping structure for table fms.tbl-system-logs
CREATE TABLE IF NOT EXISTS `tbl-system-logs` (
  `isu` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(100) DEFAULT NULL,
  `logs` varchar(255) DEFAULT NULL,
  `date_time` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`isu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23971 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table fms.tbl-system-logs: ~51 rows (approximately)
INSERT INTO `tbl-system-logs` (`isu`, `emp_id`, `logs`, `date_time`) VALUES
	(23887, 'ISUC-0000300', 'Inserted Document VOUCHER_SIR_ROSARIO_1713512673.pdf: ::1', '2024-04-19 07:44:33'),
	(23888, 'ISUC-0000300', 'Uploaded Document 2023-CONCEPT-PROPOSAL-HRMIS_1713496582_1713513582.docx: ::1', '2024-04-19 07:59:41'),
	(23889, 'ISUC-0000300', 'Uploaded Document ANNEX_A_1713513656.docx: ::1', '2024-04-19 08:00:55'),
	(23890, 'ISUC-0000300', 'Created Folder folder 2 : ::1', '2024-04-19 08:15:18'),
	(23891, 'ISUC-0000300', 'Created Folder folder 3 : ::1', '2024-04-19 08:15:49'),
	(23892, 'ISUC-0000300', 'Created Folder folder 4 : ::1', '2024-04-19 08:15:56'),
	(23893, 'ISUC-0000300', 'Created Folder folder 5 : ::1', '2024-04-19 08:16:03'),
	(23894, 'ISUC-0000300', 'Created Folder folder 6 : ::1', '2024-04-19 08:16:10'),
	(23895, 'ISUC-0000300', 'Created Folder folder 7 : ::1', '2024-04-19 08:16:16'),
	(23896, 'ISUC-0000300', 'Created Folder folder 8 : ::1', '2024-04-19 08:16:26'),
	(23897, 'ISUC-0000300', 'login ::1', '2024-04-19 11:10:19'),
	(23898, 'ISUC-0000300', 'Uploaded Document ELECTION_TALLY_1713535637.xlsx: ::1', '2024-04-19 14:07:16'),
	(23899, 'ISUC-0000300', 'Uploaded Document sample_1713536236.pptx: ::1', '2024-04-19 14:17:16'),
	(23900, 'ISUC-0000300', 'Uploaded Document vouchers_isucabagan_roll372_1713536441.csv: ::1', '2024-04-19 14:20:41'),
	(23901, NULL, 'Deleted Document 76: ::1', '2024-04-19 15:07:48'),
	(23902, 'ISUC-0000300', 'login ::1', '2024-04-20 12:09:05'),
	(23903, 'ISUC-0000300', 'login ::1', '2024-04-21 07:14:27'),
	(23904, 'ISUC-0000300', 'UpdateD The Document : ::1', '2024-04-21 09:22:07'),
	(23905, 'ISUC-0000300', 'UpdateD The Document : ::1', '2024-04-21 09:23:34'),
	(23906, 'ISUC-0000300', 'UpdateD The Document ANNEX_A_1713513656_1713691431.docx: ::1', '2024-04-21 09:23:50'),
	(23907, 'ISUC-0000300', 'Uploaded Document ANNEX_A_1713691534.docx: ::1', '2024-04-21 09:25:34'),
	(23908, 'ISUC-0000300', 'Updated and uploaded new document ELECTION_TALLY_1713535637_1713691560.xlsx: ::1', '2024-04-21 09:26:00'),
	(23909, 'ISUC-0000300', 'Updated and uploaded new document ANNEX_A_1713513656_1713691580.docx: ::1', '2024-04-21 09:26:19'),
	(23910, 'ISUC-0000300', 'Uploaded Document ELECTION_TALLY_1713535637_1713692413.xlsx: ::1', '2024-04-21 09:40:13'),
	(23911, NULL, 'Deleted Document 78: ::1', '2024-04-21 11:09:14'),
	(23912, NULL, 'Deleted Document 80: ::1', '2024-04-21 11:09:17'),
	(23913, NULL, 'Deleted Document 79: ::1', '2024-04-21 11:09:21'),
	(23914, NULL, 'Deleted Document 74: ::1', '2024-04-21 11:09:30'),
	(23915, NULL, 'Deleted Document 73: ::1', '2024-04-21 11:09:34'),
	(23916, NULL, 'Deleted Document 75: ::1', '2024-04-21 11:09:37'),
	(23917, 'ISUC-0000300', 'Uploaded Document alexis_resume_jan2023_1713697988.docx: ::1', '2024-04-21 11:13:07'),
	(23918, 'ISUC-0000300', 'Uploaded Document HARDWARE_ASSTES_1713698008.xlsx: ::1', '2024-04-21 11:13:28'),
	(23919, 'ISUC-0000300', 'Uploaded Document vouchers_isucabagan_roll372_1713698069.csv: ::1', '2024-04-21 11:14:28'),
	(23920, 'ISUC-0000300', 'Uploaded Document ELECTION_TALLY_1713535637_1713698100.xlsx: ::1', '2024-04-21 11:14:59'),
	(23921, 'ISUC-0000300', 'Uploaded Document sample_1713698210.pptx: ::1', '2024-04-21 11:16:49'),
	(23922, 'ISUC-0000300', 'Uploaded Document VOUCHER_SIR_ROSARIO_1713698238.pdf: ::1', '2024-04-21 11:17:18'),
	(23923, 'ISUC-0000300', 'Uploaded Document VOUCHER_SIR_ROSARIO_1713698493.pdf: ::1', '2024-04-21 11:21:32'),
	(23924, 'ISUC-0000300', 'Uploaded Document HARDWARE_ASSTES_1713698592.xlsx: ::1', '2024-04-21 11:23:12'),
	(23925, 'ISUC-0000300', 'logout ::1', '2024-04-21 11:27:29'),
	(23926, 'ISUC-0000300', 'login ::1', '2024-04-21 11:27:31'),
	(23927, 'ISUC-0000300', 'Uploaded Document ANNEX_A_1713698893.docx: ::1', '2024-04-21 11:28:12'),
	(23928, NULL, 'Deleted Document 89: ::1', '2024-04-21 11:31:11'),
	(23929, 'ISUC-0000300', 'Uploaded Document Sample_documents_1713699218.docx: ::1', '2024-04-21 11:33:38'),
	(23930, 'ISUC-0000300', 'Uploaded Document sample_1713699265.pptx: ::1', '2024-04-21 11:34:24'),
	(23931, 'ISUC-0000300', 'Uploaded Document sample_1713699766.pptx: ::1', '2024-04-21 11:42:46'),
	(23932, 'ISUC-0000300', 'Uploaded Document sample_1713699794.xlsx: ::1', '2024-04-21 11:43:14'),
	(23933, 'ISUC-0000300', 'Uploaded Document sample_1713699816.xlsx: ::1', '2024-04-21 11:43:36'),
	(23934, 'ISUC-0000300', 'Uploaded Document VOUCHER_SIR_ROSARIO_1713700146.pdf: ::1', '2024-04-21 11:49:05'),
	(23935, 'ISUC-0000300', 'Uploaded Document vouchers_isucabagan_roll370_1713700165.csv: ::1', '2024-04-21 11:49:24'),
	(23936, 'ISUC-0000300', 'UpdateD The Document : ::1', '2024-04-21 11:53:33'),
	(23937, 'ISUC-0000300', 'Uploaded Document Sample_documents_1713700754.docx: ::1', '2024-04-21 11:59:14'),
	(23938, 'ISUC-0000300', 'logout ::1', '2024-04-21 14:37:28'),
	(23939, 'ISUC-0261', 'login ::1', '2024-04-21 14:37:33'),
	(23940, 'ISUC-0261', 'logout ::1', '2024-04-21 14:44:10'),
	(23941, 'ISUC-0001087', 'login ::1', '2024-04-21 14:44:23'),
	(23942, 'ISUC-0001087', 'logout ::1', '2024-04-21 14:45:15'),
	(23943, 'ISUC-0261', 'login ::1', '2024-04-21 14:45:28'),
	(23944, 'ISUC-0261', 'logout ::1', '2024-04-21 14:45:36'),
	(23945, 'ISUC-0001087', 'login ::1', '2024-04-21 14:45:41'),
	(23946, 'ISUC-0001087', 'Created Folder MIST folder : ::1', '2024-04-21 14:46:38'),
	(23947, 'ISUC-0001087', 'Uploaded Document VOUCHER_SIR_ROSARIO_1713710815.pdf: ::1', '2024-04-21 14:46:55'),
	(23948, 'ISUC-0001087', 'logout ::1', '2024-04-21 14:47:03'),
	(23949, 'ISUC-0261', 'login ::1', '2024-04-21 14:47:14'),
	(23950, 'ISUC-0261', 'logout ::1', '2024-04-21 14:47:39'),
	(23951, 'ISUC-0000300', 'login ::1', '2024-04-21 14:47:43'),
	(23952, 'ISUC-0000300', 'Uploaded Document sample_1713710960.pptx: ::1', '2024-04-21 14:49:20'),
	(23953, 'ISUC-0000300', 'logout ::1', '2024-04-21 14:52:44'),
	(23954, 'ISUC-0261', 'login ::1', '2024-04-21 14:52:52'),
	(23955, 'ISUC-0261', 'Created Folder head folder : ::1', '2024-04-21 14:53:03'),
	(23956, 'ISUC-0261', 'logout ::1', '2024-04-21 14:56:01'),
	(23957, 'ISUC-0000300', 'login ::1', '2024-04-21 14:56:04'),
	(23958, 'ISUC-0000300', 'logout ::1', '2024-04-21 14:59:08'),
	(23959, 'ISUC-0261', 'login ::1', '2024-04-21 14:59:13'),
	(23960, 'ISUC-0261', 'Created Folder new : ::1', '2024-04-21 15:21:03'),
	(23961, 'ISUC-0261', 'Created Folder new 2 : ::1', '2024-04-21 15:22:07'),
	(23962, 'ISUC-0261', 'Created Folder new 3 : ::1', '2024-04-21 15:36:08'),
	(23963, 'ISUC-0261', 'Created Folder new 4 : ::1', '2024-04-21 15:36:17'),
	(23964, 'ISUC-0261', 'logout ::1', '2024-04-21 15:36:23'),
	(23965, 'ISUC-0000300', 'login ::1', '2024-04-21 15:36:27'),
	(23966, 'ISUC-0000300', 'logout ::1', '2024-04-21 15:36:47'),
	(23967, 'ISUC-0001087', 'login ::1', '2024-04-21 15:36:52'),
	(23968, 'ISUC-0001087', 'Created Folder alex : ::1', '2024-04-21 15:37:02'),
	(23969, 'ISUC-0001087', 'logout ::1', '2024-04-21 15:37:07'),
	(23970, 'ISUC-0000300', 'login ::1', '2024-04-21 15:37:10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
