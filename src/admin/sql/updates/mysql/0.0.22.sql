-- ver. 0.0.22
-- rozszerzenie tabeli o kolumnę status_promotor
ALTER TABLE `#__thesis_form2` ADD COLUMN `status_promotor` INT(10) AFTER `status_student`;