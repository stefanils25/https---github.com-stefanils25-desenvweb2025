<?php
    function salvarResposta($condb, $perguntaId, $nota, $opcional = null)
    {
        $query = "
            INSERT INTO respostas (pergunta_id, nota, resposta_opcional)
            VALUES ($1, $2, $3)
        ";

        return pg_query_params($condb, $query, [$perguntaId, $nota, $opcional]);
    }
    function buscarPerguntas($condb)
    {
        $result = pg_query($condb, "SELECT id, texto FROM perguntas ORDER BY id ASC");
        return pg_fetch_all($result);
    }
    function getPerguntaAtual($perguntas)
    {
        $indice = $_SESSION['pergunta_atual'] ?? 0;
        return $perguntas[$indice] ?? null;
    }
    function getEscalaAvaliacao()
    {
        return [
            1 => "Muito ruim",
            2 => "Ruim",
            3 => "Insatisfatório",
            4 => "Regular",
            5 => "Mediano",
            6 => "Satisfatório",
            7 => "Bom",
            8 => "Muito bom",
            9 => "Excelente",
            10 => "Excepcional"
        ];
    }

?>
