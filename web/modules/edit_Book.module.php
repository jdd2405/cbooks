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
        
    function updateCompleteBook(){
        
      //  echo "</br>Checkpoint 2</br>";
        
        $queryUpdateBook = "UPDATE books SET "
                . "title = '". $_GET['title'] ."', "
                . "subtitle = '". $_GET['subtitle'] ."', "
                . "blurb = '". $_GET['blurb'] ."'"
                . " WHERE id_isbn = '" . $_GET['isbn']
                . "';";
        $queryUpdatePersonalBook = "UPDATE personal_books SET "
                . "title = '". $_GET['description'] ."', "
                . " WHERE id_personal_book = {$details["id_personal_book"]}"
                . "';";

        $this->mysqli->query($queryUpdateBook);
        $this->mysqli->query($queryUpdatePersonalBook);
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        
    }
    
}