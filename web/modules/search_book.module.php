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

    function __construct($search_term) {
        $this->search_term = $search_term;
    }

    function start($smarty, $mysqli) {


        /* create a prepared statement */
        if ($stmt = $mysqli->prepare("SELECT id_isbn, title FROM books WHERE id_isbn = ?")) {

            /* bind parameters for markers */
            $stmt->bind_param("s", $this->search_term);

            /* execute query */
            $stmt->execute();

            /* bind result variables */
            $stmt->bind_result($isbn, $title);

            /* fetch value */
            $stmt->fetch();

            /* close statement */
            $stmt->close();
        }

        $smarty->assign("isbn", $isbn);
        $smarty->assign("title", $title);
        $smarty->display("books.tpl");


        /* close connection */
        $mysqli->close();
    }

}
