<div id="grupos">
  <?       
  $form->addH2('Grupos relacionados');
  
  $grupos = Doctrine_Query::create()
    ->from('NewsletterGrupo g')
    ->orderBy('g.nome ASC')
    ->execute();
  
  $rel = array();
  
  foreach($i->Grupos as $g)
  {
    $rel[$g->id] = $g->id;
  }
  
  if($grupos)
  {
    foreach($grupos as $g)
    {
      $sel = isset($rel[$g->id]) ? 'checked="checked"' : '';
      
      echo '<label class="w80" style="display:inline-block;">';
      echo sprintf('<input %s type="checkbox" value="%s" name="dados[grupos][]" />%s',
        $sel, $g->id, $g->nome);
      echo '</label>';
    } 
  }
  else
    echo sprintf('<p>Nenhum grupo de contato foi encontrado!<br />Cadastre seus grupos <a href="%s">aqui!</a></p>',
      bwRouter::_('adm.php?com=newsletters&sub=grupos&view=cadastro'));
  ?>
</div>
