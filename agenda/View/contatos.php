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
        <h1>Agenda de Contatos</h1>
        <a href="index.php?pagina=cadastro" class="btn-novo">+ Novo contato</a>
    </header>

    <section class="pesquisa">
        <form method="GET" action="index.php">
            <input type="hidden" name="pagina" value="contatos">
            <input type="search" name="busca" class="campo-busca" placeholder="Pesquisar contato..." value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>">
            <button type="submit" class="btn-busca">Buscar</button>
            <a href="index.php?pagina=contatos" class="btn-limpar">Limpar</a>
        </form>
    </section>

    <section class="filtros">
        <span class="filtro-label">Filtrar por:</span>
        <a href="index.php?pagina=contatos<?= isset($_GET['busca']) ? '&busca=' . urlencode($_GET['busca']) : '' ?>" class="filtro <?= (!isset($_GET['categoria']) || $_GET['categoria'] === 'todos') ? 'ativo' : '' ?>">Todos</a>
        <a href="index.php?pagina=contatos&categoria=pessoal<?= isset($_GET['busca']) ? '&busca=' . urlencode($_GET['busca']) : '' ?>" class="filtro <?= (isset($_GET['categoria']) && $_GET['categoria'] === 'pessoal') ? 'ativo' : '' ?>">Pessoal</a>
        <a href="index.php?pagina=contatos&categoria=familia<?= isset($_GET['busca']) ? '&busca=' . urlencode($_GET['busca']) : '' ?>" class="filtro <?= (isset($_GET['categoria']) && $_GET['categoria'] === 'familia') ? 'ativo' : '' ?>">Família</a>
        <a href="index.php?pagina=contatos&categoria=trabalho<?= isset($_GET['busca']) ? '&busca=' . urlencode($_GET['busca']) : '' ?>" class="filtro <?= (isset($_GET['categoria']) && $_GET['categoria'] === 'trabalho') ? 'ativo' : '' ?>">Trabalho</a>
    </section>

    <?php if (isset($_GET['sucesso'])): ?>
        <div class="mensagem sucesso"><?= htmlspecialchars($_GET['sucesso']) ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['erro'])): ?>
        <div class="mensagem erro"><?= htmlspecialchars($_GET['erro']) ?></div>
    <?php endif; ?>

    <section class="lista-contatos">
        <?php if (empty($contatos)): ?>
            <p class="vazio">Nenhum contato encontrado.</p>
        <?php else: ?>
            <table class="tabela-contatos">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Categoria</th>
                        <th class="acoes-col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contatos as $contato): ?>
                        <tr>
                            <td><?= htmlspecialchars($contato['nome']) ?></td>
                            <td><?= htmlspecialchars($contato['telefone']) ?></td>
                            <td><?= htmlspecialchars($contato['email'] ?? '-') ?></td>
                            <td>
                                <span class="categoria-badge <?= htmlspecialchars($contato['categoria']) ?>">
                                    <?= ucfirst(str_replace('familia', 'família', $contato['categoria'])) ?>
                                </span>
                            </td>
                            <td class="contato-acoes">
                                <a href="index.php?pagina=detalhes&id=<?= $contato['id'] ?>" class="btn-acao btn-detalhes">Detalhes</a>
                                <a href="index.php?pagina=editar&id=<?= $contato['id'] ?>" class="btn-acao btn-editar">Editar</a>
                                <a href="index.php?pagina=excluir&id=<?= $contato['id'] ?>" class="btn-acao btn-excluir" onclick="return confirm('Tem certeza de que deseja excluir este contato?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</div>
</body>
</html>