<?

defined('BW') or die("Acesso negado!");

class bwNewslettersContatos extends bwObject
{
    // getInstance
    function getInstance($class = false)
    {
        $class = $class ? $class : __CLASS__;
        return bwObject::getInstance($class);
    }
    
    public function salvar($id, $nome, $email, $status, $grupos)
    {
        if(is_array($grupos))
            $grupos = join(',', $grupos);
    
        $x = bwNewsletters::getInstance()->sendPostServer('contato_salvar', array(
            'id' => $id,
            'nome' => $nome,
            'email' => $email,
            'status' => $status,
            'grupos' => $grupos
        ));
        
        return $x;
    }
    
    public function listar($status = NULL)
    {    
        $x = bwNewsletters::getInstance()->sendPostServer('contato_listar', array(
            'status' => $status
        ));
        return $x;
    }

    public function remover($id)
    {
        $x = bwNewsletters::getInstance()->sendPostServer('contato_remover', array(
            'id' => $id
        ));
        return $x;    
    }
    
    public function selecionar($id)
    {
        $x = bwNewsletters::getInstance()->sendPostServer('contato_selecionar', array(
            'id' => $id
        ));
        return $x;    
    }  

}
?>
