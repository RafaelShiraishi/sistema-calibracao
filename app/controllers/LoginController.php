<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../../config/database.php';

class LoginController
{

    public function autenticar()
    {

        session_start();

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header("Location: index.php");
            exit;
        }

        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

       $pdo = Database::conectar();

$usuarioModel = new Usuario($pdo);

        $usuario = $usuarioModel->buscarPorEmail($email);

        if (!$usuario) {

            $_SESSION['erro'] = "Usuário não encontrado.";

            header("Location: index.php");

            exit;
        }

        if (!password_verify($senha, $usuario['senha'])) {

            $_SESSION['erro'] = "Senha incorreta.";

            header("Location: index.php");

            exit;
        }

        $_SESSION['usuario'] = $usuario;

        header("Location: dashboard.php");

        exit;

    }

}