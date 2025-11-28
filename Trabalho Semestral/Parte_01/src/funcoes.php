<?php

// Salva resposta no banco
function salvarResposta($condb, $perguntaId, $nota, $opcional = null)
{
    $query = "
        INSERT INTO respostas (pergunta_id, nota, resposta_opcional)
        VALUES ($1, $2, $3)
    ";

    $result = pg_query_params($condb, $query, [
        $perguntaId,
        $nota,
        $opcional
    ]);

    if (!$result) {
        error_log("Erro ao salvar resposta: " . pg_last_error($condb));
        return false;
    }

    return true;
}


// Busca todas as perguntas do banco
function buscarPerguntas($condb)
{
    $query = "SELECT id, texto FROM perguntas ORDER BY id ASC";
    $result = pg_query($condb, $query);

    if (!$result) {
        error_log("Erro ao buscar perguntas: " . pg_last_error($condb));
        return [];
    }

    $perguntas = pg_fetch_all($result);

    return $perguntas ?: []; // se vier false, retorna array vazio
}


// Retorna a pergunta atual com base na sessão
function getPerguntaAtual($perguntas)
{
    $indice = $_SESSION['pergunta_atual'] ?? 0;

    if (!isset($perguntas[$indice])) {
        return null;
    }

    return $perguntas[$indice];
}


// Escala de 1 a 10
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

