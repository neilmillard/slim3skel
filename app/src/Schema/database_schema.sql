-- Dumping structure for table apps.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL,
  `fullname` char(20) DEFAULT NULL,
  `password` char(15) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `colour` char(10) DEFAULT NULL,
  `mobile` char(15) DEFAULT NULL,
  `home` char(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='InnoDB free: 11264 kB';

INSERT INTO `users` (`id`, `name`, `fullname`, `password`, `hash`, `colour`, `mobile`, `home`) VALUES
	(1, 'ADMIN', 'Administrator', 'Password1', '$2y$10$/Z3v5y2T/jBWaNcxXzFsA.KyF34yy0Dpbxz/R6Ba09Wn19J2tiSiW', 'FAD2F5', '', '');

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
