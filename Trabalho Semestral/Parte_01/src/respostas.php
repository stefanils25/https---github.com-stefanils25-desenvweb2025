<?php

    require_once "../src/session.php";
    require_once "../src/db.php";
    require_once "../src/funcoes.php";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nota = $_POST['nota'] ?? null;
    $perguntaId = $_POST['pergunta_id'] ?? null;
    $opcional = $_POST['opcional'] ?? null;

    if ($nota !== null && $perguntaId !== null) {

        // Salva no banco, agora incluindo o texto opcional
        salvarResposta($condb, $perguntaId, $nota, $opcional);

        // Guarda na sessão
        $_SESSION['respostas'][$perguntaId] = [
            'nota' => $nota,
            'opcional' => $opcional
        ];

        // Avança para a próxima pergunta
        $_SESSION['pergunta_atual']++;
    }

    // Redireciona para a próxima tela
    $totalPerguntas = count(buscarPerguntas($condb));

    if ($_SESSION['pergunta_atual'] >= $totalPerguntas) {
        header("Location: agradecimento.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}

