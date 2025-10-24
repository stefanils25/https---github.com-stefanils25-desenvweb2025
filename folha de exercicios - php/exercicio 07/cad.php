<?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "<h3>Resumo do Financiamento:</h3>";

    $valorAVista = $_GET['a_vista'];
    $valorParcela = $_GET['parcelado'];
    $parcelas = $_GET['parcelas'];

    $valorTotalPago = $valorParcela * $parcelas;
    $juros = $valorTotalPago - $valorAVista;

    echo "Valor à vista: R$ $valorAVista<br>";
    echo "Valor total pago no financiamento: R$ $valorTotalPago<br>";
    echo "O juros total foi de: R$ $juros";
}    
?>