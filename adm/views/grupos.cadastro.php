<?
defined('BW') or die("Acesso negado!");

// menu
echo bwAdm::createHtmlSubMenu(4);

?>
<table class="painel">
    <tr>
        <td class="lateral-menu">
            <? require('grupos.treeview.php'); ?>
        </td>
        <td>
            <h2 class="header">Dados do grupo</h2>
            <div class="conteudo">
            <?
                $form = new bwForm();
                $id = bwRequest::getVar('id');
                if($id)
                {
                    $r = bwNewsletters::getGrupos()->selecionar($id);
                    if($r['retorno'])
                    {
                        $r = $r['dados'];
                    
                        $form->isEdit = true;
                        $form->addHidden('id', '', array(
                            'value' => $r['id'],
                            'findDB' => false
                        ));       

                        $form->addInput('nome', 'text', array(
                            'label' => 'Nome:',
                            'findDB' => false,
                            'value' => $r['nome'],
                        ));

                        $form->addInput('', 'text', array(
                            'label' => 'Contatos relacionados:',
                            'findDB' => false,
                            'value' => $r['total_contatos'],
                            'edit' => false,
                        ));
                
                        $form->addBottonSalvar('salvarGrupo');
                        
                        if(!$r['total_contatos'])
                            $form->addBottonRemover('removerGrupo');
                        
                        $form->show();
                    }
                    else
                    {
                         bwNewsletters::getInstance()->showMensagemRetorno($r);
                    }
                }
                else
                {
                    $form->addInput('nome', 'text', array(
                        'label' => 'Nome:',
                        'findDB' => false,
                        'value' => ''
                    ));
                    
                    $form->addBottonSalvar('salvarGrupo');
                    $form->show();
                }
            ?>      
            </div>
        </td>
    </tr>
</table>
