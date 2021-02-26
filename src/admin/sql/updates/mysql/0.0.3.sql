-- ver. 0.0.3
-- rozszerzenie tabeli o kolumnę z datą
ALTER TABLE `#__zaswiadczenia_form1` ADD `ts` TIMESTAMP DEFAULT NOW();
