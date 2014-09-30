<?php
/**
 * Example Application
 *
 * @package Example-application
 */

require 'libs/Smarty.class.php';

$smarty = new Smarty;

//$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = true;
$smarty->cache_lifetime = 120;

session_start();
session_regenerate_id(true); 

$smarty->assign("session_id", session_id());


$smarty->display('index.tpl');
