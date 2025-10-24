<?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $dinheiroDisponivel = 50;

    $maca = $_GET["maca"] * $_GET["qtd_maca"];
    $melancia = $_GET["melancia"] * $_GET["qtd_melancia"];
    $laranja = $_GET["laranja"] * $_GET["qtd_laranja"];
    $repolho = $_GET["repolho"] * $_GET["qtd_repolho"];
    $cenoura = $_GET["cenoura"] * $_GET["qtd_cenoura"];
    $batatinha = $_GET["batatinha"] * $_GET["qtd_batatinha"];

    $dinheiroCompra = $maca + $melancia + $laranja + $repolho + $cenoura + $batatinha;
    $sobra = $dinheiroDisponivel - $dinheiroCompra;
    $falta = $dinheiroCompra - $dinheiroDisponivel;

    echo "O valor total da compra foi de: R$ $dinheiroCompra";

    if ($dinheiroCompra < $dinheiroDisponivel) {
        echo "<p style='color:blue'>Você ainda pode gastar R$ $sobra!</p>";
    } elseif ($dinheiroCompra > $dinheiroDisponivel) {
        echo "<p style='color:red'>Você gastou R$ $falta a mais!</p>";
    } else 
        echo "<p style='color:green'>O seu saldo para compras foi esgotado!</p>";
}
?>