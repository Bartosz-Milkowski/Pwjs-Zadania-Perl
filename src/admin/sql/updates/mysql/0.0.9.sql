-- ver. 0.0.9
-- rozszerzenie tabeli o kolumnę proponowany_recenzent, opinia_promotora data_promotor
ALTER TABLE `#__thesis_form1` ADD COLUMN `proponowany_recenzent` VARCHAR(255) AFTER `status_promotor`;
ALTER TABLE `#__thesis_form1` ADD COLUMN `opinia_promotora` VARCHAR(1000) AFTER `status_promotor`;
ALTER TABLE `#__thesis_form1` ADD COLUMN `date_promotor` DATETIME AFTER `date`;