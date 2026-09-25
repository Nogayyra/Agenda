<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agenda de Contatos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="agenda">
    <header class="cabecalho">
        <h1>Detalhes do Contato</h1>
        <a href="index.php?pagina=contatos" class="btn-voltar">← Voltar</a>
    </header>

    <section class="detalhes-contato">
        <div class="detalhe-item">
            <span class="detalhe-label">Nome</span>
            <span class="detalhe-valor"><?= htmlspecialchars($contato['nome']) ?></span>
        </div>

        <div class="detalhe-item">
            <span class="detalhe-label">Telefone</span>
            <span class="detalhe-valor"><?= htmlspecialchars($contato['telefone']) ?></span>
        </div>

        <div class="detalhe-item">
            <span class="detalhe-label">E-mail</span>
            <span class="detalhe-valor"><?= htmlspecialchars($contato['email'] ?? 'Não informado') ?></span>
        </div>

        <div class="detalhe-item">
            <span class="detalhe-label">Categoria</span>
            <span class="detalhe-valor">
                <span class="categoria-badge <?= htmlspecialchars($contato['categoria']) ?>">
                    <?= ucfirst(str_replace('familia', 'família', $contato['categoria'])) ?>
                </span>
            </span>
        </div>
    </section>

    <div class="acoes-detalhes">
        <a href="index.php?pagina=editar&id=<?= $contato['id'] ?>" class="btn-acao btn-editar">Editar</a>
        <a href="index.php?pagina=excluir&id=<?= $contato['id'] ?>" class="btn-acao btn-excluir" onclick="return confirm('Tem certeza de que deseja excluir este contato?')">Excluir</a>
    </div>
</div>
</body>
</html>