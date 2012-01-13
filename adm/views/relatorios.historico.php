<?
defined('BW') or die("Acesso negado!");

// get api
$api = bwNewsletters::getInstance();
$dados = $api->api_selecionar_historico();

if(!$dados['retorno'])
{
    echo sprintf('<div class="erro">%s</div>', $dados['mensagem']);
    $dados['historicos'] = array();
}

$api->showCreditos();
?>
<table class="historico">
    <thead>
        <tr>
            <th class="w30 tac">Data/Hora</th>
            <th>Referente</th>
            <th class="w30 tac">Valor</th>
            <th class="w20 tac">Saldo atual</th>
        </tr>
    </thead>
    <tbody>
    
    <?
        foreach($dados['dados'] as $i)
        {
            $ref = $i['id_envio'] ? sprintf('%s - <a href="%s">Ver relatório</a>',
                $i['referente'],
                bwRouter::_('adm.php?com=newsletters&sub=relatorios&view=index&pagina=envios&id='.$i['id_envio']),
                $i['id_envio']
            ) : $i['referente'] ;
        
            echo sprintf('<tr><td class="tac">%s</td><td>%s</td><td class="tac">%s</td><td class="tac">%s</td></tr>',
                bwUtil::data($i['datahora']),
                $ref,
                $i['valor'],
                $i['valor_atual']
            );
        }
    ?>
    
    </tbody>
</table>


<script type="text/javascript">
    $(function() {
        oTable = $('.historico').dataTable($.extend($.dataTableSettingsNoAjax));
    });
</script>
