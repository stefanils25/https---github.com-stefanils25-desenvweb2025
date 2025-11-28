<?php
require_once "../src/db.php";
require_once "../src/session.php";
require_once "../src/funcoes.php";

// Busca todas as perguntas do banco
$perguntas = buscarPerguntas($condb);

// Caso o usuário já tenha respondido todas, redireciona
if ($_SESSION['pergunta_atual'] >= count($perguntas)) {
    header("Location: agradecimento.php");
    exit;
}

// Obtém a pergunta atual
$perguntaAtual = getPerguntaAtual($perguntas);
$escala = getEscalaAvaliacao();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Avaliação</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>

<?php include "components/header.php"; ?>

<main>

    <!-- Barra de Progresso -->
    <div class="progresso-container">
        <?php include "components/progresso.php"; ?>
    </div>

    <!-- Pergunta -->
    <div class="pergunta">
        <h2>Pergunta <?php echo $_SESSION['pergunta_atual'] + 1; ?> de <?php echo count($perguntas); ?></h2>
        <p><?php echo htmlspecialchars($perguntaAtual['texto']); ?></p>
    </div>

    <!-- Formulário -->
    <div class="resposta">
        <form method="post" action="responder.php">
            <input type="hidden" name="pergunta_id" value="<?php echo $perguntaAtual['id']; ?>">

            <!-- Escala -->
            <?php include "components/escala.php"; ?>

            <!-- Resposta opcional só na última pergunta -->
            <?php if ($_SESSION['pergunta_atual'] == count($perguntas) - 1): ?>
                <?php include "components/resposta_opcional.php"; ?>
            <?php endif; ?>

            <button type="submit">Próxima</button>
        </form>
    </div>

</main>

<?php include "components/footer.php"; ?>

<script src="../public/js/script.js"></script>
</body>
</html>
