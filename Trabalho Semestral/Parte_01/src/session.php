<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inicializa variáveis de sessão caso seja o primeiro acesso
if (!isset($_SESSION['pergunta_atual'])) {
    $_SESSION['pergunta_atual'] = 0;
    $_SESSION['respostas'] = [];
}
?>
