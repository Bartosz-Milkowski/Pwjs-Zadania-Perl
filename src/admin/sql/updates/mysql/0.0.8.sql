-- ver. 0.0.8
-- rozszerzenie tabeli o kolumnę status_promotor oraz status_dziekanat
ALTER TABLE `#__thesis_form1` ADD COLUMN `status_promotor` INT(10) AFTER `status_student`;
ALTER TABLE `#__thesis_form1` ADD COLUMN `status_dziekanat` INT(10) AFTER `status_student`;
