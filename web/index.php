<?php
/**
 * Example Application
 *
 * @package Example-application
 */

require_once 'globals.php';

session_start();
session_regenerate_id(true); 

$smarty->assign("session_id", session_id());


$smarty->display('index.tpl');
