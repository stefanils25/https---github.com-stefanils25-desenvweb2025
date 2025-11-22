<?php
session_start();

// Se já estiver logado, manda para o admin
if (isset($_SESSION['admin_id'])) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Painel Administrativo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Painel Administrativo</h2>

<form action="../src/auth.php" method="post">
    <label>Login:</label>
    <input type="text" name="login" required>

    <label>Senha:</label>
    <input type="password" name="senha" required>

    <button type="submit">Entrar</button>
</form>

</body>
</html>
