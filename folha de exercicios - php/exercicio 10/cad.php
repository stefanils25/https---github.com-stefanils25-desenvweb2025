<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 10</title>
</head>
<body>
    <h1>Exercício 10</h1>

    <?php

    $pastas = array(
        "bsn" => array(
            "3a Fase" => array("desenvWeb", "bancoDados 1", "engSoft 1"),
            "4a Fase" => array("Intro Web", "bancoDados 2", "engSoft 2")
        )
    );
    function exibirArvore($estrutura, $nivel = 0) {
        foreach ($estrutura as $chave => $valor) {
            echo str_repeat("-", $nivel * 2) . " ";

            if (is_array($valor)) {
                echo $chave . "<br>";
                exibirArvore($valor, $nivel + 1);
            } else {
                echo $valor . "<br>";
            }
        }
    }

    exibirArvore($pastas);
    ?>
</body>
</html>
