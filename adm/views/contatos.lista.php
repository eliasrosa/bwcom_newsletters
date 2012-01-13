<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(3);

?>

<?= bwButton::redirect('Criar novo contato', 'adm.php?com=newsletters&sub=contatos&view=cadastro'); ?>
<?//= bwButton::redirect('Exportar', 'adm.php?com=newsletters&sub=contatos&view=exportar', 'right'); ?>
<?= bwButton::redirect('Importar', 'adm.php?com=newsletters&sub=contatos&view=importar', 'right'); ?>

<table id="dataTable01">
    <thead>
        <tr>
            <th class="tac" style="width: 50px;">ID</th>
            <th>E-mail</th>
            <th>Nome</th>
            <th class="tac">Adicionado</th>
            <th class="tac" style="width: 25px;">Status</th>
        </tr>
    </thead>
    <tbody>

        <?
        $r = bwNewsletters::getContatos()->listar();
        
        foreach($r['dados'] as $i)
        { 
            $nome = '<a href="' . bwRouter::_('adm.php?com=newsletters&sub=contatos&view=cadastro&id=' . $i['id']) . '">' . $i['nome'] . '</a>';
            $email = '<a href="' . bwRouter::_('adm.php?com=newsletters&sub=contatos&view=cadastro&id=' . $i['id']) . '">' . $i['email'] . '</a>';
            $status = bwAdm::getImgStatus($i['status']);
            echo sprintf('<tr><td class="tac">%s</td><td>%s</td><td class="w100">%s</td><td class="tac w30">%s</td><td class="tac w30">%s</td></tr>',
                $i['id'],
                $email,
                $nome,
                bwUtil::data($i['datahora_adicionado']),
                $status
            );
        }
        ?>    
    
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {

        oTable = $('#dataTable01').dataTable($.extend($.dataTableSettingsNoAjax, {
            "oLanguage": {
                "sProcessing": "Buscando registros...",
                "sLengthMenu": "Exibir _MENU_ registros por página",
                "sEmptyTable": '<?= $r['mensagem']; ?>',
                "sZeroRecords": '<?= $r['mensagem']; ?>',
                "sInfo": "Exibindo _START_ de _END_ em _TOTAL_ registros",
                "sInfoEmpty": "Exibindo 0 de 0 em 0 registros",
                "sInfoFiltered": "(filtrado dos _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst":    "Primeira",
                    "sPrevious": "Anterior",
                    "sNext":     "Próxima",
                    "sLast":     "Última"
                }
            }
        }));
    });
</script>

