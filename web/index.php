<?php
/**
 * Example Application
 *
 * @package Example-application
 */

require_once 'globals.php';
require_once 'includes/db.inc.php';


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
     

      




$smarty->display('index.tpl');
