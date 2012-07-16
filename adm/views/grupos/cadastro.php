<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(1);

$id = bwRequest::getVar('id', 0, 'get');
$i = bwComponent::openById('NewsletterGrupo', $id);

$form = new bwForm($i, bwRouter::_('/newsletters/task'));
$form->addH2('Dados do grupo');
$form->addInputID();
$form->addInput('nome');

$form->addBottonSalvar('salvarGrupo');
$form->addBottonRemover('removerGrupo');
$form->show();