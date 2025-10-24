<?php 

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $dinheiro = $_GET['a_vista'];
    $parcelas = $_GET['parcelas'];

    switch ($parcelas) {
                case 24:
                    $taxa = 1.5 / 100; // 1,5%
                    break;
                case 36:
                    $taxa = 2.0 / 100; // +0,5%
                    break;
                case 48:
                    $taxa = 2.5 / 100; // +1%
                    break;
                case 60:
                    $taxa = 3.0 / 100; // +1,5%
                    break;
                default:
                    $taxa = 0;
            }
    $montante = $dinheiro + $dinheiro * $taxa * $parcelas;
    $valorParcela = $montante / $parcelas;

    echo "O valor da moto a vista é: R$ $dinheiro.<br>";
    echo "Em parcelas de $parcelas vezes, a taxa seria de $taxa%, resultando em parcelas de: R$ " . number_format($valorParcela, 2, ',', '.') . " mensais.<br>";
    echo "<strong>O valor total da moto parcelada ficaria em: R$ " . number_format($montante, 2, ',', '.') . "!<strong/>";
    }
?>