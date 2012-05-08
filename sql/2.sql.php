-- <? defined('BW') or die("Acesso negado!"); ?>


-- 
ALTER TABLE `bw_versao` CHANGE `com_newsletters_1` `com_newsletters_2` INT NOT NULL;


--
DELETE FROM `bw_configuracoes` WHERE `bw_configuracoes`.`var` = 'component.newsletters.autenticacao';
DELETE FROM `bw_configuracoes` WHERE `bw_configuracoes`.`var` = 'component.newsletters.api';


--
CREATE TABLE `bw_newsletters_contatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servico` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `datahora_adicionado` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
CREATE TABLE `bw_newsletters_contatos_grupos_rel` (
  `id_contato` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
CREATE TABLE `bw_newsletters_grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servico` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;