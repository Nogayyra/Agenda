<?php

require_once __DIR__ . '/vendor/autoload.php';

use Controller\ContatoController;

$controller = new ContatoController();
$pagina = $_GET['pagina'] ?? 'contatos';

if ($pagina === 'cadastrar') {
    $controller->cadastrar();
} elseif ($pagina === 'atualizar') {
    $controller->atualizar();
} elseif ($pagina === 'excluir') {
    $controller->excluir();
} elseif ($pagina === 'cadastro') {
    include __DIR__ . '/View/cadastro.php';
} elseif ($pagina === 'editar') {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null || $id <= 0) {
        header('Location: index.php?pagina=contatos&erro=' . urlencode('ID inválido.'));
        exit;
    }
    $contato = $controller->detalhes();
    if ($contato) {
        include __DIR__ . '/View/editar.php';
    }
} elseif ($pagina === 'detalhes') {
    $contato = $controller->detalhes();
    if ($contato) {
        include __DIR__ . '/View/detalhes.php';
    }
} else {
    $contatos = $controller->listar();
    include __DIR__ . '/View/contatos.php';
}