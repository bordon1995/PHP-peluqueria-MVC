<?php

function debuguear($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';

    exit;
}

function sanitizarHTML($variable)
{
    $html = htmlspecialchars($variable);
    return $html;
}
