<div class="container-fluid">

    <?php if (!empty($sucessoUsuario)): ?>

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle"></i>

            <?= htmlspecialchars($sucessoUsuario) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    <?php if (!empty($erroUsuario)): ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="bi bi-exclamation-triangle"></i>

            <?= htmlspecialchars($erroUsuario) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="bi bi-people"></i>

                Usuários

            </h2>

            <p class="text-muted mb-0">

                Gerenciamento dos usuários do sistema.

            </p>

        </div>


        <a
            href="usuarios.php?acao=novo"
            class="btn btn-primary"
        >

            <i class="bi bi-person-plus"></i>

            Novo Usuário

        </a>

    </div>


    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Perfil</th>
                            <th>Telefone</th>
                            <th>Status</th>
                            <th>Cadastro</th>
                            <th>Ações</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php if (empty($usuarios)): ?>

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center text-muted py-5"
                                >

                                    <i
                                        class="bi bi-people fs-1 d-block mb-3"
                                    ></i>

                                    Nenhum usuário cadastrado.

                                </td>

                            </tr>

                        <?php else: ?>


                            <?php foreach ($usuarios as $usuario): ?>

                                <tr>


                                    <td>

                                        <strong>

                                            <?= htmlspecialchars(
                                                $usuario['nome']
                                            ) ?>

                                        </strong>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $usuario['email']
                                        ) ?>

                                    </td>


                                    <td>

                                        <span class="badge text-bg-primary">

                                            <?= htmlspecialchars(
                                                $usuario['perfil']
                                            ) ?>

                                        </span>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars(
                                            $usuario['telefone']
                                            ?? '-'
                                        ) ?>

                                    </td>


                                    <td>

                                        <?php if (
                                            (int) $usuario['ativo'] === 1
                                        ): ?>

                                            <span
                                                class="badge text-bg-success"
                                            >

                                                Ativo

                                            </span>

                                        <?php else: ?>

                                            <span
                                                class="badge text-bg-secondary"
                                            >

                                                Inativo

                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <td>

                                        <?php if (
                                            !empty(
                                                $usuario['data_cadastro']
                                            )
                                        ): ?>

                                            <?= date(
                                                'd/m/Y H:i',
                                                strtotime(
                                                    $usuario['data_cadastro']
                                                )
                                            ) ?>

                                        <?php else: ?>

                                            -

                                        <?php endif; ?>

                                    </td>


                                    <td>

                                        <div class="d-flex gap-1">


                                            <!-- EDITAR -->

                                            <a
                                                href="usuarios.php?acao=editar&id=<?= (int) $usuario['id'] ?>"
                                                class="btn btn-sm btn-outline-warning"
                                                title="Editar usuário"
                                            >

                                                <i
                                                    class="bi bi-pencil"
                                                ></i>

                                            </a>


                                            <!-- ATIVAR / INATIVAR -->

                                            <?php if (
                                                (int) $usuario['id']
                                                ===
                                                (int) $_SESSION['usuario']['id']
                                            ): ?>

                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    disabled
                                                    title="Você não pode inativar o próprio usuário"
                                                >

                                                    <i
                                                        class="bi bi-lock"
                                                    ></i>

                                                </button>

                                            <?php else: ?>

                                                <form
                                                    method="POST"
                                                    action="usuarios.php"
                                                    class="d-inline"
                                                >

                                                    <input
                                                        type="hidden"
                                                        name="acao"
                                                        value="alternar_ativo"
                                                    >

                                                    <input
                                                        type="hidden"
                                                        name="id"
                                                        value="<?= (int) $usuario['id'] ?>"
                                                    >

                                                    <input
                                                        type="hidden"
                                                        name="ativo"
                                                        value="<?= (int) $usuario['ativo'] === 1 ? 0 : 1 ?>"
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm <?= (int) $usuario['ativo'] === 1
                                                            ? 'btn-outline-danger'
                                                            : 'btn-outline-success'
                                                        ?>"
                                                        title="<?= (int) $usuario['ativo'] === 1
                                                            ? 'Inativar usuário'
                                                            : 'Ativar usuário'
                                                        ?>"
                                                        onclick="return confirm('Deseja realmente alterar o status deste usuário?');"
                                                    >

                                                        <i
                                                            class="bi <?= (int) $usuario['ativo'] === 1
                                                                ? 'bi-person-x'
                                                                : 'bi-person-check'
                                                            ?>"
                                                        ></i>

                                                    </button>

                                                </form>

                                            <?php endif; ?>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>