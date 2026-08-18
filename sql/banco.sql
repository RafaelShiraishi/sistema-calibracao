-- =====================================================
-- SISTEMA DE GESTÃO DE CALIBRAÇÃO
-- Colormaq - Araçatuba
-- Banco de Dados MySQL 8
-- =====================================================

DROP DATABASE IF EXISTS sistema_calibracao;
CREATE DATABASE sistema_calibracao
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE sistema_calibracao;

-- =====================================================
-- TABELA: PERFIS
-- =====================================================

CREATE TABLE perfis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE,
    descricao VARCHAR(255),
    ativo BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

-- =====================================================
-- TABELA: EMPRESAS
-- =====================================================

CREATE TABLE empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    razao_social VARCHAR(150) NOT NULL,
    nome_fantasia VARCHAR(150),
    cnpj VARCHAR(18) UNIQUE,
    telefone VARCHAR(20),
    email VARCHAR(150),
    endereco VARCHAR(255),
    cidade VARCHAR(100),
    estado CHAR(2),
    ativo BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

-- =====================================================
-- TABELA: FABRICANTES
-- =====================================================

CREATE TABLE fabricantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    site VARCHAR(200),
    telefone VARCHAR(20),
    email VARCHAR(150),
    ativo BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

-- =====================================================
-- TABELA: SETORES
-- =====================================================

CREATE TABLE setores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(255),
    ativo BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

-- =====================================================
-- TABELA: STATUS DOS EQUIPAMENTOS
-- =====================================================

CREATE TABLE status_equipamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE,
    descricao VARCHAR(255),
    ativo BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

-- =====================================================
-- TABELA: TIPOS DE EQUIPAMENTOS
-- =====================================================

CREATE TABLE tipos_equipamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    descricao VARCHAR(255),
    ativo BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

-- =====================================================
-- TABELA: STATUS DAS CALIBRAÇÕES
-- =====================================================

CREATE TABLE status_calibracao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE,
    descricao VARCHAR(255),
    ativo BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

-- =====================================================
-- TABELA: LABORATÓRIOS
-- =====================================================

CREATE TABLE laboratorios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    cnpj VARCHAR(18),
    contato VARCHAR(100),
    telefone VARCHAR(20),
    email VARCHAR(150),
    cidade VARCHAR(100),
    estado CHAR(2),
    ativo BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

-- ===========================================
-- TABELA: USUARIOS
-- ===========================================

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,

    perfil_id INT NOT NULL,

    nome VARCHAR(150) NOT NULL,

    email VARCHAR(150) NOT NULL UNIQUE,

    senha VARCHAR(255) NOT NULL,

    telefone VARCHAR(20),

    ativo BOOLEAN DEFAULT TRUE,

    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_usuario_perfil
        FOREIGN KEY (perfil_id)
        REFERENCES perfis(id)
);

-- ===========================================
-- TABELA: EQUIPAMENTOS
-- ===========================================

CREATE TABLE equipamentos (

    id INT AUTO_INCREMENT PRIMARY KEY,

    empresa_id INT NOT NULL,
    fabricante_id INT NOT NULL,
    setor_id INT NOT NULL,
    responsavel_id INT NOT NULL,
    status_id INT NOT NULL,
    tipo_id INT NOT NULL,

    patrimonio VARCHAR(50) NOT NULL UNIQUE,

    tag VARCHAR(50) UNIQUE,

    nome VARCHAR(150) NOT NULL,

    descricao TEXT,

    modelo VARCHAR(100),

    numero_serie VARCHAR(100),

    faixa_medicao VARCHAR(100),

    resolucao VARCHAR(100),

    localizacao VARCHAR(150),

    data_aquisicao DATE,

    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    data_ultima_calibracao DATE,

    data_proxima_calibracao DATE,

    observacoes TEXT,

    ativo BOOLEAN DEFAULT TRUE,

    CONSTRAINT fk_equip_empresa
        FOREIGN KEY (empresa_id)
        REFERENCES empresas(id),

    CONSTRAINT fk_equip_fabricante
        FOREIGN KEY (fabricante_id)
        REFERENCES fabricantes(id),

    CONSTRAINT fk_equip_setor
        FOREIGN KEY (setor_id)
        REFERENCES setores(id),

    CONSTRAINT fk_equip_usuario
        FOREIGN KEY (responsavel_id)
        REFERENCES usuarios(id),

    CONSTRAINT fk_equip_status
        FOREIGN KEY (status_id)
        REFERENCES status_equipamentos(id),

    CONSTRAINT fk_equip_tipo
        FOREIGN KEY (tipo_id)
        REFERENCES tipos_equipamentos(id)

);

-- ===========================================
-- TABELA: CALIBRACOES
-- ===========================================

CREATE TABLE calibracoes (

    id INT AUTO_INCREMENT PRIMARY KEY,

    equipamento_id INT NOT NULL,

    laboratorio_id INT NOT NULL,

    usuario_id INT NOT NULL,

    status_id INT NOT NULL,

    data_calibracao DATE NOT NULL,

    data_validade DATE NOT NULL,

    numero_certificado VARCHAR(100) NOT NULL,

    resultado ENUM(
        'Aprovado',
        'Aprovado com Restrição',
        'Reprovado'
    ) NOT NULL,

    incerteza VARCHAR(100),

    observacoes TEXT,

    certificado_pdf VARCHAR(255),

    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_calibracao_equipamento
        FOREIGN KEY (equipamento_id)
        REFERENCES equipamentos(id),

    CONSTRAINT fk_calibracao_laboratorio
        FOREIGN KEY (laboratorio_id)
        REFERENCES laboratorios(id),

    CONSTRAINT fk_calibracao_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id),

    CONSTRAINT fk_calibracao_status
        FOREIGN KEY (status_id)
        REFERENCES status_calibracao(id)

);

-- ===========================================
-- TABELA: MANUTENCOES
-- ===========================================

CREATE TABLE manutencoes (

    id INT AUTO_INCREMENT PRIMARY KEY,

    equipamento_id INT NOT NULL,

    usuario_id INT NOT NULL,

    descricao TEXT NOT NULL,

    data_manutencao DATE NOT NULL,

    observacoes TEXT,

    CONSTRAINT fk_manutencao_equipamento
        FOREIGN KEY (equipamento_id)
        REFERENCES equipamentos(id),

    CONSTRAINT fk_manutencao_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)

);

-- ===========================================
-- TABELA: HISTORICO_EQUIPAMENTOS
-- ===========================================

CREATE TABLE historico_equipamentos (

    id INT AUTO_INCREMENT PRIMARY KEY,

    equipamento_id INT NOT NULL,

    usuario_id INT NOT NULL,

    acao VARCHAR(100) NOT NULL,

    descricao TEXT,

    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_historico_equipamento
        FOREIGN KEY (equipamento_id)
        REFERENCES equipamentos(id),

    CONSTRAINT fk_historico_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)

);

