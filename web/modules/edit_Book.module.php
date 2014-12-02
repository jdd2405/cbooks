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
        $isbn = filter_input(INPUT_POST, 'isbn' , FILTER_SANITIZE_NUMBER_INT);
        $pbID = filter_input(INPUT_POST, 'pbID', FILTER_SANITIZE_NUMBER_INT);
                      
        $queryUpdateBook = "UPDATE books SET title = '$title', subtitle = '$subtitle', blurb = '$blurb' "
                . "WHERE id_isbn = $isbn";
        
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        
        $queryUpdatePersonalBook = "UPDATE personal_books SET description = '$description' "
                . "WHERE id_personal_book = $pbID";
        
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
        
        //$queryUpdateAuthor = "UPDATE authors SET ";

        $this->mysqli->query($queryUpdateBook);
        $this->mysqli->query($queryUpdatePersonalBook);
    /*    
        Wenn sich der Autor verändert sollen alle Autoren gelöscht.
     * 
     */

        header("Location: portal.php?info=Dein Buch wurde geändert.");
        
    }
    
    function deleteBook($idPersonalBook){
        $querylendingRelations = "delete from lending_relations where item_id_personal_book = $idPersonalBook";
        $queryPersonalBook = "delete from personal_books where id_personal_book = $idPersonalBook";
        
        $this->mysqli->query($querylendingRelations);
        $this->mysqli->query($queryPersonalBook);
        
        header("Location: portal.php?info=Dein Buch wurde gelöscht.");
        
    }
    
}