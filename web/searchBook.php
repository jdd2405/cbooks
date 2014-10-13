<?php

require_once 'includes/globals.php';
require_once 'includes/db.inc.php';

if (isset($_GET['input'])){
    $isbn = filter_input(INPUT_GET, 'input', FILTER_SANITIZE_STRING);
     
    $result = $GLOBALS['mysqli']->query("SELECT * FROM books WHERE isbn=$isbn");
    $row = mysqli_num_rows($result);
}

$smarty->assign('test', $row);

$smarty->display('books.tpl');