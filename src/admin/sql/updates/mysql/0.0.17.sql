-- ver. 0.0.17
-- rozszerzenie tabeli o kolumnę reject_reason_promotor
ALTER TABLE `#__thesis_form1` ADD COLUMN `reject_reason_promotor` TEXT AFTER `proponowany_recenzent`;