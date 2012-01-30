<?

defined('BW') or die("Acesso negado!");

class bwNewsletters extends bwComponent
{
    // variaveis ADM
    var $id = 'newsletters';
    var $nome = 'Newsletters';
    var $adm_url_default = 'adm.php?com=newsletters&view=resumo';
    var $adm_visivel = false;
    
    // getInstance
    function getInstance($class = false)
    {
        $class = $class ? $class : __CLASS__;
        return bwObject::getInstance($class);
    }

    public function getConfig()
    {
        return parent::getConfig('newsletters');
    }

    public function getContatos()
    {
        require_once('classes' . DS . 'contatos.php');
        return bwNewslettersContatos::getInstance();
    }

    public function getGrupos()
    {
        require_once('classes' . DS . 'grupos.php');
        return bwNewslettersGrupos::getInstance();
    }

    public function getRemetentes()
    {
        require_once('classes' . DS . 'remetentes.php');
        return bwNewslettersRemetente::getInstance();
    }
    
    public function getEnvios()
    {
        require_once('classes' . DS . 'envios.php');
        return bwNewslettersEnvios::getInstance();
    }    

    public function getRelatorios()
    {
        require_once('classes' . DS . 'relatorios.php');
        return bwNewslettersRelatorios::getInstance();
    }    

    function showMensagemRetorno($r, $mensagem = '')
    {
        if($r === false)
        {
            $r['retorno'] = false;
            $r['mensagem'] = $mensagem;
        }
        
        $class = $r['retorno'] ? 'aviso' : 'erro';
        echo '<div class="'.$class.'">'.$r['mensagem'].'</div>';
    }
    

    /*
     * Retorna saldo atual de créditos
     * para envios dos e-mails 
     */
    public function api_selecionar_saldo_atual($validade = false)
    { 
        $r = $this->sendPostServer('selecionar_saldo');

        if(!$r['retorno'])
        {
            $r['dados']['validade'] = NULL;
            $r['dados']['saldo_atual'] = 0;
        }        
        
        return $r; 
    }


    public function api_selecionar_historico()
    { 
        $r = $this->sendPostServer('selecionar_historio_saldo');
        return $r;
    }

    public function showCreditos($comprar = true)
    {     
        $r = $this->api_selecionar_saldo_atual(true);
        
        $validade = is_null($r['dados']['validade']) || $r['dados']['saldo_atual'] == 0 ? '' : '<br/>Créditos válidos até <strong>'.bwUtil::data($r['dados']['validade'].'</strong><br/>');
        $comprar = $comprar ? '<br/>Obtenha mais créditos <a href="'.bwRouter::_('adm.php?com=newsletters&view=comprar').'">clicando aqui!</a>' : false;
        
        $html = sprintf('<div class="aviso creditos"><h1>Créditos disponíveis</h1><p>Você tem <strong class="saldo" rel="%s">%s</strong> envios disponíveis.%s%s</p></div>',
            $r['dados']['saldo_atual'],
            $r['dados']['saldo_atual'],
            $validade,
            $comprar
        );
        
        echo $html;
    }
    
    
    public function api_listar_boletos()
    { 
        $r = $this->sendPostServer('listar_boletos');
        return $r;
    }


    /*
     * Retorna uma array com
     * mensagem e status de retorno
     */
    function retorno($msg, $retorno)
    {
        $a = array(
            'retorno' => $retorno,
            'msg' => $msg,
            'mensagem' => $msg
        );
        
        return $a;
    }

    /*
     * Envia uma solicitação para o 
     * servidor usando POST
     */
    function sendPostServer($acao, $dados = array(), $return = 'json2array')
    {
        $autenticacao = $this->getConfig()->getValue('autenticacao');

        if(!$autenticacao)
            return $this->retorno('Autenticação inválida!', false);
    
        $dados = array_merge($dados, array(
           'acao' => $acao,
           'token' => $autenticacao
        ));

        // debug
        //print_r($dados);

        $dados = http_build_query($dados, '', '&');
        $url = $this->getConfig()->getValue('api');
        
        $params = array(
           'http' => array(
              'method' => 'POST',
              'content' => $dados,
              'header' => null
           )
        );
             
        try
        {
            $ctx = stream_context_create($params);
            $fp = @fopen($url, 'rb', false, $ctx);
            
            if (!$fp)
               throw new Exception("Não foi possível abrir a URL: $url");
            
            $response = stream_get_contents($fp);
            
            if ($response === false)
                throw new Exception("Erro ao obter dados da URL: $url");

            @fclose($fp);
            
            // convert to array
            if($return == 'json2array')
            {
                $dados = json_decode($response, true);
                
                if(is_array($dados))
                {
                    $dados['msg'] = $dados['mensagem'];
                    return $dados;
                }
            }
            elseif($return == 'csv')
            {
                if($response != '__ERROR__')
                    return bwUtil::csv2array($response);
                else
                    return false;
            }
            
            return $response;
        }
        catch (Exception $e) {
            return $this->retorno($e->getMessage(), false);
        }
    }
}
?>
