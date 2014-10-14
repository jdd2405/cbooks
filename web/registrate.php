<?php


require_once 'globals.php';
require_once 'includes/db.inc.php';
require_once 'includes/functions.php';



if (isset($_POST['email'], $_POST['password'], $_POST['confirmpwd'])) {
    // Bereinige und überprüfe die Daten
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // keine gültige E-Mail
        $error_msg .= 'The email address you entered is not valid';
    }
 
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirmpwd = filter_input(INPUT_POST, 'confirmpwd', FILTER_SANITIZE_STRING);
    
    if (!$password==$confirmpwd){
        $error_msg .= "Da ist ein Fehler aufgetreten";
    }
    /*if (strlen($password) != 128) {
            // Das gehashte Passwort sollte 128 Zeichen lang sein.
            // Wenn nicht, dann ist etwas sehr seltsames passiert
            $error_msg .= '<p class="error">Invalid password configuration.</p>';
            echo $error_msg;
        }*/

        // Benutzername und Passwort wurde auf der Benutzer-Seite schon überprüft.
        // Das sollte genügen, denn niemand hat einen Vorteil, wenn diese Regeln   
        // verletzt werden.
        //
    else {
        


        if ($result = $mysqli->query("SELECT user_id FROM cb_users WHERE email = ".$email." LIMIT 1")) {
            if ($result->num_rows == 1) {
                // Ein Benutzer mit dieser E-Mail-Adresse existiert schon
                $error_msg .= '<p class="error">A user with this email address already exists.</p>';
            }

            /* free result set */
            $result->close();
        }
        
        
    }
    
    // Noch zu tun: 
    // Wir müssen uns noch um den Fall kümmern, wo der Benutzer keine
    // Berechtigung für die Anmeldung hat indem wir überprüfen welche Art 
    // von Benutzer versucht diese Operation durchzuführen.
 
    if (empty($error_msg)) {
        // Erstelle ein zufälliges Salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
        // Erstelle saltet Passwort 
        $password = hash('sha512', $password . $random_salt);
 
        // Trage den neuen Benutzer in die Datenbank ein 
        
        
        if ($mysqli->query("INSERT INTO cb_users (email, password, salt) VALUES ('".$email."', '".$password."', '".$random_salt."')") === FALSE) {
            $error_msg="Registration failure: INSERT";
            $smarty->assign("alert_warning", $error_msg);
            $smarty->display("index.tpl");
        }
        
        else {
            
            $info_msg = "Ihre Registration war erfolgreich. Herzlich Willkommen bei cBooks.ch.";
            $smarty->assign("alert_info", $info_msg);
            $smarty->display("index.tpl");
        }
    }
}

else {
    echo "WTF!";
}
    
    
    
    
    
    //$smarty->assign("alert_error", $msg);
    //$smarty->display('index.tpl');
    




