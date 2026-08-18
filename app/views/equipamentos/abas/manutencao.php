<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">
        <h5 class="mb-1">
            <i class="bi bi-tools"></i>
            Manutenção
        </h5>

        <small class="text-muted">
            Histórico e planejamento de manutenções do equipamento.
        </small>
    </div>

    <div class="card-body">

        <div class="row">

            <!-- ÚLTIMA MANUTENÇÃO -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Data da Última Manutenção
                </label>

                <input
                    type="date"
                    name="data_manutencao"
                    class="form-control"
                    value="<?= htmlspecialchars($manutencao['data_manutencao'] ?? '') ?>"
                >

            </div>


            <!-- PRÓXIMA MANUTENÇÃO -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Data da Próxima Manutenção
                </label>

                <input
                    type="date"
                    name="data_proxima_manutencao"
                    class="form-control"
                    value="<?= htmlspecialchars($manutencao['data_proxima_manutencao'] ?? '') ?>"
                >

            </div>


            <!-- OBSERVAÇÕES -->

            <div class="col-12 mb-3">

                <label class="form-label">
                    Observações da Manutenção
                </label>

                <textarea
                    name="observacoes_manutencao"
                    rows="5"
                    class="form-control"
                    placeholder="Informe detalhes da manutenção realizada..."
                ><?= htmlspecialchars($manutencao['observacoes'] ?? '') ?></textarea>

            </div>

        </div>

    </div>

</div>