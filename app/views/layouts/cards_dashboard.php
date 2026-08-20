<?php

$cards = $cards ?? [];

?>

<div class="row mb-4">

    <?php foreach ($cards as $card): ?>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card card-dashboard">

                <div class="card-body">

                    <h6 class="text-muted">
                        <?= htmlspecialchars($card['titulo']) ?>
                    </h6>

                    <h2>
                        <?= htmlspecialchars($card['valor']) ?>
                    </h2>

                </div>

            </div>

        </div>

    <?php endforeach; ?>

</div>