<?php

require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController
{
    private Usuario $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new Usuario($pdo);
    }


    public function listar(): array
    {
        return $this->model->listar();
    }


    public function buscar(int $id): ?array
    {
        return $this->model->buscarPorId($id);
    }


    public function perfis(): array
    {
        return $this->model->listarPerfis();
    }


    public function existeEmail(
        string $email,
        ?int $ignorarId = null
    ): bool
    {
        return $this->model->existeEmail(
            $email,
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