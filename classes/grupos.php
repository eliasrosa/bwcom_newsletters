<?

defined('BW') or die("Acesso negado!");

class bwNewslettersGrupos extends bwObject
{
    // getInstance
    function getInstance($class = false)
    {
        $class = $class ? $class : __CLASS__;
        return bwObject::getInstance($class);
    }
    
    public function salvar($id, $nome)
    {
        $x = bwNewsletters::getInstance()->sendPostServer('grupo_salvar', array(
            'id' => $id,
            'nome' => $nome
        ));
        
        return $x;    
    }
    
    public function listar()
    {    
        $x = bwNewsletters::getInstance()->sendPostServer('grupo_listar');
        return $x;
    }  

    public function remover($id)
    {
        $x = bwNewsletters::getInstance()->sendPostServer('grupo_remover', array(
            'id' => $id
        ));
        return $x;    
    }
    
    public function selecionar($id)
    {
        $x = bwNewsletters::getInstance()->sendPostServer('grupo_selecionar', array(
            'id' => $id
        ));
        return $x;    
    }    
}
?>
