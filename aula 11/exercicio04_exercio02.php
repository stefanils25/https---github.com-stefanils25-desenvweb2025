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

$busca = "";
if (isset($_GET['busca'])) {
    $busca = filter_var(trim($_GET['busca']), FILTER_SANITIZE_STRING);
}

if ($busca != "") {
    $sql = "SELECT * FROM tbpessoa WHERE pesnome ILIKE $1 ORDER BY pescodigo";
    $params = array('%' . $busca . '%');
    $resultado = pg_query_params($condb, $sql, $params);
} else {
    $sql = "SELECT * FROM tbpessoa ORDER BY pescodigo";
    $resultado = pg_query($condb, $sql);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Pessoas</title>
</head>
<body>
    <h2>Listagem de Pessoas</h2>

    <form method="get" action="">
        <input type="text" name="busca" placeholder="Buscar por nome" 
               value="<?php echo htmlspecialchars($busca); ?>">
        <input type="submit" value="Buscar">
        <?php if ($busca != "") echo "<a href='buscapessoa.php'>Limpar</a>"; ?>
    </form>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Email</th>
            <th>Cidade</th>
            <th>Estado</th>
        </tr>

        <?php
        if (pg_num_rows($resultado) > 0) {
            while ($linha = pg_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($linha['pescodigo']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['pesnome']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['pessobrenome']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['pesemail']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['pescidade']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['pesestado']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum registro encontrado.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
