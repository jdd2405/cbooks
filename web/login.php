<?php

require_once 'globals.php';


if(isset($_POST['email']) && isset($_POST['password'])){
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    login($email, $password);
}

function login($email, $password){
    

    if($email=="admin@realnet.ch" && $password=="admin"){
        $_SESSION['auth']=true;
        $_COOKIE['session_id']=  session_id();
        $GLOBALS["smarty"]->assign('email', $email);
        $GLOBALS["smarty"]->display('portal.tpl');
        
    }

    else {
        $_SESSION['auth']=false;
        header("Location:index.php");
    }

}

