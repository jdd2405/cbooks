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
        $run = filter_input(INPUT_POST, 'run', FILTER_SANITIZE_STRING);
        $input = filter_input(INPUT_POST, 'isbn' , FILTER_SANITIZE_NUMBER_INT);
        $isbn = preg_replace("/[^0-9]/","",$input);
        $pbID = filter_input(INPUT_POST, 'pbID', FILTER_SANITIZE_NUMBER_INT);
                      
        $queryUpdateBook = "UPDATE books SET title = '$title', subtitle = '$subtitle', blurb = '$blurb' "
                . "WHERE id_isbn = '$isbn'";
        $this->mysqli->query($queryUpdateBook);
        
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        
        $queryUpdatePersonalBook = "UPDATE personal_books SET description = '$description', run = '$run' "
                . "WHERE id_personal_book = '$pbID'";
        $this->mysqli->query($queryUpdatePersonalBook);
        
        
        $authors = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
        $author = explode(", ", $authors);
        $this->updateAuthor($author, $isbn);
        

        header("Location: portal.php?info=Dein Buch wurde geändert.");
        
    }
    
    function updateAuthor($author, $isbn){
        //alte Autorenverlinkungen (vor Update) löschen
        $queryDelete = "DELETE FROM books_has_authors WHERE books_id_isbn = '$isbn'";
        $this->mysqli->query($queryDelete);
        
        //Update der Autoren
        
        $anzahlAuthor = count($author);
        for($i = 0; $i<$anzahlAuthor; $i++){
            $authorInDB = "SELECT id_author FROM authors WHERE aut_name = '$author[$i]'";
            $result = $this->mysqli->query($authorInDB);
            if (0 !== $result->num_rows){
                $authorID = $result->fetch_array(MYSQLI_NUM);
                $result->free();
                $queryUpdate = "INSERT INTO books_has_authors (books_id_isbn, authors_id_author) VALUES ('$isbn', '$authorID[0]')";
                $this->mysqli->query($queryUpdate);
            }
            else{
                $queryInsertNewAuthor = "INSERT INTO authors(aut_name) VALUES ('$author[$i]')";
                $this->mysqli->query($queryInsertNewAuthor);
                $queryNewAuthorID = "SELECT id_author FROM authors WHERE aut_name = '$author[$i]'";
                $result = $this->mysqli->query($queryNewAuthorID);
                $authors_id_author = $result->fetch_array(MYSQLI_NUM);
                $queryInsertNewBookHasAuthor = "INSERT INTO books_has_authors (books_id_isbn, authors_id_author) VALUES ('$isbn', '$authors_id_author[0]')";
                $this->mysqli->query($queryInsertNewBookHasAuthor); 
            }
        }
    }
    
    function deleteBook($idPersonalBook){
        $querylendingRelations = "delete from lending_relations where item_id_personal_book = $idPersonalBook";
        $queryPersonalBook = "delete from personal_books where id_personal_book = $idPersonalBook";
        
        $this->mysqli->query($querylendingRelations);
        $this->mysqli->query($queryPersonalBook);
        
        header("Location: portal.php?info=Dein Buch wurde gelöscht.");
        
    }
    
}