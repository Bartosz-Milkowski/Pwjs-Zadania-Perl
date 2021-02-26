-- ver. 0.0.6
-- rozszerzenie tabeli o kolumnę promotor_username oraz status_student
ALTER TABLE `#__thesis_form1` ADD COLUMN `promotor_username` VARCHAR(255) AFTER `user_id`;
ALTER TABLE `#__thesis_form1` ADD COLUMN `status_student` VARCHAR(255) AFTER `thesis`;