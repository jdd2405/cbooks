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
        // fallback: "SELECT id_isbn, title FROM books WHERE id_isbn = ? OR title LIKE ?"
        $query = "SELECT b.id_isbn, b.title, u.zip, u.city, pb.id_personal_book
            FROM books b
            INNER JOIN personal_books pb
            ON b.id_isbn=pb.isbn
            INNER JOIN cb_users u
            ON pb.owner_id_user=u.id_cb_user
            WHERE b.id_isbn = ? OR b.title LIKE ?";
        if ($stmt = $this->mysqli->prepare($query)) {

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

        if(!empty($searchResult)){
            $this->smarty->assign("searchResult", $searchResult);
        }
        $this->smarty->assign("searchTerm", $search_term);
        
        
        
        $this->smarty->display("book_list.tpl");


        /* close connection */
        $this->mysqli->close();
    }

}
