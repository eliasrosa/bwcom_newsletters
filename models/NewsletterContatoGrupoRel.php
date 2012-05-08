<?php
class NewsletterContatoGrupoRel extends bwRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('bw_newsletters_contatos_grupos_rel');
        $this->hasColumn('id_contato', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('id_grupo', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}