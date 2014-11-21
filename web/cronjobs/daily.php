<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header("Content-Type: text/html; charset=utf-8");
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");

define("SECURE", FALSE);    // NUR FÜR DIE ENTWICKLUNG!!!!


// Setup DB
$mysqli = new mysqli("194.126.200.55",  "cbooksch_dev", "r34d_b00k$", "cbooksch_dev");
$mysqli->query("SET NAMES 'utf8'");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


// Setup Smarty
require_once '../smarty/libs/Smarty.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir('./templates/');
$smarty->setCompileDir('smarty/templates_c/');
$smarty->setConfigDir('smarty/configs/');
$smarty->setCacheDir('smarty/cache/');

// Setup PHPMailer
require_once('../mail/class.phpmailer.php');
require_once('../mail/class.smtp.php');



require_once '../modules/lend_book.module.php';
$lendBookModule = new LendBook($smarty, $mysqli);
$lendBookModule->checkLendingRelations();

echo "Daily Cronjob done.";