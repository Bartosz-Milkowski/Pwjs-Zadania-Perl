-- ver. 0.0.7
DROP TABLE IF EXISTS `#__thesis_status`;

CREATE TABLE `#__thesis_status` (
	`id`       			INT(11) NOT NULL AUTO_INCREMENT,
	`status_id` 			INT(11) NOT NULL,
	`text`   			VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
AUTO_INCREMENT=0
DEFAULT CHARSET=utf8;

INSERT INTO `#__thesis_status` (`status_id`,`text`) VALUES
('1','Nowy'),
('2','Wysłany do promotora'),
('3','Odesłany do poprawy'),
('4','Odrzucony przez promotora'),
('5','Wysłany do dziekanatu'),
('6','Zaakceptowany w dziekanacie'),
('7','Odrzucony w dziekanacie'),
('8','Odrzucony'),
('9','Zaakceptowany');