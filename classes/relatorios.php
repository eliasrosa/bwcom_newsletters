<?

defined('BW') or die("Acesso negado!");

class bwNewslettersRelatorios extends bwObject
{
    // getInstance
    function getInstance($class = false)
    {
        $class = $class ? $class : __CLASS__;
        return bwObject::getInstance($class);
    }
 

    public function mensagem($id)
    {    
        $x = bwNewsletters::getInstance()->sendPostServer('envio_relatorio_mensagem', array(
            'id' => $id
        ));
        
        if($x['retorno'])
        {
            echo base64_decode($x['html']);
        }
        else
            bwNewsletters::getInstance()->showMensagemRetorno($x);
        
        exit('<br class="clearfix" />');
    } 
    
    public function html($id)
    {    
        $x = bwNewsletters::getInstance()->sendPostServer('envio_relatorio_mensagem', array(
            'id' => $id
        ));
        
        if($x['retorno'])
        {
            echo '<div class="aviso">'.htmlentities(base64_decode($x['html'])).'</div>';
        }
        else
            bwNewsletters::getInstance()->showMensagemRetorno($x);
        
        exit('<br class="clearfix" />');
    }
    
    
    public function views($id)
    {    
        $x = bwNewsletters::getInstance()->sendPostServer('envio_relatorio_views', array(
            'id' => $id
        ));
        
        if($x['retorno'])
        {
            print_r($x);
        }
        else
            bwNewsletters::getInstance()->showMensagemRetorno($x);
        
        exit('<br class="clearfix" />');
    }
    
    
    public function links($id)
    {   
        echo '<p>Em breve!</p>';
        
        exit('<br class="clearfix" />');
    }               

}
?>
