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
$mysqli = new mysqli("194.126.200.55", "cbooksch_dev", "r34d_b00k$", "cbooksch_dev");

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




// Check authentification
require_once 'modules/login.module.php';
require_once 'classes/User.class.php';
$login = new LoginModule($smarty, $mysqli);
$user = $login->check_login();
if ($user->isLoggedIn == true) {

    $smarty->assign("path", "portal.php");
    

    
    
    
    
    if ($result = $mysqli->query("SELECT id_isbn, title FROM books")) {

        /* fetch value */   
        $books = $result->fetch_all(MYSQLI_ASSOC);
        //print_r($books);
        $smarty->assign("books", $books);



            /* close statement */
        $result->close();
    }



    
    
    
    if(isset($_GET['logout'])){
        $logout = filter_input(INPUT_GET, 'logout', FILTER_SANITIZE_STRING);
        if($logout==true){
            $login->logout();
        }
    }
    
    else if(isset($_POST['updateUser'])){
        require_once 'modules/registrate_user.module.php';
        $registrateUserModule = new RegistrateUserModule($smarty, $mysqli);
        $registrateUserModule->updateUser($user);
    }
    
    else if(isset($_POST['searchBook'], $_POST['searchTerm'])){
        require_once 'modules/search_book.module.php';
        $registrateUserModule = new SearchBookModule($smarty, $mysqli);
        
        $registrateUserModule->search(filter_input(INPUT_POST, 'searchTerm', FILTER_SANITIZE_STRING));
    }
    
    else if(!empty($_GET['book_id'])){
        require_once 'modules/detail_book.module.php';
        $detailBookModule = new DetailBook($smarty, $mysqli);
        $detailBookModule->details($_GET['book_id']);
      
    }
    else if(isset($_GET['duration'])){
        require_once 'modules/lend_book.module.php';
        $lendBookModule = new LendBook($smarty, $mysqli);
        $lendBookModule->request(filter_input(INPUT_GET, 'duration', FILTER_SANITIZE_NUMBER_INT));
    }
    
    else {
        $smarty->display('portal.tpl');
    }
    
    
    
} else {
    header("Location: index.php?err=Da ist etwas schief gelaufen.");
}

