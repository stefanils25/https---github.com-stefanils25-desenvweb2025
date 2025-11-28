<?php
require_once "../src/session.php";
require_once "../src/db.php";
require_once "../src/funcoes.php";

// Apenas aceita POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$nota       = $_POST['nota'] ?? null;
$perguntaId = $_POST['pergunta_id'] ?? null;
$opcional   = $_POST['opcional'] ?? null;

// Validações básicas
if ($nota === null || $perguntaId === null) {
    header("Location: index.php");
    exit;
}

if (!is_numeric($nota) || $nota < 0 || $nota > 10) {
    header("Location: index.php?erro=nota_invalida");
    exit;
}

// Garante array de respostas
if (!isset($_SESSION['respostas'])) {
    $_SESSION['respostas'] = [];
}

// Busca as perguntas uma única vez
$perguntas = buscarPerguntas($condb);
$totalPerguntas = count($perguntas);

// Evita pergunta inválida
$idsValidos = array_column($perguntas, 'id');

if (!in_array($perguntaId, $idsValidos)) {
    header("Location: index.php?erro=id_invalido");
    exit;
}

// Salva a resposta no banco
salvarResposta($condb, $perguntaId, $nota, $opcional);

// Armazena na sessão
$_SESSION['respostas'][$perguntaId] = [
    'nota' => $nota,
    'opcional' => $opcional
];

// Avança pergunta
$_SESSION['pergunta_atual']++;

// Redireciona
if ($_SESSION['pergunta_atual'] >= $totalPerguntas) {
    header("Location: agradecimento.php");
    exit;
}

header("Location: index.php");
exit;
