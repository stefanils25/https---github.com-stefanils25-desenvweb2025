CREATE TABLE setores (
    id_setor SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

INSERT INTO setores (nome)
VALUES 
 ('Produção'),
 ('Manutenção'),
 ('Qualidade'),
 ('TI'),
 ('Logística');

CREATE TABLE dispositivos (
    id_dispositivo SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    status BOOLEAN NOT NULL,
    id_setor INTEGER NOT NULL,
    CONSTRAINT fk_setor FOREIGN KEY (id_setor) REFERENCES setores(id_setor)
);

INSERT INTO dispositivos (nome, status, id_setor)
VALUES
 ('Compressor Principal', true, 1),
 ('Esteira Transportadora 02', true, 1),
 ('Sistema de Refrigeração', true, 2),
 ('Servidor Local 01', true, 4),
 ('Empilhadeira 07', true, 5);

CREATE TABLE perguntas (
    id_pergunta SERIAL PRIMARY KEY,
    texto_pergunta TEXT NOT NULL,
    status BOOLEAN NOT NULL,
    id_dispositivo INTEGER NOT NULL,
    CONSTRAINT fk_dispositivo_pergunta FOREIGN KEY (id_dispositivo) REFERENCES dispositivos(id_dispositivo)
);

INSERT INTO perguntas (texto_pergunta, status, id_dispositivo)
VALUES
 ('O compressor está funcionando dentro dos níveis normais de pressão?', true, 1),
 ('Houve ruídos anormais no compressor hoje?', true, 1),

 ('A esteira apresentou falhas durante o turno?', true, 2),
 ('Os sensores da esteira estão operando corretamente?', true, 2),

 ('A temperatura do sistema de refrigeração está estável?', true, 3),
 ('Existe acúmulo de gelo acima do esperado?', true, 3),

 ('O servidor está respondendo dentro do tempo esperado?', true, 4),
 ('Houve quedas de conexão hoje?', true, 4),

 ('A empilhadeira apresentou falhas mecânicas?', true, 5),
 ('A bateria da empilhadeira completou o ciclo corretamente?', true, 5);

CREATE TABLE avaliacoes (
    id_avaliacao SERIAL PRIMARY KEY,
    id_pergunta INTEGER NOT NULL,
    id_dispositivo INTEGER NOT NULL,
    nota INT CHECK (nota BETWEEN 0 AND 10) NOT NULL,
    resposta_opcional TEXT,
    data_hora TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_pergunta FOREIGN KEY (id_pergunta) REFERENCES perguntas(id_pergunta) ON DELETE CASCADE,
    CONSTRAINT fk_dispositivo FOREIGN KEY (id_dispositivo) REFERENCES dispositivos(id_dispositivo)
);

INSERT INTO avaliacoes 
(id_pergunta, id_dispositivo, nota, resposta_opcional, data_hora)
VALUES 
 (1, 1, 8, 'Funcionando normalmente', NOW()),
 (2, 1, 4, 'Ruído incomum detectado', NOW()),
 (3, 2, 9, NULL, NOW()),
 (4, 2, 10, NULL, NOW());

CREATE TABLE usuarios_administrativos (
    id_usuario SERIAL PRIMARY KEY,
    login VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(20) NOT NULL
);

INSERT INTO usuarios_administrativos (login, senha)
VALUES
 ('admin', '123456'),
 ('supervisor', 'admin123'),
 ('ti_master', 'passwd321');
