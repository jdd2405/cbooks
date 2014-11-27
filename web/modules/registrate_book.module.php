<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class registrateBookModule {

    function __construct($smarty, $mysqli) {
        $this->smarty = $smarty;
        $this->mysqli = $mysqli;
    }

    function searchBookByIsbn($isbn) {

        $this->smarty->assign("isbn_input", $isbn);

        $query = "SELECT id_isbn, title, subtitle, blurb
            FROM books WHERE id_isbn = '" . $isbn . "' LIMIT 1";
        if ($result = $this->mysqli->query($query)) {
            $book = $result->fetch_assoc();
            $this->smarty->assign("book", $book);
        }

        /* Template aufrufen mit Smarty */

        $this->smarty->display("registrate_book.tpl");
    }

    function insertPersonalBook() {
        $author_id = -1;
        
        if (isset($_POST["author"])) {

            $author_id = $this->getAuthorIDbyName($_POST["author"]);

            if ($author_id < 0) {
                $sqlQuery = "INSERT authors (aut_name) VALUES ('" . $_POST["author"] . "')";
                $this->mysqli->query($sqlQuery);
                $author_id = $this->getAuthorIDbyName($_POST["author"]);
            }
        }
        
        $queryAddBook = "INSERT INTO books"
                . "(id_isbn, title, subtitle, blurb) values ("
                . "'" . $_POST['isbn'] . "', "
                . "'" . $_POST['title'] . "', "
                . "'" . $_POST['subtitle'] . "', "
                . "'" . $_POST['blurb'] 
                . "');"
                . "";
        
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
        
        echo '</br>'.$queryAddBook.'</br></br>'.$queryAddPersonalBook.'</br></br>'.$queryConnectBookWithAuthors.'</br>';
        
        $this->mysqli->query($queryAddBook);
        
        $this->mysqli->query($queryAddPersonalBook);
        
        $this->mysqli->query($queryConnectBookWithAuthors);

        /* Template aufrufen mit Smarty */

        $this->smarty->display("portal.tpl");

        /* $queryPersonalBook
         * 
         */
    }

    function getAuthorIDbyName($authorName) {

        $sqlQuery = "SELECT id_author FROM authors WHERE aut_name = '" . $authorName . "'";
        $result = $this->mysqli->query($sqlQuery);
        $authors = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
//           print_r($row);
            $authors[] = $row['id_author'];
       }
//       print_r($authors);

        if (empty($authors)) {
            
            return -2;
            
        } else {
            
            return $authors[0];
            
        }

    }

}
