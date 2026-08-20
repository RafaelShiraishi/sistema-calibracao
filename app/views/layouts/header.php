<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Sistema de Gestão de Calibração</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f6fa;
            overflow-x: hidden;
            margin: 0;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #0d6efd;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1000;
        }

        .sidebar h4 {
            padding: 25px;
            margin: 0;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,.2);
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 15px 25px;
            transition: .2s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,.15);
        }

        .sidebar a.active {
            background: white;
            color: #0d6efd;
            font-weight: bold;
            border-left: 5px solid #0b5ed7;
        }

        .sidebar a.active i {
            color: #0d6efd;
        }

        .content {
            margin-left: 260px;
            padding: 25px;
            min-height: 100vh;
        }

        .topbar {
            background: white;
            border-radius: 10px;
            padding: 15px 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
            margin-bottom: 25px;
        }

        .card-dashboard {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
            transition: .2s;
        }

        .card-dashboard:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,.12);
        }

    </style>

</head>

<body>