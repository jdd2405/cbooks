<?php

require 'index.php';

// Löschen aller Session-Variablen.
$_SESSION = array();

// Falls die Session gelöscht werden soll, löschen Sie auch das
// Session-Cookie.
// Achtung: Damit wird die Session gelöscht, nicht nur die Session-Daten!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"],
        $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Zum Schluß, löschen der Session.
session_destroy();


$smarty->display('logout.tpl');
