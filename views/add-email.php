<?

defined('BW') or die("Acesso negado!");

$nome = bwRequest::getVar('nome');
$email = bwRequest::getVar('email');

if ($nome == 'Nome')
    $nome = NULL;

$dados = array(
    'email' => $email,
    'nome' => $nome,
    'datahora_adicionado' => bwUtil::dataNow(),
    'status' => 1,
    'grupos' => array(1)
);

$r = NewsletterContato::salvar($dados);
//print_r($r);

if ($r['retorno']) {
    $msg = sprintf('O e-mail <b>%s</b> foi cadastrado com sucesso!', $dados['email']);
} else {
    $msg = sprintf('E-mail <b>%s</b> é inválido ou já está cadastrado!', $dados['email']);
}

echo '<h1 class="tit1">Newsletter</h1>';
echo "<p>{$msg}</p>";
?>
