-- przy pierwszej instalacji komponetu wykonywany jest plik install.mysql.utf8.sql
-- przy aktualizacji wykonane zostaną skrypty z admin/sql/updates/mysql/ z nr wersji wyższym od aktualnej
-- install.mysql.utf8.sql powinien być sumą wszystkich plików z admin/sql/updates/mysql/

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
