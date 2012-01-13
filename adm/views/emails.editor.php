<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(1);

bwHtml::js('/array.util.js', true);
bwHtml::js('/tiny_mce/jquery.tinymce.js', true);
bwHtml::js(BW_URL_JAVASCRIPTS . '/validaform/jquery.meio.mask.min.js');
bwHtml::js(BW_URL_JAVASCRIPTS . '/validaform/jquery.validaform.js');
bwHtml::css(BW_URL_JAVASCRIPTS . '/validaform/jquery.datepicker.css');
bwHtml::js(BW_URL_JAVASCRIPTS . '/validaform/jquery-ui-timepicker-addon.js');
bwHtml::js(BW_URL_JAVASCRIPTS . '/validaform/ui.datepicker-pt-BR.js');

$classEditor = 'editor_'.rand();
?>

<form action="" method="post" class="validaform">

    <input type="hidden" name="task" value="salvarEnvio" />
    <?= bwHtml::createInputToken(); ?>

    <div class="cmp assunto">
        <h2>Assunto</h2>
        <input type="text" name="assunto" value="" rel="text_" title="Assunto" />
    </div>

    <div class="cmp conteudo">
        <h2>Conteúdo</h2>
        <textarea class="editor <?= $classEditor; ?>" name="conteudo" rel="text_" title="Conteúdo"></textarea>
    </div>
    
    <!--
    <div class="cmp textoplano" id="textoplano">
        <h2>Texto Plano <input type="checkbox" name="istextoplano" class="is" /></h2>
    </div>
    -->
    
    <div class="cmp contatos">
        <h2>Contatos</h2>

        <div class="tabs">
            <ul>
                <li><a href="#tabs-1">Enviar para</a></li>
                <li><a href="#tabs-2">Não enviar para</a></li>
            </ul>
            <div id="tabs-1">
                <p>Selecione para quais grupos de contatos deseja enviar sua mensagem. Fique atento ao número de créditos disponíveis.</p>
                
                <p class="opcoes">
                    <a href="javascript:void(0);" class="sel">Selecionar todos os grupos</a> | <a href="javascript:void(0);" class="des">Desmarcar todos os grupos</a>
                </p>

                <?       
                                
                $r = bwNewsletters::getGrupos()->listar();
                echo '<ul>';

                foreach($r['dados'] as $g)
                {
                    $id = $g['id'];
                    $nome = $g['nome'];
                    $total = count($g['contatos']['ativos']);
                    
                    $disabled = $total ? '' : ' disabled="disabled"';
                    $ativos = join(',', $g['contatos']['ativos']);
                    
                    echo sprintf('<label enviar="gp%s" class="w80" style="display:inline-block;"><input type="checkbox" value="%s" name="grupos[]"%s rel="%s" ids-ativos="%s" />%s (<span class="c">%s</span>)</label>', $id, $id, $disabled, $total, $ativos, $nome, $total);
                } 
         
                echo '</ul>';        
                 
                ?>

            </div>
            <div id="tabs-2">
                <p>Em breve!</p>
            </div>

            <? 
                $api = bwNewsletters::getInstance();
                $api->showCreditos();
            ?>
            
            </div>
        </div>

        <div class="cmp remetente">
            <h2>Remetente</h2>
            <select name="remetente" title="Remetente" rel="text_">
                <option value="">-- Selecione um remetente --</option>

            <?
                $x = bwNewsletters::getRemetentes()->listar_todos();
                foreach ($x['dados'] as $r)
                {
                    if($r['status'] == 3)
                        echo sprintf('<option value="%s">%s | %s</option>',
                            $r['id'],
                            $r['nome'],
                            $r['email']
                        );
                }
            ?>
            </select>
        </div>

        <div class="cmp agendar" id="agendar">
            <h2>Agendar <input type="checkbox" name="isagenda" class="is" /></h2>
        </div>

        <a class="enviar submit">Enviar email</a>
    </form>

    <script type="text/javascript">
        $(function() {
           
            <?
            
            $config = new bwConfigDB();
            $json = $config->getValue('plugins.tinymce.parametros');
            
            ?>
            
            // Editor HTML        
            $('textarea.<?= $classEditor ?>').tinymce($.extend(<?= $json; ?>, { 
                script_url : '<?= BW_URL_JAVASCRIPTS ?>/tiny_mce/tiny_mce.js',
                mode: 'exact',
                theme: 'advanced'
            }));
            
            // Tabs in jQuery UI
            $('#newsletters-emails-editor form .contatos .tabs').tabs();

            // Eventos #tab-1
            $('#tabs-1 .opcoes .sel').click(function(){
               $('#tabs-1 input:not(:checked)').click();
            });

            $('#tabs-1 .opcoes .des').click(function(){
               $('#tabs-1 input:checked').click();
            });

            $('#tabs-1').change(function(){
                var contatosMarcados = 0;
                var saldo = $('#newsletters-emails-editor .contatos .creditos .saldo').attr('rel');
                var ids = new Array();

                $('#tabs-1 label input:checked').each(function(){
                    var str = ""+$(this).attr('ids-ativos');
                    var ativos = str.split(',');

                    $.each(ativos, function(a, b){
                       ids.push(b);
                    });
                });

                contatosMarcados = ids.unique().length;
                var saldoPos = saldo - contatosMarcados;
                $('#newsletters-emails-editor .contatos .creditos .saldo').html(saldoPos);
            });
            
            
            // Agendamento
            $('#agendar input.is').change(function(){
                if($(this).prop('checked')){
                    $('#agendar').append('<input type="text" class="agenda" name="agenda" value="" rel="datetime_" title="Data/Hora do envio" />');
                    $('#agendar .agenda').datetimepicker();
                    $('#agendar .agenda').focus();
                }else{
                    $('#agendar .agenda').remove();
                }
            });

            // Validação e Retorno do form 
            $('#newsletters-emails-editor form').validaForm({
                upload: true,
                success: function(retorno){
                    var json = eval('('+ retorno +')');
                    alert(json.mensagem);
                    
                    if(json.retorno){
                        window.location.reload();
                    }                      
                }
            });

            // Enviar btn submit
            $('#newsletters-emails-editor form a.enviar.submit').click(function(){
                if(confirm('Confirmar envio?'))
                    $('#newsletters-emails-editor form').submit();
                else
                    return false;
            }).button();              
        });
    </script>
