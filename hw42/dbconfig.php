<?php

$db_host = "database";
$db_user = "root";
$db_password = "tiger";
$db_name = "docdb";

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

$mysqli->set_charset("utf8");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    
}