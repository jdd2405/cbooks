<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This Module handels the act of lending a book.
 *
 * @author Theresa
 */



class LendBook {
    
    private $smarty;
    private $mysqli;
    
    function __construct($smarty, $mysqli) {
        $this->smarty=$smarty;
        $this->mysqli=$mysqli;
    }
    
    //in DB eintragen und Mail versenden
    function request($duration, $id_personal_book){
        $timestamp = time();
        $date = date('Y-m-d', $timestamp);
        $state = "r";
        $user_id = $_SESSION['user_id'];

        $this->mysqli->query("INSERT INTO `lending_relations` (requestDate, duration, state,lender_id_user, item_id_personal_book) VALUES ('" . $date . "', '" . $duration . "', '" . $state . "','" . $user_id . "', '" . $id_personal_book . "')");
        $this->mysqli->query("UPDATE personal_books SET availability= '" . $state . "' WHERE id_personal_book ='" . $id_personal_book . "'");
        $result=$this->mysqli->query("SELECT email FROM cb_users JOIN personal_books ON id_cb_user = owner_id_user WHERE id_personal_book = $id_personal_book");
        $email = $result->fetch_assoc();
        $result->close();
        
        
        
        //mail
        try {
            $mail = new PHPMailer();
            $mail->IsSMTP();    // Klasse nutzt SMTP
            $body = file_get_contents('templates/requestMail.html');
            $body = stripslashes($body);    // Backslashes enfernt
            $mail->SetFrom("info@cbooks.ch", "cBooks.ch - die Büchertauschplatform");     // Sender Information         
            $mail->AddAddress($email['email']);  // Empfänger information
            $mail->AddReplyTo("info@cbooks.ch", "cBooks.ch - die Büchertauschplatform");  // Spezifiziere ReplyTo Addresse 
            $mail->Subject = "Empfangene Anfrage";
            $mail->AltBody = ""; // Plain-text message body, falls kein HTML email viewer vorhanden
            $mail->MsgHTML($body);
            $mail->send();
        } catch (phpmailerException $e) {   // PHP Mailer Exception
            $e->errorMessage();
        } catch (Exception $e) {
            echo $e->errorMessage();        // allg. Exception
        }



        $this->smarty->assign("alert_success", "Buch wurde angefragt.");
        $this->smarty->display("portal.tpl");
    }

    function accept($idPersonalBook){
        $state= "l";
        
        $this->mysqli->query("UPDATE lending_relations l, personal_books p "
                . "SET l.authorizationDate = CURDATE(), l.state = '" . $state . "', p.availability = '". $state . "' "
                . "WHERE l.item_id_personal_book = p.id_personal_book "
                . "AND l.item_id_personal_book = '". $idPersonalBook ."' AND l.state != 'p'");
        $this->mysqli->query("UPDATE lending_relations SET returnDate = DATE_ADD(authorizationDate, INTERVAL duration WEEK)"
                . " WHERE item_id_personal_book = '". $idPersonalBook ."' AND state != 'p'");
        
        $result=$this->mysqli->query("SELECT first_name, email FROM cb_users WHERE id_cb_user = '".$_SESSION['user_id']."'");
        $owner = $result->fetch_assoc();
        $result->free();
        $result=$this->mysqli->query("SELECT first_name, email FROM cb_users JOIN lending_relations ON id_cb_user = lender_id_user WHERE item_id_personal_book = $idPersonalBook");
        $lender = $result->fetch_assoc();

        $result->close();
        
        
        //mail an ausleihender
        try {
            $mail = new PHPMailer();
            $mail->IsSMTP();    // Klasse nutzt SMTP
            $mail->SetFrom("info@cbooks.ch", "cBooks.ch - die Büchertauschplatform");     // Sender Information         
            $mail->AddAddress($lender['email']);  // Empfänger information
            $mail->AddReplyTo("info@cbooks.ch", "cBooks.ch - die Büchertauschplatform");  // Spezifiziere ReplyTo Addresse 
            $mail->Subject = "Anfrage wurde bestätigt";
            //$mail->AltBody = ""; // Plain-text message body, falls kein HTML email viewer vorhanden
            $mail->Body="Besitzer des Buches ist ".$owner['first_name'].".\n Bitte nimm mit ".$owner['first_name']." über die folgende Mailadresse Kontakt auf: ".$owner['email'].". \n"
                    . "Vielen Dank und viel Spass beim Lesen.";
            $mail->send();
        } catch (phpmailerException $e) {   // PHP Mailer Exception
            $e->errorMessage();
        } catch (Exception $e) {
            echo $e->errorMessage();        // allg. Exception
        }
        
        //mail an besitzer
        try {
            $mail = new PHPMailer();
            $mail->IsSMTP();    // Klasse nutzt SMTP
            $mail->SetFrom("info@cbooks.ch", "cBooks.ch - die Büchertauschplatform");     // Sender Information         
            $mail->AddAddress($owner['email']);  // Empfänger information
            $mail->AddReplyTo("info@cbooks.ch", "cBooks.ch - die Büchertauschplatform");  // Spezifiziere ReplyTo Addresse 
            $mail->Subject = "Abwicklung der Ausleihe";
            //$mail->AltBody = ""; // Plain-text message body, falls kein HTML email viewer vorhanden
            $mail->Body="Die Antragsperson ist ".$lender['first_name'].".\n ".$lender['first_name']." hat deine Emailadresse erhalten und wird sich mit dir in Verbindung setzen. \n"
                    . "Falls du nichts hörst, kannst du auch unter folgender Mailadresse ".$lender['email']." mit ".$lender['first_name']. " in Kontakt treten.";
            $mail->send();
        } catch (phpmailerException $e) {   // PHP Mailer Exception
            $e->errorMessage();
        } catch (Exception $e) {
            echo $e->errorMessage();        // allg. Exception
        }
        
        
        $this->smarty->assign("alert_success", "Buch wurde zur Ausleihe akzeptiert.");
        $this->smarty->display("portal.tpl");
       
    }
    
    function decline($idPersonalBook){
        $result = $this->mysqli->query("SELECT email FROM cb_users JOIN lending_relations ON id_cb_user = lender_id_user WHERE item_id_personal_book = $idPersonalBook");
        $userMail = $result->fetch_assoc();
        $result->free();
        
        $result = $this->mysqli->query("SELECT isbn, title, first_name FROM cb_users 
            JOIN personal_books ON id_cb_user = owner_id_user 
            JOIN lending_relations ON id_personal_book = item_id_personal_book 
            JOIN books ON isbn = id_isbn
            WHERE id_personal_book = $idPersonalBook");
        $requestDetails = $result->fetch_assoc();
        $result->close();
        
        $this->mysqli->query("UPDATE personal_books SET availability= 'a' WHERE id_personal_book = $idPersonalBook");
        $this->mysqli->query("UPDATE lending_relations SET state = 'p' WHERE item_id_personal_book = $idPersonalBook");
        
        
        //Mail an Antragssteller schicken um Ablehnung der Anfrage mitzuteilen
         try {
            $mail = new PHPMailer();
            $mail->IsSMTP();    // Klasse nutzt SMTP
            $mail->SetFrom("info@cbooks.ch", "cBooks.ch - die Büchertauschplatform");     // Sender Information         
            $mail->AddAddress($userMail['email']);  // Empfänger information
            $mail->AddReplyTo("info@cbooks.ch", "cBooks.ch - die Büchertauschplatform");  // Spezifiziere ReplyTo Addresse 
            $mail->Subject = "Die Buchanfrage wurde leider abgelehnt.";
            //$mail->AltBody = ""; // Plain-text message body, falls kein HTML email viewer vorhanden
            $mail->Body="Leider wurde deine Buchanfrage abgelehnt. \n"
                    . "Das angefragte Buch hiess ".$requestDetails['title'].". \n"
                    . "ISBN Numer: ".$requestDetails['isbn']." \n"
                    . "Der Besitzer des Buches war ".$requestDetails['first_name'].". \n"
                    . "Versuche das Buch bei einem anderen User auf der cBooks-Plattform auszuleihen.";
            $mail->send();
        } catch (phpmailerException $e) {   // PHP Mailer Exception
            $e->errorMessage();
        } catch (Exception $e) {
            echo $e->errorMessage();        // allg. Exception
        }
        
        
        $this->smarty->assign("alert_success", "Anfrage wurde abgelehnt");
        $this->smarty->display("portal.tpl");
    }
    
    
    
    
    function removeOrReturn($idPersonalBook, $returnOrRemove){
        
        $this->mysqli->query("UPDATE personal_books SET availability= 'a' WHERE id_personal_book = $idPersonalBook");
        $this->mysqli->query("UPDATE lending_relations SET state = 'p' WHERE item_id_personal_book = $idPersonalBook");
                
        if ($returnOrRemove=="remove"){
            $this->smarty->assign("alert_success", "Buchantrag wurde gelöscht.");
            $this->smarty->display("portal.tpl");
        }
        else{
            $this->smarty->assign("alert_success", "Buch wurde zurückgebracht.");
            $this->smarty->display("portal.tpl");
        } 
    }
    
    
    function alert(){
        $query= "SELECT title, DATE_FORMAT(returnDate,'%d.%m.%Y') AS returnDate, id_personal_book FROM lending_relations JOIN personal_books ON item_id_personal_book = id_personal_book"
                . " JOIN books ON isbn = id_isbn WHERE lender_id_user = '".$_SESSION['user_id']."' AND"
                . " returnDate BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
            
            $result = $this->mysqli->query($query);
            $alertbooks = $result->fetch_all(MYSQLI_ASSOC);
            
           
            $this->smarty->assign("alertbooks", $alertbooks);
            $result->close();
    }

    
    function statement($number){
        $id=$_SESSION['user_id'];
        
        //Empfangene Anfragen
        if($number==1){
            $query= "SELECT * FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn "
            . "JOIN books_has_authors bha ON b.id_isbn = bha.books_id_isbn "
            . "JOIN authors a ON bha.authors_id_author = a.id_author "
            . "WHERE l.state ='r' AND p.owner_id_user =$id";
            
            $result = $this->mysqli->query($query);
            $received = $result->fetch_all(MYSQLI_ASSOC);

            $this->smarty->assign("lists", $received);
            $result->close();
            
            $lendingListTitle= "Empfangene Anfragen";    
        }
        
        //Offene Anfragen
        else if($number==2){
            $query= "SELECT * FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn "
            . "JOIN books_has_authors bha ON b.id_isbn = bha.books_id_isbn "
            . "JOIN authors a ON bha.authors_id_author = a.id_author "
            . "WHERE l.state ='r' AND l.lender_id_user =$id";
            
            $result = $this->mysqli->query($query);
            $requests = $result->fetch_all(MYSQLI_ASSOC);
            
            $this->smarty->assign("lists", $requests);
            $result->close();
            
            $lendingListTitle= "Offene Anfragen";
        }
        
        //Geliehene Bücher
        else if ($number==3) {
            $query= "SELECT * FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn "
            . "JOIN books_has_authors bha ON b.id_isbn = bha.books_id_isbn "
            . "JOIN authors a ON bha.authors_id_author = a.id_author "
            . "WHERE l.state ='l' AND l.lender_id_user =$id";
            
            $result = $this->mysqli->query($query);
            $borrowed = $result->fetch_all(MYSQLI_ASSOC);
            
            $this->smarty->assign("lists", $borrowed);
            $result->close();
            
            $lendingListTitle= "Geliehene Bücher";
        }
        
        //Verliehene Bücher
        else {
            $query= "SELECT * FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn "
            . "JOIN books_has_authors bha ON b.id_isbn = bha.books_id_isbn "
            . "JOIN authors a ON bha.authors_id_author = a.id_author "
            . "WHERE l.state ='l' AND p.owner_id_user =$id";
            
            $result = $this->mysqli->query($query);
            $lended = $result->fetch_all(MYSQLI_ASSOC);
            
            $this->smarty->assign("lists", $lended);
            $result->close();
            
            $lendingListTitle= "Verliehene Bücher";
        }
        
        $this->smarty->assign("lendingListTitle", $lendingListTitle);
        $this->smarty->display('lending_list.tpl');
        
    }
    
    
    function badgeUpdate(){
        $id=$_SESSION['user_id'];
        
        $query= "SELECT * FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn WHERE l.state ='r' AND p.owner_id_user =$id";
        $result = $this->mysqli->query($query);
        $rowsList1 = $result->num_rows;
        $result->free();
        
        $query= "SELECT * FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn WHERE l.state ='r' AND l.lender_id_user =$id";
        $result = $this->mysqli->query($query);
        $rowsList2 = $result->num_rows;
        $result->free();
        
        
        $query= "SELECT * FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn WHERE l.state ='l' AND l.lender_id_user =$id";
        $result = $this->mysqli->query($query);
        $rowsList3 = $result->num_rows;
        $result->free();
        
        
        $query= "SELECT * FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn WHERE l.state ='l' AND p.owner_id_user =$id";
        $result = $this->mysqli->query($query);
        $rowsList4 = $result->num_rows;
        $result->close();
        
        $this->smarty->assign("rowsList1",$rowsList1);
        $this->smarty->assign("rowsList2",$rowsList2);
        $this->smarty->assign("rowsList3",$rowsList3);
        $this->smarty->assign("rowsList4",$rowsList4);
        
    }
    
    
    //Cronjob
    function checkLendingRelations(){
        $query="SELECT b.title, a.aut_name, p.isbn, u.email, u.first_name, DATE_FORMAT(l.returnDate,'%d.%m.%Y') AS returnDate "
                . "FROM lending_relations l JOIN cb_users u ON  l.lender_id_user = u.id_cb_user "
                . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
                . "JOIN books b ON p.isbn = b.id_isbn "
                . "JOIN books_has_authors bha ON b.id_isbn = bha.books_id_isbn "
                . "JOIN authors a ON bha.authors_id_author = id_author"
                . "WHERE l.state = 'l' AND"
                . "returnDate = DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
        
        
        if ($result = $this->mysqli->query($query)) {

            /* fetch object array */
            while ($reminderData = $result->fetch_assoc()) {
                try {
                    $mail = new PHPMailer();
                    $mail->IsSMTP();    // Klasse nutzt SMTP
                    $mail->SetFrom("info@cbooks.ch", "cBooks.ch - die Büchertauschplatform");     // Sender Information         
                    $mail->AddAddress($reminderData['email']);  // Empfänger information
                    $mail->AddReplyTo("info@cbooks.ch", "cBooks.ch - die Büchertauschplatform");  // Spezifiziere ReplyTo Addresse 
                    $mail->Subject = "Reminder-Mail";
                    //$mail->AltBody = ""; // Plain-text message body, falls kein HTML email viewer vorhanden
                    $mail->Body = "Hallo ".$reminderData['first_name']."\n "
                            . "Die Ausleihdauer des Buches ".$reminderData['title']." von ".$reminderData['aut_name']." läuft am ".$reminderData['returnDate']." ab. \n"
                            . "Bitte bringe das Buch zurück. \n"
                            . "Dein cBooks.ch Team";
                    $mail->send();
                } catch (phpmailerException $e) {   // PHP Mailer Exception
                    $e->errorMessage();
                } catch (Exception $e) {
                    echo $e->errorMessage();        // allg. Exception
                }
            }

            /* free result set */
            $result->close();
        }
    }
}
