<?php

require_once __DIR__ . '/../models/Calibracao.php';

class CalibracaoController
{
    private Calibracao $model;


    public function __construct(PDO $pdo)
    {
        $this->model = new Calibracao($pdo);
    }

    public function listar(): array
    {
        return $this->model->listar();
    }

    public function buscar(int $id): ?array
    {
        return $this->model->buscarPorId($id);
    }

    public function salvar(array $dados): bool
    {
        return $this->model->inserir($dados);
    }

    public function atualizar(int $id, array $dados): bool
    {
        return $this->model->atualizar($id, $dados);
    }

    public function equipamentos(): array
    {
        return $this->model->listarEquipamentos();
    }

    public function laboratorios(): array
    {
        return $this->model->listarLaboratorios();
    }

    public function usuarios(): array
    {
        return $this->model->listarUsuarios();
    }

    public function status(): array
    {
        return $this->model->listarStatus();
    }
}