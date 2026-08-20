<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: index.php");
    exit;

}

require_once 'config/database.php';
require_once 'app/controllers/RelatorioController.php';
require_once 'app/controllers/EquipamentoController.php';
require_once 'app/controllers/CalibracaoController.php';

$pdo = Database::conectar();

$relatorioController =
    new RelatorioController($pdo);

$equipamentoController =
    new EquipamentoController($pdo);

$calibracaoController =
    new CalibracaoController($pdo);

$tipo = $_GET['tipo'] ?? 'calibracoes';

$filtros = [

    'equipamento_id' =>
        !empty($_GET['equipamento_id'])
            ? (int) $_GET['equipamento_id']
            : null,

    'laboratorio_id' =>
        !empty($_GET['laboratorio_id'])
            ? (int) $_GET['laboratorio_id']
            : null,

    'setor_id' =>
        !empty($_GET['setor_id'])
            ? (int) $_GET['setor_id']
            : null,

    'status_id' =>
        !empty($_GET['status_id'])
            ? (int) $_GET['status_id']
            : null,

    'resultado' =>
        trim($_GET['resultado'] ?? ''),

    'situacao' =>
        trim($_GET['situacao'] ?? ''),

    'data_inicio' =>
        trim($_GET['data_inicio'] ?? ''),

    'data_fim' =>
        trim($_GET['data_fim'] ?? '')
];


$dados = [];


switch ($tipo) {

    case 'equipamentos':

        $dados =
            $relatorioController
                ->equipamentos($filtros);

        break;


    case 'manutencoes':

        $dados =
            $relatorioController
                ->manutencoes($filtros);

        break;


    case 'calibracoes_vencidas':

        $filtros['situacao'] =
            'vencida';

        $dados =
            $relatorioController
                ->calibracoes($filtros);

        break;


    case 'calibracoes_proximas':

        $filtros['situacao'] =
            'proxima';

        $dados =
            $relatorioController
                ->calibracoes($filtros);

        break;


    case 'calibracoes':

    default:

        $tipo = 'calibracoes';

        $dados =
            $relatorioController
                ->calibracoes($filtros);

        break;
}


$equipamentos =
    $equipamentoController->listar();

$laboratorios =
    $calibracaoController->laboratorios();

$setores =
    $equipamentoController->setores();

$statusEquipamentos =
    $equipamentoController->status();


include 'app/views/layouts/header.php';

include 'app/views/layouts/sidebar.php';

include 'app/views/relatorios/listar.php';

include 'app/views/layouts/footer.php';