<div class="d-flex justify-content-between mb-4">

    <div>

        <h2>Novo Equipamento</h2>

        <small class="text-muted">
            Cadastro de Equipamento
        </small>

    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <form method="POST" action="salvar_equipamento.php">

            <div class="row">

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        TAG

                    </label>

                    <input
                        type="text"
                        class="form-control">

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Patrimônio

                    </label>

                    <input
                        type="text"
                        class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Nome do Equipamento

                    </label>

                    <input
                        type="text"
                        class="form-control">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Fabricante

                    </label>

                    <select class="form-select">

                        <option>Selecione...</option>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Modelo

                    </label>

                    <input
                        type="text"
                        class="form-control">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Número de Série

                    </label>

                    <input
                        type="text"
                        class="form-control">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Setor

                    </label>

                    <select class="form-select">

                        <option>Selecione...</option>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Responsável

                    </label>

                    <select class="form-select">

                        <option>Selecione...</option>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select class="form-select">

                        <option>Em uso</option>

                        <option>Manutenção</option>

                        <option>Quarentena</option>

                    </select>

                </div>

            </div>

            <hr>

            <button class="btn btn-success">

                <i class="bi bi-check-circle"></i>

                Salvar Equipamento

            </button>

            <a href="equipamentos.php" class="btn btn-secondary">

                Cancelar

            </a>

        </form>

    </div>

</div>