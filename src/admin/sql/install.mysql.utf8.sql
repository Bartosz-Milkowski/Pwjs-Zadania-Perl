-- install.mysql.utf8.sql powinien być sumą wszystkich plików z admin/sql/updates/mysql/

-- ver. 0.0.1
DROP TABLE IF EXISTS `#__zaswiadczenia_form1`;

CREATE TABLE `#__zaswiadczenia_form1` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(25) NOT NULL,
	`field1`   VARCHAR(250),
	`field2`   VARCHAR(250),
	`description` TEXT,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
AUTO_INCREMENT=0
DEFAULT CHARSET=utf8;

INSERT INTO `#__zaswiadczenia_form1` (`username`,`field1`,`field2`,`description`) VALUES
('bmalachowski','ble ble','coś tam','bardzo istotny opis'),
('bmalachowski','ble ble 2','coś tam 2','bardzo istotny opis 2');

-- ver. 0.0.2
-- rozszerzenie tabeli o kolumnę email
ALTER TABLE `#__zaswiadczenia_form1` ADD `email` VARCHAR(255);

-- ver. 0.0.3
-- rozszerzenie tabeli o kolumnę z datą
ALTER TABLE `#__zaswiadczenia_form1` ADD `ts` TIMESTAMP DEFAULT NOW();

-- ver. 0.0.4
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

-- ver. 0.0.5
-- rozszerzenie tabeli o kolumnę user_id
ALTER TABLE `#__thesis_form1` ADD COLUMN `user_id` INT(10) AFTER `id`;

-- ver. 0.0.6
-- rozszerzenie tabeli o kolumnę promotor_username oraz status
ALTER TABLE `#__thesis_form1` ADD COLUMN `promotor_username` VARCHAR(255) AFTER `user_id`;
ALTER TABLE `#__thesis_form1` ADD COLUMN `status_student` VARCHAR(255) AFTER `thesis`;

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

-- ver. 0.0.8
-- rozszerzenie tabeli o kolumnę status_promotor oraz status_dziekanat
ALTER TABLE `#__thesis_form1` ADD COLUMN `status_promotor` INT(10) AFTER `status_student`;
ALTER TABLE `#__thesis_form1` ADD COLUMN `status_dziekanat` INT(10) AFTER `status_student`;

-- ver. 0.0.9
-- rozszerzenie tabeli o kolumnę proponowany_recenzent, opinia_promotora date_promotor
ALTER TABLE `#__thesis_form1` ADD COLUMN `proponowany_recenzent` VARCHAR(255) AFTER `status_promotor`;
ALTER TABLE `#__thesis_form1` ADD COLUMN `opinia_promotora` VARCHAR(1000) AFTER `status_promotor`;
ALTER TABLE `#__thesis_form1` ADD COLUMN `date_promotor` DATETIME AFTER `date`;

-- ver. 0.0.10
-- Wstawienie nowych danych do tabeli #__thesis_status

INSERT INTO `#__thesis_status` (`status_id`,`text`) VALUES
('10','Oczekuje na wysłanie'),
('11','Do poprawy');

-- ver. 0.0.11
-- Wstawienie nowych danych do tabeli #__thesis_status

INSERT INTO `#__thesis_status` (`status_id`,`text`) VALUES
('12','Poprawiony');

-- ver. 0.0.12
-- Wstawienie nowych danych do tabeli #__thesis_status

INSERT INTO `#__thesis_status` (`status_id`,`text`) VALUES
('13','Odesłany do promotora');

-- ver. 0.0.13
-- Wstawienie nowych danych do tabeli #__thesis_status

INSERT INTO `#__thesis_status` (`status_id`,`text`) VALUES
('14','Wydrukowany');

-- ver. 0.0.14
-- rozszerzenie tabeli o kolumnę date_dziekanat
ALTER TABLE `#__thesis_form1` ADD COLUMN `date_dziekanat` DATETIME AFTER `date`;

-- ver. 0.0.15
-- rozszerzenie tabeli o kolumnę date_printed
ALTER TABLE `#__thesis_form1` ADD COLUMN `date_printed` DATETIME AFTER `date`;

-- ver. 0.0.16
-- rozszerzenie tabeli o kolumnę reject_reason_dziekanat
ALTER TABLE `#__thesis_form1` ADD COLUMN `reject_reason_dziekanat` TEXT AFTER `proponowany_recenzent`;

-- ver. 0.0.17
-- rozszerzenie tabeli o kolumnę reject_reason_promotor
ALTER TABLE `#__thesis_form1` ADD COLUMN `reject_reason_promotor` TEXT AFTER `proponowany_recenzent`;

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

-- ver. 0.0.20
-- rozszerzenie tabeli o kolumnę promotor_username
ALTER TABLE `#__thesis_form4` ADD COLUMN `promotor_username` VARCHAR(255) AFTER `promotor_name_with_title`;

-- ver. 0.0.21
-- rozszerzenie tabeli o kolumnę date_promotor
ALTER TABLE `#__thesis_form4` ADD COLUMN `date_promotor` DATETIME AFTER `date_dziekanat`;

-- ver. 0.0.22
-- rozszerzenie tabeli o kolumnę status_promotor
ALTER TABLE `#__thesis_form2` ADD COLUMN `status_promotor` INT(10) AFTER `status_student`;

-- ver. 0.0.23
-- rozszerzenie tabeli o kolumnę date_promotor
ALTER TABLE `#__thesis_form2` ADD COLUMN `date_promotor` DATETIME AFTER `date`;

-- ver. 0.0.24
-- rozszerzenie tabeli o kolumnę promotor_username
ALTER TABLE `#__thesis_form2` ADD COLUMN `promotor_username` VARCHAR(255) AFTER `promotor_name`;

-- ver. 0.0.25
DROP TABLE IF EXISTS `#__thesis_form3`;

CREATE TABLE `#__thesis_form3` (
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

-- ver. 0.0.26
-- rozszerzenie tabeli o kolumnę promotor_username
ALTER TABLE `#__thesis_form3` ADD COLUMN `promotor_username` VARCHAR(255) AFTER `promotor_name_with_title`;

-- ver. 0.0.27
-- rozszerzenie tabeli o kolumnę date_promotor
ALTER TABLE `#__thesis_form3` ADD COLUMN `date_promotor` DATETIME AFTER `date_dziekanat`;