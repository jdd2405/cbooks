<?php

require_once 'globals.php';
require_once 'includes/db.inc.php';

if (isset($_GET['input'])){
    $test1="";
    $test2="";
    //$summary= array(array(),array());
    $isbn = filter_input(INPUT_GET, 'input', FILTER_SANITIZE_STRING);
     
    //select query for isbn number
    $result = $GLOBALS['mysqli']->query("SELECT * FROM books WHERE id_isbn='$isbn'");
    if (!$result) {
        $test1 = "verbindung zur Datenbank nicht verfügbar";
    }
    else{
        $test1 = "Verbindung steht";
        $affectedRows = mysqli_num_rows($result);
        if($affectedRows==0){
          $test2 = "kein Eintrag in der Datenbank vorhanden";
        }
        else{
            $test2= $affectedRows;
        }
        
    }
    
    $smarty->assign('test1', $test1);
    $smarty->assign('test2', $test2);
    
    
    
}


$smarty->display('books.tpl');
