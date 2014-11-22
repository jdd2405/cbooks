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
        
        $query = "SELECT p.isbn, p.description, p.availability, b.title, b.subtitle, b.blurb, p.id_personal_book, p.owner_id_user, GROUP_CONCAT(a.aut_name SEPARATOR ', ') AS aut_name 
            FROM personal_books p
            INNER JOIN books b
            ON p.isbn=b.id_isbn
            JOIN books_has_authors bha ON b.id_isbn = bha.books_id_isbn 
            JOIN authors a ON bha.authors_id_author = a.id_author
            WHERE p.id_personal_book = '$book_id'
            GROUP BY p.isbn";
        
        $result = $this->mysqli->query($query);
        
        /* fetch value */   
        $details = $result->fetch_array(MYSQLI_ASSOC);
        
        $result->free();
        
        $query= "SELECT DATE_FORMAT(returnDate,'%d.%m.%Y') AS returnDate FROM lending_relations WHERE item_id_personal_book = $book_id AND state= 'l' ";
        $result =$this->mysqli->query($query);
        $returnDate = $result->fetch_array(MYSQLI_ASSOC);
        $result->free();
        
        $result = $this->mysqli->query("SELECT first_name, city FROM cb_users INNER JOIN personal_books ON id_cb_user = owner_id_user WHERE id_personal_book ='$book_id'");
        $besitzerdaten= $result->fetch_array(MYSQLI_ASSOC);
        
        $result->close();
        
        
        $this->smarty->assign("details", $details);
        $this->smarty->assign("returnDate",$returnDate);
        $this->smarty->assign("besitzerdaten", $besitzerdaten);
        
        $this->smarty->display('book_details.tpl');
        
        
    }
    
}
    
