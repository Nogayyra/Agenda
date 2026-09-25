# Agenda de Contatos

Sistema web simples para gerenciamento de contatos pessoais em PHP.

## Funcionalidades

- Cadastrar contato (nome, telefone, e-mail, categoria)
- Listar contatos com pesquisa por nome
- Filtrar por categoria (Pessoal, Família, Trabalho)
- Editar contato
- Ver detalhes
- Excluir com confirmação
- Validações no backend

## Categorias

- `pessoal` → Pessoal
- `familia` → Família
- `trabalho` → Trabalho

## Banco
CREATE DATABASE IF NOT EXISTS `agenda_contatos` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `agenda_contatos`;

CREATE TABLE IF NOT EXISTS `contatos` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `telefone` VARCHAR(20) NOT NULL,
    `email` VARCHAR(100) DEFAULT NULL,
    `categoria` ENUM('pessoal', 'familia', 'trabalho') NOT NULL DEFAULT 'pessoal',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;