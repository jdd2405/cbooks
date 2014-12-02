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
        
        
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
        $blurb = filter_input(INPUT_POST, 'blurb', FILTER_SANITIZE_STRING);
                      
        $queryUpdateBook = "UPDATE books SET "
                . "title = '". $title ."', "
                . "subtitle = '". $subtitle ."', "
                . "blurb = '". $blurb ."'"
                . " WHERE id_isbn = '" . $_GET['isbn']
                . "';";
        
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        
        $queryUpdatePersonalBook = "UPDATE personal_books SET "
                . "title = '". $description ."', "
                . " WHERE id_personal_book = {$details["id_personal_book"]}"
                . "';";

        $this->mysqli->query($queryUpdateBook);
        $this->mysqli->query($queryUpdatePersonalBook);
    /*    
        Wenn sich der Autor verändert sollen alle Autoren gelöscht.
     * 
     */
        $this->mysqli->assign("title", $title);
        
        header("Location: portal.php?info=Dein Buch wurde geändert.");
        
    }
    
}