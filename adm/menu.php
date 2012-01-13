<?
defined('BW') or die("Acesso negado!");

$tituloPage = "Administração de Newsletters";

$menu = array(
    '0' => array(
        'url' => 'adm.php?com=newsletters&view=resumo',
        'tit' => 'Resumo'
    ),
    '1' => array(
        'url' => 'adm.php?com=newsletters&sub=emails&view=index',
        'tit' => 'Enviar e-mail marketing'
    ),
    '3' => array(
        'url' => 'adm.php?com=newsletters&sub=contatos&view=lista',
        'tit' => 'Contatos'
    ),
    '4' => array(
        'url' => 'adm.php?com=newsletters&sub=grupos&view=lista',
        'tit' => 'Grupos'
    ),
    '7' => array(
        'url' => 'adm.php?com=newsletters&sub=remetentes&view=lista',
        'tit' => 'Remetentes'
    ),
    '5' => array(
        'url' => 'adm.php?com=newsletters&sub=relatorios&view=index',
        'tit' => 'Relatórios'
    ),
    '8' => array(
        'url' => 'adm.php?com=newsletters&view=comprar',
        'tit' => 'Comprar créditos'
    ),
    '6' => array(
        'url' => 'adm.php?com=newsletters&view=configuracoes',
        'tit' => 'Configurações'
    ),
);

$relatorios = array(
    'envios' => array(
        'url' => 'adm.php?com=newsletters&sub=relatorios&view=index&pagina=envios',
        'tit' => 'Relatórios de envios'
    ),
    'historico' => array(
        'url' => 'adm.php?com=newsletters&sub=relatorios&view=index&pagina=historico',
        'tit' => 'Histórico de créditos'
    )
);

?>

