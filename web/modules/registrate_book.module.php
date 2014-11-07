<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class registrateBookModule {

    function __construct($smarty, $mysqli) {
        $this->smarty = $smarty;
        $this->mysqli = $mysqli;
    }

    function searchBookByIsbn($isbn) {
        
        $this->smarty->assign("isbn_input", $isbn);
        
        $query = "SELECT id_isbn, title
            FROM books WHERE id_isbn = '".$isbn."' LIMIT 1";
        if ($result = $this->mysqli->query($query)) {
            $book = $result->fetch_assoc();
            $this->smarty->assign("book", $book);
            
        }


        /* Template aufrufen mit Smarty */

        $this->smarty->display("registrate_book.tpl");
    }

}
