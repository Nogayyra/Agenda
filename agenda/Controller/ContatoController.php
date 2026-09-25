<?php

namespace Controller;

use Model\Contato;

class ContatoController {
    private Contato $model;

    public function __construct() {
        $this->model = new Contato();
    }

    public function cadastrar(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?pagina=cadastro');
            exit;
        }

        $nome = trim((string) filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
        $telefone = trim((string) filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS));
        $email = trim((string) filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
        $categoria = (string) filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($nome)) {
            header('Location: index.php?pagina=cadastro&erro=' . urlencode('O nome é obrigatório.'));
            exit;
        }

        if (empty($telefone)) {
            header('Location: index.php?pagina=cadastro&erro=' . urlencode('O telefone é obrigatório.'));
            exit;
        }

        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?pagina=cadastro&erro=' . urlencode('E-mail inválido.'));
            exit;
        }

        $categoriasPermitidas = ['pessoal', 'familia', 'trabalho'];
        if (!in_array($categoria, $categoriasPermitidas, true)) {
            header('Location: index.php?pagina=cadastro&erro=' . urlencode('Categoria inválida.'));
            exit;
        }

        $emailSalvar = ($email !== '') ? $email : null;

        if ($this->model->salvar($nome, $telefone, $emailSalvar, $categoria)) {
            header('Location: index.php?pagina=contatos&sucesso=' . urlencode('Contato cadastrado com sucesso!'));
        } else {
            header('Location: index.php?pagina=contatos&erro=' . urlencode('Erro ao cadastrar contato.'));
        }
        exit;
    }

    public function atualizar(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?pagina=contatos');
            exit;
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $nome = trim((string) filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
        $telefone = trim((string) filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS));
        $email = trim((string) filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
        $categoria = (string) filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($id === false || $id === null || $id <= 0) {
            header('Location: index.php?pagina=contatos&erro=' . urlencode('ID inválido.'));
            exit;
        }

        if (empty($nome)) {
            header('Location: index.php?pagina=editar&id=' . $id . '&erro=' . urlencode('O nome é obrigatório.'));
            exit;
        }

        if (empty($telefone)) {
            header('Location: index.php?pagina=editar&id=' . $id . '&erro=' . urlencode('O telefone é obrigatório.'));
            exit;
        }

        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?pagina=editar&id=' . $id . '&erro=' . urlencode('E-mail inválido.'));
            exit;
        }

        $categoriasPermitidas = ['pessoal', 'familia', 'trabalho'];
        if (!in_array($categoria, $categoriasPermitidas, true)) {
            header('Location: index.php?pagina=editar&id=' . $id . '&erro=' . urlencode('Categoria inválida.'));
            exit;
        }

        $contato = $this->model->buscarPorId($id);
        if ($contato === null) {
            header('Location: index.php?pagina=contatos&erro=' . urlencode('Contato não encontrado.'));
            exit;
        }

        $emailSalvar = ($email !== '') ? $email : null;

        if ($this->model->atualizar($id, $nome, $telefone, $emailSalvar, $categoria)) {
            header('Location: index.php?pagina=contatos&sucesso=' . urlencode('Contato atualizado com sucesso!'));
        } else {
            header('Location: index.php?pagina=contatos&erro=' . urlencode('Erro ao atualizar contato.'));
        }
        exit;
    }

    public function excluir(): void {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null || $id <= 0) {
            header('Location: index.php?pagina=contatos&erro=' . urlencode('ID inválido.'));
            exit;
        }

        $contato = $this->model->buscarPorId($id);
        if ($contato === null) {
            header('Location: index.php?pagina=contatos&erro=' . urlencode('Contato não encontrado.'));
            exit;
        }

        if ($this->model->excluir($id)) {
            header('Location: index.php?pagina=contatos&sucesso=' . urlencode('Contato excluído com sucesso!'));
        } else {
            header('Location: index.php?pagina=contatos&erro=' . urlencode('Erro ao excluir contato.'));
        }
        exit;
    }

    public function listar(): array {
        $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria = filter_input(INPUT_GET, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS);

        $busca = $busca !== false && $busca !== null ? trim($busca) : null;
        $categoria = $categoria !== false && $categoria !== null ? trim($categoria) : null;

        return $this->model->listar($busca, $categoria);
    }

    public function detalhes(): ?array {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null || $id <= 0) {
            header('Location: index.php?pagina=contatos&erro=' . urlencode('ID inválido.'));
            exit;
        }

        $contato = $this->model->buscarPorId($id);

        if ($contato === null) {
            header('Location: index.php?pagina=contatos&erro=' . urlencode('Contato não encontrado.'));
            exit;
        }

        return $contato;
    }
}