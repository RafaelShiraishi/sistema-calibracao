<?php

class Relatorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    // ============================================================
    // EQUIPAMENTOS
    // ============================================================

    public function equipamentos(array $filtros = []): array
    {
        $sql = "
            SELECT
                e.id,
                e.nome,
                e.patrimonio,
                e.tag,
                e.modelo,
                e.numero_serie,
                e.localizacao,
                e.ativo,
                s.nome AS setor,
                st.nome AS status,
                f.nome AS fabricante,
                t.nome AS tipo,
                emp.razao_social AS empresa
            FROM equipamentos e
            LEFT JOIN setores s
                ON s.id = e.setor_id
            LEFT JOIN status_equipamentos st
                ON st.id = e.status_id
            LEFT JOIN fabricantes f
                ON f.id = e.fabricante_id
            LEFT JOIN tipos_equipamentos t
                ON t.id = e.tipo_id
            LEFT JOIN empresas emp
                ON emp.id = e.empresa_id
            WHERE 1 = 1
        ";

        $params = [];

        if (!empty($filtros['setor_id'])) {

            $sql .= "
                AND e.setor_id = :setor_id
            ";

            $params[':setor_id'] =
                (int) $filtros['setor_id'];
        }

        if (!empty($filtros['status_id'])) {

            $sql .= "
                AND e.status_id = :status_id
            ";

            $params[':status_id'] =
                (int) $filtros['status_id'];
        }

        $sql .= "
            ORDER BY e.nome
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // CALIBRAÇÕES
    // ============================================================

    public function calibracoes(array $filtros = []): array
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
            WHERE 1 = 1
        ";

        $params = [];

        if (!empty($filtros['equipamento_id'])) {

            $sql .= "
                AND c.equipamento_id = :equipamento_id
            ";

            $params[':equipamento_id'] =
                (int) $filtros['equipamento_id'];
        }

        if (!empty($filtros['laboratorio_id'])) {

            $sql .= "
                AND c.laboratorio_id = :laboratorio_id
            ";

            $params[':laboratorio_id'] =
                (int) $filtros['laboratorio_id'];
        }

        if (!empty($filtros['data_inicio'])) {

            $sql .= "
                AND c.data_calibracao >= :data_inicio
            ";

            $params[':data_inicio'] =
                $filtros['data_inicio'];
        }

        if (!empty($filtros['data_fim'])) {

            $sql .= "
                AND c.data_calibracao <= :data_fim
            ";

            $params[':data_fim'] =
                $filtros['data_fim'];
        }

        if (!empty($filtros['resultado'])) {

            $sql .= "
                AND c.resultado = :resultado
            ";

            $params[':resultado'] =
                $filtros['resultado'];
        }

        if (!empty($filtros['situacao'])) {

            if ($filtros['situacao'] === 'vencida') {

                $sql .= "
                    AND c.data_validade < CURDATE()
                ";

            } elseif (
                $filtros['situacao'] === 'proxima'
            ) {

                $sql .= "
                    AND c.data_validade >= CURDATE()
                    AND c.data_validade <= DATE_ADD(
                        CURDATE(),
                        INTERVAL 30 DAY
                    )
                ";
            }
        }

        $sql .= "
            ORDER BY
                c.data_calibracao DESC,
                c.id DESC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // MANUTENÇÕES
    // ============================================================

    public function manutencoes(array $filtros = []): array
    {
        $sql = "
            SELECT
                m.*,
                e.nome AS equipamento,
                e.patrimonio,
                e.tag,
                u.nome AS usuario
            FROM manutencoes m
            INNER JOIN equipamentos e
                ON e.id = m.equipamento_id
            INNER JOIN usuarios u
                ON u.id = m.usuario_id
            WHERE 1 = 1
        ";

        $params = [];

        if (!empty($filtros['equipamento_id'])) {

            $sql .= "
                AND m.equipamento_id = :equipamento_id
            ";

            $params[':equipamento_id'] =
                (int) $filtros['equipamento_id'];
        }

        if (!empty($filtros['data_inicio'])) {

            $sql .= "
                AND m.data_manutencao >= :data_inicio
            ";

            $params[':data_inicio'] =
                $filtros['data_inicio'];
        }

        if (!empty($filtros['data_fim'])) {

            $sql .= "
                AND m.data_manutencao <= :data_fim
            ";

            $params[':data_fim'] =
                $filtros['data_fim'];
        }

        $sql .= "
            ORDER BY
                m.data_manutencao DESC,
                m.id DESC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}