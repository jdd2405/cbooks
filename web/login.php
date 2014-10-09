<?php

require_once 'globals.php';
require_once 'db.php';
include_once 'functions.php';

// Check if request attributes are not empty
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    login($email, $password);
}

// 
//function login($email, $password){
//    
//    $query = "SELECT * FROM 'user' WHERE 'email' = '".$email."';";
//        
//    $res = $GLOBALS['mysqli']->query($query);
//    $row = $res->fetch_assoc();
//    
//    // check if password match
//    if ($res['password'] && $res['email']) {
//        if ($email == "admin@realnet.ch" && $password == "admin") {
//            $_SESSION['auth'] = true;
//            $_COOKIE['session_id'] = session_id();
//            $GLOBALS["smarty"]->assign('email', $email);
//            $GLOBALS["smarty"]->display('portal.tpl');
//        } else {
//            $_SESSION['auth'] = false;
//            header("Location:index.php");
//        }
//    }
//}


sec_session_start(); // Unsere selbstgemachte sichere Funktion um eine PHP-Sitzung zu starten.
 
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // Das gehashte Passwort.
 
    if (login($email, $password, $mysqli) == true) {
        // Login erfolgreich 
        header('Location: ../protected_page.php');
    } else {
        // Login fehlgeschlagen 
        header('Location: ../index.php?error=1');
    }
} else {
    // Die korrekten POST-Variablen wurden nicht zu dieser Seite geschickt. 
    echo 'Invalid Request';
}

