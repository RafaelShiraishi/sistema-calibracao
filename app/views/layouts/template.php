<?php

require_once __DIR__ . '/header.php';
require_once __DIR__ . '/sidebar.php';

if (isset($conteudo)) {
    require_once $conteudo;
}

require_once __DIR__ . '/footer.php';