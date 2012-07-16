<?
defined('BW') or die("Acesso negado!");

class bwGridContatos extends bwGrid
{
    function col0($i)
    {
        return sprintf('<a href="%s">%s</a>', $i->getUrl('/newsletters/contatos/cadastro'), $i->id);
    }
    
    function col1($i)
    {
        return $i->email;
    }

    function col2($i)
    {
        return $i->nome;
    }

    function col3($i)
    {
        return bwUtil::data($i->datahora_adicionado);
    }

    function __construct()
    {
        //
        $this->orderColDefault = 1;
      
        //
        $sql = Doctrine_Query::create()
          ->from('NewsletterContato c');
    
        //
        parent::__construct($sql, 'contatos');
        
        //
        $this->addCol('ID', 'c.id', 'tac', 50); 
        $this->addCol('E-mail', 'c.email'); 
        $this->addCol('Nome', 'c.nome');
        $this->addCol('Adicionado', 'c.datahora_adicionado', 'tac', 130);

        //
        $this->show(); 
    }
}


echo bwAdm::createHtmlSubMenu(0);
echo bwButton::redirect('Criar novo contato', '/newsletters/contatos/cadastro/0');
new bwGridContatos();


?>