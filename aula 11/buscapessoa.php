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

// Estabelece a conexão
$condb = pg_connect($connectionString);

if (!$condb) {
    die("Erro ao conectar ao Banco de Dados.");
}

$busca = "";
if (isset($_GET['busca'])) {
    $busca = trim($_GET['busca']);
}

// Define o SQL de busca
if ($busca != "") {
    $sql = "SELECT * FROM tbpessoa WHERE pesnome ILIKE '%$busca%' ORDER BY pescodigo";
} else {
    $sql = "SELECT * FROM tbpessoa ORDER BY pescodigo";
}

// ⚠️ Aqui estava o erro — use $condb (a conexão), não $connectionString
$resultado = pg_query($condb, $sql);

if (!$resultado) {
    die("Erro na consulta: " . pg_last_error($condb));
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
        <?php if ($busca != "") echo "<button><a href='buscapessoa.php'>Limpar</a></button>"; ?>
    </form>

    <table border="1" cellpadding="5">
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
                echo "<td>{$linha['pescodigo']}</td>";
                echo "<td>{$linha['pesnome']}</td>";
                echo "<td>{$linha['pessobrenome']}</td>";
                echo "<td>{$linha['pesemail']}</td>";
                echo "<td>{$linha['pescidade']}</td>";
                echo "<td>{$linha['pesestado']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum registro encontrado.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

