<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of settings
 *
 * @author Jonas
 */
require_once('classes/User.class.php');
require_once('mail/class.phpmailer.php');
require_once('mail/class.smtp.php');

class SettingsModule {

    function __construct($smarty, $mysqli) {
        $this->smarty = $smarty;
        $this->mysqli = $mysqli;
    }
    
    public function changePassword($password, $confirmPwd){
        
        if($password==$confirmPwd){
        
            if ($stmt = $this->mysqli->prepare("UPDATE cb_users
                                          SET password=?, salt=?
                                          WHERE id_cb_user = ".$_SESSION['user_id'])) {


                $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

                // Erstelle zufälliges saltet Passwort 
                $password = hash('sha512', $password . $random_salt);

                    // Bind "$user_id" zum Parameter. 
                    $stmt->bind_param('ss', $password, $random_salt);
                    $stmt->execute();   // Execute the prepared query.
                    $this->smarty->assign("alert_info", "Dein Passwort wurde geändert.");
                    $this->smarty->display("portal.tpl");
            }
        }
        else {
            $this->smarty->assign("alert_error", "Deine Passwörter stimmen nicht überein. Bitte versuche es nochmals.");
            $this->smarty->display('portal.tpl');
        }
    }
}
