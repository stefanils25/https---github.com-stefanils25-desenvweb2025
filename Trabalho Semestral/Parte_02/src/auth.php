<?php
require_once "db.php";
session_start();

$login = $_POST['login'] ?? '';
$senha = $_POST['senha'] ?? '';

$sql = "SELECT * FROM usuarios_administrativos WHERE login = $1 LIMIT 1";
$stmt = pg_query_params($condb, $sql, [$login]);
$user = pg_fetch_assoc($stmt);

if ($user && $senha === $user['senha']) {
    // Login OK
    $_SESSION['admin_id'] = $user['id_usuario'];
    $_SESSION['admin_login'] = $user['login'];

    header("Location: ../public/admin.php");
    exit;
} else {
    // Login falhou
    header("Location: ../public/login.php?erro=1");
    exit;
}
