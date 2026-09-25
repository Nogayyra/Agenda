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
        <h1>Novo Contato</h1>
        <a href="index.php?pagina=contatos" class="btn-voltar">← Voltar</a>
    </header>

    <?php if (isset($_GET['erro'])): ?>
        <div class="mensagem erro"><?= htmlspecialchars($_GET['erro']) ?></div>
    <?php endif; ?>

    <section class="formulario">
        <form method="POST" action="index.php?pagina=cadastrar">
            <div class="campo">
                <label for="nome">Nome <span class="obrigatorio">*</span></label>
                <input type="text" id="nome" name="nome" required maxlength="100" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
            </div>

            <div class="campo">
                <label for="telefone">Telefone <span class="obrigatorio">*</span></label>
                <input type="tel" id="telefone" name="telefone" required maxlength="20" placeholder="(XX) XXXXX-XXXX" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>">
            </div>

            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" maxlength="100" placeholder="exemplo@email.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="campo">
                <label for="categoria">Categoria <span class="obrigatorio">*</span></label>
                <select id="categoria" name="categoria" required>
                    <option value="pessoal" <?= (($_POST['categoria'] ?? '') === 'pessoal') ? 'selected' : '' ?>>Pessoal</option>
                    <option value="familia" <?= (($_POST['categoria'] ?? '') === 'familia') ? 'selected' : '' ?>>Família</option>
                    <option value="trabalho" <?= (($_POST['categoria'] ?? '') === 'trabalho') ? 'selected' : '' ?>>Trabalho</option>
                </select>
            </div>

            <div class="acoes-form">
                <button type="submit" class="btn-salvar">Salvar</button>
                <a href="index.php?pagina=contatos" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </section>
</div>
</body>
</html>