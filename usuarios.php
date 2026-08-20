<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: index.php");
    exit;

}

require_once 'config/database.php';
require_once 'app/controllers/UsuarioController.php';

$pdo = Database::conectar();

$controller = new UsuarioController($pdo);

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

        $perfilId = !empty($_POST['perfil_id'])
            ? (int) $_POST['perfil_id']
            : 0;

        $nome = trim(
            $_POST['nome'] ?? ''
        );

        $email = trim(
            $_POST['email'] ?? ''
        );

        $telefone = trim(
            $_POST['telefone'] ?? ''
        );

        $senha = $_POST['senha'] ?? '';

        $confirmarSenha =
            $_POST['confirmar_senha'] ?? '';


        // ----------------------------------------------------
        // VALIDAÇÃO
        // ----------------------------------------------------

        if (
            $perfilId <= 0 ||
            $nome === '' ||
            $email === ''
        ) {

            $_SESSION['erro_usuario'] =
                'Preencha todos os campos obrigatórios.';

            header(
                'Location: usuarios.php?acao=' .
                ($id > 0
                    ? 'editar&id=' . $id
                    : 'novo')
            );

            exit;
        }


        if (
            !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )
        ) {

            $_SESSION['erro_usuario'] =
                'Informe um e-mail válido.';

            header(
                'Location: usuarios.php?acao=' .
                ($id > 0
                    ? 'editar&id=' . $id
                    : 'novo')
            );

            exit;
        }


        if (
            $controller->existeEmail(
                $email,
                $id > 0 ? $id : null
            )
        ) {

            $_SESSION['erro_usuario'] =
                'Já existe um usuário com este e-mail.';

            header(
                'Location: usuarios.php?acao=' .
                ($id > 0
                    ? 'editar&id=' . $id
                    : 'novo')
            );

            exit;
        }


        // ----------------------------------------------------
        // SENHA
        // ----------------------------------------------------

        if ($id === 0 && $senha === '') {

            $_SESSION['erro_usuario'] =
                'A senha é obrigatória para novos usuários.';

            header(
                'Location: usuarios.php?acao=novo'
            );

            exit;
        }


        if ($senha !== '') {

            if (strlen($senha) < 6) {

                $_SESSION['erro_usuario'] =
                    'A senha deve possuir pelo menos 6 caracteres.';

                header(
                    'Location: usuarios.php?acao=' .
                    ($id > 0
                        ? 'editar&id=' . $id
                        : 'novo')
                );

                exit;
            }


            if ($senha !== $confirmarSenha) {

                $_SESSION['erro_usuario'] =
                    'As senhas não coincidem.';

                header(
                    'Location: usuarios.php?acao=' .
                    ($id > 0
                        ? 'editar&id=' . $id
                        : 'novo')
                );

                exit;
            }
        }


        $dados = [

            ':perfil_id' =>
                $perfilId,

            ':nome' =>
                $nome,

            ':email' =>
                $email,

            ':telefone' =>
                $telefone !== ''
                    ? $telefone
                    : null
        ];


        if ($senha !== '') {

            $dados[':senha'] =
                password_hash(
                    $senha,
                    PASSWORD_DEFAULT
                );
        }


        try {

            if ($id > 0) {

                $controller->atualizar(
                    $id,
                    $dados
                );

                $_SESSION['sucesso_usuario'] =
                    'Usuário atualizado com sucesso.';

            } else {

                $controller->salvar(
                    $dados
                );

                $_SESSION['sucesso_usuario'] =
                    'Usuário cadastrado com sucesso.';
            }


            header(
                'Location: usuarios.php'
            );

            exit;

        } catch (Throwable $e) {

            $_SESSION['erro_usuario'] =
                'Não foi possível salvar o usuário.';

            header(
                'Location: usuarios.php'
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

            $_SESSION['erro_usuario'] =
                'Usuário inválido.';

            header(
                'Location: usuarios.php'
            );

            exit;
        }


        // Não permite desativar o próprio usuário logado.
        if (
            $id ===
            (int) $_SESSION['usuario']['id']
            &&
            $ativo === 0
        ) {

            $_SESSION['erro_usuario'] =
                'Você não pode inativar o próprio usuário.';

            header(
                'Location: usuarios.php'
            );

            exit;
        }


        try {

            $controller->alterarAtivo(
                $id,
                $ativo === 1
            );

            $_SESSION['sucesso_usuario'] =
                $ativo === 1
                    ? 'Usuário ativado.'
                    : 'Usuário inativado.';

        } catch (Throwable $e) {

            $_SESSION['erro_usuario'] =
                'Não foi possível alterar o status do usuário.';
        }


        header(
            'Location: usuarios.php'
        );

        exit;
    }
}


// ============================================================
// NOVO
// ============================================================

if ($acao === 'novo') {

    $usuario = [];

    $perfis =
        $controller->perfis();

    include 'app/views/layouts/header.php';
    include 'app/views/layouts/sidebar.php';
    include 'app/views/usuarios/form.php';
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

        die(
            'ID do usuário inválido.'
        );
    }


    $usuario =
        $controller->buscar($id);


    if (!$usuario) {

        http_response_code(404);

        die(
            'Usuário não encontrado.'
        );
    }


    $perfis =
        $controller->perfis();


    include 'app/views/layouts/header.php';
    include 'app/views/layouts/sidebar.php';
    include 'app/views/usuarios/form.php';
    include 'app/views/layouts/footer.php';

    exit;
}


// ============================================================
// LISTAGEM
// ============================================================

$usuarios =
    $controller->listar();

$sucessoUsuario =
    $_SESSION['sucesso_usuario']
    ?? null;

$erroUsuario =
    $_SESSION['erro_usuario']
    ?? null;


unset(
    $_SESSION['sucesso_usuario'],
    $_SESSION['erro_usuario']
);


include 'app/views/layouts/header.php';
include 'app/views/layouts/sidebar.php';
include 'app/views/usuarios/listar.php';
include 'app/views/layouts/footer.php';