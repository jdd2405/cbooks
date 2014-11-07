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
    
    function statement($number){
        $id=$_SESSION['user_id'];
        
        //Empfangene Anfragen
        if($number==1){
            $query= "SELECT * FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn WHERE l.state ='r' AND p.owner_id_user =$id";
            
            $result = $this->mysqli->query($query);
            $test123 = $result->fetch_all(MYSQLI_ASSOC);
           
            $this->smarty->assign("test123", $test123);
            $result->close();
            
            $lendingListTitle= "Empfangene Anfragen";    
        }
        
        //Offene Anfragen
        else if($number==2){
            $query= "SELECT * FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn WHERE l.state ='r' AND l.lender_id_user =$id";
            
            $result = $this->mysqli->query($query);
            $requests = $result->fetch_all(MYSQLI_ASSOC);
            
            $this->smarty->assign("test123", $requests);
            $result->close();
            
            $lendingListTitle= "Offene Anfragen";
        }
        
        //Geliehene Bücher
        else if ($number==3) {
            $query= "SELECT * FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn WHERE l.state ='l' AND l.lender_id_user =$id";
            
            $result = $this->mysqli->query($query);
            $borrowed = $result->fetch_all(MYSQLI_ASSOC);
            
            $this->smarty->assign("test123", $borrowed);
            $result->close();
            
            $lendingListTitle= "Geliehene Bücher";
        }
        
        //Verliehene Bücher
        else{
            $query= "SELECT * FROM lending_relations l "
            . "JOIN cb_users c ON l.lender_id_user = c.id_cb_user "
            . "JOIN personal_books p ON l.item_id_personal_book = p.id_personal_book "
            . "JOIN books b ON p.isbn=b.id_isbn WHERE l.state ='l' AND p.owner_id_user =$id";
            
            $result = $this->mysqli->query($query);
            $lended = $result->fetch_all(MYSQLI_ASSOC);
            
            $this->smarty->assign("test123", $lended);
            $result->close();
            
            $lendingListTitle= "Verliehene Bücher";
        }
        
        $this->smarty->assign("lendingListTitle", $lendingListTitle);
        $this->smarty->display('lending_list.tpl');
        
    }      
}
