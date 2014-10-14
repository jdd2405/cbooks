<?php
/**
 * Example Application
 *
 * @package Example-application
 */

require_once 'globals.php';
require_once '../includes/db.inc.php';
require_once '../includes/functions.php';

sec_session_start(); 
if(login_check($mysqli) == true) {
        // Füge den Seiteninhalt hier ein!


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



  
  $smarty->assign('array', $summary);
  $smarty->assign('number', $numberOfRows);
  $smarty->assign('counter', $counter);
     

      




$smarty->display('portal.tpl');

} else { 
        echo 'You are not authorized to access this page, please login.';
}