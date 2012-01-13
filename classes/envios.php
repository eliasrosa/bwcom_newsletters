<?

defined('BW') or die("Acesso negado!");

class bwNewslettersEnvios extends bwObject
{
    // getInstance
    function getInstance($class = false)
    {
        $class = $class ? $class : __CLASS__;
        return bwObject::getInstance($class);
    }


    public function salvar($assunto, $conteudo, $remtente, $grupos, $agendamento)
    {    
        // Agendamento
        if(!is_null($agendamento))
            $agendamento = bwUtil::data($agendamento);


        // Grupos
        $grupos = join(',', $grupos);

        
        // envia 
        $dados = array(
            'assunto' => $assunto,
            'mensagem' => $conteudo,
            'remetente' => $remtente,
            'grupos' => $grupos,
            'agendamento' => $agendamento
        );


        // remove agendamento
        if(is_null($dados['agendamento']))
            unset($dados['agendamento']);


        // envia o post
        $x = bwNewsletters::getInstance()->sendPostServer('envio_salvar', $dados);
        
        
        //print_r($x);
        return $x;
    }
    

    public function listar()
    {    
        $x = bwNewsletters::getInstance()->sendPostServer('envio_listar');
        return $x;
    }    

    public function selecionar($id)
    {    
        $x = bwNewsletters::getInstance()->sendPostServer('envio_selecionar', array(
            'id' => $id
        ));
        return $x;
    }   

}
?>
