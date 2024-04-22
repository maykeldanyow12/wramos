<?php

require __DIR__ . "/globals.php";
require __DIR__ . "/functions.php";
require __DIR__ . "/tools.php";


$form = new FormHandler($db);
$file = new FileHandler();

$nosql = new NoSql();
$nosql->DB_CONNECTION = $db;

$session = new Session();

$paymongo = new Paymongo;