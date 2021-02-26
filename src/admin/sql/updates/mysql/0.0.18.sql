-- ver. 0.0.18
DROP TABLE IF EXISTS `#__thesis_form2`;

CREATE TABLE `#__thesis_form2` (
	`id`       			INT(11)     NOT NULL AUTO_INCREMENT,
	`user_id`			INT(10),
	`name` 				VARCHAR(100) NOT NULL,
	`promotor_name`			VARCHAR(255),
	`date`   			DATETIME,
	`date_dziekanat`   		DATETIME,
	`date_printed`   		DATETIME,
	`date_accept_promotor` 		DATE,
	`field_of_study`   		VARCHAR(100),
	`nr_album`   			VARCHAR(100),
	`specialty` 			VARCHAR(100),
	`form_and_level_of_study` 	VARCHAR(100),
	`tel` 				VARCHAR(100),
	`email`				VARCHAR(50),
	`stopien`			INT(10),
	`rodzaj`			INT(10),
	`status_student` 		INT(10),
	`status_dziekanat`		INT(10),
	`reject_reason_dziekanat`	TEXT,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
AUTO_INCREMENT=0
DEFAULT CHARSET=utf8;