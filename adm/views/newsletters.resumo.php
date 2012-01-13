<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(0);

$api = bwNewsletters::getInstance();
$api->showCreditos();
?>

