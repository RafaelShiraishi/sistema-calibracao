<?php

$laboratorio = $laboratorio ?? [];

$modoEdicao =
    !empty($laboratorio['id']);

$erroLaboratorio =
    $_SESSION['erro_laboratorio']
    ?? null;

unset(
    $_SESSION['erro_laboratorio']
);

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="bi bi-building"></i>

                <?= $modoEdicao
                    ? 'Editar Laboratório'
                    : 'Novo Laboratório'
                ?>

            </h2>

            <p class="text-muted mb-0">

                <?= $modoEdicao
                    ? 'Atualize os dados do laboratório.'
                    : 'Cadastre um novo laboratório.'
                ?>

            </p>

        </div>

        <a
            href="laboratorios.php"
            class="btn btn-outline-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Voltar

        </a>

    </div>


    <?php if ($erroLaboratorio): ?>

        <div class="alert alert-danger">

            <i class="bi bi-exclamation-triangle"></i>

            <?= htmlspecialchars($erroLaboratorio) ?>

        </div>

    <?php endif; ?>


    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form
                method="POST"
                action="laboratorios.php"
            >

                <input
                    type="hidden"
                    name="acao"
                    value="<?= $modoEdicao
                        ? 'editar'
                        : 'salvar'
                    ?>"
                >


                <?php if ($modoEdicao): ?>

                    <input
                        type="hidden"
                        name="id"
                        value="<?= (int) $laboratorio['id'] ?>"
                    >

                <?php endif; ?>


                <div class="row">


                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nome do Laboratório *

                        </label>

                        <input
                            type="text"
                            name="nome"
                            class="form-control"
                            maxlength="150"
                            required
                            value="<?= htmlspecialchars(
                                $laboratorio['nome'] ?? ''
                            ) ?>"
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            CNPJ

                        </label>

                        <input
                            type="text"
                            name="cnpj"
                            class="form-control"
                            maxlength="18"
                            value="<?= htmlspecialchars(
                                $laboratorio['cnpj'] ?? ''
                            ) ?>"
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Contato

                        </label>

                        <input
                            type="text"
                            name="contato"
                            class="form-control"
                            maxlength="100"
                            value="<?= htmlspecialchars(
                                $laboratorio['contato'] ?? ''
                            ) ?>"
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Telefone

                        </label>

                        <input
                            type="text"
                            name="telefone"
                            class="form-control"
                            maxlength="20"
                            value="<?= htmlspecialchars(
                                $laboratorio['telefone'] ?? ''
                            ) ?>"
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            E-mail

                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            maxlength="150"
                            value="<?= htmlspecialchars(
                                $laboratorio['email'] ?? ''
                            ) ?>"
                        >

                    </div>


                    <div class="col-md-5 mb-3">

                        <label class="form-label">

                            Cidade

                        </label>

                        <input
                            type="text"
                            name="cidade"
                            class="form-control"
                            maxlength="100"
                            value="<?= htmlspecialchars(
                                $laboratorio['cidade'] ?? ''
                            ) ?>"
                        >

                    </div>


                    <div class="col-md-1 mb-3">

                        <label class="form-label">

                            UF

                        </label>

                        <input
                            type="text"
                            name="estado"
                            class="form-control text-uppercase"
                            maxlength="2"
                            value="<?= htmlspecialchars(
                                $laboratorio['estado'] ?? ''
                            ) ?>"
                        >

                    </div>

                </div>


                <hr>


                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="bi bi-check-circle"></i>

                    <?= $modoEdicao
                        ? 'Salvar Alterações'
                        : 'Cadastrar Laboratório'
                    ?>

                </button>


                <a
                    href="laboratorios.php"
                    class="btn btn-secondary"
                >

                    Cancelar

                </a>

            </form>

        </div>

    </div>

</div>