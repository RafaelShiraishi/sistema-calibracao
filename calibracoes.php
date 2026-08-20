<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: index.php");
    exit;
}

require_once 'config/database.php';
require_once 'app/controllers/CalibracaoController.php';

$pdo = Database::conectar();

$controller = new CalibracaoController($pdo);

$acao = $_GET['acao'] ?? 'listar';


// ============================================================
// PROCESSAMENTO DE POST
// ============================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $acaoPost = $_POST['acao'] ?? 'novo';


    // ========================================================
    // EDITAR CALIBRAÇÃO
    // ========================================================

    if ($acaoPost === 'editar') {

        $id = (int) ($_POST['id'] ?? 0);

        $equipamentoId = (int) (
            $_POST['equipamento_id'] ?? 0
        );

        $laboratorioId = (int) (
            $_POST['laboratorio_id'] ?? 0
        );

        $usuarioId = (int) (
            $_SESSION['usuario']['id'] ?? 0
        );


        $dataCalibracao = trim(
            $_POST['data_calibracao'] ?? ''
        );

        $dataValidade = trim(
            $_POST['data_validade'] ?? ''
        );

        $numeroCertificado = trim(
            $_POST['numero_certificado'] ?? ''
        );

        $resultado = trim(
            $_POST['resultado'] ?? ''
        );

        $incerteza = trim(
            $_POST['incerteza'] ?? ''
        );

        $observacoes = trim(
            $_POST['observacoes'] ?? ''
        );


        // ----------------------------------------------------
        // VALIDAÇÃO BÁSICA
        // ----------------------------------------------------

        if (
            $id <= 0 ||
            $equipamentoId <= 0 ||
            $laboratorioId <= 0 ||
            $usuarioId <= 0 ||
            empty($dataCalibracao) ||
            empty($dataValidade) ||
            empty($numeroCertificado) ||
            empty($resultado)
        ) {

            $_SESSION['erro_calibracao'] =
                'Preencha todos os campos obrigatórios.';

            header(
                "Location: calibracoes.php?acao=editar&id=" . $id
            );

            exit;
        }


        // ----------------------------------------------------
        // VALIDAÇÃO DO RESULTADO
        // ----------------------------------------------------

        $resultadosPermitidos = [
            'Aprovado',
            'Aprovado com Restrição',
            'Reprovado'
        ];


        if (
            !in_array(
                $resultado,
                $resultadosPermitidos,
                true
            )
        ) {

            $_SESSION['erro_calibracao'] =
                'Resultado de calibração inválido.';

            header(
                "Location: calibracoes.php?acao=editar&id=" . $id
            );

            exit;
        }


        // ----------------------------------------------------
        // VALIDAÇÃO DAS DATAS
        // ----------------------------------------------------

        $dataCalibracaoObj =
            DateTime::createFromFormat(
                'Y-m-d',
                $dataCalibracao
            );

        $dataValidadeObj =
            DateTime::createFromFormat(
                'Y-m-d',
                $dataValidade
            );


        if (
            !$dataCalibracaoObj ||
            $dataCalibracaoObj->format('Y-m-d')
                !== $dataCalibracao
        ) {

            $_SESSION['erro_calibracao'] =
                'A data da calibração é inválida.';

            header(
                "Location: calibracoes.php?acao=editar&id=" . $id
            );

            exit;
        }


        if (
            !$dataValidadeObj ||
            $dataValidadeObj->format('Y-m-d')
                !== $dataValidade
        ) {

            $_SESSION['erro_calibracao'] =
                'A data de validade é inválida.';

            header(
                "Location: calibracoes.php?acao=editar&id=" . $id
            );

            exit;
        }


        if (
            $dataValidadeObj < $dataCalibracaoObj
        ) {

            $_SESSION['erro_calibracao'] =
                'A data de validade não pode ser anterior à data da calibração.';

            header(
                "Location: calibracoes.php?acao=editar&id=" . $id
            );

            exit;
        }


        // ----------------------------------------------------
        // STATUS AUTOMÁTICO
        // ----------------------------------------------------

        $hoje = new DateTime('today');

        $statusId =
            $dataValidadeObj < $hoje
                ? 2
                : 1;


        // ----------------------------------------------------
        // BUSCA O REGISTRO ATUAL
        // ----------------------------------------------------

        $calibracaoAtual =
            $controller->buscar($id);


        if (!$calibracaoAtual) {

            $_SESSION['erro_calibracao'] =
                'Calibração não encontrada.';

            header(
                "Location: calibracoes.php"
            );

            exit;
        }


        // ----------------------------------------------------
        // CERTIFICADO ATUAL
        // ----------------------------------------------------

        $certificadoPdf =
            $calibracaoAtual['certificado_pdf']
            ?? null;


        // ----------------------------------------------------
        // NOVO PDF
        // ----------------------------------------------------

        if (
            isset($_FILES['certificado_pdf'])
            &&
            $_FILES['certificado_pdf']['error']
                !== UPLOAD_ERR_NO_FILE
        ) {

            if (
                $_FILES['certificado_pdf']['error']
                !== UPLOAD_ERR_OK
            ) {

                $_SESSION['erro_calibracao'] =
                    'Erro ao enviar o certificado PDF.';

                header(
                    "Location: calibracoes.php?acao=editar&id=" . $id
                );

                exit;
            }


            $tamanhoMaximo =
                10 * 1024 * 1024;


            if (
                $_FILES['certificado_pdf']['size']
                > $tamanhoMaximo
            ) {

                $_SESSION['erro_calibracao'] =
                    'O certificado PDF não pode ultrapassar 10 MB.';

                header(
                    "Location: calibracoes.php?acao=editar&id=" . $id
                );

                exit;
            }


            $extensao =
                strtolower(
                    pathinfo(
                        $_FILES['certificado_pdf']['name'],
                        PATHINFO_EXTENSION
                    )
                );


            if ($extensao !== 'pdf') {

                $_SESSION['erro_calibracao'] =
                    'O certificado deve estar no formato PDF.';

                header(
                    "Location: calibracoes.php?acao=editar&id=" . $id
                );

                exit;
            }


            $finfo = new finfo(
                FILEINFO_MIME_TYPE
            );

            $mime =
                $finfo->file(
                    $_FILES['certificado_pdf']['tmp_name']
                );


            if ($mime !== 'application/pdf') {

                $_SESSION['erro_calibracao'] =
                    'O arquivo enviado não é um PDF válido.';

                header(
                    "Location: calibracoes.php?acao=editar&id=" . $id
                );

                exit;
            }


            $pastaUpload =
                __DIR__ . '/uploads/certificados';


            if (!is_dir($pastaUpload)) {

                if (
                    !mkdir(
                        $pastaUpload,
                        0775,
                        true
                    )
                ) {

                    $_SESSION['erro_calibracao'] =
                        'Não foi possível criar a pasta de certificados.';

                    header(
                        "Location: calibracoes.php?acao=editar&id=" . $id
                    );

                    exit;
                }
            }


            $nomeArquivo =
                'certificado_' .
                date('Ymd_His') .
                '_' .
                bin2hex(random_bytes(8)) .
                '.pdf';


            $caminhoCompleto =
                $pastaUpload . '/' . $nomeArquivo;


            if (
                !move_uploaded_file(
                    $_FILES['certificado_pdf']['tmp_name'],
                    $caminhoCompleto
                )
            ) {

                $_SESSION['erro_calibracao'] =
                    'Não foi possível salvar o certificado PDF.';

                header(
                    "Location: calibracoes.php?acao=editar&id=" . $id
                );

                exit;
            }


            $certificadoPdf =
                'uploads/certificados/' . $nomeArquivo;
        }


        // ----------------------------------------------------
        // DADOS DA EDIÇÃO
        // ----------------------------------------------------

        $dados = [

            ':equipamento_id' =>
                $equipamentoId,

            ':laboratorio_id' =>
                $laboratorioId,

            ':usuario_id' =>
                $usuarioId,

            ':status_id' =>
                $statusId,

            ':data_calibracao' =>
                $dataCalibracao,

            ':data_validade' =>
                $dataValidade,

            ':numero_certificado' =>
                $numeroCertificado,

            ':resultado' =>
                $resultado,

            ':incerteza' =>
                $incerteza !== ''
                    ? $incerteza
                    : null,

            ':observacoes' =>
                $observacoes !== ''
                    ? $observacoes
                    : null,

            ':certificado_pdf' =>
                $certificadoPdf
        ];


        // ----------------------------------------------------
        // ATUALIZA
        // ----------------------------------------------------

        try {

            $controller->atualizar(
                $id,
                $dados
            );

            $_SESSION['sucesso_calibracao'] =
                'Calibração atualizada com sucesso.';

            header(
                "Location: calibracoes.php?acao=visualizar&id=" . $id
            );

            exit;

        } catch (Throwable $e) {

            $_SESSION['erro_calibracao'] =
                'Não foi possível atualizar a calibração.';

            header(
                "Location: calibracoes.php?acao=editar&id=" . $id
            );

            exit;
        }
    }


    // ========================================================
    // NOVA CALIBRAÇÃO
    // ========================================================

    if ($acaoPost === 'novo') {

        $equipamentoId = !empty(
            $_POST['equipamento_id']
        )
            ? (int) $_POST['equipamento_id']
            : 0;


        $laboratorioId = !empty(
            $_POST['laboratorio_id']
        )
            ? (int) $_POST['laboratorio_id']
            : 0;


        $usuarioId = !empty(
            $_SESSION['usuario']['id']
        )
            ? (int) $_SESSION['usuario']['id']
            : 0;


        $dataCalibracao = trim(
            $_POST['data_calibracao'] ?? ''
        );

        $dataValidade = trim(
            $_POST['data_validade'] ?? ''
        );

        $numeroCertificado = trim(
            $_POST['numero_certificado'] ?? ''
        );

        $resultado = trim(
            $_POST['resultado'] ?? ''
        );

        $incerteza = trim(
            $_POST['incerteza'] ?? ''
        );

        $observacoes = trim(
            $_POST['observacoes'] ?? ''
        );


        // ----------------------------------------------------
        // VALIDAÇÃO BÁSICA
        // ----------------------------------------------------

        if (
            $equipamentoId <= 0 ||
            $laboratorioId <= 0 ||
            $usuarioId <= 0 ||
            empty($dataCalibracao) ||
            empty($dataValidade) ||
            empty($numeroCertificado) ||
            empty($resultado)
        ) {

            $_SESSION['erro_calibracao'] =
                'Preencha todos os campos obrigatórios.';

            header(
                "Location: calibracoes.php?acao=novo"
            );

            exit;
        }


        // ----------------------------------------------------
        // VALIDA RESULTADO
        // ----------------------------------------------------

        $resultadosPermitidos = [
            'Aprovado',
            'Aprovado com Restrição',
            'Reprovado'
        ];


        if (
            !in_array(
                $resultado,
                $resultadosPermitidos,
                true
            )
        ) {

            $_SESSION['erro_calibracao'] =
                'Resultado de calibração inválido.';

            header(
                "Location: calibracoes.php?acao=novo"
            );

            exit;
        }


        // ----------------------------------------------------
        // VALIDA DATAS
        // ----------------------------------------------------

        $dataCalibracaoObj =
            DateTime::createFromFormat(
                'Y-m-d',
                $dataCalibracao
            );

        $dataValidadeObj =
            DateTime::createFromFormat(
                'Y-m-d',
                $dataValidade
            );


        if (
            !$dataCalibracaoObj ||
            $dataCalibracaoObj->format('Y-m-d')
                !== $dataCalibracao
        ) {

            $_SESSION['erro_calibracao'] =
                'A data da calibração é inválida.';

            header(
                "Location: calibracoes.php?acao=novo"
            );

            exit;
        }


        if (
            !$dataValidadeObj ||
            $dataValidadeObj->format('Y-m-d')
                !== $dataValidade
        ) {

            $_SESSION['erro_calibracao'] =
                'A data de validade é inválida.';

            header(
                "Location: calibracoes.php?acao=novo"
            );

            exit;
        }


        if (
            $dataValidadeObj < $dataCalibracaoObj
        ) {

            $_SESSION['erro_calibracao'] =
                'A data de validade não pode ser anterior à data da calibração.';

            header(
                "Location: calibracoes.php?acao=novo"
            );

            exit;
        }


        // ----------------------------------------------------
        // STATUS AUTOMÁTICO
        // ----------------------------------------------------

        $hoje =
            new DateTime('today');

        $statusId =
            $dataValidadeObj < $hoje
                ? 2
                : 1;


        // ----------------------------------------------------
        // UPLOAD PDF
        // ----------------------------------------------------

        $certificadoPdf = null;


        if (
            isset($_FILES['certificado_pdf'])
            &&
            $_FILES['certificado_pdf']['error']
                !== UPLOAD_ERR_NO_FILE
        ) {

            if (
                $_FILES['certificado_pdf']['error']
                !== UPLOAD_ERR_OK
            ) {

                $_SESSION['erro_calibracao'] =
                    'Erro ao enviar o certificado PDF.';

                header(
                    "Location: calibracoes.php?acao=novo"
                );

                exit;
            }


            $tamanhoMaximo =
                10 * 1024 * 1024;


            if (
                $_FILES['certificado_pdf']['size']
                > $tamanhoMaximo
            ) {

                $_SESSION['erro_calibracao'] =
                    'O certificado PDF não pode ultrapassar 10 MB.';

                header(
                    "Location: calibracoes.php?acao=novo"
                );

                exit;
            }


            $extensao =
                strtolower(
                    pathinfo(
                        $_FILES['certificado_pdf']['name'],
                        PATHINFO_EXTENSION
                    )
                );


            if ($extensao !== 'pdf') {

                $_SESSION['erro_calibracao'] =
                    'O certificado deve estar no formato PDF.';

                header(
                    "Location: calibracoes.php?acao=novo"
                );

                exit;
            }


            $finfo =
                new finfo(FILEINFO_MIME_TYPE);


            $mime =
                $finfo->file(
                    $_FILES['certificado_pdf']['tmp_name']
                );


            if ($mime !== 'application/pdf') {

                $_SESSION['erro_calibracao'] =
                    'O arquivo enviado não é um PDF válido.';

                header(
                    "Location: calibracoes.php?acao=novo"
                );

                exit;
            }


            $pastaUpload =
                __DIR__ . '/uploads/certificados';


            if (!is_dir($pastaUpload)) {

                if (
                    !mkdir(
                        $pastaUpload,
                        0775,
                        true
                    )
                ) {

                    $_SESSION['erro_calibracao'] =
                        'Não foi possível criar a pasta de certificados.';

                    header(
                        "Location: calibracoes.php?acao=novo"
                    );

                    exit;
                }
            }


            $nomeArquivo =
                'certificado_' .
                date('Ymd_His') .
                '_' .
                bin2hex(random_bytes(8)) .
                '.pdf';


            $caminhoCompleto =
                $pastaUpload . '/' . $nomeArquivo;


            if (
                !move_uploaded_file(
                    $_FILES['certificado_pdf']['tmp_name'],
                    $caminhoCompleto
                )
            ) {

                $_SESSION['erro_calibracao'] =
                    'Não foi possível salvar o certificado PDF.';

                header(
                    "Location: calibracoes.php?acao=novo"
                );

                exit;
            }


            $certificadoPdf =
                'uploads/certificados/' . $nomeArquivo;
        }


        // ----------------------------------------------------
        // DADOS
        // ----------------------------------------------------

        $dados = [

            ':equipamento_id' =>
                $equipamentoId,

            ':laboratorio_id' =>
                $laboratorioId,

            ':usuario_id' =>
                $usuarioId,

            ':status_id' =>
                $statusId,

            ':data_calibracao' =>
                $dataCalibracao,

            ':data_validade' =>
                $dataValidade,

            ':numero_certificado' =>
                $numeroCertificado,

            ':resultado' =>
                $resultado,

            ':incerteza' =>
                $incerteza !== ''
                    ? $incerteza
                    : null,

            ':observacoes' =>
                $observacoes !== ''
                    ? $observacoes
                    : null,

            ':certificado_pdf' =>
                $certificadoPdf
        ];


        // ----------------------------------------------------
        // SALVA
        // ----------------------------------------------------

        try {

            $controller->salvar(
                $dados
            );

            $_SESSION['sucesso_calibracao'] =
                'Calibração cadastrada com sucesso.';

            header(
                "Location: calibracoes.php"
            );

            exit;

        } catch (Throwable $e) {

            $_SESSION['erro_calibracao'] =
                'Não foi possível cadastrar a calibração.';

            header(
                "Location: calibracoes.php?acao=novo"
            );

            exit;
        }
    }
}


// ============================================================
// VISUALIZAR CALIBRAÇÃO
// ============================================================

if ($acao === 'visualizar') {

    $id = filter_input(
        INPUT_GET,
        'id',
        FILTER_VALIDATE_INT
    );


    if (!$id) {

        http_response_code(400);

        die(
            'ID da calibração inválido.'
        );
    }


    $calibracao =
        $controller->buscar($id);


    if (!$calibracao) {

        http_response_code(404);

        die(
            'Calibração não encontrada.'
        );
    }


    include 'app/views/layouts/header.php';

    include 'app/views/layouts/sidebar.php';

    include 'app/views/calibracoes/visualizar.php';

    include 'app/views/layouts/footer.php';

    exit;
}


// ============================================================
// EDITAR CALIBRAÇÃO
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
            'ID da calibração inválido.'
        );
    }


    $calibracao =
        $controller->buscar($id);


    if (!$calibracao) {

        http_response_code(404);

        die(
            'Calibração não encontrada.'
        );
    }


    $equipamentos =
        $controller->equipamentos();

    $laboratorios =
        $controller->laboratorios();

    $usuarios =
        $controller->usuarios();

    $status =
        $controller->status();


    include 'app/views/layouts/header.php';

    include 'app/views/layouts/sidebar.php';

    include 'app/views/calibracoes/editar.php';

    include 'app/views/layouts/footer.php';

    exit;
}


// ============================================================
// NOVA CALIBRAÇÃO
// ============================================================

if ($acao === 'novo') {

    $equipamentoSelecionado =
        filter_input(
            INPUT_GET,
            'equipamento_id',
            FILTER_VALIDATE_INT
        );

    if (!$equipamentoSelecionado) {

        $equipamentoSelecionado = null;
    }


    $equipamentos =
        $controller->equipamentos();

    $laboratorios =
        $controller->laboratorios();

    $usuarios =
        $controller->usuarios();

    $status =
        $controller->status();


    include 'app/views/layouts/header.php';

    include 'app/views/layouts/sidebar.php';

    include 'app/views/calibracoes/nova.php';

    include 'app/views/layouts/footer.php';

    exit;
}


// ============================================================
// LISTAR CALIBRAÇÕES
// ============================================================

$calibracoes =
    $controller->listar();


// ============================================================
// INDICADORES
// ============================================================

$totalCalibracoes =
    count($calibracoes);

$totalAprovadas = 0;

$totalRestricoes = 0;

$totalReprovadas = 0;

$totalVencidas = 0;

$hoje =
    new DateTime('today');


foreach ($calibracoes as $calibracao) {

    $resultado =
        $calibracao['resultado'] ?? '';


    if (
        $resultado === 'Aprovado'
    ) {

        $totalAprovadas++;

    } elseif (
        $resultado ===
        'Aprovado com Restrição'
    ) {

        $totalRestricoes++;

    } elseif (
        $resultado === 'Reprovado'
    ) {

        $totalReprovadas++;
    }


    if (
        !empty(
            $calibracao['data_validade']
        )
    ) {

        $validade =
            DateTime::createFromFormat(
                'Y-m-d',
                $calibracao['data_validade']
            );


        if (
            $validade &&
            $validade < $hoje
        ) {

            $totalVencidas++;
        }
    }
}


// ============================================================
// MENSAGENS
// ============================================================

$sucessoCalibracao =
    $_SESSION['sucesso_calibracao']
    ?? null;

$erroCalibracao =
    $_SESSION['erro_calibracao']
    ?? null;


unset(
    $_SESSION['sucesso_calibracao'],
    $_SESSION['erro_calibracao']
);


// ============================================================
// LAYOUT
// ============================================================

include 'app/views/layouts/header.php';

include 'app/views/layouts/sidebar.php';

include 'app/views/calibracoes/listar.php';

include 'app/views/layouts/footer.php';