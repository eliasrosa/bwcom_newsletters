<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(7);

?>

<?= bwButton::redirect('Criar novo remetente', 'adm.php?com=newsletters&sub=remetentes&view=cadastro'); ?>

<table id="dataTable01">
    <thead>
        <tr>
            <th class="tac" style="width: 50px;">ID</th>
            <th>E-mail</th>
            <th>Nome</th>
            <th class="tac" style="">Status</th>
        </tr>
    </thead>
    <tbody>
        <?
        $r = bwNewsletters::getRemetentes()->listar_todos();
        
        foreach($r['dados'] as $i)
        { 
            // nome
            $nome = '<a href="' . bwRouter::_('adm.php?com=newsletters&sub=remetentes&view=cadastro&id=' . $i['id']) . '">' . $i['nome'] . '</a>';
        
            switch ($i['status'])
            {
                case '1':
                    
                    $status = sprintf('%s<br />%s<br/><a class="send" rel="%s" href="%s">Verificar e-mail</a>',
                        bwAdm::getImgStatus(0),
                        $i['status_mensagem'],
                        $i['id'],
                        bwRouter::_('adm.php?com=newsletters&sub=remetentes&view=verificar&id='. $i['id'])
                    );
                    break;

                case '3':
                    
                    $status = bwAdm::getImgStatus(1).'<br />'.$i['status_mensagem'];
                    break;
                
                default:
                    
                    $status = bwAdm::getImgStatus(0) .'<br />'.$i['status_mensagem'];
                    break;
            }
            
            echo sprintf('<tr><td class="tac">%s</td><td>%s</td><td>%s</td><td class="tac wp20">%s</td></tr>',
                $i['id'],
                $nome,
                $i['email'],
                $status
            );
        }
        ?>
    </tbody>
</table>

<div class="aviso">
    <p>Para a configuração de seu remetente, é necessário que você utilize um domínio próprio com o registro SPF, de acordo com: <span>"v=spf1 include:_spf.sulbrasilweb.com.br ~all"</span></p>
</div>

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
