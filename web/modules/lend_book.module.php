<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lend_book
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
        $timestamp= time();
        $date=  date('Y-m-d',$timestamp);
        $state = "r";
        $user_id = $_SESSION['user_id'];
       
        $this->mysqli->query("INSERT INTO `lending_relations` (requestDate, duration, state,lender_id_user, item_id_personal_book) VALUES ('" . $date . "', '" . $duration . "', '" . $state . "','" . $user_id . "', '" . $id_personal_book . "')");
        $this->mysqli->query("UPDATE personal_books SET availability= '" . $state . "' WHERE id_personal_book ='". $id_personal_book ."'");
        
        //mail
        //$text= "Hallo \n Sie haben eine Buchanfrage erhalten.";
        //mail('t547490@hotmail.com', 'Testmail', $text);
        
        header("Location: portal.php?err=Es konnte keine sichere Session gestartet werden.");
    }

    
    function accept($lendingRelation){
        $state= "l";
        
        $this->mysqli->query("UPDATE lending_relations l, personal_books p "
                . "SET l.authorizationDate = CURDATE(), l.state = '" . $state . "', p.availability = '". $state . "' "
                . "WHERE l.item_id_personal_book = p.id_personal_book "
                . "AND l.item_id_personal_book = '". $lendingRelation ."'");
        $this->mysqli->query("UPDATE lending_relations SET returnDate = DATE_ADD(authorizationDate, INTERVAL duration WEEK)"
                . " WHERE item_id_personal_book = '". $lendingRelation ."'");
        
        header("Location: portal.php?err=Es konnte keine sichere Session gestartet werden.");
       
    }
    
    
    
        function DB(){
        //Angefragte Bücher
        $id=$_SESSION['user_id'];
        $result = $this->mysqli->query("SELECT id_lending_relation, DATE_FORMAT(requestDate,'%d.%m.%Y') AS requestDate FROM lending_relations WHERE lender_id_user = $id AND state = 'r'");

        /* fetch value */   
        $requests = $result->fetch_all(MYSQLI_ASSOC);
        //print_r($books);
        $this->smarty->assign("requests", $requests);
            /* close statement */
        $result->close();
        
        //Anfragen deiner Bücher
        $query= "SELECT title, id_isbn, first_name, city, duration, id_lending_relation, item_id_personal_book, DATE_FORMAT(requestDate, '%d.%m.%Y') AS requestDate FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn WHERE l.state ='r' AND p.owner_id_user =$id";
    
        $result = $this->mysqli->query($query);

        /* fetch value */   
        $confirms = $result->fetch_all(MYSQLI_ASSOC);
      
        $this->smarty->assign("confirms", $confirms);
            /* close statement */
        $result->close();
        
        //Ausgeliehene Bücher
        $query= "SELECT title, id_isbn, first_name, city, duration, id_lending_relation, item_id_personal_book, DATE_FORMAT(returnDate, '%d.%m.%Y') AS returnDate, DATE_FORMAT(requestDate, '%d.%m.%Y') AS requestDate FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn WHERE l.state ='l' AND l.lender_id_user =$id";
    
        $result = $this->mysqli->query($query);

        /* fetch value */   
        $borrowed = $result->fetch_all(MYSQLI_ASSOC);
      
        $this->smarty->assign("borrowed", $borrowed);
            /* close statement */
        $result->close();
        
        //Meine geliehenen Bücher
        $query= "SELECT title, id_isbn, first_name, city, duration, id_lending_relation, item_id_personal_book, DATE_FORMAT(returnDate, '%d.%m.%Y') AS returnDate, DATE_FORMAT(requestDate, '%d.%m.%Y') AS requestDate FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn WHERE l.state ='l' AND p.owner_id_user =$id";
    
        $result = $this->mysqli->query($query);

        /* fetch value */   
        $lended = $result->fetch_all(MYSQLI_ASSOC);
      
        $this->smarty->assign("lended", $lended);
            /* close statement */
        $result->close();
    }
    
    
    
      
}
