-- ver. 0.0.16
-- rozszerzenie tabeli o kolumnę reject_reason_dziekanat
ALTER TABLE `#__thesis_form1` ADD COLUMN `reject_reason_dziekanat` TEXT AFTER `proponowany_recenzent`;

