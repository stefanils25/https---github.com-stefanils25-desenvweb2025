<?php
define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_USER', 'postgres');
define('DB_PASS', 'postgres');
define('DB_NAME', 'local');

$connectionString = "host=".DB_HOST.
                    " port=".DB_PORT.
                    " dbname=".DB_NAME.
                    " user=".DB_USER.
                    " password=".DB_PASS;

$condb = pg_connect($connectionString);

if (!$condb) {
    die("Erro ao conectar ao Banco de Dados.");
}

// Recebe os dados do formulário
$dados = array(
    $_POST['nome'],
    $_POST['sobrenome'],
    $_POST['email'],
    $_POST['senha'],
    $_POST['cidade'],
    $_POST['estado']
);

// Insere os dados no banco
$sql = "INSERT INTO tbpessoa (pesnome, pessobrenome, pesemail, pespassword, pescidade, pesestado)
        VALUES ($1, $2, $3, $4, $5, $6)";

$result = pg_query_params($condb, $sql, $dados);

if ($result) {
    echo "Pessoa cadastrada com sucesso!<br>";
    echo "<a href='listapessoa.php'>Ver lista de pessoas</a>";
} else {
    echo "Erro ao inserir: " . pg_last_error($condb);
}

pg_close($condb);
?>
