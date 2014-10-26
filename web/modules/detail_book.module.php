<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of detail_book
 *
 * @author Theresa
 */
class DetailBook {
    //put your code here
    
    private $smarty;
    private $mysqli;
    
    function __construct($smarty, $mysqli) {
        $this->smarty=$smarty;
        $this->mysqli=$mysqli;
    }
    
    function details($book_id){
        $bookID = substr($book_id, 8);
        
        $result = $this->mysqli->query("SELECT * FROM books WHERE id_isbn = '$bookID'"); 
        
        /* fetch value */   
        $details = $result->fetch_array(MYSQLI_ASSOC);
        
        $result->free();
        $besitzerdaten= "hier erscheinen die Besitzerdaten";
        $this->smarty->assign("details", $details);
        $this->smarty->assign("besitzerdaten", $besitzerdaten);
        
        $this->smarty->display('book_details.tpl');
        
        
    }
    
}
