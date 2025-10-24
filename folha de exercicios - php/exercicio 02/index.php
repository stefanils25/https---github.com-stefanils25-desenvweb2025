<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 02</title>
</head>
<body>
    <h1>Exercício 02</h1>
    <p>Digite um número:</p>

    <form action="" method="get">

        <label for="num"></label>
        <input type="number" name="num" id="num">

        <input type="submit" value="Somar">

    </form>

    <?php
    function divisivel($num) {
        $resultado = $num / 2;

        if (is_int($resultado) && $resultado > 0) {
            echo "$num é divísivel por 2";
        } else {
        echo "$num não é divisível por 2";
        }
    }

    if (isset($_GET['num'])) {
        divisivel($_GET['num']);
    }
    ?>
</body>
</html>