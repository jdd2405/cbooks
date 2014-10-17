<?php

require_once 'globals.php';
require_once 'includes/db.inc.php';
include_once 'includes/functions.php';



sec_session_start(); // Unsere selbstgemachte sichere Funktion um eine PHP-Sitzung zu starten.
 
if (isset($_POST['loginEmail'], $_POST['loginPassword'])) {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword']; 
 
    
    if (login($email, $password, $mysqli) == true) {
        // Login erfolgreich 
        header('Location: portal.php');
    } else {
        // Login fehlgeschlagen 
        $smarty->assign("alert_warning", "Ooops! Da stimmt was nicht.");
        $smarty->display("index.tpl");
    }
} else {
    // Die korrekten POST-Variablen wurden nicht zu dieser Seite geschickt. 
    $smarty->assign("alert_warning", "Da läuft was nicht.");
    $smarty->display("index.tpl");
}

