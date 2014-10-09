<?php

require_once 'globals.php';

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

