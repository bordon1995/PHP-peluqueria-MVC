<?php

use Dotenv\Dotenv;
use Model\ActiveRecord;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/conectDB.php';
require_once __DIR__ . '/helpers.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();


$db = conectarDB();

ActiveRecord::setDataBase($db);
