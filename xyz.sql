-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table love.interest
CREATE TABLE IF NOT EXISTS `interest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL DEFAULT 0,
  `reciver` int(11) NOT NULL DEFAULT 0,
  `interest_back` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table love.interest: ~2 rows (approximately)
/*!40000 ALTER TABLE `interest` DISABLE KEYS */;
INSERT INTO `interest` (`id`, `sender`, `reciver`, `interest_back`, `created_at`, `updated_at`) VALUES
	(1, 1, 13, 0, '2020-08-18 08:58:55', '2020-08-19 00:07:41'),
	(2, 11, 1, 1, '2020-08-18 08:59:30', '2020-08-19 07:08:03'),
	(3, 1, 9, 0, '2020-08-18 09:01:16', '2020-08-19 00:05:24');
/*!40000 ALTER TABLE `interest` ENABLE KEYS */;

-- Dumping structure for table love.martial_status
CREATE TABLE IF NOT EXISTS `martial_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table love.martial_status: ~5 rows (approximately)
/*!40000 ALTER TABLE `martial_status` DISABLE KEYS */;
INSERT INTO `martial_status` (`id`, `name`) VALUES
	(153, 'Never Married'),
	(154, 'Divorced'),
	(155, 'Widowed'),
	(156, 'Awaiting Divorce'),
	(157, 'Annulled');
/*!40000 ALTER TABLE `martial_status` ENABLE KEYS */;

-- Dumping structure for table love.mother_toungh
CREATE TABLE IF NOT EXISTS `mother_toungh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12877 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table love.mother_toungh: ~37 rows (approximately)
/*!40000 ALTER TABLE `mother_toungh` DISABLE KEYS */;
INSERT INTO `mother_toungh` (`id`, `name`) VALUES
	(51, 'Hindi'),
	(52, 'Punjabi'),
	(327, 'Gujarati'),
	(328, 'Persian'),
	(329, 'Bangali'),
	(333, 'Jewish'),
	(337, 'Other'),
	(1097, 'Arabic'),
	(1098, 'Assamese'),
	(1099, 'Awadhi'),
	(1101, 'Chattisgari'),
	(1102, 'Coorgi'),
	(1103, 'Dogri'),
	(1104, 'English'),
	(1105, 'French'),
	(1106, 'Garhwali'),
	(1108, 'Haryanavi'),
	(1109, 'Himachali'),
	(1110, 'Kannada'),
	(1111, 'Kashmiri'),
	(1112, 'Konkani'),
	(1113, 'Kumaoni'),
	(1114, 'Kutchi'),
	(1115, 'Magahi'),
	(1116, 'Malayalam'),
	(1117, 'Manipuri'),
	(1118, 'Marathi'),
	(1119, 'Marwari'),
	(1120, 'Nepali'),
	(1121, 'Oriya'),
	(1122, 'Rajasthani'),
	(1123, 'Russian'),
	(1124, 'Sindhi'),
	(1126, 'Tamil'),
	(1127, 'Telugu'),
	(1128, 'Urdu'),
	(12876, 'Tulu');
/*!40000 ALTER TABLE `mother_toungh` ENABLE KEYS */;

-- Dumping structure for table love.religion
CREATE TABLE IF NOT EXISTS `religion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1091 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table love.religion: ~11 rows (approximately)
/*!40000 ALTER TABLE `religion` DISABLE KEYS */;
INSERT INTO `religion` (`id`, `name`) VALUES
	(739, 'Hindu'),
	(740, 'Muslim'),
	(741, 'Christian'),
	(742, 'Sikh'),
	(743, 'Parsi'),
	(744, 'Jain'),
	(745, 'Buddhist'),
	(746, 'Jewish'),
	(748, 'Spiritual'),
	(749, 'Other'),
	(1090, 'No Religion');
/*!40000 ALTER TABLE `religion` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
