<?php
function h($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}
function redirecionar($url) {
    header("Location: $url");
    exit;
}
