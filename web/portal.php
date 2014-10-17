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


// Check authentification always
require_once 'modules/login.module.php';
$login = new LoginModule($smarty, $mysqli);
if ($login->check_login($mysqli) == true) {


// Füge den Seiteninhalt hier ein!

    $smarty->assign("mainPage", "portal.php");

    $query = "SELECT * FROM books";
    $result = $mysqli->query($query);
    $numberOfRows = $result->num_rows;

    $summary = array(array(), array());
    $counter = 0;

    while ($row = mysqli_fetch_array($result)) {

        for ($i = 0; $i < 4; $i++) {
            $summary[$counter][$i] = $row[$i];
        }
        $counter++;
    }




    $smarty->assign('array', $summary);
    $smarty->assign('number', $numberOfRows);
    $smarty->assign('counter', $counter);

    $smarty->display('portal.tpl');
    
    
    if(isset($_GET['logout'])){
        $logout = filter_input(INPUT_GET, 'logout', FILTER_SANITIZE_STRING);
        if($logout==true){
            $login->logout();
        }
    }
    
    
    
} else {
    $smarty->assign("alert_error", "Sie wurden ausgeloggt.");
    $smarty->display("index.tpl");
}