    <div id="grupos">
        <?       
        
        $form->addH2('Grupos relacionados');
        
        $r = bwNewsletters::getGrupos()->listar();
        echo '<ul>';

        foreach($r['dados'] as $g)
        {
            $id = $g['id'];
            $nome = $g['nome'];
            
            $ck = isset($i['grupos'][$id]) ? 'checked="checked"' : '';
            $disabled = $i['status'] || !$i['id'] ? '' : 'disabled="disabled"';
            echo sprintf('<label class="w80" style="display:inline-block;"><input %s %s type="checkbox" value="%s" name="grupos[]" />%s</label>', $disabled, $ck, $id, $nome);
        } 
 
        echo '</ul>';        

         
        ?>
    </div>
