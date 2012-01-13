<?
defined('BW') or die("Acesso negado!");
echo bwAdm::createHtmlSubMenu(7);

$r = bwNewsletters::getRemetentes()->enviar_verificacao(
    bwRequest::getInt('id')
);

echo "<h1>Validar remetente</h1>";
bwNewsletters::getInstance()->showMensagemRetorno($r);

?>

