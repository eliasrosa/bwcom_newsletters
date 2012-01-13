<?
defined('BW') or die("Acesso negado!");

echo '<h2>Destinatários</h2>';

$x = bwNewsletters::getInstance()->sendPostServer('envio_relatorio_destinatarios', array(
    'id' => $id
), 'csv');

//print_r($x);

if($x !== false)
{
    unset($x[0]);
    $html = '<table id="destinatarios"><thead><tr><th class="tac w10">ID</th><th>E-mail</th><th class="tac">Nome</th><th class="tac w20">Visualizações</th><th class="tac w20">Cliques</th></tr></thead><tbody>';    
    foreach($x as $c)
    {
        $c_id = $c[1];
        $c_nome = $c[2];
        $c_email = $c[3];
        $c_view = $c[4];
        $c_click = $c[5];
    
        $cliques = sprintf('<a id-rel="%s" class="cliques mais relative" href="javascript:void(0);">%s<div class="hide absolute aviso nowrap" style="top: 0px; left: -180px;"></div></a>', $c_id, $c_click);
        $views = sprintf('<a id-rel="%s" class="views mais relative" href="javascript:void(0);">%s<div class="hide absolute aviso nowrap" style="top: 0px; left: -180px;"></div></a>', $c_id, $c_view);
        
        $email = sprintf('<a href="%s">%s</a>', 
            bwRouter::_('adm.php?com=newsletters&sub=contatos&view=cadastro&id='.$c_id), 
            $c_email
        );
        
        $html .= sprintf('<tr><td class="tac w10">%s</td><td style="width: 350px;">%s</td><td  style="width: 350px;">%s</td><td class="tac w20 nowrap">%s</td><td class="tac w20 nowrap">%s</td></tr>',
            $c_id, 
            $email,
            $c_nome, 
            $views,
            $cliques
        );
    }
    $html .= '</tbody></table>';
    
    $url = bwRouter::_('adm.php?com=newsletters&task=relatorioShowViews&'.bwRequest::getToken().'=1&id=');
    $html .= "<script type=\"text/javascript\">
                    $(function() {

                        oTableDest = $('#destinatarios').dataTable($.extend($.dataTableSettingsNoAjax));
                        
                        $('#destinatarios a.mais').mouseenter(function(){
                            var d = $('div', this);
                            d.css('top', '-'+(d.height()+16)+'px');
                            //d.load('$url' + $(this).attr('id-rel'));
                            //d.show();
                        }).mouseout(function(){
                            $('div', this).hide();
                        });
                        
                    });
                </script>
            ";

    echo $html;


}
else
    bwNewsletters::getInstance()->showMensagemRetorno($x, 'O relátorio não foi processado!<br/>Todos os relatórios são atualizados a cada 10 minutos.');


?>

