CREATE TABLE IF NOT EXISTS manutencoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipamento_id INT NOT NULL,
    usuario_id INT NOT NULL,
    data_manutencao DATE NOT NULL,
    data_proxima_manutencao DATE NULL,
    observacoes TEXT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_manutencao_equipamento
        FOREIGN KEY (equipamento_id)
        REFERENCES equipamentos(id),

    CONSTRAINT fk_manutencao_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
);


