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
    
    //Angefragte Bücher
    $id=$_SESSION['user_id'];
    if ($result = $mysqli->query("SELECT id_lending_relation, DATE_FORMAT(requestDate,'%d.%m.%Y') AS requestDate FROM lending_relations WHERE lender_id_user = $id AND state = 'r'")) {

        /* fetch value */   
        $requests = $result->fetch_all(MYSQLI_ASSOC);
        //print_r($books);
        $smarty->assign("requests", $requests);
            /* close statement */
        $result->close();
    }
    
    //Anfragen deiner Bücher
    $query= "SELECT title, id_isbn, first_name, city, duration, id_lending_relation, item_id_personal_book, DATE_FORMAT(requestDate, '%d.%m.%Y') AS requestDate FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn WHERE l.state ='r' AND p.owner_id_user =$id";
    
    if ($result = $mysqli->query($query)) {

        /* fetch value */   
        $confirms = $result->fetch_all(MYSQLI_ASSOC);
      
        $smarty->assign("confirms", $confirms);
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
    
    else if(isset($_GET['searchBook'])){
        require_once 'modules/search_book.module.php';
        $searchBookModule = new SearchBookModule($smarty, $mysqli);

        $searchBookModule->search(filter_input(INPUT_GET, 'searchBook', FILTER_SANITIZE_STRING));
    }
    
    else if(!empty($_GET['book_id'])){
        require_once 'modules/detail_book.module.php';
        $detailBookModule = new DetailBook($smarty, $mysqli);
        $detailBookModule->details(filter_input(INPUT_GET,'book_id', FILTER_SANITIZE_NUMBER_INT));
      
    }
    else if(isset($_GET['duration'], $_GET['id_personal_book'])){
        require_once 'modules/lend_book.module.php';
        $lendBookModule = new LendBook($smarty, $mysqli);
        $lendBookModule->request(filter_input(INPUT_GET, 'duration', FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, 'id_personal_book', FILTER_SANITIZE_NUMBER_INT));
    }
    
    else if(isset($_POST['lendingRelation'])){
        require_once 'modules/lend_book.module.php';
        $acceptRequest = new LendBook($smarty, $mysqli);
        $acceptRequest->accept(filter_input(INPUT_POST, 'lendingRelation', FILTER_SANITIZE_NUMBER_INT));
    }
    
    else if(isset($_GET['isbn'])){
        require_once 'modules/registrate_book.module.php';
        $registrateBookModule = new registrateBookModule($smarty, $mysqli);
        $registrateBookModule->searchBookByIsbn(filter_input(INPUT_GET, 'isbn', FILTER_DEFAULT));
    }
    
    else {
        $smarty->display('portal.tpl');
    }
    
    
    
} else {
    header("Location: index.php?err=Da ist etwas schief gelaufen.");
}

