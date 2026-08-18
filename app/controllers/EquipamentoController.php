<?php

require_once __DIR__ . '/../models/Equipamento.php';

class EquipamentoController
{
    private Equipamento $model;


    // ============================================================
    // CONSTRUTOR
    // ============================================================

    public function __construct(PDO $pdo)
    {
        $this->model = new Equipamento($pdo);
    }


    // ============================================================
    // LISTAR EQUIPAMENTOS
    // ============================================================

    public function listar(): array
    {
        return $this->model->listar();
    }


    // ============================================================
    // BUSCAR EQUIPAMENTO POR ID
    // ============================================================

    public function buscar(int $id): ?array
    {
        return $this->model->buscarPorId($id);
    }


    // ============================================================
    // BUSCAR ÚLTIMA CALIBRAÇÃO
    // ============================================================

    public function ultimaCalibracao(int $equipamentoId): ?array
    {
        return $this->model->buscarUltimaCalibracao($equipamentoId);
    }


    // ============================================================
    // LISTAR CALIBRAÇÕES
    // ============================================================

    public function listarCalibracoes(int $equipamentoId): array
    {
        return $this->model->listarCalibracoes($equipamentoId);
    }


    // ============================================================
    // SALVAR EQUIPAMENTO
    // ============================================================

    public function salvar(array $dados): bool
    {
        try {

            return $this->model->inserir($dados);

        } catch (Throwable $e) {

            die(
                '<div style="
                    font-family: Arial, sans-serif;
                    padding: 30px;
                    background: #f8f9fa;
                ">

                    <h2 style="color: #dc3545;">
                        Erro ao salvar equipamento
                    </h2>

                    <p>
                        Ocorreu um erro ao tentar cadastrar o equipamento.
                    </p>

                    <pre style="
                        background: #fff;
                        border: 1px solid #ddd;
                        padding: 15px;
                        border-radius: 5px;
                        white-space: pre-wrap;
                    ">' .
                    htmlspecialchars($e->getMessage()) .
                    '</pre>

                    <a
                        href="equipamentos.php?acao=novo"
                        style="
                            display: inline-block;
                            margin-top: 15px;
                            padding: 10px 15px;
                            background: #0d6efd;
                            color: white;
                            text-decoration: none;
                            border-radius: 5px;
                        "
                    >
                        Voltar para o cadastro
                    </a>

                </div>'
            );
        }
    }


    // ============================================================
    // ATUALIZAR EQUIPAMENTO
    // ============================================================

    public function atualizar(int $id, array $dados): bool
    {
        try {

            return $this->model->atualizar($id, $dados);

        } catch (Throwable $e) {

            die(
                '<div style="
                    font-family: Arial, sans-serif;
                    padding: 30px;
                    background: #f8f9fa;
                ">

                    <h2 style="color: #dc3545;">
                        Erro ao atualizar equipamento
                    </h2>

                    <p>
                        Ocorreu um erro ao tentar atualizar o equipamento.
                    </p>

                    <pre style="
                        background: #fff;
                        border: 1px solid #ddd;
                        padding: 15px;
                        border-radius: 5px;
                        white-space: pre-wrap;
                    ">' .
                    htmlspecialchars($e->getMessage()) .
                    '</pre>

                    <a
                        href="equipamentos.php"
                        style="
                            display: inline-block;
                            margin-top: 15px;
                            padding: 10px 15px;
                            background: #0d6efd;
                            color: white;
                            text-decoration: none;
                            border-radius: 5px;
                        "
                    >
                        Voltar para equipamentos
                    </a>

                </div>'
            );
        }
    }


    // ============================================================
    // LISTAR FABRICANTES
    // ============================================================

    public function fabricantes(): array
    {
        return $this->model->listarFabricantes();
    }


    // ============================================================
    // LISTAR SETORES
    // ============================================================

    public function setores(): array
    {
        return $this->model->listarSetores();
    }


    // ============================================================
    // LISTAR TIPOS DE EQUIPAMENTO
    // ============================================================

    public function tipos(): array
    {
        return $this->model->listarTipos();
    }


    // ============================================================
    // LISTAR USUÁRIOS
    // ============================================================

    public function usuarios(): array
    {
        return $this->model->listarUsuarios();
    }


    // ============================================================
    // LISTAR EMPRESAS
    // ============================================================

    public function empresas(): array
    {
        return $this->model->listarEmpresas();
    }


    // ============================================================
    // LISTAR STATUS
    // ============================================================

    public function status(): array
    {
        return $this->model->listarStatus();
    }


    // ============================================================
    // LISTAR LABORATÓRIOS
    // ============================================================

    public function laboratorios(): array
    {
        return $this->model->listarLaboratorios();
    }
}