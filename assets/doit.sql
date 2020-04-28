
CREATE DATABASE IF NOT EXISTS `doit`;
USE `doit`;


CREATE TABLE IF NOT EXISTS `appointment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `reason` text,
  `patient_id` bigint(20) NOT NULL,
  `doctor_id` bigint(20) NOT NULL,
  `status` varchar(50) DEFAULT 'PENDING',
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `FK__doctor` (`doctor_id`),
  CONSTRAINT `FK__doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`),
  CONSTRAINT `FK__patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `appointment` (`id`, `start_date`, `end_date`, `reason`, `patient_id`, `doctor_id`, `status`) VALUES
	(1, '2020-04-15 16:18:00', '2020-04-15 18:00:00', 'Normal checkup', 2, 5, 'VALIDATED');
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;


-- Dumping structure for table doit.doctor
CREATE TABLE IF NOT EXISTS `doctor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `zip` varchar(12) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `speciality` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table doit.doctor: ~1 rows (approximately)
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` (`id`, `first_name`, `last_name`, `zip`, `phone`, `address`, `email`, `login`, `password`, `city`, `speciality`) VALUES
	(4, 'HAMZA', 'EL ABASSI', '23400', '0633751714', 'HAY NAKHIL BLOC 14 N°232', 'admin@gmail.com', 'ssss', 'ayoub@1995', 'OULED AYAD', 'Dentiste'),
	(5, 'SAMIR', 'EL HAMDAOUI', '878172', '065477261', 'Hay OULFA IMM16 N°27', 'samir.elhamdaoui@yahoo.com', 'samir', 'samir2020', 'Casablanca', 'Généraliste');
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;


-- Dumping structure for table doit.employee
CREATE TABLE IF NOT EXISTS `employee` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `doctor_fk` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`),
  KEY `doctor_employee_fk` (`doctor_fk`),
  CONSTRAINT `doctor_employee_fk` FOREIGN KEY (`doctor_fk`) REFERENCES `doctor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table doit.employee: ~2 rows (approximately)
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` (`id`, `first_name`, `last_name`, `email`, `address`, `phone`, `city`, `zip`, `login`, `password`, `doctor_fk`) VALUES
	(3, 'ayoub', 'el abassi', 'ayoubselabassi0@gmail.com', 'qdqdsd', '0633751714', 'CASA', '256', 'ayoubs', 'ayoubs', NULL),
	(4, 'AYOUB', 'EL ABASSI', 'admin@gmail.com', 'HAY NAKHIL BLOC 14 N°232', '0633751714', 'OULED AYAD', '23400', 'admin', 'admin', 4);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;


-- Dumping structure for table doit.patient
CREATE TABLE IF NOT EXISTS `patient` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `ensurrence_number` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `ensurence_type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table doit.patient: ~1 rows (approximately)
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` (`id`, `first_name`, `last_name`, `email`, `phone`, `city`, `address`, `zip`, `ensurrence_number`, `birthday`, `ensurence_type`) VALUES
	(2, 'AYOUB', 'EL ABASSI', 'a.elabassi@yahoo.com', '0633751714', 'OULED AYAD', 'HAY NAKHIL BLOC 14 N°232', '23400', '876726372637632', '2020-04-09', 'FULL'),
	(7, 'Armando', 'Lightner', 'a.elabasssi@yahoo.com', '2538391664', 'Philadelphia', '943 Pheasant Ridge Road', '19103', '878178378273821738', '1995-06-25', 'FULL');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
