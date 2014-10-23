<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of search_book
 *
 * @author Jonas
 */

class SearchBookModule{
    

    //put your code here

    function __construct($smarty, $mysqli) {
        $this->smarty = $smarty;
        $this->mysqli = $mysqli;
    }

    function search($search_term) {


        /* create a prepared statement */
        if ($stmt = $this->mysqli->prepare("SELECT id_isbn, title FROM books WHERE id_isbn = ? OR title LIKE ?")) {

            /* bind parameters for markers */
            $preparedValue = "%".$search_term."%";
            $stmt->bind_param('ss', $search_term, $preparedValue);


            /* execute query */
            $stmt->execute();

            /* bind result variables */
            $stmt->bind_result($isbn, $title);

            /* fetch value */
            $stmt->fetch();

            /* close statement */
            $stmt->close();
        }

        $this->smarty->assign("isbn", $isbn);
        $this->smarty->assign("title", $title);
        
        
        
        $this->smarty->display("books.tpl");


        /* close connection */
        $this->mysqli->close();
    }

}
