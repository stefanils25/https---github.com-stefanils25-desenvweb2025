<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 04</title>
</head>
<body>
    <h1>Exercício 04</h1>

    <form action="" method="get">

        <label for="base">Base:</label>
        <input type="number" name="base" id="base" >

        <label for="altura">Altura:</label>
        <input type="number" name="altura" id="altura">

        <input type="submit" value="Calcular área">

    </form>

    <?php
    function area($base, $altura) {
        $area = $base * $altura;
        $mensagem = "A área do retângulo é: $area metros quadrados. <br> Com base de $base metros e altura de $altura metros.";
        if ($area > 10) {
            echo "<h1>$mensagem</h1>";
        } elseif ($area < 0) {
            echo "O número precisa ser maior que 0!";
        }
    }

    if (isset($_GET['base'], $_GET['altura'])) {
        area($_GET['base'], $_GET['altura']);
    }
    ?>
</body>
</html>