<?php

require_once __DIR__ . '/../models/Manutencao.php';

class ManutencaoController
{
    private Manutencao $model;


    // ============================================================
    // CONSTRUTOR
    // ============================================================

    public function __construct(PDO $pdo)
    {
        $this->model = new Manutencao($pdo);
    }


    // ============================================================
    // LISTAR MANUTENÇÕES POR EQUIPAMENTO
    // ============================================================

    public function listarPorEquipamento(int $equipamentoId): array
    {
        return $this->model->listarPorEquipamento(
            $equipamentoId
        );
    }


    // ============================================================
    // SALVAR MANUTENÇÃO
    // ============================================================

    public function salvar(array $dados): bool
    {
        return $this->model->inserir($dados);
    }
}