<?php

$titulo = $titulo ?? '';
$subtitulo = $subtitulo ?? '';
$botaoTexto = $botaoTexto ?? null;
$botaoLink = $botaoLink ?? '#';

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-0">
            <?= htmlspecialchars($titulo) ?>
        </h2>

        <small class="text-muted">
            <?= htmlspecialchars($subtitulo) ?>
        </small>

    </div>

    <?php if ($botaoTexto): ?>

        <a href="<?= htmlspecialchars($botaoLink) ?>" class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            <?= htmlspecialchars($botaoTexto) ?>

        </a>

    <?php endif; ?>

</div>