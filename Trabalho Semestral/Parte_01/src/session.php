<?php

// Inicia sessão com configurações mais seguras
if (session_status() === PHP_SESSION_NONE) {

    session_set_cookie_params([
        'lifetime' => 0,            // expira ao fechar navegador
        'path'     => '/',
        'secure'   => isset($_SERVER['HTTPS']), // evita warning
        'httponly' => true,         // JS não pode acessar cookies
        'samesite' => 'Lax'         // protege contra CSRF básico
    ]);

    session_start();
}

// Inicializa variáveis apenas se ainda não existirem
if (!isset($_SESSION['pergunta_atual'])) {
    $_SESSION['pergunta_atual'] = 0;
}

if (!isset($_SESSION['respostas']) || !is_array($_SESSION['respostas'])) {
    $_SESSION['respostas'] = [];
}

?>
