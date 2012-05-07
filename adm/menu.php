<?
defined('BW') or die("Acesso negado!");

$tituloPage = "Administração de Newsletters";

$menu = array(
    '0' => array(
        'url' => 'adm.php?com=newsletters&sub=contatos&view=lista',
        'tit' => 'Contatos'
    ),
    '1' => array(
        'url' => 'adm.php?com=newsletters&sub=grupos&view=lista',
        'tit' => 'Grupos'
    )
);
?>

