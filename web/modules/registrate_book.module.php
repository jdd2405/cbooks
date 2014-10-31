<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class registrateBookModule{
    
     function __construct($smarty, $mysqli) {
        $this->smarty = $smarty;
        $this->mysqli = $mysqli;
    }
    
    
    
    function searchBookByIsbn($isbn){
        $query = "SELECT id_isbn, title
            FROM books
            WHERE id_isbn = ?";
        if ($stmt = $this->mysqli->prepare($query)) {

            /* bind parameters for markers */
            $stmt->bind_param('s', $isbn);
            $stmt->execute();
            
            $result = $this->mysqli->fetch_assoc();
            
            if($stmt->num_rows==1){
                # Variablen via smarty dem Template übergeben
                $this->smarty->assign("id_isbn", $result['id_isbn']);
                $this->smarty->assign("title", $result['title']);
            }
            
        }
        
        /* Template aufrufen mit Smarty*/
        
        $this->smarty->display("registrate_book.tpl");
        
    }
    
    
    
}