<?
defined('BW') or die("Acesso negado!");
$task = bwRequest::getVar('task');



/************************************* 
 * CONTADOS
 *************************************/

if ($task == 'salvarContato')
{
  $r = NewsletterContato::salvar(bwRequest::getVar('dados', array()));
}

if ($task == 'removerContato')
{
  $r = NewsletterContato::remover(bwRequest::getVar('dados', array()));
  $r['redirect'] = bwRouter::_("/newsletters/contatos/lista");  
}





/************************************* 
 * GRUPOS
 *************************************/

if ($task == 'salvarGrupo')
{
  $r = NewsletterGrupo::salvar(bwRequest::getVar('dados', array()));
}

if ($task == 'removerGrupo')
{
  $r = NewsletterGrupo::remover(bwRequest::getVar('dados', array()));
  $r['redirect'] = bwRouter::_("/newsletters/grupos/lista");    
}

die(json_encode($r));
?>
