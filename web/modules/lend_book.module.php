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
    function request($duration){
        
        $this->smarty->assign("weeksOfDuration",$duration);
        $this->smarty->display("just_for_testing.tpl");
    }
    
    
    
    
    
    
}
