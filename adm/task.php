<?
defined('BW') or die("Acesso negado!");



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
  $r['redirect'] = bwRouter::_("adm.php?com=newsletters&sub=contatos&view=lista");  
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
  $r['redirect'] = bwRouter::_("adm.php?com=newsletters&sub=grupos&view=lista");    
}

die(json_encode($r));
?>
