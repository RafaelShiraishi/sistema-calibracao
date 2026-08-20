<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: index.php");
    exit;

}

$usuario = $_SESSION['usuario'] ?? [];

include 'app/views/layouts/header.php';
include 'app/views/layouts/sidebar.php';
include 'app/views/configuracoes/index.php';
include 'app/views/layouts/footer.php';
