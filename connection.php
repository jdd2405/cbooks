<?php 

$db_username = "cbooks";
$db_pass = "jesus4ever";


    
// Create connection
$link = mysqli_connect('localhost', $db_username, $db_pass, 'cbooks');

if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

echo 'Success... ' . mysqli_get_host_info($link) . "\n";


     
?>