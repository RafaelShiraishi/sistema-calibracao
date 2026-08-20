<?php

class Manutencao
{
    private PDO $pdo;


    // ============================================================
    // CONSTRUTOR
    // ============================================================

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    // ============================================================
    // LISTAR MANUTENÇÕES POR EQUIPAMENTO
    // ============================================================

    public function listarPorEquipamento(int $equipamentoId): array
    {
        $sql = "
            SELECT
                m.*,
                u.nome AS usuario

            FROM manutencoes m

            LEFT JOIN usuarios u
                ON u.id = m.usuario_id

            WHERE m.equipamento_id = :equipamento_id

            ORDER BY
                m.data_manutencao DESC,
                m.id DESC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':equipamento_id' => $equipamentoId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // INSERIR MANUTENÇÃO
    // ============================================================

    public function inserir(array $dados): bool
    {
        $sql = "
            INSERT INTO manutencoes
            (
                equipamento_id,
                usuario_id,
                descricao,
                data_manutencao,
                observacoes
            )

            VALUES
            (
                :equipamento_id,
                :usuario_id,
                :descricao,
                :data_manutencao,
                :observacoes
            )
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':equipamento_id' =>
                $dados[':equipamento_id'],

            ':usuario_id' =>
                $dados[':usuario_id'],

            ':descricao' =>
                $dados[':descricao'],

            ':data_manutencao' =>
                $dados[':data_manutencao'],

            ':observacoes' =>
                $dados[':observacoes'] ?? null
        ]);
    }
}