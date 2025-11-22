<?php
if (session_status() === PHP_SESSION_NONE)
session_start();

// Impede acesso sem login
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../public/login.php");
    exit;
}

// Define o dispositivo ativo (TEMPORÁRIO)
// Depois você substitui isso por algo dinâmico:
if (!isset($_SESSION['dispositivo_id'])) {
    $_SESSION['dispositivo_id'] = 1; 
}

// Inicializa variáveis de sessão caso seja o primeiro acesso
if (!isset($_SESSION['pergunta_atual'])) {
    $_SESSION['pergunta_atual'] = 0;
    $_SESSION['respostas'] = [];
}
?>
