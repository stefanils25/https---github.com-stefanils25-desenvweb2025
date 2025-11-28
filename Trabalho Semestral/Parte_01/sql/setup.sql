CREATE TABLE perguntas (
    id SERIAL PRIMARY KEY,
    texto VARCHAR(300) NOT NULL,
    ativo BOOLEAN DEFAULT TRUE
);

INSERT INTO perguntas (texto) VALUES
('Como você avalia o atendimento dos funcionários?'),
('O tempo de espera para ser atendido foi satisfatório?'),
('Os ambientes do estabelecimento estavam limpos e organizados?'),
('A sinalização e orientação dentro do local foram claras?'),
('Os produtos ou serviços oferecidos atenderam às suas expectativas?'),
('Como você avalia a cordialidade e simpatia da equipe?'),
('Os preços praticados estão de acordo com a qualidade oferecida?'),
('O ambiente físico (estrutura, iluminação, conforto) foi agradável?'),
('Você se sentiu bem atendido de forma geral?'),
('Qual é a sua satisfação geral com o estabelecimento?');

CREATE TABLE respostas (
    id SERIAL PRIMARY KEY,
    pergunta_id INT REFERENCES perguntas(id) ON DELETE CASCADE,
    nota INT CHECK (nota BETWEEN 0 AND 10),
    resposta_opcional TEXT,
    data_resposta TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);