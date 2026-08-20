<div class="row">

    <!-- LABORATÓRIO -->

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Laboratório
        </label>

        <select
            name="laboratorio"
            class="form-select"
        >

            <option value="">
                Selecione...
            </option>

            <?php foreach (($laboratorios ?? []) as $laboratorio): ?>

                <option
                    value="<?= (int) $laboratorio['id'] ?>"
                >
                    <?= htmlspecialchars($laboratorio['nome']) ?>
                </option>

            <?php endforeach; ?>

        </select>

    </div>


    <!-- NÚMERO DO CERTIFICADO -->

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Número do Certificado
        </label>

        <input
            type="text"
            name="certificado"
            class="form-control"
        >

    </div>


    <!-- DATA DA CALIBRAÇÃO -->

    <div class="col-md-4 mb-3">

        <label class="form-label">
            Data da Calibração
        </label>

        <input
            type="date"
            name="data_calibracao"
            class="form-control"
        >

    </div>


    <!-- VALIDADE -->

    <div class="col-md-4 mb-3">

        <label class="form-label">
            Validade
        </label>

        <input
            type="date"
            name="validade"
            class="form-control"
        >

    </div>
    
    <!-- INCERTEZA -->

    <div class="col-md-4 mb-3">

        <label class="form-label">
            Incerteza de Medição
        </label>

        <input
            type="text"
            name="incerteza"
            class="form-control"
        >

    </div>


    <!-- RESULTADO -->

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Resultado
        </label>

        <select
            name="resultado"
            class="form-select"
        >

            <option value="Aprovado">
                Aprovado
            </option>

            <option value="Aprovado com Restrição">
                Aprovado com Restrição
            </option>

            <option value="Reprovado">
                Reprovado
            </option>

        </select>

    </div>


    <!-- CERTIFICADO PDF -->

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Certificado (PDF)
        </label>

        <input
            type="file"
            name="certificado_pdf"
            class="form-control"
            accept=".pdf,application/pdf"
        >

    </div>


    <!-- OBSERVAÇÕES -->

    <div class="col-12 mb-3">

        <label class="form-label">
            Observações
        </label>

        <textarea
            name="observacoes"
            rows="4"
            class="form-control"
        ></textarea>

    </div>

</div>