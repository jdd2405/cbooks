<?php

/**
 * Example Application
 *
 * @package Example-application
 */
header("Content-Type: text/html; charset=utf-8");
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");

define("SECURE", FALSE);    // NUR FÜR DIE ENTWICKLUNG!!!!
// Setup DB
$mysqli = new mysqli("194.126.200.55", "cbooksch_dev", "r34d_b00k$", "cbooksch_dev");
$mysqli->query("SET NAMES 'utf8'");

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


// Setup PHPMailer
require_once('mail/class.phpmailer.php');
require_once('mail/class.smtp.php');


// Check authentification
require_once 'modules/login.module.php';
require_once 'classes/User.class.php';
$login = new LoginModule($smarty, $mysqli);
$user = $login->check_login();
if ($user->isLoggedIn == true) {

    $smarty->assign("path", "portal.php");

    require_once 'modules/lend_book.module.php';
    require_once 'modules/statistics.module.php';

    $privateStats = new statisticsModule($smarty, $mysqli);
    $privateStats->getPrivateStats($user);

    $alert = new LendBook($smarty, $mysqli);
    $alert->alert();
    $alert->badgeUpdate();
    
    
    if (isset($_GET['logout'])) {
        $logout = filter_input(INPUT_GET, 'logout', FILTER_SANITIZE_STRING);
        if ($logout == true) {
            $login->logout();
        }
    } else if (isset($_POST['updateUser'])) {
        require_once 'modules/registrate_user.module.php';
        $registrateUserModule = new RegistrateUserModule($smarty, $mysqli);
        $registrateUserModule->updateUser($user);
    } else if (isset($_POST['changePassword'])) {
        require_once 'modules/settings.module.php';
        $settingsModule = new SettingsModule($smarty, $mysqli);
        $settingsModule->changePassword(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), filter_input(INPUT_POST, 'confirmPwd', FILTER_SANITIZE_STRING));
    } else if (isset($_GET['searchBook'])) {
        require_once 'modules/search_book.module.php';
        $searchBookModule = new SearchBookModule($smarty, $mysqli);

        $searchBookModule->search(filter_input(INPUT_GET, 'searchBook', FILTER_SANITIZE_STRING));
    } else if (isset($_GET['allPersonalBooks'])) {
        require_once 'modules/statistics.module.php';
        $listdetails = new statisticsModule($smarty, $mysqli);
        $listdetails->allPersonalBooks();
    } else if (!empty($_GET['book_id'])) {
        require_once 'modules/detail_book.module.php';
        $detailBookModule = new DetailBook($smarty, $mysqli);
        $detailBookModule->details(filter_input(INPUT_GET, 'book_id', FILTER_SANITIZE_NUMBER_INT));
    } else if (isset($_GET['duration'], $_GET['id_personal_book'])) {
        require_once 'modules/lend_book.module.php';
        $lendBookModule = new LendBook($smarty, $mysqli);
        $lendBookModule->request(filter_input(INPUT_GET, 'duration', FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, 'id_personal_book', FILTER_SANITIZE_NUMBER_INT));
    } else if (isset($_GET['registrateBookWithISBN'])) {
        require_once 'modules/registrate_book.module.php';
        $registrateBookModule = new registrateBookModule($smarty, $mysqli);
        $registrateBookModule->searchBookByIsbn(filter_input(INPUT_GET, 'registrateBookWithISBN', FILTER_DEFAULT));
        
    } else if(isset($_GET['editBook'])){
        require_once 'modules/edit_Book.module.php';
        $editBookModule = new editBook($smarty, $mysqli);
        $editBookModule->updateCompleteBook();
                
    } else if (isset($_GET['registrateBook'])) {
        require_once 'modules/registrate_book.module.php';
        $insertBook = new registrateBookModule($smarty, $mysqli);
        $insertBook->insertPersonalBook();
        
    } else if (isset($_GET['list'])) {
        require_once 'modules/lend_book.module.php';
        $listdetails = new LendBook($smarty, $mysqli);
        $listdetails->statement(filter_input(INPUT_GET, 'list', FILTER_SANITIZE_NUMBER_INT));
    } else if (isset($_GET['accept'])) {
        require_once 'modules/lend_book.module.php';
        $acceptRequest = new LendBook($smarty, $mysqli);
        $acceptRequest->accept(filter_input(INPUT_GET, 'accept', FILTER_SANITIZE_NUMBER_INT));
    } else if (isset($_GET['decline'])) {
        require_once 'modules/lend_book.module.php';
        $declineRequest = new LendBook($smarty, $mysqli);
        $declineRequest->decline(filter_input(INPUT_GET, 'decline', FILTER_SANITIZE_NUMBER_INT));
    } else if (isset($_GET['RemoveOrReturn'], $_GET['ID'])) {
        require_once 'modules/lend_book.module.php';
        $removeRequest = new LendBook($smarty, $mysqli);
        $removeRequest->removeOrReturn(filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, 'RemoveOrReturn', FILTER_SANITIZE_STRING));
    }



    // Check for warning and info messages
    else if (isset($_GET['warning'])) {
        $smarty->assign("alert_warning", filter_input(INPUT_GET, 'warning', FILTER_SANITIZE_STRING));
        $smarty->display('portal.tpl');
    } 
    else if (isset($_GET['info'])) {
        $smarty->assign("alert_info", filter_input(INPUT_GET, 'info', FILTER_SANITIZE_STRING));
        $smarty->display('portal.tpl');
    }

    else if (isset($_GET['page'])) {
        $smarty->display(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING) . ".tpl");
    } 
    
    else {
        $smarty->display('portal.tpl');
    }
} else {
    header("Location: index.php?warning=Da ist etwas schief gelaufen.");
}

