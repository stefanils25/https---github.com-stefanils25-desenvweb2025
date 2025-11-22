<?php
require_once "../src/db.php";
require_once "../src/funcoes.php";
require_once "../src/session.php";

// Sanitização dos dados recebidos via POST
$perguntas = sanitizarTexto($_POST['texto_pergunta'] ?? '');
$setor = sanitizarTexto($_POST['nome'] ?? '');

// AÇÕES
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['acao'] === 'criar') {
        criarPergunta(
            $condb,
            $_POST['texto_pergunta'],
            isset($_POST['status']),
            $_POST['id_dispositivo']
        );
    } elseif ($_POST['acao'] === 'editar') {
        editarPergunta(
            $condb,
            $_POST['id_pergunta'],
            $_POST['texto_pergunta'],
            isset($_POST['status']),
            $_POST['id_dispositivo']
        );
    }
    header("Location: perguntas.php");
    exit;
}

if (isset($_GET['remover'])) {
    excluirPergunta($condb, $_GET['remover']);
}

// LISTAGEM
$perguntas = listarPerguntas($condb);
$dispositivos = listarDispositivos($condb);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perguntas</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="card">

        <header>
            <div class="titulo">
                <h1>Gerenciamento de Perguntas</h1>
            </div>
        </header>

        <main>
            <h2>Perguntas cadastradas:</h2>

            <table border="1" cellpadding="5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pergunta</th>
                        <th>Dispositivo</th>
                        <th>Setor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($perguntas as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['id_pergunta']) ?></td>
                        <td><?= htmlspecialchars($p['texto_pergunta']) ?></td>
                        <td><?= htmlspecialchars($p['id_dispositivo']) ?></td>
                        <td><?= htmlspecialchars($p['id_setor']) ?></td>
                        <td><?= $p['status'] === 't' ? 'Ativa' : 'Inativa' ?></td>
                        <td>
                            <!-- Formulário para editar -->
                            <form method="post" style="display:inline-block;">
                                <input type="hidden" name="acao" value="editar">
                                <input type="hidden" name="id_pergunta" value="<?= htmlspecialchars($p['id_pergunta']) ?>">

                                <input type="text" name="texto_pergunta" value="<?= htmlspecialchars($p['texto_pergunta']) ?>" required>

                                <select name="id_dispositivo" required>
                                    <?php foreach ($dispositivos as $d): ?>
                                        <option value="<?= htmlspecialchars($d['id_dispositivo']) ?>"
                                            <?= $d['id_dispositivo'] == $p['id_dispositivo'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($d['nome']) ?> (<?= htmlspecialchars($d['setor']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <label>
                                    <input type="checkbox" name="status" <?= $p['status'] === 't' ? 'checked' : '' ?>>
                                    Ativa
                                </label>

                                <button type="submit">Salvar</button>

                                <a href="perguntas.php?remover=<?= $p['id_pergunta'] ?>"
                                    onclick="return confirm('Tem certeza que deseja remover esta pergunta?')"
                                    name="excluir">
                                    Remover
                                </a>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </main>

        <section>
            <!-- Criar nova pergunta -->
            <h2>Criar nova pergunta</h2>

            <form method="post">
                <input type="hidden" name="acao" value="criar">

                <input type="text" name="texto_pergunta" required placeholder="Digite a pergunta">

                <select name="id_dispositivo" required>
                    <?php foreach ($dispositivos as $d): ?>
                        <option value="<?= htmlspecialchars($d['id_dispositivo']) ?>">
                            <?= htmlspecialchars($d['nome']) ?> (<?= htmlspecialchars($d['setor']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>
                    <input type="checkbox" name="status">
                    Ativa
                </label>

                <button type="submit">Cadastrar</button>
            </form>
        </section>
    </div>
</body>
</html>
