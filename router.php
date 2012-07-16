<?
defined('BW') or die("Acesso negado!");

// ADM
bwRouter::addUrl('/newsletters');
bwRouter::addUrl('/newsletters/task', array(), 'task');
bwRouter::addUrl('/newsletters/contatos/lista');
bwRouter::addUrl('/newsletters/contatos/cadastro/:id', array('id'));
bwRouter::addUrl('/newsletters/grupos/lista');
bwRouter::addUrl('/newsletters/grupos/cadastro/:id', array('id'));
