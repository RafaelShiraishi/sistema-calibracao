<?php

require_once __DIR__ . '/../models/Laboratorio.php';

class LaboratorioController
{
    private Laboratorio $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new Laboratorio($pdo);
    }

    public function listar(): array
    {
        return $this->model->listar();
    }

    public function buscar(int $id): ?array
    {
        return $this->model->buscarPorId($id);
    }

    public function existeNome(
        string $nome,
        ?int $ignorarId = null
    ): bool
    {
        return $this->model->existeNome(
            $nome,
            $ignorarId
        );
    }

    public function salvar(array $dados): bool
    {
        return $this->model->inserir($dados);
    }

    public function atualizar(
        int $id,
        array $dados
    ): bool
    {
        return $this->model->atualizar(
            $id,
            $dados
        );
    }

    public function alterarAtivo(
        int $id,
        bool $ativo
    ): bool
    {
        return $this->model->alterarAtivo(
            $id,
            $ativo
        );
    }
} 