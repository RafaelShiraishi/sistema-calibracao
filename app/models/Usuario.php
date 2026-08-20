<?php

class Usuario
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    // ============================================================
    // BUSCAR POR E-MAIL
    // ============================================================

    public function buscarPorEmail(string $email): ?array
    {
        $sql = "
            SELECT
                u.*,
                p.nome AS perfil,
                p.descricao AS perfil_descricao
            FROM usuarios u
            INNER JOIN perfis p
                ON p.id = u.perfil_id
            WHERE u.email = :email
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }


    // ============================================================
    // LISTAR USUÁRIOS
    // ============================================================

    public function listar(): array
    {
        $sql = "
            SELECT
                u.id,
                u.perfil_id,
                u.nome,
                u.email,
                u.telefone,
                u.ativo,
                u.data_cadastro,
                p.nome AS perfil,
                p.descricao AS perfil_descricao
            FROM usuarios u
            INNER JOIN perfis p
                ON p.id = u.perfil_id
            ORDER BY u.nome
        ";

        return $this->pdo
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // BUSCAR POR ID
    // ============================================================

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT
                u.id,
                u.perfil_id,
                u.nome,
                u.email,
                u.telefone,
                u.ativo,
                u.data_cadastro,
                p.nome AS perfil,
                p.descricao AS perfil_descricao
            FROM usuarios u
            INNER JOIN perfis p
                ON p.id = u.perfil_id
            WHERE u.id = :id
            LIMIT 1
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }


    // ============================================================
    // LISTAR PERFIS
    // ============================================================

    public function listarPerfis(): array
    {
        return $this->pdo
            ->query("
                SELECT
                    id,
                    nome,
                    descricao
                FROM perfis
                WHERE ativo = 1
                ORDER BY nome
            ")
            ->fetchAll(PDO::FETCH_ASSOC);
    }


    // ============================================================
    // VERIFICAR E-MAIL DUPLICADO
    // ============================================================

    public function existeEmail(
        string $email,
        ?int $ignorarId = null
    ): bool
    {
        $sql = "
            SELECT id
            FROM usuarios
            WHERE LOWER(TRIM(email)) = LOWER(TRIM(:email))
        ";

        if ($ignorarId !== null) {
            $sql .= " AND id <> :id";
        }

        $sql .= " LIMIT 1";

        $stmt = $this->pdo->prepare($sql);

        $params = [
            ':email' => $email
        ];

        if ($ignorarId !== null) {
            $params[':id'] = $ignorarId;
        }

        $stmt->execute($params);

        return (bool) $stmt->fetchColumn();
    }


    // ============================================================
    // INSERIR USUÁRIO
    // ============================================================

    public function inserir(array $dados): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO usuarios
            (
                perfil_id,
                nome,
                email,
                senha,
                telefone,
                ativo
            )
            VALUES
            (
                :perfil_id,
                :nome,
                :email,
                :senha,
                :telefone,
                1
            )
        ");

        return $stmt->execute([
            ':perfil_id' => $dados[':perfil_id'],
            ':nome' => $dados[':nome'],
            ':email' => $dados[':email'],
            ':senha' => $dados[':senha'],
            ':telefone' => $dados[':telefone']
        ]);
    }


    // ============================================================
    // ATUALIZAR USUÁRIO
    // ============================================================

    public function atualizar(
        int $id,
        array $dados
    ): bool
    {
        $sql = "
            UPDATE usuarios
            SET
                perfil_id = :perfil_id,
                nome = :nome,
                email = :email,
                telefone = :telefone
        ";

        $params = [
            ':id' => $id,
            ':perfil_id' => $dados[':perfil_id'],
            ':nome' => $dados[':nome'],
            ':email' => $dados[':email'],
            ':telefone' => $dados[':telefone']
        ];

        if (
            isset($dados[':senha']) &&
            $dados[':senha'] !== ''
        ) {
            $sql .= ",
                senha = :senha
            ";

            $params[':senha'] = $dados[':senha'];
        }

        $sql .= "
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($params);
    }


    // ============================================================
    // ATIVAR / INATIVAR
    // ============================================================

    public function alterarAtivo(
        int $id,
        bool $ativo
    ): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE usuarios
            SET ativo = :ativo
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id,
            ':ativo' => $ativo ? 1 : 0
        ]);
    }
}