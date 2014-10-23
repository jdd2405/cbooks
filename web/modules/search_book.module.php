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
    
    private $search_term;

    //put your code here

    function __construct($search_term) {
        $this->search_term = $search_term;
    }

    function start($smarty, $mysqli) {


        /* create a prepared statement */
        if ($stmt = $mysqli->prepare("SELECT id_isbn, title FROM books WHERE id_isbn = ? OR title LIKE ?")) {

            /* bind parameters for markers */
            $preparedValue = "%".$this->search_term."%";
            $stmt->bind_param('ss', $this->search_term, $preparedValue);


            /* execute query */
            $stmt->execute();

            /* bind result variables */
            $result=$stmt->get_result();

            /* fetch value */
            $result->fetch_array(MYSQLI_ASSOC);

            /* close statement */
            $result->close();
        }
        
        $smarty->assign("result",$result);
        //$smarty->assign("isbn", $isbn);
        //$smarty->assign("title", $title);
        
        
        
        $smarty->display("books.tpl");


        /* close connection */
        $mysqli->close();
    }

}
