<?
defined('BW') or die("Acesso negado!");

class bwGridGrupos extends bwGrid
{
    function col0($i)
    {
        return sprintf('<a href="%s">%s</a>', $i->getUrl('/newsletters/grupos/cadastro'), $i->id);
    }

    function col1($i)
    {
        return $i->nome;
    }

    function col2($i)
    {
        return $i->total_contatos;
    }


    function __construct()
    {
        //
        $this->orderColDefault = 1;
      
        //
        $sql = Doctrine_Query::create()
          ->select('*, (SELECT COUNT(*) FROM NewsletterContatoGrupoRel r WHERE r.id_grupo = g.id) AS total_contatos')
          ->from('NewsletterGrupo g');
    
        
        //
        parent::__construct($sql, 'grupos');
        
        
        //
        $this->addCol('ID', 'g.id', 'tac', 50); 
        $this->addCol('Nome', 'g.nome');
        $this->addCol('Contatos', NULL, 'tac', 100);

        
        $this->show(); 
    }
}

echo bwAdm::createHtmlSubMenu(1);
echo bwButton::redirect('Criar novo grupo', '/newsletters/grupos/cadastro/0');
new bwGridGrupos();

?>