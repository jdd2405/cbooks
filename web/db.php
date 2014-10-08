<?php


$mysqli = new mysqli('194.126.200.55', 'cbooksch_dev', 'r34d_b00k$', 'cbooksch_dev');
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}


