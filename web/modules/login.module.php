<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Jonas
 */
class LoginModule {

    function __construct($smarty, $mysqli) {
        $this->smarty = $smarty;
        $this->mysqli = $mysqli;
        
        $this->sec_session_start();
    }

    function login($email, $password) {

        // Das Benutzen vorbereiteter Statements verhindert SQL-Injektion.
        if ($stmt = $this->mysqli->prepare("SELECT id_cb_user, email, password, salt 
            FROM cb_users WHERE email = ? LIMIT 1")) {
            $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
            $stmt->execute();    // Führe die vorbereitete Anfrage aus.
            $stmt->store_result();

            // hole Variablen von result.
            $stmt->bind_result($user_id, $email, $db_password, $salt);
            $stmt->fetch();

            // hash das Passwort mit dem eindeutigen salt.
            $password = hash('sha512', $password . $salt);
            if ($stmt->num_rows == 1) {
                // Wenn es den Benutzer gibt, dann wird überprüft ob das Konto
                // blockiert ist durch zu viele Login-Versuche 

                if ($this->checkbrute($user_id, $this->mysqli) == true) {
                    // Konto ist blockiert 
                    // Schicke E-Mail an Benutzer, dass Konto blockiert ist
                    return false;
                } else {
                    // Überprüfe, ob das Passwort in der Datenbank mit dem vom
                    // Benutzer angegebenen übereinstimmt.
                    if ($db_password == $password) {
                        // Passwort ist korrekt!
                        // Hole den user-agent string des Benutzers.
                        $user_browser = $_SERVER['HTTP_USER_AGENT'];
                        // XSS-Schutz, denn eventuell wir der Wert gedruckt
                        $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                        $_SESSION['user_id'] = $user_id;

                        $_SESSION['email'] = email;
                        $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                        // Login erfolgreich.
                        header('Location: portal.php');
                    } else {
                        // Passwort ist nicht korrekt
                        // Der Versuch wird in der Datenbank gespeichert
                        $now = time();
                        $this->mysqli->query("INSERT INTO login_attempts(id_cb_user, time)
                                        VALUES ('$user_id', '$now')");
                        $this->smarty->assign("alert_warning", "Ooops! Da stimmt was nicht.");
                        $this->smarty->display("index.tpl");
                    }
                }
            } else {
                //Es gibt keinen Benutzer.
                $this->smarty->assign("alert_warning", "Ooops! Da stimmt was nicht.");
                $this->smarty->display("index.tpl");
            }
        }
    }

    // start secure session to avoid XSS attack
    function sec_session_start() {
        $session_name = 'sec_session_id';   // define name of session
        $secure = SECURE;
        // to avoid access to session id via JavaScript.
        $httponly = true;
        // Zwingt die Sessions nur Cookies zu benutzen.
        if (ini_set('session.use_only_cookies', 1) === FALSE) {
            header("Location: ../index.php?err=Could not initiate a safe session (ini_set)");
            exit();
        }
        // Holt Cookie-Parameter.
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
        // Setzt den Session-Name zu oben angegebenem.
        session_name($session_name);
        session_start();            // Startet die PHP-Sitzung 
        session_regenerate_id();    // Erneuert die Session, löscht die alte. 
    }

    function checkbrute($user_id) {
        // Hole den aktuellen Zeitstempel 
        $now = time();

        // Alle Login-Versuche der letzten zwei Stunden werden gezählt.
        $valid_attempts = $now - (2 * 60 * 60);

        if ($stmt = $this->mysqli->prepare("SELECT time FROM login_attempts
                            WHERE id_cb_user = ? AND time > '$valid_attempts'")) {
            $stmt->bind_param('i', $user_id);

            // Führe die vorbereitet Abfrage aus. 
            $stmt->execute();
            $stmt->store_result();

            // Wenn es mehr als 5 fehlgeschlagene Versuche gab 
            if ($stmt->num_rows > 5) {
                return true;
            } else {
                return false;
            }
        }
    }

    function check_login() {
        // Überprüfe, ob alle Session-Variablen gesetzt sind 
        if (isset($_SESSION['user_id'], $_SESSION['email'], $_SESSION['login_string'])) {

            $user_id = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];
            $email = $_SESSION['email'];

            // Hole den user-agent string des Benutzers.
            $user_browser = $_SERVER['HTTP_USER_AGENT'];

            if ($stmt = $this->mysqli->prepare("SELECT password 
                                      FROM cb_users 
                                      WHERE id_cb_user = ? LIMIT 1")) {
                // Bind "$user_id" zum Parameter. 
                $stmt->bind_param('i', $user_id);
                $stmt->execute();   // Execute the prepared query.
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    // Wenn es den Benutzer gibt, hole die Variablen von result.
                    $stmt->bind_result($password);
                    $stmt->fetch();
                    $login_check = hash('sha512', $password . $user_browser);

                    if ($login_check == $login_string) {
                        // Eingeloggt!!!!
                        $this->smarty->assign("isLoggedIn", "true");
                        return true;
                    } else {
                        // Nicht eingeloggt
                        header("Location: ../index.php?err=Could not initiate a safe session (ini_set)");
                    }
                } else {
                    // Nicht eingeloggt
                    return false;
                }
            } else {
                // Nicht eingeloggt
                return false;
            }
        } else {
            // Nicht eingeloggt
            return false;
        }
    }

    function logout() {
        // Setze alle Session-Werte zurück 
        $_SESSION = array();

        // hole Session-Parameter 
        $params = session_get_cookie_params();

        // Lösche das aktuelle Cookie. 
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

        // Vernichte die Session 
        session_destroy();
    }

}
