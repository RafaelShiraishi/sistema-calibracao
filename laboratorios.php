<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: index.php");
    exit;

}

require_once 'config/database.php';
require_once 'app/controllers/LaboratorioController.php';

$pdo = Database::conectar();

$controller = new LaboratorioController($pdo);

$acao = $_GET['acao'] ?? 'listar';


// ============================================================
// POST
// ============================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $acaoPost = $_POST['acao'] ?? 'salvar';


    // ========================================================
    // SALVAR / EDITAR
    // ========================================================

    if (
        $acaoPost === 'salvar'
        || $acaoPost === 'editar'
    ) {

        $id = !empty($_POST['id'])
            ? (int) $_POST['id']
            : 0;

        $nome = trim(
            $_POST['nome'] ?? ''
        );

        $cnpj = trim(
            $_POST['cnpj'] ?? ''
        );

        $contato = trim(
            $_POST['contato'] ?? ''
        );

        $telefone = trim(
            $_POST['telefone'] ?? ''
        );

        $email = trim(
            $_POST['email'] ?? ''
        );

        $cidade = trim(
            $_POST['cidade'] ?? ''
        );

        $estado = strtoupper(
            trim(
                $_POST['estado'] ?? ''
            )
        );


        // ----------------------------------------------------
        // VALIDAÇÃO
        // ----------------------------------------------------

        if ($nome === '') {

            $_SESSION['erro_laboratorio'] =
                'O nome do laboratório é obrigatório.';

            header(
                'Location: laboratorios.php?acao=' .
                ($id > 0 ? 'editar&id=' . $id : 'novo')
            );

            exit;
        }


        if (
            $estado !== ''
            && !preg_match(
                '/^[A-Z]{2}$/',
                $estado
            )
        ) {

            $_SESSION['erro_laboratorio'] =
                'O estado deve conter 2 letras.';

            header(
                'Location: laboratorios.php?acao=' .
                ($id > 0 ? 'editar&id=' . $id : 'novo')
            );

            exit;
        }


        if (
            $email !== ''
            && !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )
        ) {

            $_SESSION['erro_laboratorio'] =
                'O e-mail informado é inválido.';

            header(
                'Location: laboratorios.php?acao=' .
                ($id > 0 ? 'editar&id=' . $id : 'novo')
            );

            exit;
        }


        if (
            $controller->existeNome(
                $nome,
                $id > 0 ? $id : null
            )
        ) {

            $_SESSION['erro_laboratorio'] =
                'Já existe um laboratório com esse nome.';

            header(
                'Location: laboratorios.php?acao=' .
                ($id > 0 ? 'editar&id=' . $id : 'novo')
            );

            exit;
        }


        $dados = [

            ':nome' => $nome,

            ':cnpj' =>
                $cnpj !== '' ? $cnpj : null,

            ':contato' =>
                $contato !== '' ? $contato : null,

            ':telefone' =>
                $telefone !== '' ? $telefone : null,

            ':email' =>
                $email !== '' ? $email : null,

            ':cidade' =>
                $cidade !== '' ? $cidade : null,

            ':estado' =>
                $estado !== '' ? $estado : null

        ];


        try {

            if ($id > 0) {

                $controller->atualizar(
                    $id,
                    $dados
                );

                $_SESSION['sucesso_laboratorio'] =
                    'Laboratório atualizado com sucesso.';

            } else {

                $controller->salvar($dados);

                $_SESSION['sucesso_laboratorio'] =
                    'Laboratório cadastrado com sucesso.';
            }


            header(
                'Location: laboratorios.php'
            );

            exit;

        } catch (Throwable $e) {

            $_SESSION['erro_laboratorio'] =
                'Não foi possível salvar o laboratório.';

            header(
                'Location: laboratorios.php'
            );

            exit;
        }
    }


    // ========================================================
    // ATIVAR / INATIVAR
    // ========================================================

    if ($acaoPost === 'alternar_ativo') {

        $id = (int) (
            $_POST['id'] ?? 0
        );

        $ativo = (int) (
            $_POST['ativo'] ?? 0
        );


        if ($id <= 0) {

            $_SESSION['erro_laboratorio'] =
                'Laboratório inválido.';

            header(
                'Location: laboratorios.php'
            );

            exit;
        }


        try {

            $controller->alterarAtivo(
                $id,
                $ativo === 1
            );

            $_SESSION['sucesso_laboratorio'] =
                $ativo === 1
                    ? 'Laboratório ativado.'
                    : 'Laboratório inativado.';

        } catch (Throwable $e) {

            $_SESSION['erro_laboratorio'] =
                'Não foi possível alterar o status do laboratório.';
        }


        header(
            'Location: laboratorios.php'
        );

        exit;
    }
}


// ============================================================
// NOVO
// ============================================================

if ($acao === 'novo') {

    $laboratorio = [];

    include 'app/views/layouts/header.php';
    include 'app/views/layouts/sidebar.php';
    include 'app/views/laboratorios/form.php';
    include 'app/views/layouts/footer.php';

    exit;
}


// ============================================================
// EDITAR
// ============================================================

if ($acao === 'editar') {

    $id = filter_input(
        INPUT_GET,
        'id',
        FILTER_VALIDATE_INT
    );

    if (!$id) {

        http_response_code(400);

        die('ID do laboratório inválido.');
    }


    $laboratorio =
        $controller->buscar($id);


    if (!$laboratorio) {

        http_response_code(404);

        die('Laboratório não encontrado.');
    }


    include 'app/views/layouts/header.php';
    include 'app/views/layouts/sidebar.php';
    include 'app/views/laboratorios/form.php';
    include 'app/views/layouts/footer.php';

    exit;
}


// ============================================================
// LISTAR
// ============================================================

$laboratorios =
    $controller->listar();


$sucessoLaboratorio =
    $_SESSION['sucesso_laboratorio']
    ?? null;

$erroLaboratorio =
    $_SESSION['erro_laboratorio']
    ?? null;


unset(
    $_SESSION['sucesso_laboratorio'],
    $_SESSION['erro_laboratorio']
);


include 'app/views/layouts/header.php';
include 'app/views/layouts/sidebar.php';
include 'app/views/laboratorios/listar.php';
include 'app/views/layouts/footer.php';