<?

defined('BW') or die("Acesso negado!");

class bwNewsletters extends bwComponent
{
    // variaveis ADM
    var $id = 'newsletters';
    var $nome = 'Newsletters';
    var $adm_visivel = true;
    
    // getInstance
    function getInstance($class = false)
    {
        $class = $class ? $class : __CLASS__;
        return bwObject::getInstance($class);
    }
}
?>
