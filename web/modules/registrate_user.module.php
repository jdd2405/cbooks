<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registrate
 *
 * @author Jonas
 */
date_default_timezone_set('Europe/Zurich');

require_once('mail/class.phpmailer.php');
require_once('mail/class.smtp.php');
require_once 'classes/User.class.php';

class RegistrateUserModule {

    private $smarty;
    private $mysqli;

    function __construct($smarty, $mysqli) {
        $this->smarty = $smarty;
        $this->mysqli = $mysqli;
    }

    function registrateUser() {

        if (isset($_POST['registrateEmail'], $_POST['registratePassword'], $_POST['registrateConfirmpwd'])) {
            // Bereinige und überprüfe die Daten
            $email = filter_input(INPUT_POST, 'registrateEmail', FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $error_msg = NULL;


            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // keine gültige E-Mail
                $error_msg .= 'The email address you entered is not valid';
            }

            $password = filter_input(INPUT_POST, 'registratePassword', FILTER_SANITIZE_STRING);
            $confirmpwd = filter_input(INPUT_POST, 'registrateConfirmpwd', FILTER_SANITIZE_STRING);

            if (!$password == $confirmpwd) {
                $error_msg .= "Da ist ein Fehler aufgetreten";
            }
            /* if (strlen($password) != 128) {
              // Das gehashte Passwort sollte 128 Zeichen lang sein.
              // Wenn nicht, dann ist etwas sehr seltsames passiert
              $error_msg .= '<p class="error">Invalid password configuration.</p>';
              echo $error_msg;
              } */

            // Benutzername und Passwort wurde auf der Benutzer-Seite schon überprüft.
            // Das sollte genügen, denn niemand hat einen Vorteil, wenn diese Regeln   
            // verletzt werden.
            //
    else {



                if ($result = $this->mysqli->query("SELECT user_id FROM cb_users WHERE email = " . $email . " LIMIT 1")) {
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


                if ($this->mysqli->query("INSERT INTO cb_users (email, password, salt) VALUES ('" . $email . "', '" . $password . "', '" . $random_salt . "')") === FALSE) {
                    $error_msg = "Registration failure: INSERT";
                    $this->smarty->assign("alert_warning", $error_msg);
                    $this->smarty->display("index.tpl");
                } else {

                    $info_msg = "Ihre Registration war erfolgreich. Herzlich Willkommen bei cBooks.ch.";
                    $this->smarty->assign("alert_info", $info_msg);
                    $this->smarty->display("index.tpl");

                    try {
                        $mail = new PHPMailer();
                        $mail->IsSMTP();    // Klasse nutzt SMTP
                        $mail->SMTPAuth = true; // für SMTP Authentifizierung  
                        $mail->SMTPSecure = "ssl"; // setzt Präfix 
                        $mail->Host = 'mail.cbooks.ch'; // // setzt GMX als SMTP server
                        $mail->Port = '465'; // setzt den SMTP port (=> Port 993 ist nötig für eine SSL Verbindung)
                        $mail->Username = "info@cbooks.ch";
                        $mail->Password = "r34dB00ks";
                        $mail->CharSet = 'utf-8';
                        $mail->SMTPDebug = 0; //    für SMTP debug information (für Testen) 1 = errors and messages 2 = messages only
                        $body = file_get_contents('templates/registrationMail.html');
                        $body = stripslashes($body);    // Backslashes enfernt
                        $mail->SetFrom("info@cbooks.ch", "cBooks.ch - die Büchertauschplatform");     // Sender Information         
                        $mail->AddAddress($email, "");  // Empfänger information
                        $mail->AddReplyTo("info@cbooks.ch", "cBooks.ch - die Büchertauschplatform");  // Spezifiziere ReplyTo Addresse
                        //$mail->AddCC("jonas.daester@gmail.com");   // CC Information 
                        $mail->Subject = "Herzlich Willkommen bei cBooks.ch";
                        $mail->AltBody = ""; // Plain-text message body, falls kein HTML email viewer vorhanden
                        $mail->MsgHTML($body);
                        $mail->AddAttachment("img/v2.png");      // Attachment
                        $mail->send();
                    } catch (phpmailerException $e) {   // PHP Mailer Exception
                        $e->errorMessage();
                    } catch (Exception $e) {
                        echo $e->errorMessage();        // allg. Exception
                    }
                }
            }
        } else {
            echo "WTF!";
        }
    }

    function updateUser($user) {

        if (isset($_POST['updateFirstName'], $_POST['updateFamilyName'], $_POST['updateStreet'], $_POST['updateZIP'], $_POST['updateCity'], $_POST['updateEmail'], $_POST['updateTel'])) {
            $user->first_name = filter_input(INPUT_POST, 'updateFirstName', FILTER_DEFAULT);
            $user->family_name = filter_input(INPUT_POST, 'updateFamilyName', FILTER_DEFAULT);
            $user->street = filter_input(INPUT_POST, 'updateStreet', FILTER_DEFAULT);
            $user->zip = filter_input(INPUT_POST, 'updateZIP', FILTER_SANITIZE_NUMBER_INT);
            $user->city = filter_input(INPUT_POST, 'updateCity', FILTER_DEFAULT);
            $user->email = filter_input(INPUT_POST, 'updateEmail', FILTER_SANITIZE_EMAIL);
            $user->tel = filter_input(INPUT_POST, 'updateTel', FILTER_SANITIZE_NUMBER_INT);



            if ($stmt = $this->mysqli->prepare("
                    UPDATE cb_users 
                    SET email=?, first_name=?, family_name=?, street=?, zip=?, city=?, tel=?
                    WHERE id_cb_user = ?
                ")) {

                // Bind "$user_id" zum Parameter. 
                @$stmt->bind_param('ssssisii', $user->email, $user->first_name, $user->family_name, $user->street, $user->zip, $user->city, $user->tel, $user->user_id);

                if ($stmt->execute()) {
                    $this->smarty->assign('alert_success', "Deine Angaben wurden gespeichert.");
                    $this->smarty->display('portal.tpl');
                } else {
                    $this->smarty->assign('alert_warning', "Da ist etwas schief gegangen.");
                    $smarty->display('portal.tpl');
                }
            } else {
                $this->smarty->assign('alert_warning', "Statement failed");
                $smarty->display('portal.tpl');
            }
        } else {
            $this->smarty->assign('alert_warning', "No values inserted.");
            $smarty->display('portal.tpl');
        }
    }

}
