-- ver. 0.0.4
-- Dodanie nowej tabeli

DROP TABLE IF EXISTS `#__thesis_form1`;

CREATE TABLE `#__thesis_form1` (
	`id`       			INT(11)     NOT NULL AUTO_INCREMENT,
	`name` 				VARCHAR(100) NOT NULL,
	`date`   			DATETIME,
	`field_of_study`   		VARCHAR(100),
	`nr_album`   			VARCHAR(100),
	`specialty` 			VARCHAR(100),
	`form_and_level_of_study` 	VARCHAR(100),
	`tel` 				VARCHAR(100),
	`email`				VARCHAR(50),
	`thesis`			VARCHAR(250),
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
AUTO_INCREMENT=0
DEFAULT CHARSET=utf8;