
INSERT INTO fabricantes
    (nome, site, telefone, email, ativo)
VALUES
    ('Fabricante de Teste', NULL, NULL, NULL, 1);

INSERT INTO setores
    (nome, descricao, ativo)
VALUES
    ('Laboratório de Metrologia', 'Setor responsável pelas atividades de metrologia e calibração.', 1),
    ('Produção', 'Setor de produção da empresa.', 1),
    ('Qualidade', 'Setor responsável pela qualidade.', 1);

INSERT INTO tipos_equipamentos
    (nome, descricao, ativo)
VALUES
    ('Instrumento de Medição', 'Instrumentos utilizados para medições.', 1),
    ('Paquímetro', 'Instrumento para medição de dimensões.', 1),
    ('Micrômetro', 'Instrumento para medições de alta precisão.', 1),
    ('Balança', 'Equipamento utilizado para medição de massa.', 1);

INSERT INTO empresas
    (
        razao_social,
        nome_fantasia,
        cnpj,
        telefone,
        email,
        endereco,
        cidade,
        estado,
        ativo
    )
VALUES
    (
        'Empresa de Teste',
        'Empresa de Teste',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        1
    );

INSERT INTO status_equipamentos
    (nome, descricao, ativo)
VALUES
    ('Ativo', 'Equipamento disponível para utilização.', 1),
    ('Em Manutenção', 'Equipamento temporariamente indisponível para manutenção.', 1),
    ('Inativo', 'Equipamento não está disponível para utilização.', 1),
    ('Em Calibração', 'Equipamento enviado para processo de calibração.', 1);