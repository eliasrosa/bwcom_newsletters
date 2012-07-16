<?
defined('BW') or die("Acesso negado!");

echo bwButton::redirect('Crie um novo grupo', 'adm.php?com=newsletters&sub=grupos&view=cadastro');

$r = bwNewsletters::getGrupos()->listar();

echo '<ul>';
foreach($r['dados'] as $g)
{
    $id = $g['id'];
    $nome = $g['nome'];
    
    $class = bwRequest::getVar('id', null) == $id ? ' class="active"' : '';
    $href = bwRouter::_("adm.php?com=newsletters&sub=grupos&view=cadastro&id={$id}");
    echo sprintf('<li%s><a href="%s">%s</a></li>', $class, $href, $nome);
} 
echo '</ul>';

/*
            
        $tree = array();
        $semPai = array();
        foreach($r['grupos'] as $g)
        {
            $l = explode('/', $g['nome'], 2);
            
            if(count($l) == 1)
                $semPai[] = $g['id']."|{$l[0]}";
            else
                $tree[$l[0]][] = $g['id']."|{$l[1]}";;

        }
        
        if(count($semPai))
        {
            echo '<ul>';
            foreach($semPai as $v)
            {
                list($id, $nome) = explode('|', $v);
                $class = bwRequest::getVar('id', null) == $id ? ' class="active"' : '';
                $href = bwRouter::_("adm.php?com=newsletters&sub=grupos&view=cadastro&id={$id}");
                echo sprintf('<li%s><a href="%s">%s</a></li>', $class, $href, $nome);
            }
            echo '</ul>';
        }
        
        foreach($tree as $k=>$grupos)
        {
            echo '<h2>'.$k.'</h2>';
            echo '<ul>';
            foreach($grupos as $g)
            {
                list($id, $nome) = explode('|', $g);
                $class = bwRequest::getVar('id', null) == $id ? ' class="active"' : '';
                $href = bwRouter::_("adm.php?com=newsletters&sub=grupos&view=cadastro&id={$id}");
                echo sprintf('<li%s><a href="%s">%s</a></li>', $class, $href, $nome);
            }
            echo '</ul>';
        }
*/

?>


