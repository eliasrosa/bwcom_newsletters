-- <? defined('BW') or die("Acesso negado!"); ?>


-- 
ALTER TABLE `bw_versao` CHANGE `com_newsletters_1` `com_newsletters_2` INT NOT NULL;


--
DELETE FROM `bw_configuracoes` WHERE `bw_configuracoes`.`var` = 'component.newsletters.autenticacao';
DELETE FROM `bw_configuracoes` WHERE `bw_configuracoes`.`var` = 'component.newsletters.api';


--
