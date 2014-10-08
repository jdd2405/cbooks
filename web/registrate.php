<?php


require_once 'globals.php';
require_once 'db.php';


$password;
$email;
$msg;

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    
    $user = new user($email, $password);
    
    $query = "INSERT INTO `user` (`id_user`, `email`, `pword`, `access_right`, `first_name`, `family_name`, `street`, `street_num`, `zip`, `city`, `country`, `reg_date`, `last_activity`) VALUES (NULL, '".$user->email."', '".$user->password."', '".$user->access_right."', '".$user->first_name."', '".$user->family_name."', '".$user->street."', '".$user->street_num."', '".$user->zip."', '".$user->city."', '".$user->country."', '".$user->reg_date."', ''".$user->last_activity."'');";

    if ($mysqli->query($query) === TRUE) {
        $msg = "Ein neuer Benutzer mit der E-Mail-Adresse ".$user->email." wurde hinzugefügt\n";
    }
    else {
        printf("Error: ". $mysqli->error);    
    }
    
    $mysqli->close();
    
    $smarty->assign("alert_info", $msg);
    $smarty->display('index.tpl');
    
}



