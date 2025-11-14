<?php

    require_once "../src/db.php";

    // busca as perguntas cadastradas no banco
    $result = pg_query($condb, "SELECT id, texto FROM perguntas ORDER BY id ASC");
    $perguntas = pg_fetch_all($result);

    if (!$perguntas) {
        die("Nenhuma pergunta cadastrada no banco de dados.");
    }


?>