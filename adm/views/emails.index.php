<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(1);
?>

<table>
    <tr>
        <td nowrap="nowrap"><img src="<?= BW_URL_TEMPLATE ?>/img/newsletter_novo.jpg" width="150" height="150" /><br/><?= bwButton::redirect('Enviar usando um novo e-mail', 'adm.php?com=newsletters&sub=emails&view=editor'); ?></td>
        <!--
        <td nowrap="nowrap"><img src="<?= BW_URL_TEMPLATE ?>/img/newsletter_modelos.jpg" width="150" height="150" /><br/><?= bwButton::redirect('Enviar usando um modelo salvo', 'adm.php?com=newsletters&sub=emails&view=modelos'); ?></td>
        <td nowrap="nowrap"><img src="<?= BW_URL_TEMPLATE ?>/img/newsletter_url.jpg" width="150" height="150" /><br/><?= bwButton::redirect('Enviar usando um modelo salvo', 'adm.php?com=newsletters&sub=emails&view=modelos'); ?></td>
        -->
    </tr>
</table>

