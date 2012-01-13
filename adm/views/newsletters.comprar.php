<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(8);

// get api
$api = bwNewsletters::getInstance();

$x = $api->api_listar_boletos();

if(!$x['retorno'])
    echo sprintf('<div class="aviso"><h1>Chave de acesso inválida!</h1><br/>Cadastre sua chave <a href="%s">clicando aqui.</a></div>',
        bwRouter::_('adm.php?com=newsletters&view=configuracoes&var=component.newsletters.autenticacao')
    );
else
{
$dados = $x['dados'];
$api->showCreditos(false);
?>
<table class="boletos">
    <tr>
        <td colspan="2"><img src="<?= BW_URL_MEDIA .'/newsletters/sbw.jpg'?>" /></td>
    </tr>

    <? foreach($dados['boletos'] as $b)
    {
        echo sprintf('<tr><td>%s - %s</td><td>%s</td></tr>',
            $b['descricao'],
            $b['valor'],
            bwButton::redirect('Comprar', $b['url'])
        );
    }
    ?>
    <tr>
        <td colspan="2"><div class="aviso">Validade dos créditos: <?= $dados['validade']; ?></div></td>
    </tr>    
</table>
<? } ?>