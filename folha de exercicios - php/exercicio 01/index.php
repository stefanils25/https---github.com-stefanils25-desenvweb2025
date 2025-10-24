<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 01</title>
</head>
<body>
    <h1>Exercício 01</h1>
    <p>Digite três números:</p>

    <form action="" method="get">

        <label for="num1"></label>
        <input type="number" name="num1" id="num1">

        <label for="num2"></label>
        <input type="number" name="num2" id="num2">

        <label for="num3"></label>
        <input type="number" name="num3" id="num3">

        <input type="submit" value="Somar">

    </form>
</body>

<?php
    function soma($num1, $num2, $num3) {
        $resultado = $num1 + $num2 + $num3;

        if ($num1 > 10) {
            $cor = "blue";
        } elseif ($num2 < $num3) {
            $cor = "green";
        } elseif ($num3 < $num1 && $num3 < $num2) {
            $cor = "red";
        } else {
            $cor = "black";
        }

        echo "<p style='color:$cor'>A soma é: $resultado</p>";
    }

    if (isset($_GET['num1'], $_GET['num2'], $_GET['num3'])) {
        soma($_GET['num1'], $_GET['num2'], $_GET['num3']);
    }
?>
</html>