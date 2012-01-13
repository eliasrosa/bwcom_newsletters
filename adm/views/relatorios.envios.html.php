<?
defined('BW') or die("Acesso negado!");

echo '<h2>Código HTML</h2>';
echo sprintf('<div class="aviso">%s</div>', htmlspecialchars($rel_mensagem));
?>