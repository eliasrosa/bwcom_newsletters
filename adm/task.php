<?
defined('BW') or die("Acesso negado!");

/************************************* 
 * ENVIOS
 *************************************/

if ($task == 'salvarEnvio')
{
    $r = bwNewsletters::getEnvios()->salvar(
        bwRequest::getVar('assunto', NULL),
        bwRequest::getVar('conteudo', NULL),
        bwRequest::getInt('remetente', NULL),
        bwRequest::getVar('grupos', array()),
        bwRequest::getVar('agenda', NULL)
    );
}

if ($task == 'cancelarEnvio')
{
    $r = bwNewsletters::getEnvios()->cancelar(
        bwRequest::getInt('id')
    );
}




/************************************* 
 * RELATÓRIOS
 *************************************/

if ($task == 'relatorioShowViews')
{
    $r = bwNewsletters::getRelatorios()->views(
        bwRequest::getInt('id')
    );
}






/************************************* 
 * CONTADOS
 *************************************/

if ($task == 'salvarContato')
{
    $r = bwNewsletters::getContatos()->salvar(
        bwRequest::getVar('id', 0),
        bwRequest::getVar('nome', NULL),
        bwRequest::getVar('email', NULL),
        bwRequest::getVar('status', NULL),
        bwRequest::getVar('grupos', NULL)
    );
}

if ($task == 'removerContato')
{
    $r = bwNewsletters::getContatos()->remover(
        bwRequest::getVar('id', 0)
    );
    $r['redirect'] = bwRouter::_('adm.php?com=newsletters&sub=contatos&view=lista');
}






/************************************* 
 * GRUPOS
 *************************************/

if ($task == 'salvarGrupo')
{
    $r = bwNewsletters::getGrupos()->salvar(
        bwRequest::getVar('id', 0),
        bwRequest::getVar('nome', NULL)
    );
}

if ($task == 'removerGrupo')
{
    $r = bwNewsletters::getGrupos()->remover(
        bwRequest::getVar('id', 0)
    );
    $r['redirect'] = bwRouter::_('adm.php?com=newsletters&sub=grupos&view=lista');
}






/************************************* 
 * REMETENTES
 *************************************/

if ($task == 'listarRemetentes')
{
    $r = bwNewsletters::getRemetentes()->listar();
}

if ($task == 'salvarRemetente')
{
    $r = bwNewsletters::getRemetentes()->salvar(
        bwRequest::getVar('id', 0),
        bwRequest::getVar('nome', NULL),
        bwRequest::getVar('email', NULL)
    );
}

if ($task == 'removerRemetente')
{
    $r = bwNewsletters::getRemetentes()->remover(
        bwRequest::getVar('id', 0)
    );
    
    if($r['retorno'])
        $r['redirect'] = bwRouter::_('adm.php?com=newsletters&sub=remetentes&view=lista');
}

if ($task == 'ativarRemetente')
{
    $r = bwNewsletters::getRemetentes()->ativar(
        bwRequest::getVar('id', 0)
    );
}

if ($task == 'desativarRemetente')
{
    $r = bwNewsletters::getRemetentes()->desativar(
        bwRequest::getVar('id', 0)
    );
}




die(json_encode($r));
?>
