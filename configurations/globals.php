<?php

$host = "http://localhost:8080/wramos/";
$name = "W. Ramos Diagnostic Laboratory Management System";

//Database Configuration
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'wramosmis');


$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);