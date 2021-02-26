-- ver. 0.0.24
-- rozszerzenie tabeli o kolumnę promotor_username
ALTER TABLE `#__thesis_form2` ADD COLUMN `promotor_username` VARCHAR(255) AFTER `promotor_name`;