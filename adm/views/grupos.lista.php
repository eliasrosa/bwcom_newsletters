<?
defined('BW') or die("Acesso negado!");

?>

<?= bwAdm::createHtmlSubMenu(4); ?>

<table class="painel">
	<tr>
		<td class="lateral-menu">
			<? require('grupos.treeview.php'); ?>
		</td>
		<td>
			<h2 class="header">Grupos</h2>
			<div class="conteudo">
				Selecione um grupo ao lado ou 
				<?= bwButton::redirect('Crie um novo grupo', 'adm.php?com=newsletters&sub=grupos&view=cadastro'); ?>
			</div>
		</td>
	</tr>
</table>






