<?php

function conectarDB()
{
    $db = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

    $db->set_charset('utf8');

    if ($db) {
        return $db;
    } else {
        echo 'no se pudo conectar';
        exit;
    };
};
