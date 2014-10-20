<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

     


require_once 'libs/Smarty.class.php';
require_once 'classes/user.class.php';

function __autoload($classname) {
    require_once "classes/".$classname.".class.php";
}

$smarty = new Smarty;

//$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = true;
$smarty->cache_lifetime = 120;


/**
 * Das sind die Login-Angaben für die Datenbank
 */  
define("HOST", "194.126.200.55");     // Der Host mit dem du dich verbinden willst.
define("USER", "cbooksch_dev");    // Der Datenbank-Benutzername. 
define("PASSWORD", "r34d_b00k$");    // Das Datenbank-Passwort. 
define("DATABASE", "cbooksch_dev");    // Der Datenbankname.


define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    // NUR FÜR DIE ENTWICKLUNG!!!!
