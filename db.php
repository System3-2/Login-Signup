<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'login-db';

$mysqli = new mysqli($host, $user, $password, $dbname);

if ($mysqli->connect_error) {
    echo  "Connection Error" . PHP_EOL;
}
return $mysqli;
