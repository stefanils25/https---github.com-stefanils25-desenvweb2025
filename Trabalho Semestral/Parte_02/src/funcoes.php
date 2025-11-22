<?php

    // Funções - Perguntas

function getPerguntaAtual($perguntas){
        $indice = $_SESSION['pergunta_atual'] ?? 0;
        return $perguntas[$indice] ?? null;
    }
function listarPerguntas($condb) {
    $id_dispositivo = $_SESSION['dispositivo_id'];

    $sql = "SELECT * FROM perguntas 
            WHERE status = true 
              AND id_dispositivo = $1
            ORDER BY id_pergunta ASC";

    $stmt = pg_query_params($condb, $sql, [$id_dispositivo]);
    return pg_fetch_all($stmt);
}

function listarDispositivos($condb) {
    $sql = "
    SELECT d.*, s.nome AS setor
    FROM dispositivos d
    JOIN setores s ON s.id_setor = d.id_setor
    ORDER BY d.nome";

    $resultado = pg_query($condb, $sql);
    return $resultado ? pg_fetch_all($resultado) : [];
}

function criarPergunta($condb, $perguntas, $status, $id_dispositivo) {
    $sql = "INSERT INTO perguntas (texto_pergunta, status, id_dispositivo)
            VALUES ($1, $2, $3)";

    return pg_query_params($condb, $sql, [
        sanitizarTexto($perguntas),
        $status ? 'true' : 'false',
        (int)$id_dispositivo
    ]);
}

 function editarPergunta($condb, $perguntaId, $perguntas, $status, $id_dispositivo) {
    $sql = "
        UPDATE perguntas
        SET texto_pergunta = $1,
            status = $2,
            id_dispositivo = $3
        WHERE id_pergunta = $4
    ";

    return pg_query_params($condb, $sql, [
        sanitizarTexto($perguntas),
        $status ? 'true' : 'false',
        (int)$id_dispositivo,
        (int)$perguntaId
    ]);
}


    function excluirPergunta($condb, $perguntaId) {
        $perguntaId = (int)$perguntaId;
        $sql = "DELETE FROM perguntas WHERE id_pergunta = $1";
        $result = pg_query_params($condb, $sql, [$perguntaId]);
        return $result !== false;
    }
    
    // Sanitização
    function sanitizarTexto(string $perguntas): string {
        // Remove espaços do início e fim
        $perguntas = trim($perguntas);
        // Remove tags HTML
        $perguntas = strip_tags($perguntas);
        // Remove caracteres especiais inválidos
        $perguntas = preg_replace('/[\x00-\x1F\x7F]/u', '', $perguntas);
        // Convertendo caracteres especiais para HTML entities para evitar injeção
        $perguntas = htmlspecialchars($perguntas, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return $perguntas;
    }

    // Funções - Respostas
function salvarResposta($condb, $perguntaId, $nota, $opcional = null)
{
    $id_dispositivo = $_SESSION['dispositivo_id'];

    $query = "
        INSERT INTO avaliacoes (id_pergunta, id_dispositivo, nota, resposta_opcional)
        VALUES ($1, $2, $3, $4)
    ";

    return pg_query_params($condb, $query, [
        $perguntaId,
        $id_dispositivo,
        $nota,
        $opcional
    ]);
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
