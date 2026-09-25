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
        <h1>Editar Contato</h1>
        <a href="index.php?pagina=contatos" class="btn-voltar">← Voltar</a>
    </header>

    <?php if (isset($_GET['erro'])): ?>
        <div class="mensagem erro"><?= htmlspecialchars($_GET['erro']) ?></div>
    <?php endif; ?>

    <section class="formulario">
        <form method="POST" action="index.php?pagina=atualizar">
            <input type="hidden" name="id" value="<?= htmlspecialchars($contato['id']) ?>">

            <div class="campo">
                <label for="nome">Nome <span class="obrigatorio">*</span></label>
                <input type="text" id="nome" name="nome" required maxlength="100" value="<?= htmlspecialchars($contato['nome']) ?>">
            </div>

            <div class="campo">
                <label for="telefone">Telefone <span class="obrigatorio">*</span></label>
                <input type="tel" id="telefone" name="telefone" required maxlength="20" placeholder="(XX) XXXXX-XXXX" value="<?= htmlspecialchars($contato['telefone']) ?>">
            </div>

            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" maxlength="100" placeholder="exemplo@email.com" value="<?= htmlspecialchars($contato['email'] ?? '') ?>">
            </div>

            <div class="campo">
                <label for="categoria">Categoria <span class="obrigatorio">*</span></label>
                <select id="categoria" name="categoria" required>
                    <option value="pessoal" <?= $contato['categoria'] === 'pessoal' ? 'selected' : '' ?>>Pessoal</option>
                    <option value="familia" <?= $contato['categoria'] === 'familia' ? 'selected' : '' ?>>Família</option>
                    <option value="trabalho" <?= $contato['categoria'] === 'trabalho' ? 'selected' : '' ?>>Trabalho</option>
                </select>
            </div>

            <div class="acoes-form">
                <button type="submit" class="btn-salvar">Atualizar</button>
                <a href="index.php?pagina=contatos" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </section>
</div>
</body>
</html>