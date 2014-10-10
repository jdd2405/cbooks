<?php

require_once 'includes/globals.php';
require_once 'includes/db.inc.php';

$string= $_POST['input'];
$smarty->assign('test', $string);

$smarty->display('books.tpl');