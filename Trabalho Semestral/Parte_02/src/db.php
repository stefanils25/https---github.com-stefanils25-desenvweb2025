<?php

require_once "../config.php";

$connectionString = "host={$host} port={$port} dbname={$dbname} user={$user} password={$pass}";

$condb = pg_connect($connectionString);

if (!$condb) {
    die("Erro ao conectar ao Banco de Dados.");
}
?>