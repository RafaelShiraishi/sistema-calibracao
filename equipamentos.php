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
// SALVAR MANUTENÇÃO
// ============================================================

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['acao'] ?? '') === 'salvar_manutencao'
) {

    $equipamentoId = (int) ($_POST['equipamento_id'] ?? 0);

    if ($equipamentoId <= 0) {
        die('Equipamento inválido.');
    }

    $dadosManutencao = [

        ':equipamento_id' => $equipamentoId,

        ':usuario_id' => (int) $_SESSION['usuario']['id'],

        ':descricao' => trim(
            $_POST['descricao_manutencao'] ?? ''
        ),

        ':data_manutencao' => $_POST['data_manutencao'] ?? '',

        ':observacoes' => trim(
            $_POST['observacoes_manutencao'] ?? ''
        )

    ];

    if (
        empty($dadosManutencao[':descricao'])
        || empty($dadosManutencao[':data_manutencao'])
    ) {
        die('Descrição e data da manutenção são obrigatórias.');
    }

    $manutencaoController->salvar($dadosManutencao);

    header(
        'Location: equipamentos.php?acao=editar&id='
        . $equipamentoId
    );

    exit;
}


// ============================================================
// SALVAR / ATUALIZAR EQUIPAMENTO
// ============================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dados = [

        ':empresa' => !empty($_POST['empresa'])
            ? (int) $_POST['empresa']
            : null,

        ':fabricante' => !empty($_POST['fabricante'])
            ? (int) $_POST['fabricante']
            : null,

        ':setor' => !empty($_POST['setor'])
            ? (int) $_POST['setor']
            : null,

        ':responsavel' => !empty($_POST['responsavel'])
            ? (int) $_POST['responsavel']
            : null,

        ':status' => !empty($_POST['status'])
            ? (int) $_POST['status']
            : 1,

        ':tipo' => !empty($_POST['tipo'])
            ? (int) $_POST['tipo']
            : null,

        ':patrimonio' => trim(
            $_POST['patrimonio'] ?? ''
        ),

        ':tag' => trim(
            $_POST['tag'] ?? ''
        ),

        ':nome' => trim(
            $_POST['nome'] ?? ''
        ),

        ':modelo' => trim(
            $_POST['modelo'] ?? ''
        ),

        ':serie' => trim(
            $_POST['serie'] ?? ''
        ),

        ':faixa' => trim(
            $_POST['faixa'] ?? ''
        ),

        ':resolucao' => trim(
            $_POST['resolucao'] ?? ''
        ),

        ':localizacao' => trim(
            $_POST['localizacao'] ?? ''
        ),

        ':data' => !empty($_POST['data'])
            ? $_POST['data']
            : null,

        ':obs' => trim(
            $_POST['observacoes']
            ?? $_POST['obs']
            ?? ''
        )

    ];


    // --------------------------------------------------------
    // SE EXISTIR ID, ATUALIZA
    // --------------------------------------------------------

    if (!empty($_POST['id'])) {

        $id = (int) $_POST['id'];

        $controller->atualizar(
            $id,
            $dados
        );

        header(
            "Location: equipamentos.php?acao=editar&id="
            . $id
        );

        exit;
    }


    // --------------------------------------------------------
    // CASO CONTRÁRIO, CADASTRA NOVO
    // --------------------------------------------------------

    $controller->salvar($dados);

    header(
        "Location: equipamentos.php"
    );

    exit;
}


// ============================================================
// ROTAS
// ============================================================

switch ($acao) {


    // ========================================================
    // LISTAR
    // ========================================================

    case 'listar':

        $equipamentos = $controller->listar();

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

        $fabricantes = $controller->fabricantes();

        $setores = $controller->setores();

        $tipos = $controller->tipos();

        $usuarios = $controller->usuarios();

        $empresas = $controller->empresas();

        $status = $controller->status();

        $laboratorios = $controller->laboratorios();

        $modoEdicao = false;

        $equipamento = [];

        $ultimaCalibracao = null;

        $calibracoes = [];

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


        // ----------------------------------------------------
        // BUSCA O EQUIPAMENTO
        // ----------------------------------------------------

        $equipamento = $controller->buscar($id);


        // ----------------------------------------------------
        // VERIFICA SE EXISTE
        // ----------------------------------------------------

        if (!$equipamento) {

            http_response_code(404);

            die(
                'Equipamento não encontrado.'
            );
        }


        // ----------------------------------------------------
        // BUSCA ÚLTIMA CALIBRAÇÃO
        // ----------------------------------------------------

        $ultimaCalibracao =
            $controller->ultimaCalibracao($id);


        // ----------------------------------------------------
        // BUSCA HISTÓRICO DE CALIBRAÇÕES
        // ----------------------------------------------------

        $calibracoes =
            $controller->listarCalibracoes($id);


        // ----------------------------------------------------
        // CARREGA OS DADOS DOS SELECTS
        // ----------------------------------------------------

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


        // ----------------------------------------------------
        // CARREGA A VIEW
        // ----------------------------------------------------

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


        // ----------------------------------------------------
        // BUSCA O EQUIPAMENTO
        // ----------------------------------------------------

        $equipamento =
            $controller->buscar($id);


        if (!$equipamento) {

            http_response_code(404);

            die(
                'Equipamento não encontrado.'
            );
        }


        // ----------------------------------------------------
        // BUSCA ÚLTIMA CALIBRAÇÃO
        // ----------------------------------------------------

        $ultimaCalibracao =
            $controller->ultimaCalibracao($id);


        // ----------------------------------------------------
        // BUSCA HISTÓRICO DE CALIBRAÇÕES
        // ----------------------------------------------------

        $calibracoes =
            $controller->listarCalibracoes($id);

            $manutencoes = $manutencaoController->listarPorEquipamento($id);


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