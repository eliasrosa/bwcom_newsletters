-- <? defined('BW') or die("Acesso negado!"); ?>


-- 
ALTER TABLE `bw_versao` ADD `com_newsletters_1` INT(1) NOT NULL;


--
INSERT INTO `bw_configuracoes` (`var`, `value`, `default`, `tipo`, `params`, `titulo`, `protegido`, `oculto`, `desc`) VALUES
('component.newsletters.autenticacao', '', NULL, 'string', '', 'Chave de acesso', 0, 0, 'Chave de acesso, exemplo: cd0c7142c339eed67da86ca19e5a94e0a6b3db49'),
('component.newsletters.api', 'http://mkt.sulbrasilweb.com.br/api', 'http://mkt.sulbrasilweb.com.br/api', 'string', '', 'URL da API', 0, 0, 'URL do servidor de envio de e-mail');
