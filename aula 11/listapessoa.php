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

$sql = "SELECT * FROM tbpessoa ORDER BY pescodigo";
$result = pg_query($condb, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pessoas</title>
</head>
<body>
    <h2>Lista de Pessoas Cadastradas</h2>

    <?php
    if (pg_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Email</th>
                <th>Cidade</th>
                <th>Estado</th>
              </tr>";

        while ($linha = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$linha['pescodigo']}</td>";
            echo "<td>{$linha['pesnome']}</td>";
            echo "<td>{$linha['pessobrenome']}</td>";
            echo "<td>{$linha['pesemail']}</td>";
            echo "<td>{$linha['pescidade']}</td>";
            echo "<td>{$linha['pesestado']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Nenhuma pessoa cadastrada.</p>";
    }

    pg_close($condb);
    ?>
</body>
</html>
