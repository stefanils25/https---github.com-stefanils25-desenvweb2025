<?php
define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_USER', 'postgres');
define('DB_PASS', 'postgres');
define('DB_NAME', 'local');

$connectionString = "host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS;
$condb = pg_connect($connectionString);

if (!$condb) {
    die("Erro ao conectar ao Banco de Dados.");
}

$nome       = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
$sobrenome  = filter_var($_POST['sobrenome'], FILTER_SANITIZE_STRING);
$email      = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$senha      = filter_var($_POST['senha'], FILTER_SANITIZE_STRING);
$cidade     = filter_var($_POST['cidade'], FILTER_SANITIZE_STRING);
$estado     = filter_var($_POST['estado'], FILTER_SANITIZE_STRING);

if (!$email) {
    die("E-mail inválido!");
}

$sql = "INSERT INTO tbpessoa (pesnome, pessobrenome, pesemail, pespassword, pescidade, pesestado)
        VALUES ($1, $2, $3, $4, $5, $6)";

$result = pg_query_params($condb, $sql, array($nome, $sobrenome, $email, $senha, $cidade, $estado));

if ($result) {
    echo "Pessoa cadastrada com sucesso!";
} else {
    echo "Erro ao cadastrar pessoa: " . pg_last_error($condb);
}

pg_close($condb);
?>
