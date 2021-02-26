-- ver. 0.0.19
DROP TABLE IF EXISTS `#__thesis_form4`;

CREATE TABLE `#__thesis_form4` (
	`id`       			INT(11)     NOT NULL AUTO_INCREMENT,
	`user_id`			INT(10),
	`name` 				VARCHAR(100) NOT NULL,
	`promotor_name_with_title`	VARCHAR(255),
	`date`   			DATETIME,
	`date_dziekanat`   		DATETIME,
	`date_printed`   		DATETIME,
	`field_of_study`   		VARCHAR(100),
	`nr_album`   			VARCHAR(100),
	`form_and_level_of_study` 	VARCHAR(100),
	`tel` 				VARCHAR(100),
	`address`			VARCHAR(255),
	`thesis`			VARCHAR(255),
	`status_student` 		INT(10),
	`status_promotor` 		INT(10),
	`status_dziekanat`		INT(10),
	`reject_reason_dziekanat`	TEXT,
	`reject_reason_promotor`	TEXT,
	`to_date`			DATE,
	`student_reason`		TEXT,
	`work_progress`			INT(10),
	`substantiation_promotor`	TEXT,
	`decision_promotor`		INT(10),
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
AUTO_INCREMENT=0
DEFAULT CHARSET=utf8;