<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(5);
?>
<table class="painel">
    <tr>
        <td class="lateral-menu">
            <h2>Selecione o relatório</h2>
        
            <?
            require(dirname(__FILE__) .DS. '..' .DS. 'menu.php');
            $page = bwRequest::getVar('pagina', 'envios', 'get');
            $tit = $relatorios[$page]['tit'];
            ?>
            <ul>
                <? foreach($relatorios as $k=>$v) {
                    $class= $page == $k ? ' class="active"' : '';
                    echo sprintf('<li%s><a href="%s">%s</a></li>', $class, bwRouter::_($v['url']), $v['tit']);
                } ?>
            </ul>
        </td>
        <td>
            <h2 class="header"><?= $tit; ?></h2>
            <div class="conteudo">
                <? 
                $file = sprintf('relatorios.%s.php', $page);
                require($file); ?>
            </div>
        </td>
    </tr>
</table>
