<?php

require_once "../src/session.php";

// Reinicia o questionário para voltar ao início
$_SESSION['pergunta_atual'] = 0;
$_SESSION['respostas'] = [];
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
   
<main>
        <div class="container">
        <h2>
            O estabelecimento agradece sua resposta!  
            Ela é muito importante para nós, pois nos ajuda a melhorar continuamente nossos serviços.
        </h2>

        <div class="voltar">
        <button onclick="window.location.href='../public/index.php'">
            Voltar
        </button>
        </div>
    </div>
</main>

</body>
</html>