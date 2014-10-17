<?php

/**
 * Example Application
 *
 * @package Example-application
 */
// define DB connection
define("HOST", "194.126.200.55");     // Der Host mit dem du dich verbinden willst.
define("USER", "cbooksch_dev");    // Der Datenbank-Benutzername. 
define("PASSWORD", "r34d_b00k$");    // Das Datenbank-Passwort. 
define("DATABASE", "cbooksch_dev");    // Der Datenbankname.


define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");

define("SECURE", FALSE);    // NUR FÜR DIE ENTWICKLUNG!!!!
// Setup DB
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


// Setup Smarty
require_once 'smarty/libs/Smarty.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir('./templates/');
$smarty->setCompileDir('smarty/templates_c/');
$smarty->setConfigDir('smarty/configs/');
$smarty->setCacheDir('smarty/cache/');


// Check for called actions
if (isset($_GET['search_book'])) {
    include_once 'modules/search_book.module.php';
    $search_term = filter_input(INPUT_GET, 'search_book', FILTER_SANITIZE_STRING);
    $search_book = new search_book($search_term);
    $search_book->start($smarty, $mysqli);
}

// If no action is called
else {



    /* create a prepared statement */
    if ($result = $mysqli->query("SELECT id_isbn, title FROM books")) {

        /* fetch value */
        $books = $result->fetch_assoc();
        
        $smarty->assign("books", $books);


        
        /* close statement */
        $result->close();
    }
    
    $smarty->display('index.tpl');

    
}

/*
  $query = "SELECT * FROM books";  
  $result = $GLOBALS['mysqli']->query($query);
  $numberOfRows = mysqli_num_rows($result);
  
  $summary= array(array(),array());
  $counter=0;
  
  while($row = mysqli_fetch_array($result)){
    
    for($i =0; $i<4;$i++){
        $summary[$counter][$i]=$row[$i];
     }
     $counter++;
  }

*/

  /*
  $smarty->assign('array', $summary);
  $smarty->assign('number', $numberOfRows);
  $smarty->assign('counter', $counter);
  */

      





