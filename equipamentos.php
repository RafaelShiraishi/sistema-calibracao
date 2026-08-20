<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

require_once 'config/database.php';
require_once 'app/controllers/EquipamentoController.php';
require_once 'app/controllers/ManutencaoController.php';

$pdo = Database::conectar();

$controller = new EquipamentoController($pdo);
$manutencaoController = new ManutencaoController($pdo);

$acao = $_GET['acao'] ?? 'listar';


// ============================================================
// POST - MANUTENÇÃO
// ============================================================

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['acao'] ?? '') === 'salvar_manutencao'
) {

    $equipamentoId = (int) ($_POST['equipamento_id'] ?? 0);

    if ($equipamentoId <= 0) {

        $_SESSION['erro_equipamento'] =
            'Equipamento inválido.';

        header("Location: equipamentos.php");

        exit;
    }


    $dadosManutencao = [

        ':equipamento_id' =>
            $equipamentoId,

        ':usuario_id' =>
            (int) $_SESSION['usuario']['id'],

        ':descricao' =>
            trim(
                $_POST['descricao_manutencao'] ?? ''
            ),

        ':data_manutencao' =>
            $_POST['data_manutencao'] ?? '',

        ':observacoes' =>
            trim(
                $_POST['observacoes_manutencao'] ?? ''
            )

    ];


    if (
        empty($dadosManutencao[':descricao'])
        ||
        empty($dadosManutencao[':data_manutencao'])
    ) {

        $_SESSION['erro_equipamento'] =
            'Descrição e data da manutenção são obrigatórias.';

        header(
            'Location: equipamentos.php?acao=editar&id='
            . $equipamentoId
        );

        exit;
    }


    try {

        $manutencaoController->salvar(
            $dadosManutencao
        );

        $_SESSION['sucesso_equipamento'] =
            'Manutenção registrada com sucesso.';

    } catch (Throwable $e) {

        $_SESSION['erro_equipamento'] =
            'Não foi possível registrar a manutenção.';
    }


    header(
        'Location: equipamentos.php?acao=editar&id='
        . $equipamentoId
    );

    exit;
}


// ============================================================
// POST - ATIVAR / INATIVAR
// ============================================================

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['acao'] ?? '') === 'alternar_ativo'
) {

    $equipamentoId =
        (int) ($_POST['id'] ?? 0);

    $ativo =
        (int) ($_POST['ativo'] ?? 0);


    if ($equipamentoId <= 0) {

        $_SESSION['erro_equipamento'] =
            'Equipamento inválido.';

        header(
            'Location: equipamentos.php'
        );

        exit;
    }


    try {

        $controller->alterarAtivo(
            $equipamentoId,
            $ativo === 1
        );

        $_SESSION['sucesso_equipamento'] =
            $ativo === 1
                ? 'Equipamento ativado com sucesso.'
                : 'Equipamento inativado com sucesso.';

    } catch (Throwable $e) {

        $_SESSION['erro_equipamento'] =
            'Não foi possível alterar o status do equipamento.';
    }


    header(
        'Location: equipamentos.php'
    );

    exit;
}


// ============================================================
// POST - SALVAR / ATUALIZAR EQUIPAMENTO
// ============================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dados = [

        ':empresa' =>
            !empty($_POST['empresa'])
                ? (int) $_POST['empresa']
                : null,

        ':fabricante' =>
            !empty($_POST['fabricante'])
                ? (int) $_POST['fabricante']
                : null,

        ':setor' =>
            !empty($_POST['setor'])
                ? (int) $_POST['setor']
                : null,

        ':responsavel' =>
            !empty($_POST['responsavel'])
                ? (int) $_POST['responsavel']
                : null,

        ':status' =>
            !empty($_POST['status'])
                ? (int) $_POST['status']
                : 1,

        ':tipo' =>
            !empty($_POST['tipo'])
                ? (int) $_POST['tipo']
                : null,

        ':patrimonio' =>
            trim(
                $_POST['patrimonio'] ?? ''
            ),

        ':tag' =>
            trim(
                $_POST['tag'] ?? ''
            ),

        ':nome' =>
            trim(
                $_POST['nome'] ?? ''
            ),

        ':modelo' =>
            trim(
                $_POST['modelo'] ?? ''
            ),

        ':serie' =>
            trim(
                $_POST['serie'] ?? ''
            ),

        ':faixa' =>
            trim(
                $_POST['faixa'] ?? ''
            ),

        ':resolucao' =>
            trim(
                $_POST['resolucao'] ?? ''
            ),

        ':localizacao' =>
            trim(
                $_POST['localizacao'] ?? ''
            ),

        ':data' =>
            !empty($_POST['data'])
                ? $_POST['data']
                : null,

        ':obs' =>
            trim(
                $_POST['observacoes']
                ?? $_POST['obs']
                ?? ''
            )

    ];


    // ========================================================
    // ID ATUAL
    // ========================================================

    $idAtual =
        !empty($_POST['id'])
            ? (int) $_POST['id']
            : 0;


    // ========================================================
    // VALIDAÇÃO DE CAMPOS OBRIGATÓRIOS
    // ========================================================

    if (
        $dados[':empresa'] === null
        ||
        $dados[':fabricante'] === null
        ||
        $dados[':setor'] === null
        ||
        $dados[':responsavel'] === null
        ||
        $dados[':tipo'] === null
        ||
        $dados[':patrimonio'] === ''
        ||
        $dados[':nome'] === ''
    ) {

        $_SESSION['erro_equipamento'] =
            'Preencha todos os campos obrigatórios.';

        header(
            'Location: equipamentos.php?acao=' .
            (
                $idAtual > 0
                    ? 'editar&id=' . $idAtual
                    : 'novo'
            )
        );

        exit;
    }


    // ========================================================
    // PATRIMÔNIO DUPLICADO
    // ========================================================

    if (
        $controller->existePatrimonio(
            $dados[':patrimonio'],
            $idAtual > 0
                ? $idAtual
                : null
        )
    ) {

        $_SESSION['erro_equipamento'] =
            'Já existe um equipamento cadastrado com este patrimônio.';

        header(
            'Location: equipamentos.php?acao=' .
            (
                $idAtual > 0
                    ? 'editar&id=' . $idAtual
                    : 'novo'
            )
        );

        exit;
    }


    // ========================================================
    // TAG DUPLICADA
    // ========================================================

    if (
        $dados[':tag'] !== ''
        &&
        $controller->existeTag(
            $dados[':tag'],
            $idAtual > 0
                ? $idAtual
                : null
        )
    ) {

        $_SESSION['erro_equipamento'] =
            'Já existe um equipamento cadastrado com esta TAG.';

        header(
            'Location: equipamentos.php?acao=' .
            (
                $idAtual > 0
                    ? 'editar&id=' . $idAtual
                    : 'novo'
            )
        );

        exit;
    }


    // ========================================================
    // ATUALIZAR
    // ========================================================

    if ($idAtual > 0) {

        try {

            $controller->atualizar(
                $idAtual,
                $dados
            );

            $_SESSION['sucesso_equipamento'] =
                'Equipamento atualizado com sucesso.';

            header(
                "Location: equipamentos.php?acao=editar&id="
                . $idAtual
            );

            exit;

        } catch (Throwable $e) {

            $_SESSION['erro_equipamento'] =
                'Não foi possível atualizar o equipamento.';

            header(
                "Location: equipamentos.php?acao=editar&id="
                . $idAtual
            );

            exit;
        }
    }


    // ========================================================
    // NOVO EQUIPAMENTO
    // ========================================================

    try {

        $controller->salvar(
            $dados
        );

        $_SESSION['sucesso_equipamento'] =
            'Equipamento cadastrado com sucesso.';

        header(
            "Location: equipamentos.php"
        );

        exit;

    } catch (Throwable $e) {

        $_SESSION['erro_equipamento'] =
            'Não foi possível cadastrar o equipamento.';

        header(
            "Location: equipamentos.php?acao=novo"
        );

        exit;
    }
}


// ============================================================
// MENSAGENS
// ============================================================

$sucessoEquipamento =
    $_SESSION['sucesso_equipamento']
    ?? null;

$erroEquipamento =
    $_SESSION['erro_equipamento']
    ?? null;


unset(
    $_SESSION['sucesso_equipamento'],
    $_SESSION['erro_equipamento']
);


// ============================================================
// ROTAS
// ============================================================

switch ($acao) {


    // ========================================================
    // LISTAR
    // ========================================================

    case 'listar':

        $equipamentos =
            $controller->listar();

        include 'app/views/layouts/header.php';

        include 'app/views/layouts/sidebar.php';

        include 'app/views/equipamentos/listar.php';

        include 'app/views/layouts/footer.php';

        break;


    // ========================================================
    // NOVO EQUIPAMENTO
    // ========================================================

    case 'novo':

        $manutencoes = [];

        $fabricantes =
            $controller->fabricantes();

        $setores =
            $controller->setores();

        $tipos =
            $controller->tipos();

        $usuarios =
            $controller->usuarios();

        $empresas =
            $controller->empresas();

        $status =
            $controller->status();

        $laboratorios =
            $controller->laboratorios();

        $modoEdicao = false;

        $equipamento = [];

        $ultimaCalibracao = null;

        $calibracoes = [];

        $historico = [];


        include 'app/views/layouts/header.php';

        include 'app/views/layouts/sidebar.php';

        include 'app/views/equipamentos/form.php';

        include 'app/views/layouts/footer.php';

        break;


    // ========================================================
    // EDITAR EQUIPAMENTO
    // ========================================================

    case 'editar':

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );


        if (!$id) {

            http_response_code(400);

            die(
                'ID do equipamento inválido.'
            );
        }


        $equipamento =
            $controller->buscar($id);


        if (!$equipamento) {

            http_response_code(404);

            die(
                'Equipamento não encontrado.'
            );
        }


        $ultimaCalibracao =
            $controller->ultimaCalibracao($id);


        $calibracoes =
            $controller->listarCalibracoes($id);


        $manutencoes =
            $manutencaoController
                ->listarPorEquipamento($id);


        $historico =
            $controller->listarHistorico($id);


        $fabricantes =
            $controller->fabricantes();

        $setores =
            $controller->setores();

        $tipos =
            $controller->tipos();

        $usuarios =
            $controller->usuarios();

        $empresas =
            $controller->empresas();

        $status =
            $controller->status();

        $laboratorios =
            $controller->laboratorios();


        $modoEdicao = true;


        include 'app/views/layouts/header.php';

        include 'app/views/layouts/sidebar.php';

        include 'app/views/equipamentos/form.php';

        include 'app/views/layouts/footer.php';

        break;


    // ========================================================
    // VISUALIZAR EQUIPAMENTO
    // ========================================================

    case 'visualizar':

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );


        if (!$id) {

            http_response_code(400);

            die(
                'ID do equipamento inválido.'
            );
        }


        $equipamento =
            $controller->buscar($id);


        if (!$equipamento) {

            http_response_code(404);

            die(
                'Equipamento não encontrado.'
            );
        }


        $ultimaCalibracao =
            $controller->ultimaCalibracao($id);


        $calibracoes =
            $controller->listarCalibracoes($id);


        $manutencoes =
            $manutencaoController
                ->listarPorEquipamento($id);


        $historico =
            $controller->listarHistorico($id);


        include 'app/views/layouts/header.php';

        include 'app/views/layouts/sidebar.php';

        include 'app/views/equipamentos/visualizar.php';

        include 'app/views/layouts/footer.php';

        break;


    // ========================================================
    // PÁGINA NÃO ENCONTRADA
    // ========================================================

    default:

        http_response_code(404);

        echo '

            <div style="
                font-family: Arial, sans-serif;
                padding: 40px;
            ">

                <h2>
                    Página não encontrada
                </h2>

                <p>
                    A ação solicitada não existe.
                </p>

                <a href="equipamentos.php">
                    Voltar para equipamentos
                </a>

            </div>

        ';

        break;
}