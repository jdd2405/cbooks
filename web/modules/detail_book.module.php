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
        
        $query = "SELECT p.isbn, p.description, p.availability, b.title, b.subtitle, b.blurb
            FROM personal_books p
            INNER JOIN books b
            ON p.isbn=b.id_isbn
            WHERE p.id_personal_book = '$book_id'";
        
        $result = $this->mysqli->query($query); 
        
        /* fetch value */   
        $details = $result->fetch_array(MYSQLI_ASSOC);
        
        $result->free();
        
        
        $result = $this->mysqli->query("SELECT first_name, city FROM cb_users INNER JOIN personal_books ON id_cb_user = owner_id_user WHERE id_personal_book ='$book_id'");
        $besitzerdaten= $result->fetch_array(MYSQLI_ASSOC);
        
        $result->close();
        
        
        $this->smarty->assign("details", $details);
        $this->smarty->assign("besitzerdaten", $besitzerdaten);
        
        $this->smarty->display('book_details.tpl');
        
        
    }
    
}
    
