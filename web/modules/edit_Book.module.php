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
class edit_Book {
    
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
        $queryAddBook = "UPDATE books"
                . "(title, subtitle, blurb) values ("
                . "'" . $_POST['isbn'] . "', "
                . "'" . $_POST['title'] . "', "
                . "'" . $_POST['subtitle'] . "', "
                . "'" . $_POST['blurb'] 
                . "' WHERE id_isbn = " . $details.isbn
                . "');";
        /*
        $queryAddPersonalBook = "INSERT INTO personal_books"
                . "(isbn, run, description, owner_id_user) values ("
                . "'" . $_POST['isbn'] . "', "
                . "'" . $_POST['run'] . "', "
                . "'" . $_POST['description'] . "', "
                . "'" . $_SESSION['user_id'] . "');"
                . "";

        $queryConnectBookWithAuthors = "INSERT books_has_authors"
                . "(books_id_isbn, authors_id_author) VALUES ("
                . "'" . $_POST["isbn"] . "', '" . $author_id . "')";
        
        
        
        $this->mysqli->query($queryAddPersonalBook);
        
        $this->mysqli->query($queryConnectBookWithAuthors);
         * 
         */
        $this->mysqli->query($queryAddBook);
        
        echo"</br>Checkpoint </br>";
        
    }
    
}
