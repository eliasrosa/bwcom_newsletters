<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(0);

$id = bwRequest::getVar('id', 0, 'get');
$i = bwComponent::openById('NewsletterContato', $id);

$form = new bwForm($i);
$form->addH2('Dados do contato');
$form->addInputID();
$form->addInput('email');
$form->addInput('nome');
$form->addInputDataHora('datahora_adicionado');
$form->addStatus();

$form->addBottonSalvar('salvarContato');
$form->addBottonRemover('removerContato');
$form->show();

?>


