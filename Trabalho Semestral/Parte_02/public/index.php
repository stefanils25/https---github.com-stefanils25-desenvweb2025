<?php
require_once "../src/funcoes.php";
require_once "../src/db.php";
require_once "../src/session.php";

$perguntas = listarPerguntas($condb);

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
    <header class="titulo" id="titulo">
        <h1>Avaliação de Desempenho</h1>
    </header>

    <main>
        <div class="pergunta" id="pergunta">
            <!-- Exibe número e texto da pergunta atual -->
            <h2>Pergunta <?php echo $_SESSION['pergunta_atual'] + 1; ?> de <?php echo count($perguntas); ?></h2>
            <p><?php echo htmlspecialchars($perguntaAtual['texto_pergunta']); ?></p>
        </div>

        <div class="resposta" id="resposta">
            <!-- Formulário de envio da nota -->
            <form method="post" action="responder.php">
                <input type="hidden" name="pergunta_id" value="<?php echo $perguntaAtual['id_pergunta']; ?>">

                <label>Selecione sua avaliação:</label>
                <div class="escala">
                    <?php foreach ($escala as $valor => $descricao): ?>
                        <label>
                            <input type="radio" name="nota" value="<?php echo $valor; ?>" required>
                            <?php echo $valor; ?><br><small><?php echo htmlspecialchars($descricao); ?></small>
                        </label>
                    <?php endforeach; ?>
                </div>

                <br>
                <div class="resposta_opcional">
                    <label for="opcional">Compartilhe livremente qualquer sugestão ou comentário que possa nos ajudar a evoluir.</label>
                    <input type="text" name="opcional" id="opcional">
                </div>
                <button type="submit">Próxima</button>
            </form>
        </div>    
    </main>

    <footer class="rodape" id="rodape">
        <p>Sua avaliação é anônima — nenhuma informação pessoal é solicitada ou armazenada.</p>
    </footer>

    <script src="../public/js/script.js"></script>
</body>
</html>
