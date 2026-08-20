<?php

require_once __DIR__ . '/../models/Relatorio.php';

class RelatorioController
{
    private Relatorio $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new Relatorio($pdo);
    }

    public function equipamentos(array $filtros = []): array
    {
        return $this->model->equipamentos($filtros);
    }

    public function calibracoes(array $filtros = []): array
    {
        return $this->model->calibracoes($filtros);
    }

    public function manutencoes(array $filtros = []): array
    {
        return $this->model->manutencoes($filtros);
    }
}