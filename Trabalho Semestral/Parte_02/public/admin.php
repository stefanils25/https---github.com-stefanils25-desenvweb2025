<?php
session_start();

// Impede acesso sem login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Dashboard Administrativo</h1>

<p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['admin_login']); ?>!</p>

<nav>
    <a href="../public/login.php">Sair</a>
</nav>

<h2>Avaliações</h2>

<p>Aqui você verá o painel com:</p>
<ul>
    <li>Notas por setor</li>
    <li>Média por pergunta</li>
    <li><a href="../src/perguntas.php">Gerenciamento de Perguntas</a></li>
</ul>

</body>
</html>
