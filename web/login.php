<?php

require 'libs/Smarty.class.php';

if(isset($_GET['username']) && isset($_GET['password'])){
    $username = $_GET['username'];
    $password = $_GET['password'];
    
    if($username=="admin" && $password=="admin"){
        $_SESSION['auth']=true;
        $_COOKIE['session_id']=  session_id();
        $smarty->display('portal.tpl');
    }
    
    else {
        $_SESSION['auth']=false;
        header("Location:index.php");
    }
    
}

