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

            /* fetch value */
            $meta = $stmt->result_metadata(); 

            while ($field = $meta->fetch_field()) { 
                $params[] = &$row[$field->name]; 
            } 

            call_user_func_array(array($stmt, 'bind_result'), $params); 
            while ($stmt->fetch()) { 
                foreach($row as $key => $val) { 
                    $book[$key] = $val; 
                } 
                $searchResult[] = $book; 
            }

            /* close statement */
            $stmt->close();
        }

        $this->smarty->assign("searchResult", $searchResult);
        $this->smarty->assign("searchTerm", $search_term);
        
        
        
        $this->smarty->display("book_list.tpl");


        /* close connection */
        $this->mysqli->close();
    }

}
