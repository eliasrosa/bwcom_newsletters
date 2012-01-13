<?
defined('BW') or die("Acesso negado!");

echo '<h2>Links</h2>';

$x = bwNewsletters::getInstance()->sendPostServer('envio_relatorio_links', array(
    'id' => $id
), 'csv');

//print_r($x);

if($x !== false)
{
    unset($x[0]);
    $html = '<table id="links"><thead><tr><th class="tac w10">ID</th><th>URL</th><th class="tac w20">Cliques</th></tr></thead><tbody>';    
    foreach($x as $c)
    {
        $c_id = $c[1];
        $c_url = $c[2];
        $c_cliques = $c[3];
    
        $url = sprintf('<a href="%s" target="_blank">%s</a>', $c_url, $c_url);
        
        $html .= sprintf('<tr><td class="tac w10">%s</td><td style="">%s</td><td class="tac w20">%s</td></tr>',
            $c_id, 
            $url,
            $c_cliques
        );
    }
    $html .= '</tbody></table>';
    
    $html .= "<script type=\"text/javascript\">
                    $(function() {
                        oTableDest = $('#links').dataTable($.extend($.dataTableSettingsNoAjax));
                    });
                </script>
            ";

    echo $html;

}
else
    bwNewsletters::getInstance()->showMensagemRetorno($x, 'O relátorio não foi processado!<br/>Todos os relatórios são atualizados a cada 10 minutos.');

?>

