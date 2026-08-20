<?php

class Equipamento
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
    // LISTAR EQUIPAMENTOS
    // ============================================================

    public function listar(): array
    {
        $sql = "
            SELECT
                e.*,

                s.nome AS setor,
                st.nome AS status,
                f.nome AS fabricante,
                u.nome AS responsavel,
                t.nome AS tipo,
                emp.razao_social AS empresa

            FROM equipamentos e

            LEFT JOIN setores s
                ON s.id = e.setor_id

            LEFT JOIN status_equipamentos st
                ON st.id = e.status_id

            LEFT JOIN fabricantes f
                ON f.id = e.fabricante_id

            LEFT JOIN usuarios u
                ON u.id = e.responsavel_id

            LEFT JOIN tipos_equipamentos t
                ON t.id = e.tipo_id

            LEFT JOIN empresas emp
                ON emp.id = e.empresa_id

            ORDER BY e.nome
        ";

        return $this->pdo
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // BUSCAR EQUIPAMENTO POR ID
    // ============================================================

    public function buscarPorId(int $id): ?array
    {
        $sql = "
            SELECT
                e.*,

                s.nome AS setor,
                st.nome AS status,
                f.nome AS fabricante,
                u.nome AS responsavel,
                t.nome AS tipo,
                emp.razao_social AS empresa

            FROM equipamentos e

            LEFT JOIN setores s
                ON s.id = e.setor_id

            LEFT JOIN status_equipamentos st
                ON st.id = e.status_id

            LEFT JOIN fabricantes f
                ON f.id = e.fabricante_id

            LEFT JOIN usuarios u
                ON u.id = e.responsavel_id

            LEFT JOIN tipos_equipamentos t
                ON t.id = e.tipo_id

            LEFT JOIN empresas emp
                ON emp.id = e.empresa_id

            WHERE e.id = :id

            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':id',
            $id,
            PDO::PARAM_INT
        );

        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }


    // ============================================================
    // BUSCAR ÚLTIMA CALIBRAÇÃO
    // ============================================================

    public function buscarUltimaCalibracao(
        int $equipamentoId
    ): ?array
    {
        $sql = "
            SELECT
                c.*,

                l.nome AS laboratorio,

                u.nome AS usuario,

                sc.nome AS status_calibracao

            FROM calibracoes c

            LEFT JOIN laboratorios l
                ON l.id = c.laboratorio_id

            LEFT JOIN usuarios u
                ON u.id = c.usuario_id

            LEFT JOIN status_calibracao sc
                ON sc.id = c.status_id

            WHERE c.equipamento_id = :equipamento_id

            ORDER BY
                c.data_calibracao DESC,
                c.id DESC

            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':equipamento_id' => $equipamentoId
        ]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }


    // ============================================================
    // LISTAR CALIBRAÇÕES DO EQUIPAMENTO
    // ============================================================

    public function listarCalibracoes(
        int $equipamentoId
    ): array
    {
        $sql = "
            SELECT
                c.*,

                l.nome AS laboratorio,

                u.nome AS usuario,

                sc.nome AS status_calibracao

            FROM calibracoes c

            LEFT JOIN laboratorios l
                ON l.id = c.laboratorio_id

            LEFT JOIN usuarios u
                ON u.id = c.usuario_id

            LEFT JOIN status_calibracao sc
                ON sc.id = c.status_id

            WHERE c.equipamento_id = :equipamento_id

            ORDER BY
                c.data_calibracao DESC,
                c.id DESC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':equipamento_id' => $equipamentoId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // LISTAR HISTÓRICO DO EQUIPAMENTO
    // ============================================================

    public function listarHistorico(
        int $equipamentoId
    ): array
    {
        $sql = "
            SELECT
                c.data_calibracao AS data_evento,
                'Calibração' AS tipo_evento,
                c.numero_certificado AS descricao,
                c.observacoes,
                u.nome AS usuario

            FROM calibracoes c

            LEFT JOIN usuarios u
                ON u.id = c.usuario_id

            WHERE c.equipamento_id = :equipamento_calibracao

            UNION ALL

            SELECT
                m.data_manutencao AS data_evento,
                'Manutenção' AS tipo_evento,
                m.descricao AS descricao,
                m.observacoes,
                u.nome AS usuario

            FROM manutencoes m

            LEFT JOIN usuarios u
                ON u.id = m.usuario_id

            WHERE m.equipamento_id = :equipamento_manutencao

            ORDER BY
                data_evento DESC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':equipamento_calibracao' =>
                $equipamentoId,

            ':equipamento_manutencao' =>
                $equipamentoId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // INSERIR EQUIPAMENTO
    // ============================================================

    public function inserir(array $dados): bool
    {
        $sql = "
            INSERT INTO equipamentos
            (
                empresa_id,
                fabricante_id,
                setor_id,
                responsavel_id,
                status_id,
                tipo_id,
                patrimonio,
                tag,
                nome,
                modelo,
                numero_serie,
                faixa_medicao,
                resolucao,
                localizacao,
                data_aquisicao,
                observacoes,
                ativo
            )

            VALUES
            (
                :empresa,
                :fabricante,
                :setor,
                :responsavel,
                :status,
                :tipo,
                :patrimonio,
                :tag,
                :nome,
                :modelo,
                :serie,
                :faixa,
                :resolucao,
                :localizacao,
                :data,
                :obs,
                1
            )
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($dados);
    }


    // ============================================================
    // ATUALIZAR EQUIPAMENTO
    // ============================================================

    public function atualizar(
        int $id,
        array $dados
    ): bool
    {
        $sql = "
            UPDATE equipamentos
            SET
                empresa_id = :empresa,
                fabricante_id = :fabricante,
                setor_id = :setor,
                responsavel_id = :responsavel,
                status_id = :status,
                tipo_id = :tipo,
                patrimonio = :patrimonio,
                tag = :tag,
                nome = :nome,
                modelo = :modelo,
                numero_serie = :serie,
                faixa_medicao = :faixa,
                resolucao = :resolucao,
                localizacao = :localizacao,
                data_aquisicao = :data,
                observacoes = :obs

            WHERE id = :id
        ";

        $dados[':id'] = $id;

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($dados);
    }


    // ============================================================
    // LISTAR FABRICANTES
    // ============================================================

    public function listarFabricantes(): array
    {
        return $this->pdo
            ->query("
                SELECT
                    id,
                    nome
                FROM fabricantes
                WHERE ativo = 1
                ORDER BY nome
            ")
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // LISTAR SETORES
    // ============================================================

    public function listarSetores(): array
    {
        return $this->pdo
            ->query("
                SELECT
                    id,
                    nome
                FROM setores
                WHERE ativo = 1
                ORDER BY nome
            ")
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // LISTAR TIPOS DE EQUIPAMENTO
    // ============================================================

    public function listarTipos(): array
    {
        return $this->pdo
            ->query("
                SELECT
                    id,
                    nome
                FROM tipos_equipamentos
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
    // LISTAR EMPRESAS
    // ============================================================

    public function listarEmpresas(): array
    {
        return $this->pdo
            ->query("
                SELECT
                    id,
                    razao_social
                FROM empresas
                WHERE ativo = 1
                ORDER BY razao_social
            ")
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // LISTAR STATUS DOS EQUIPAMENTOS
    // ============================================================

    public function listarStatus(): array
    {
        return $this->pdo
            ->query("
                SELECT
                    id,
                    nome
                FROM status_equipamentos
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
    // VERIFICAR PATRIMÔNIO DUPLICADO
    // ============================================================

    public function existePatrimonio(
        string $patrimonio,
        ?int $ignorarId = null
    ): bool
    {
        $sql = "
            SELECT id
            FROM equipamentos
            WHERE LOWER(TRIM(patrimonio))
                = LOWER(TRIM(:patrimonio))
        ";

        if ($ignorarId !== null) {

            $sql .= "
                AND id <> :id
            ";
        }

        $sql .= "
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);

        $params = [
            ':patrimonio' => $patrimonio
        ];

        if ($ignorarId !== null) {

            $params[':id'] = $ignorarId;
        }

        $stmt->execute($params);

        return (bool) $stmt->fetchColumn();
    }


    // ============================================================
    // VERIFICAR TAG DUPLICADA
    // ============================================================

    public function existeTag(
        string $tag,
        ?int $ignorarId = null
    ): bool
    {
        if (trim($tag) === '') {

            return false;
        }

        $sql = "
            SELECT id
            FROM equipamentos
            WHERE LOWER(TRIM(tag))
                = LOWER(TRIM(:tag))
        ";

        if ($ignorarId !== null) {

            $sql .= "
                AND id <> :id
            ";
        }

        $sql .= "
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);

        $params = [
            ':tag' => $tag
        ];

        if ($ignorarId !== null) {

            $params[':id'] = $ignorarId;
        }

        $stmt->execute($params);

        return (bool) $stmt->fetchColumn();
    }


    // ============================================================
    // ATIVAR / INATIVAR EQUIPAMENTO
    // ============================================================

    public function alterarAtivo(
        int $id,
        bool $ativo
    ): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE equipamentos
            SET ativo = :ativo
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id,
            ':ativo' => $ativo ? 1 : 0
        ]);
    }
}