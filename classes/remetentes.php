<?

defined('BW') or die("Acesso negado!");

class bwNewslettersRemetente extends bwObject
{
    // getInstance
    function getInstance($class = false)
    {
        $class = $class ? $class : __CLASS__;
        return bwObject::getInstance($class);
    }
    
    public function salvar($id, $nome, $email)
    {    
        if(!$id)
        {
            $x = bwNewsletters::getInstance()->sendPostServer('remetente_adicionar', array(
                'nome' => $nome,
                'email' => $email
            ));
        }
        else
        {
            $x = bwNewsletters::getInstance()->sendPostServer('remetente_renomear', array(
                'id' => $id,
                'nome' => $nome
            ));
        }

        return $x;
    }

    public function remover($id)
    {    
        $x = bwNewsletters::getInstance()->sendPostServer('remetente_remover', array(
            'id' => $id,
        ));
        
        return $x;
    }

    public function ativar($id)
    {    
        $x = bwNewsletters::getInstance()->sendPostServer('remetente_ativar', array(
            'id' => $id,
        ));
        
        return $x;
    }

    public function desativar($id)
    {    
        $x = bwNewsletters::getInstance()->sendPostServer('remetente_desativar', array(
            'id' => $id,
        ));
        
        return $x;
    }    
    

    public function listar_todos()
    {    
        $x = bwNewsletters::getInstance()->sendPostServer('remetente_listar');
        return $x;
    }    


    public function enviar_verificacao($id)
    {    
        $x = bwNewsletters::getInstance()->sendPostServer('remetente_enviar_verificacao', array(
            'id' => $id
        ));

        return $x;
    }    

    public function selecionar($id)
    {
        $x = bwNewsletters::getInstance()->sendPostServer('remetente_selecionar', array(
            'id' => $id
        ));
        return $x;    
    }   

}
?>
