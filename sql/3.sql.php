-- <? defined('BW') or die("Acesso negado!"); ?>


-- 
ALTER TABLE `bw_versao` CHANGE `com_newsletters_2` `com_newsletters_3` INT NOT NULL;


--
ALTER TABLE `bw_newsletters_grupos` ADD `status` INT(1) NOT NULL;


--
UPDATE `bw_newsletters_grupos` SET `status` = '1';