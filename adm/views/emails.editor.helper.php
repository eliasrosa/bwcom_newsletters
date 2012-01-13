<?

defined('BW') or die("Acesso negado!");

class helperTreeContatosGrupos
{
    var
    $base = array();
    public function __construct()
    {
        $this->getDados();
        $html = $this->montaMenu();

        echo $html;
    }

    public function getDados()
    {
        $dql = Doctrine_Query::create()
                        ->from('NewsletterContatoGrupo g')
                        ->leftJoin('g.Contatos c WITH (c.status = 1 OR c.datahora_removido != ?)', '0000-00-00 00:00:00')
                        ->orderBy('g.idpai, g.nome');

        foreach ($dql->execute() as $i)
        {
            //print_r($i->toArray());
            $this->base[$i['idpai']][] = $i;
        }

        $all = new NewsletterContatoGrupo();

        $all->id = 0;
        $all->idpai = 'all';
        $all->nome = 'Todos os grupos';
        $all->status = 1;

        $this->base['all'][] = $all;
    }

    public function montaMenu($idpai = 'all', $statusPai = true)
    {
        $grupos = isset($this->base[$idpai]) ? $this->base[$idpai] : array();
        $html = '';

        if (count($grupos))
        {
            $class = ($idpai == 0) ? ' class="menu"' : '';
            $html .= "<ul{$class}>";

            foreach ($grupos as $c)
            {
                $contatos = $c->Contatos->count();

                if ($contatos)
                {
                    if ($contatos == 1)
                        $contatos = "1 contato";
                    else
                        $contatos = "{$contatos} contatos";

                    $nome = "{$c->nome} <span>({$contatos})</span>";
                }
                else
                     $nome = $c->nome;

                $subgruposHTML = $this->montaMenu($c->id, $c->status);
                $class = ($s == '') ? '' : ' pai';
                $status = ($c->status && $statusPai) ? '' : 'disabled';

                $html .= "<li class=\"grupo_{$c->id}{$class}\"><input type=\"checkbox\" {$status} value=\"{$c->id}\"><a href=\"javascript:void(0);\"{$class}>{$nome}</a>{$subgruposHTML}</li>";
            }

            $html .= "</ul>";
        }

        return $html;
    }

}
?>


