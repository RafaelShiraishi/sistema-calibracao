<?php

class Calibracao
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
    // LISTAR CALIBRAÇÕES
    // ============================================================

    public function listar(): array
    {
        $sql = "
            SELECT
                c.*,

                e.nome AS equipamento,
                e.patrimonio,
                e.tag,

                l.nome AS laboratorio,

                u.nome AS usuario,

                sc.nome AS status

            FROM calibracoes c

            INNER JOIN equipamentos e
                ON e.id = c.equipamento_id

            INNER JOIN laboratorios l
                ON l.id = c.laboratorio_id

            INNER JOIN usuarios u
                ON u.id = c.usuario_id

            INNER JOIN status_calibracao sc
                ON sc.id = c.status_id

            ORDER BY
                c.data_calibracao DESC,
                c.id DESC
        ";

        return $this->pdo
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // BUSCAR CALIBRAÇÃO POR ID
    // ============================================================

    public function buscarPorId(int $id): ?array
    {
        $sql = "
            SELECT
                c.*,

                e.nome AS equipamento,
                e.patrimonio,
                e.tag,

                l.nome AS laboratorio,

                u.nome AS usuario,

                sc.nome AS status

            FROM calibracoes c

            INNER JOIN equipamentos e
                ON e.id = c.equipamento_id

            INNER JOIN laboratorios l
                ON l.id = c.laboratorio_id

            INNER JOIN usuarios u
                ON u.id = c.usuario_id

            INNER JOIN status_calibracao sc
                ON sc.id = c.status_id

            WHERE c.id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }


    // ============================================================
    // INSERIR CALIBRAÇÃO
    // ============================================================

    public function inserir(array $dados): bool
    {
        try {

            $this->pdo->beginTransaction();


            // ----------------------------------------------------
            // INSERE A CALIBRAÇÃO
            // ----------------------------------------------------

            $sql = "
                INSERT INTO calibracoes
                (
                    equipamento_id,
                    laboratorio_id,
                    usuario_id,
                    status_id,
                    data_calibracao,
                    data_validade,
                    numero_certificado,
                    resultado,
                    incerteza,
                    observacoes,
                    certificado_pdf
                )

                VALUES
                (
                    :equipamento_id,
                    :laboratorio_id,
                    :usuario_id,
                    :status_id,
                    :data_calibracao,
                    :data_validade,
                    :numero_certificado,
                    :resultado,
                    :incerteza,
                    :observacoes,
                    :certificado_pdf
                )
            ";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute($dados);


            // ----------------------------------------------------
            // ATUALIZA O EQUIPAMENTO
            // ----------------------------------------------------

            $sqlEquipamento = "
                UPDATE equipamentos
                SET
                    data_ultima_calibracao = :data_ultima,
                    data_proxima_calibracao = :data_proxima

                WHERE id = :equipamento_id
            ";

            $stmtEquipamento =
                $this->pdo->prepare($sqlEquipamento);

            $stmtEquipamento->execute([
                ':data_ultima' =>
                    $dados[':data_calibracao'],

                ':data_proxima' =>
                    $dados[':data_validade'],

                ':equipamento_id' =>
                    $dados[':equipamento_id']
            ]);


            $this->pdo->commit();

            return true;

        } catch (Throwable $e) {

            if ($this->pdo->inTransaction()) {

                $this->pdo->rollBack();
            }

            throw $e;
        }
    }


    // ============================================================
    // ATUALIZAR CALIBRAÇÃO
    // ============================================================

    public function atualizar(
        int $id,
        array $dados
    ): bool
    {
        try {

            $this->pdo->beginTransaction();


            // ----------------------------------------------------
            // ATUALIZA A CALIBRAÇÃO
            // ----------------------------------------------------

            $sql = "
                UPDATE calibracoes

                SET
                    equipamento_id = :equipamento_id,
                    laboratorio_id = :laboratorio_id,
                    usuario_id = :usuario_id,
                    status_id = :status_id,
                    data_calibracao = :data_calibracao,
                    data_validade = :data_validade,
                    numero_certificado = :numero_certificado,
                    resultado = :resultado,
                    incerteza = :incerteza,
                    observacoes = :observacoes,
                    certificado_pdf = :certificado_pdf

                WHERE id = :id
            ";

            $dados[':id'] = $id;

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute($dados);


            // ----------------------------------------------------
            // ATUALIZA O EQUIPAMENTO
            // ----------------------------------------------------

            $sqlEquipamento = "
                UPDATE equipamentos

                SET
                    data_ultima_calibracao = :data_ultima,
                    data_proxima_calibracao = :data_proxima

                WHERE id = :equipamento_id
            ";

            $stmtEquipamento =
                $this->pdo->prepare($sqlEquipamento);

            $stmtEquipamento->execute([
                ':data_ultima' =>
                    $dados[':data_calibracao'],

                ':data_proxima' =>
                    $dados[':data_validade'],

                ':equipamento_id' =>
                    $dados[':equipamento_id']
            ]);


            $this->pdo->commit();

            return true;

        } catch (Throwable $e) {

            if ($this->pdo->inTransaction()) {

                $this->pdo->rollBack();
            }

            throw $e;
        }
    }


    // ============================================================
    // LISTAR EQUIPAMENTOS
    // ============================================================

    public function listarEquipamentos(): array
    {
        return $this->pdo
            ->query("
                SELECT
                    id,
                    patrimonio,
                    tag,
                    nome

                FROM equipamentos

                WHERE ativo = 1

                ORDER BY nome
            ")
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // LISTAR LABORATÓRIOS
    // ============================================================

    public function listarLaboratorios(): array
    {
        return $this->pdo
            ->query("
                SELECT
                    id,
                    nome

                FROM laboratorios

                WHERE ativo = 1

                ORDER BY nome
            ")
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // LISTAR USUÁRIOS
    // ============================================================

    public function listarUsuarios(): array
    {
        return $this->pdo
            ->query("
                SELECT
                    id,
                    nome

                FROM usuarios

                WHERE ativo = 1

                ORDER BY nome
            ")
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // LISTAR STATUS DE CALIBRAÇÃO
    // ============================================================

    public function listarStatus(): array
    {
        return $this->pdo
            ->query("
                SELECT
                    id,
                    nome

                FROM status_calibracao

                WHERE ativo = 1

                ORDER BY id
            ")
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}