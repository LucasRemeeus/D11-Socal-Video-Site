<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$db_hostname = "localhost:3306";
$db_username = "root";
$db_password = "";
$db_database = "twotch";

$mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

if (!$mysqli) {
    echo "FOUT: geen connectie naar database. <br>";
    echo "Error: " . mysqli_connect_errno() . "<br/>";
    exit;
}