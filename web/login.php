<?php

require 'index.php';


if(isset($_GET['username']) && isset($_GET['password'])){
    $username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_GET, 'password', FILTER_DEFAULT);
    login($username, $password);
}

function login($username, $password){
    

    if($username=="admin" && $password=="admin"){
        $_SESSION['auth']=true;
        $_COOKIE['session_id']=  session_id();
        $GLOBALS["smarty"]->display('portal.tpl');
    }

    else {
        $_SESSION['auth']=false;
        header("Location:index.php");
    }

}

