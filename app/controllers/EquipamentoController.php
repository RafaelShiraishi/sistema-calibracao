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
    // LISTAR HISTÓRICO
    // ============================================================

    public function listarHistorico(int $equipamentoId): array
    {
        return $this->model->listarHistorico($equipamentoId);
    }


    // ============================================================
    // SALVAR EQUIPAMENTO
    // ============================================================

    public function salvar(array $dados): bool
    {
        try {
            // Pega os valores dependendo de como o array foi montado (com ou sem ':')
            $patrimonio = $dados['patrimonio'] ?? $dados[':patrimonio'] ?? null;
            $tag = $dados['tag'] ?? $dados[':tag'] ?? null;

            // 1. Validar Patrimônio Duplicado
            if (!empty($patrimonio) && $this->existePatrimonio($patrimonio)) {
                throw new Exception("O Patrimônio '{$patrimonio}' já está cadastrado em outro equipamento.");
            }

            // 2. Validar TAG Duplicada
            if (!empty($tag) && $this->existeTag($tag)) {
                throw new Exception("A TAG '{$tag}' já está cadastrada em outro equipamento.");
            }

            return $this->model->inserir($dados);

        } catch (Throwable $e) {
            $this->exibirTelaDeErro("Erro ao cadastrar equipamento", $e->getMessage(), "equipamentos.php?acao=novo");
            return false;
        }
    }


    // ============================================================
    // ATUALIZAR EQUIPAMENTO
    // ============================================================

    public function atualizar(int $id, array $dados): bool
    {
        try {
            // Pega os valores dependendo de como o array foi montado
            $patrimonio = $dados['patrimonio'] ?? $dados[':patrimonio'] ?? null;
            $tag = $dados['tag'] ?? $dados[':tag'] ?? null;

            // 1. Validar Patrimônio Duplicado (Ignorando o ID atual)
            if (!empty($patrimonio) && $this->existePatrimonio($patrimonio, $id)) {
                throw new Exception("O Patrimônio '{$patrimonio}' já pertence a outro equipamento.");
            }

            // 2. Validar TAG Duplicada (Ignorando o ID atual)
            if (!empty($tag) && $this->existeTag($tag, $id)) {
                throw new Exception("A TAG '{$tag}' já pertence a outro equipamento.");
            }

            return $this->model->atualizar($id, $dados);

        } catch (Throwable $e) {
            $this->exibirTelaDeErro("Erro ao atualizar equipamento", $e->getMessage(), "equipamentos.php");
            return false;
        }
    }


    // ============================================================
    // MELHORIA NAS MENSAGENS DE ERRO (Função Auxiliar)
    // ============================================================

    private function exibirTelaDeErro(string $titulo, string $mensagemErro, string $linkVoltar): void
    {
        die(
            '<div style="font-family: Arial, sans-serif; padding: 30px; background: #f8f9fa; max-width: 600px; margin: 50px auto; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h2 style="color: #dc3545; margin-top: 0;">⚠️ ' . htmlspecialchars($titulo) . '</h2>
                <p style="font-size: 16px; color: #333;">Não foi possível concluir a operação pelo seguinte motivo:</p>
                <div style="background: #fff; border-left: 4px solid #dc3545; padding: 15px; border-radius: 4px; font-weight: bold; color: #555; margin-bottom: 20px;">' . 
                htmlspecialchars($mensagemErro) . 
                '</div>
                <a href="' . htmlspecialchars($linkVoltar) . '" style="display: inline-block; padding: 10px 20px; background: #0d6efd; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
                    Voltar
                </a>
            </div>'
        );
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


    // ============================================================
    // VERIFICAR PATRIMÔNIO
    // ============================================================

    public function existePatrimonio(
        string $patrimonio,
        ?int $ignorarId = null
    ): bool
    {
        return $this->model->existePatrimonio(
            $patrimonio,
            $ignorarId
        );
    }


    // ============================================================
    // VERIFICAR TAG
    // ============================================================

    public function existeTag(
        string $tag,
        ?int $ignorarId = null
    ): bool
    {
        return $this->model->existeTag(
            $tag,
            $ignorarId
        );
    }


    // ============================================================
    // ATIVAR / INATIVAR
    // ============================================================

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