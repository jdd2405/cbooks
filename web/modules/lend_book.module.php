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

require_once 'classes/LendingRelations.class.php';

class LendBook {
    
    private $smarty;
    private $mysqli;
    
    function __construct($smarty, $mysqli) {
        $this->smarty=$smarty;
        $this->mysqli=$mysqli;
    }
    
    //Objekt lending_relations instanzieren und in DB eintragen und Mail versenden
    function request($duration, $id_personal_book){
        $timestamp = time();
        $datum = date("Y.m.d", $timestamp);
        $state = "r";
        $user_id = $_SESSION['user_id'];
        
        //$lend = new LendingRelations($datum, $duration, $state, $id_personal_book );

       
        $this->mysqli->query("INSERT INTO `lending_relations` (duration, state,lender_id_user, item_id_personal_book) VALUES ( '" . $duration . "', '" . $state . "','" . $user_id . "', '" . $id_personal_book . "')");
        $this->mysqli->query("UPDATE personal_books SET availability= '" . $state . "' WHERE id_personal_book ='". $id_personal_book ."'");
        
        
                
        //$this->smarty->assign("date", $datum);
        //$this->smarty->assign("id", $id_personal_book);
        //$this->smarty->assign("weeksOfDuration",$duration);
        //$this->smarty->assign("test", $user_id);
        //$this->smarty->display("just_for_testing.tpl");
        header("Location: portal.php?err=Es konnte keine sichere Session gestartet werden.");
    }
    
    
    
    
    
    
}
