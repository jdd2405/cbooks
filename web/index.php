<?php

/**
 * Example Application
 *
 * @package Example-application
 */

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");

define("SECURE", FALSE);    // NUR FÜR DIE ENTWICKLUNG!!!!


// Setup DB
$mysqli = new mysqli("194.126.200.55",  "cbooksch_dev", "r34d_b00k$", "cbooksch_dev");

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


// Logo-link
$smarty->assign("mainPage", "index.php");
/* 
 * index.tpl requires Database informations 
 * for displaying latest books ans statistics
 */
if ($result = $mysqli->query("SELECT id_isbn, title FROM books")) {
        
    /* fetch value */   
    $books = $result->fetch_all(MYSQLI_ASSOC);
    //print_r($books);
    $smarty->assign("books", $books);


        
        /* close statement */
    $result->close();
}


// Check for error messages
if (isset($_GET['err'])) {
    $smarty->assign("alert_warning", filter_input(INPUT_GET, 'err', FILTER_SANITIZE_STRING));
}

// Check for called actions
if (isset($_GET['search_book'])) {
    include_once 'modules/search_book.module.php';
    $search_term = filter_input(INPUT_GET, 'search_book', FILTER_SANITIZE_STRING);
    $search_book = new SearchBookModule($search_term);
    $search_book->start($smarty, $mysqli);
}

else if((isset($_POST['loginEmail'], $_POST['loginPassword']))){
    include_once 'modules/login.module.php';
    
    $email = filter_input(INPUT_POST, 'loginEmail', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'loginPassword', FILTER_SANITIZE_STRING);
    
    $login = new LoginModule($smarty, $mysqli);
    $login->login($email, $password);
}

else if((isset($_POST['registrateEmail'], $_POST['registratePassword']))){
    include_once 'modules/registrate.module.php';
    $registrate = new RegistrateModule();
    $registrate->start($smarty, $mysqli);
}

else if(isset($_GET['logout'])){
    include_once 'modules/login.module.php';
    $login = new LoginModule($smarty, $mysqli);
    $login->logout();
    
    $smarty->display('index.tpl');
}

// If no action is called
else {



    
    
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

      





