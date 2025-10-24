<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 03</title>
</head>
<body>
    <h1>Exercício 03</h1>
    <p>Digite um número:</p>

    <form action="" method="get">

        <label for="num"></label>
        <input type="number" name="num" id="num" step="0.01">

        <input type="submit" value="Calcular">

    </form>

    <?php
    function area($num) {
        $resultado = $num * $num;

        if ($num> 0) {
            echo "A área do quadrado de lado $num metros é $resultado metros quadrados";
        } else {
            echo "O número precisa ser maior que 0!";
        }
    }

    if (isset($_GET['num'])) {
        area($_GET['num']);
    }
    ?>
</body>
</html>