<?
defined('BW') or die("Acesso negado!");


echo bwAdm::createHtmlSubMenu(6);

$config = bwNewsletters::getInstance()->getConfig();
$config->createHtmlPainel();

?>