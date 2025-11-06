<?php

$arquivo = "pessoas.json";

$pessoa = array(
    "nome"       => $_POST['nome'],
    "sobrenome"  => $_POST['sobrenome'],
    "email"      => $_POST['email'],
    "senha"      => $_POST['senha'],
    "cidade"     => $_POST['cidade'],
    "estado"     => $_POST['estado']
);

if (file_exists($arquivo)) {
    $jsonAtual = file_get_contents($arquivo);
    $dados = json_decode($jsonAtual, true);
} else {
    $dados = array();
}

$dados[] = $pessoa;

$jsonFinal = json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

file_put_contents($arquivo, $jsonFinal);

echo "<h3>Dados gravados com sucesso!</h3>";
echo "<pre>$jsonFinal</pre>";
?>
