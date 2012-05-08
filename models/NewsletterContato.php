<?php

class NewsletterContato extends bwRecord
{
  var $labels = array(
      'nome' => 'Nome do contato',
      'email' => 'E-mail',
      'datahora_adicionado' => 'Adicionado'
  );

  public function setTableDefinition()
  {
    $this->setTableName('bw_newsletters_contatos');
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
      'notnull' => false,
      'notblank' => false,
      'autoincrement' => false,
    ));             
    $this->hasColumn('email', 'string', 255, array(
      'type' => 'string',
      'length' => 255,
      'fixed' => false,
      'unsigned' => false,
      'primary' => false,
      'notnull' => true,
      'email' => true,
      'autoincrement' => false,
    ));
    $this->hasColumn('datahora_adicionado', 'timestamp', null, array(
      'type' => 'timestamp',
      'fixed' => false,
      'unsigned' => false,
      'primary' => false,
      'notnull' => true,
      'notblank' => true,
      'autoincrement' => false,
    ));       
    $this->hasColumn('status', 'integer', 4, array(
      'type' => 'integer',
      'length' => 4,
      'fixed' => false,
      'unsigned' => false,
      'primary' => false,
      'notnull' => true,
      'autoincrement' => false,
    ));       
  }

  public function setUp()
  {
    parent::setUp();

    $this->hasMany('NewsletterGrupo as Grupos', array(
      'local' => 'id_contato',
      'foreign' => 'id_grupo',
      'refClass' => 'NewsletterContatoGrupoRel'
    ));
  }
  
  //
  public function salvar($dados)
  {
  
    // verifica emails duplicados no mesmo servico
    if(!$dados['id'])
    {
      $dql = Doctrine_Query::create()
        ->from('NewsletterContato')
        ->where('email = ?', $dados['email']);

      if($dql->fetchOne())
      {
        return array(
          'retorno' => false,
          'dados' => bwUtil::array2query($dados),
          'msg' => 'Já exite um contato com este e-mail cadastrado',
        );
      }
    }
    else
    {
      unset($dados['email']);
    }

    // grupos
    $grupos = $dados['grupos'];
    unset($dados['grupos']);
    
    if(count($grupos))
    {
      $rel = array('Grupos' => $grupos);
      
      // data
      $dados['datahora_adicionado'] = bwUtil::dataToMysql($dados['datahora_adicionado']);

      $db = bwComponent::save('NewsletterContato', $dados, 'id', $rel);
      $r = bwComponent::retorno($db);
    }
    else
    {
      $r = array(
        'retorno' => 'false',
        'msg' => 'Nenhum grupo foi selecionado!',
      );
    }
   
    return $r;
  }

  //
  public function remover($dados)
  {
    // relacionamentos do grupos
    $rel = array('Grupos');

    //
    $db = bwComponent::remover('NewsletterContato', $dados, 'id', $rel);
    $r = bwComponent::retorno($db);

    return $r;
  }
}
