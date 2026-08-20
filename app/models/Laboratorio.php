<?php

class Laboratorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    // ============================================================
    // LISTAR
    // ============================================================

    public function listar(): array
    {
        $sql = "
            SELECT
                id,
                nome,
                cnpj,
                contato,
                telefone,
                email,
                cidade,
                estado,
                ativo
            FROM laboratorios
            ORDER BY nome
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
                id,
                nome,
                cnpj,
                contato,
                telefone,
                email,
                cidade,
                estado,
                ativo
            FROM laboratorios
            WHERE id = :id
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }


    // ============================================================
    // VERIFICAR NOME DUPLICADO
    // ============================================================

    public function existeNome(
        string $nome,
        ?int $ignorarId = null
    ): bool
    {
        $sql = "
            SELECT id
            FROM laboratorios
            WHERE LOWER(TRIM(nome)) = LOWER(TRIM(:nome))
        ";

        if ($ignorarId !== null) {
            $sql .= " AND id <> :id";
        }

        $sql .= " LIMIT 1";

        $stmt = $this->pdo->prepare($sql);

        $params = [
            ':nome' => $nome
        ];

        if ($ignorarId !== null) {
            $params[':id'] = $ignorarId;
        }

        $stmt->execute($params);

        return (bool) $stmt->fetchColumn();
    }


    // ============================================================
    // INSERIR
    // ============================================================

    public function inserir(array $dados): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO laboratorios
            (
                nome,
                cnpj,
                contato,
                telefone,
                email,
                cidade,
                estado,
                ativo
            )
            VALUES
            (
                :nome,
                :cnpj,
                :contato,
                :telefone,
                :email,
                :cidade,
                :estado,
                1
            )
        ");

        return $stmt->execute([
            ':nome' => $dados[':nome'],
            ':cnpj' => $dados[':cnpj'],
            ':contato' => $dados[':contato'],
            ':telefone' => $dados[':telefone'],
            ':email' => $dados[':email'],
            ':cidade' => $dados[':cidade'],
            ':estado' => $dados[':estado']
        ]);
    }


    // ============================================================
    // ATUALIZAR
    // ============================================================

    public function atualizar(
        int $id,
        array $dados
    ): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE laboratorios
            SET
                nome = :nome,
                cnpj = :cnpj,
                contato = :contato,
                telefone = :telefone,
                email = :email,
                cidade = :cidade,
                estado = :estado
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id,
            ':nome' => $dados[':nome'],
            ':cnpj' => $dados[':cnpj'],
            ':contato' => $dados[':contato'],
            ':telefone' => $dados[':telefone'],
            ':email' => $dados[':email'],
            ':cidade' => $dados[':cidade'],
            ':estado' => $dados[':estado']
        ]);
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
            UPDATE laboratorios
            SET ativo = :ativo
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id,
            ':ativo' => $ativo ? 1 : 0
        ]);
    }
}