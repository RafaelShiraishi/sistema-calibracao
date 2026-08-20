<?php

$usuario = $usuario ?? [];
$perfis = $perfis ?? [];

$modoEdicao = !empty($usuario['id']);

$erroUsuario = $_SESSION['erro_usuario'] ?? null;

unset($_SESSION['erro_usuario']);

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="bi bi-person-plus"></i>

                <?= $modoEdicao
                    ? 'Editar Usuário'
                    : 'Novo Usuário'
                ?>

            </h2>

            <p class="text-muted mb-0">

                <?= $modoEdicao
                    ? 'Atualize os dados do usuário.'
                    : 'Cadastre um novo usuário do sistema.'
                ?>

            </p>

        </div>

        <a
            href="usuarios.php"
            class="btn btn-outline-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Voltar

        </a>

    </div>


    <?php if ($erroUsuario): ?>

        <div class="alert alert-danger">

            <i class="bi bi-exclamation-triangle"></i>

            <?= htmlspecialchars($erroUsuario) ?>

        </div>

    <?php endif; ?>


    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form
                method="POST"
                action="usuarios.php"
            >

                <input
                    type="hidden"
                    name="acao"
                    value="<?= $modoEdicao ? 'editar' : 'salvar' ?>"
                >


                <?php if ($modoEdicao): ?>

                    <input
                        type="hidden"
                        name="id"
                        value="<?= (int) $usuario['id'] ?>"
                    >

                <?php endif; ?>


                <div class="row">


                    <!-- NOME -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nome completo *
                        </label>

                        <input
                            type="text"
                            name="nome"
                            class="form-control"
                            maxlength="150"
                            required
                            value="<?= htmlspecialchars(
                                $usuario['nome'] ?? ''
                            ) ?>"
                        >

                    </div>


                    <!-- E-MAIL -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            E-mail *
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            maxlength="150"
                            required
                            value="<?= htmlspecialchars(
                                $usuario['email'] ?? ''
                            ) ?>"
                        >

                    </div>


                    <!-- PERFIL -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Perfil *
                        </label>

                        <select
                            name="perfil_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Selecione...
                            </option>

                            <?php foreach ($perfis as $perfil): ?>

                                <option
                                    value="<?= (int) $perfil['id'] ?>"
                                    <?= (
                                        (int) (
                                            $usuario['perfil_id'] ?? 0
                                        )
                                        ===
                                        (int) $perfil['id']
                                    )
                                        ? 'selected'
                                        : ''
                                    ?>
                                >

                                    <?= htmlspecialchars(
                                        $perfil['nome']
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- TELEFONE -->

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
                                $usuario['telefone'] ?? ''
                            ) ?>"
                        >

                    </div>


                    <!-- SENHA -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Senha

                            <?php if ($modoEdicao): ?>

                                <small class="text-muted">
                                    (preencha somente se quiser alterar)
                                </small>

                            <?php else: ?>

                                <span class="text-danger">*</span>

                            <?php endif; ?>

                        </label>

                        <input
                            type="password"
                            name="senha"
                            class="form-control"
                            minlength="6"
                            <?= !$modoEdicao ? 'required' : '' ?>
                        >

                    </div>


                    <!-- CONFIRMAÇÃO -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Confirmar Senha

                        </label>

                        <input
                            type="password"
                            name="confirmar_senha"
                            class="form-control"
                            minlength="6"
                            <?= !$modoEdicao ? 'required' : '' ?>
                        >

                    </div>

                </div>


                <div class="alert alert-info">

                    <i class="bi bi-shield-lock"></i>

                    As senhas são armazenadas utilizando hash seguro.

                </div>


                <hr>


                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="bi bi-check-circle"></i>

                    <?= $modoEdicao
                        ? 'Salvar Alterações'
                        : 'Cadastrar Usuário'
                    ?>

                </button>


                <a
                    href="usuarios.php"
                    class="btn btn-secondary"
                >

                    Cancelar

                </a>

            </form>

        </div>

    </div>

</div>