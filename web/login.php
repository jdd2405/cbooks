<?php

require_once 'includes/globals.php';
require_once 'includes/db.inc.php';
include_once 'includes/functions.php';



sec_session_start(); // Unsere selbstgemachte sichere Funktion um eine PHP-Sitzung zu starten.
 
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // Das gehashte Passwort.
 
    printf($password, $email);
    
    if (login($email, $password, $mysqli) == true) {
        // Login erfolgreich 
        header('Location: account/portal.php');
    } else {
        // Login fehlgeschlagen 
        printf($password, $email);
        echo 'Ooops!';
    }
} else {
    // Die korrekten POST-Variablen wurden nicht zu dieser Seite geschickt. 
    echo 'Invalid Request';
}

