<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: index.php");
    exit;

}

include 'app/views/layouts/header.php';
include 'app/views/layouts/sidebar.php';
include 'app/views/equipamentos/cadastrar.php';
include 'app/views/layouts/footer.php';