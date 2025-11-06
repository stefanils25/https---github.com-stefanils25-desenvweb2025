<?php

$arquivo = "dados.txt";


if (file_exists($arquivo)) {

    $conteudo = file_get_contents($arquivo);

    echo "<h3>Conteúdo original do arquivo:</h3>";
    echo "<pre>$conteudo</pre>";

} else {
    echo "Arquivo 'dados.txt' não encontrado!";
}
?>
