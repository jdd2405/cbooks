<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of editBookModule
 *
 * @author Johi
 */
class editBook {
     
    function __construct($smarty, $mysqli) {
        $this->smarty = $smarty;
        $this->mysqli = $mysqli;
    }
    
    /*
    function searchCompleteBookByID($isbn) {

        $this->smarty->assign("isbn_input", $isbn);

        $query = "SELECT id_isbn, title, subtitle, blurb
            FROM books WHERE id_isbn = '" . $isbn . "' LIMIT 1";
        if ($result = $this->mysqli->query($query)) {
            $book = $result->fetch_assoc();
            $this->smarty->assign("book", $book);
        }
    
    */
    
    function updateCompleteBook(){
        
      //  echo "</br>Checkpoint 2</br>";
        
        $queryUpdateBook = "UPDATE books SET " 
                . "title = '". $_GET['title'] ."', "
                . "subtitle = '". $_GET['subtitle'] ."', "
                . "blurb = '". $_GET['blurb'] ."'"
              //  . "'" . $_GET['title'] . "', "
              //  . "'" . $_GET['subtitle'] . "', "

                . " WHERE id_isbn = '" . $_GET['isbn']
                . "';";

        $this->mysqli->query($queryUpdateBook);
        $this->mysqli->query($queryUpdatePersonalBook);
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        
    }
    
}
