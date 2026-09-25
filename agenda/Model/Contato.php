<?php

namespace Model;

use PDO;

class Contato {
    private PDO $conn;

    public function __construct() {
        $this->conn = Connection::getInstance();
    }

    public function salvar(string $nome, string $telefone, ?string $email, string $categoria): bool {
        $sql = "INSERT INTO contatos (nome, telefone, email, categoria) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nome, $telefone, $email, $categoria]);
    }

    public function listar(?string $busca = null, ?string $categoria = null): array {
        $sql = "SELECT * FROM contatos";
        $conditions = [];
        $params = [];

        if ($busca !== null && $busca !== '') {
            $conditions[] = "nome LIKE ?";
            $params[] = "%{$busca}%";
        }

        if ($categoria !== null && $categoria !== '' && $categoria !== 'todos') {
            $conditions[] = "categoria = ?";
            $params[] = $categoria;
        }

        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY nome ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): ?array {
        $sql = "SELECT * FROM contatos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function atualizar(int $id, string $nome, string $telefone, ?string $email, string $categoria): bool {
        $sql = "UPDATE contatos SET nome = ?, telefone = ?, email = ?, categoria = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nome, $telefone, $email, $categoria, $id]);
    }

    public function excluir(int $id): bool {
        $sql = "DELETE FROM contatos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}