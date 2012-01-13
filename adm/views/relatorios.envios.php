<?
defined('BW') or die("Acesso negado!");

$head = '';
$id = bwRequest::getInt('id');

if($id)
{
    
    $envio = bwNewsletters::getEnvios()->selecionar($id);
    if($envio['retorno'])
    {
        $e = $envio['dados'];
        $rel_mensagem = $e['mensagem'];
        
        // cabeçalho
        $head = '<h2>Dados do envio</h2>';
        
        // ID
        $head .= sprintf('<p>ID: <b>%s</b></p>', $e['id']);
        
        // assunto
        $head .= sprintf('<p>Assunto: <b>%s</b></p>', $e['assunto']);
        
        // cancelar envio
        //$head .= bwButton::redirect('Cancelar envio', 'adm.php?com=newsletters&sub=relatorios&view=index&pagina=envios&id='.$envio->id.'&atualizar=1', 'right');
        
        // solicitados
        $head .= sprintf('<p>Envio solicitado as <b>%s</b>', bwUtil::data($e['datahora_solicitado']));
        
        if($e['datahora_agendado'])
            $head .= sprintf(' e agendado para as <b>%s</b>', bwUtil::data($e['datahora_agendado']));

        $head .= '</p>';

        if($e['datahora_iniciado'])
            $head .= sprintf('<p>Iniciado o envio as <b>%s</b>', bwUtil::data($e['datahora_iniciado']));

        if($e['datahora_termino'])
            $head .= sprintf(', finalizado as <b>%s</b>', bwUtil::data($e['datahora_termino']));
            
        $head .= '</p>';
         
        if($e['status'] == 'pendente')
            $status = 'Pendente';
            
        if($e['status'] == 'salvando')
            $status = 'Salvando';

        if($e['status'] == 'enviando')
            $status = 'Enviando';

        if($e['status'] == 'concluido')
            $status = 'Concluído';
            
        $head .= sprintf('<p>Remetente: <b>%s | %s</b></p><p>Status: <b>%s</b></p>',
            $e['remetente_nome'],
            $e['remetente_email'],
            $status
        );

    }
    else
    {
        $head = bwNewsletters::getInstance()->showMensagemRetorno($envio);
    }
}

?>

<form action="" method="get" class="validaForm">
    <input name="pagina" value="envios" type="hidden" />
    <div class="campo block envio">
        <span>Envio:</span>
        <select class="w100 envio" name="id" rel="text" title="Selecione um envio">
            <option value="">-- Selecione um envio --</option>
            <?
                $x = bwNewsletters::getEnvios()->listar();                
                
                foreach($x['dados'] as $e)
                {
                    $sel = $e['id'] == $id ? 'selected="selected"' : '';
                    echo sprintf(
                        '<option value="%s" %s>%s <<< %s</option>', 
                        $e['id'], 
                        $sel,
                        bwUtil::data($e['datahora_solicitado']),
                        $e['assunto']
                    );
                }
            ?>
        </select>       
        <br class="clearfix"/>
    </div>
    
    <?= $head; ?>
</form>

<?

if($id):
    if(isset($envio) && $envio['dados']['status'] == 'concluido'):
        $u = new bwUrl();
        $rel = bwRequest::getVar('rel', 'mensagem');
?>
<div class="rels">
    <h2>Mais informações</h2>
    <ul>
        <li><a href="<? $u->setVar('rel', 'mensagem'); echo $u->toString(); ?>">Mensagem</a></li>
        <li><a href="<? $u->setVar('rel', 'resumo'); echo $u->toString(); ?>">Resumo</a></li>
        <li><a href="<? $u->setVar('rel', 'destinatarios'); echo $u->toString(); ?>">Destinatários</a></li>
        <li><a href="<? $u->setVar('rel', 'links'); echo $u->toString(); ?>">Links</a></li>
        <li><a href="<? $u->setVar('rel', 'html'); echo $u->toString(); ?>">Código HTML</a></li>
    </ul>
</div>

<div class="rel-<?= $rel; ?>">
    <? require(dirname(__FILE__) . DS . 'relatorios.envios.' . $rel . '.php'); ?>
</div>
<? 
    endif; 
else:
?>
<div class="aviso">Selecione um envio no menu acima.</div>
<br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br />
<? endif; ?>


<script type="text/javascript">
    $(function() {
        var form =  $('#newsletters-relatorios-index .validaForm');
    
        form.validaForm();
        
        $('form .envio').change(function(){
            form.submit();
        });
    });
</script>
