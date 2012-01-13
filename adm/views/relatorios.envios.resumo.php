<?
defined('BW') or die("Acesso negado!");

echo '<h2>Resumo</h2>';

$x = bwNewsletters::getInstance()->sendPostServer('envio_relatorio_resumo', array(
    'id' => $id
), 'csv');

if($x !== false)
{
    echo sprintf('<p class="box">Enviado para <span>%s contatos</span></p>', $x[1][1]);
    echo sprintf('<p class="box">Visualizado <span>%s vezes</span></p>', $x[1][2]);
    echo sprintf('<p class="box">Cliques <span>%s</span></p>', $x[1][3]);
    echo sprintf('<p class="box">Links <span>%s</span></p>', $x[1][4]);
}
else
    bwNewsletters::getInstance()->showMensagemRetorno($x, 'O relátorio não foi processado!<br/>Todos os relatórios são atualizados a cada 10 minutos.');

?>

