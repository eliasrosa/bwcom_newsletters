<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(3);


$id = bwRequest::getVar('id');

$form = new bwForm();
$form->addH2('Informações do contato');

if($id)
{
    $r = bwNewsletters::getContatos()->selecionar($id);    
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
            'label' => 'Adicionado:',
            'findDB' => false,
            'value' => bwUtil::data($r['datahora_adicionado']),
            'edit' => false
        ));        

        if($r['status'] == 0)
        {
            $form->addInput('', 'text', array(
                'label' => 'Desativado:',
                'findDB' => false,
                'value' => bwUtil::data($r['datahora_descadastro']),
                'edit' => false
            ));        
        }
        
        $form->addStatus('status', array(
            'label' => 'Status:',
            'findDB' => false,
            'value' => $r['status']
        ));
        
        $form->addCustonFile('contatos.grupos.php', array(
            'i' => $r
        ));
        
        $form->addBottonSalvar('salvarContato');
        $form->addBottonRemover('removerContato');  
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

    $form->addCustonFile('contatos.grupos.php');    
    $form->addBottonSalvar('salvarContato');
    $form->show();
}


?>


