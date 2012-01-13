<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(7);

$id = bwRequest::getVar('id');

$form = new bwForm();
$form->addH2('Informações do Remetente');

if($id)
{
    $r = bwNewsletters::getRemetentes()->selecionar($id);
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
            'edit' => $r['status'] == 0 ? false : true
        ));

        $form->addInput('', 'text', array(
            'label' => 'E-mail:',
            'findDB' => false,
            'value' => $r['email'],
            'edit' => false
        ));
        
        $form->addInput('', 'text', array(
            'label' => 'Status:',
            'findDB' => false,
            'value' => $r['status_mensagem'],
            'edit' => false
        ));
                
        $form->addBottonSalvar('removerRemetente', 'Remover', 'right');  

        if($r['status'] != 0)         
            $form->addBottonSalvar('salvarRemetente');
        
        if($r['status'] == 0)      
            $form->addBottonSalvar('ativarRemetente', 'Reativar');        
        
        if($r['status'] != 0)      
            $form->addBottonSalvar('desativarRemetente', 'Desativar', 'right');        

        if($r['status'] == 1)      
            $form->addBottonRedirect('Enviar verificação', bwRouter::_('adm.php?com=newsletters&sub=remetentes&view=verificar&id='. $id));        

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

    $form->addInput('email', 'text', array(
        'label' => 'E-mail:',
        'findDB' => false,
        'value' => '',
    ));
    
    $form->addBottonSalvar('salvarRemetente');
    $form->show();
    
}

?>


