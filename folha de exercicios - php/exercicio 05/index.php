<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 05</title>
</head>
<body>
    <h1>Exercício 05</h1>

    <form action="" method="get">

        <label for="base">Base:</label>
        <input type="number" name="base" id="base">

        <label for="altura">Altura:</label>
        <input type="number" name="altura" id="altura">

        <input type="submit" value="Calcular área">

    </form>

    <?php
    function area($base, $altura) {
        $area = ($base * $altura) / 2 ;

        echo "A área do triângulo retângulo é: $area metros quadrados. <br> Com base de $base metros e altura de $altura metros.";
    }

    if (isset($_GET['base'], $_GET['altura'])) {
        area($_GET['base'], $_GET['altura']);
    }
    ?>
</body>
</html>