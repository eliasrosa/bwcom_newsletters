<?php

class NewsletterGrupo extends bwRecord
{
    var $labels = array(
        'nome' => 'Nome do grupo'
    );

    public function setTableDefinition()
    {
        $this->setTableName('bw_newsletters_grupos');
        $this->hasColumn('id', 'integer', 4, array(
            'type' => 'integer',
            'length' => 4,
            'fixed' => false,
            'unsigned' => false,
            'primary' => true,
            'autoincrement' => true,
        ));        
        $this->hasColumn('nome', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => true,
            'notblank' => true,
            'unique' => true,
            'autoincrement' => false,
        ));        
    }

    public function setUp()
    {
        parent::setUp();

        $this->hasMany('NewsletterContato as Contatos', array(
            'local' => 'id_grupo',
            'foreign' => 'id_contato',
            'refClass' => 'NewsletterContatoGrupoRel'
        ));
    }

    //
    public function salvar($dados)
    {        
      $db = bwComponent::save('NewsletterGrupo', $dados);
      $r = bwComponent::retorno($db);

      return $r;
    }

    //
    public function remover($dados)
    {
      // verifica se exite contato relacionados
      $dql = Doctrine_Query::create()
        ->from('NewsletterContato c')
        ->innerJoin('c.Grupos g WITH g.id = ?', $dados['id']);

      if($dql->fetchOne())
      {
        return array(
          'retorno' => false,
          'msg' => 'Existem contatos cadastrados neste grupo!',
        );
      }     
    
      $db = bwComponent::remover('NewsletterGrupo', $dados);
      $r = bwComponent::retorno($db);

      return $r;
    }    
}
