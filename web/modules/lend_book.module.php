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
    
    //Objekt lending_relations instanzieren und in DB eintragen und Mail versenden
    function request($duration, $id_personal_book){
        $timestamp= time();
        $date=  date('Y-m-d',$timestamp);
        $state = "r";
        $user_id = $_SESSION['user_id'];
       
        $this->mysqli->query("INSERT INTO `lending_relations` (requestDate, duration, state,lender_id_user, item_id_personal_book) VALUES ('" . $date . "', '" . $duration . "', '" . $state . "','" . $user_id . "', '" . $id_personal_book . "')");
        $this->mysqli->query("UPDATE personal_books SET availability= '" . $state . "' WHERE id_personal_book ='". $id_personal_book ."'");
        

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
    
    
    
      
}
