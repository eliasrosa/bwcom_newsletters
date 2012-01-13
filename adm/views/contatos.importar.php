<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(3);

if (bwRequest::getMethod() == 'POST')
{
    $grupos = bwRequest::getVar('grupos', array());
    $url = bwRouter::_('adm.php?com=newsletters&task=salvarContato&'.bwRequest::getToken().'=1');

    preg_match_all('/([\w]+)(\.[\w]+)*@([\w\-]+)(\.[\w]{2,7})(\.[a-z]{2})?/i', bwRequest::getVar('import', NULL), $matches);
    $contatos = $matches[0];
    $total = count($contatos);

    if(count($grupos))
    {
        foreach($grupos as $g)
            $url .= '&grupos[]='.$g;
    }

    if($total)
    {
        if($total > 1)
            echo sprintf('<form><h2>Importando %s contatos</h2></form>', $total);
        else
            echo '<form><h2>Importando 1 contato</h2></form>';
            

        echo '<ul id="import-contatos">';
        foreach($contatos as $c)
        {
            $c = trim($c);
            if($c != '')
            {
                $ok = 1;
                echo sprintf('<li class="pendente"><b>%s</b></li>', $c);
            }
        }
        echo '</ul>';
        
        echo "<script type=\"text/javascript\">
                    $(function(){
                    
                        var importContatos = function(){
                            $('#import-contatos li.pendente:first').each(function(){
                                var c = $(this);
                                var email = \$('b', c).html();
                                
                                \$.ajax('$url&email=' + email, {
                                
                                    success: function(responseText){
                                    
                                        setTimeout(function(){
                                        
                                            var json = eval('('+ responseText +')');
                                            c.append(' - ' + json.mensagem);
                                            
                                            c.removeClass('pendente');
                                            
                                            importContatos();
                                                        
                                        }, 200);
                                    }
                                });
                            });    
                        }
                        
                        importContatos();
                        
                    });
                </script>
            ";

    }
    
    if(!count($contatos) || !isset($ok))
        echo '<div class="erro">Nenhum contatos foi encontrado na lista!</div>';
    
}
else
{
    
?>

    <form action="" method="post" class="validaform" enctype="multipart/form-data" encoding="multipart/form-data">
        <h2>Importar contatos</h2>

        <div class="campo block">
            <span>Lista de e-mails</span>
            <textarea class="w100" style="height: 200px;" name="import"></textarea>
            <br class="clearfix"/>
        </div>


        <h2>Relacionar os novos e-mails com os grupos marcados abaixo</h2>
        <div id="grupos">
            <?       
            
            $r = bwNewsletters::getGrupos()->listar();
            echo '<ul>';

            foreach($r['dados'] as $g)
            {
                $id = $g['id'];
                $nome = $g['nome'];
                
                echo sprintf('<label class="w80" style="display:inline-block;"><input %s type="checkbox" value="%s" name="grupos[]" />%s</label>', $ck, $id, $nome);
            } 
     
            echo '</ul>';        
             
            ?>
    </div>

    <a class="enviar submit">Importar</a>
    <script type="text/javascript">
        $(function() {
            $('#newsletters-contatos-importar form a.enviar.submit').click(function(){
            if(confirm('Importar contatos?'))
                $('#newsletters-contatos-importar form').submit();
            }).button();
        });
    </script>
</form>

<? } ?>
