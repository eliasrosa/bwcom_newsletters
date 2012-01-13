<? 
defined('BW') or die("Acesso negado!");

$dados = bwRequest::getVar('dados', array());
$dados['status'] = 1;
$dados['datahora_adicionado'] = bwUtil::dataNow();

if(bwRequest::checkToken())
{
	$r = bwNewsletters::getInstance()->getContatos()->salvar($dados);
	$msg = $r['retorno'] ? "O e-mail <b>{$dados['email']}</b> foi cadastrado com sucesso!" : "E-mail <b>{$dados['email']}</b> é inválido ou já está cadastrado!";
}
else
	$msg = "Token inválido!";
	
	
echo '<h1 class="tit1">Newsletter</h1>';
echo nl2br("<p>{$msg}</p>");
?>
