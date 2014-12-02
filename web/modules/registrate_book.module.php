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
        $cleanISBN = str_replace("-", "", $isbn);
        
        
        $query = "SELECT id_isbn, title, subtitle, blurb
            FROM books WHERE id_isbn = '" . $cleanISBN . "' LIMIT 1";
        if ($result = $this->mysqli->query($query)) {
            $book = $result->fetch_assoc();
            $this->smarty->assign("book", $book);
        }
        
        $this->smarty->assign("isbn_input", $cleanISBN); 
  

        //Template aufrufen mit Smarty
        
        
        /*$isbnCheck = NULL;
        $error_msg = NULL;
        
        if (checkISBN($isbn) == 1) {
            $this->smarty->display("registrate_book.tpl");
        }
        else{
            $this->smarty->display("registrate_book_ISBN_check.tpl");
        }*/
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
            
            $isbn = filter_input(INPUT_POST, 'isbn', FILTER_SANITIZE_NUMBER_INT);
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
            $blurb = filter_input(INPUT_POST, 'blurb', FILTER_SANITIZE_STRING);
            
            $queryAddBook = "INSERT INTO books "
                    . "(id_isbn, title, subtitle, blurb) values ("
                    . "'" . $isbn . "', "
                    . "'" . $title . "', "
                    . "'" . $subtitle . "', "
                    . "'" . $blurb 
                    . "');"
                    . "";

            $run = filter_input(INPUT_POST, 'run', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            
            $queryAddPersonalBook = "INSERT INTO personal_books "
                    . "(isbn, run, description, owner_id_user) values ("
                    . "'" . $isbn . "', "
                    . "'" . $run . "', "
                    . "'" . $description . "', "
                    . "'" . $_SESSION['user_id'] . "')";

            $queryConnectBookWithAuthors = "INSERT books_has_authors "
                    . "(books_id_isbn, authors_id_author) VALUES ("
                    . "'" . $isbn . "', '" . $author_id . "')";

            $this->mysqli->query($queryAddBook);

            $this->mysqli->query($queryAddPersonalBook);

            $this->mysqli->query($queryConnectBookWithAuthors);

            /* Template aufrufen mit Smarty */

            header("Location: portal.php?info=Dein Buch wurde hinzugefügt.");

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
        }
        else {
            return $authors[0];
        }

    }
    
}
function checkISBN($input){

        $rawIsbn = $input;
        
    //    echo "<p>ISBN 4: ".$rawIsbn."</p>";

        $anz = preg_match_all("/-/", $rawIsbn);
        $anx = preg_match_all("/x/", $rawIsbn);
        $anX = preg_match_all("/X/", $rawIsbn);
        $an0 = preg_match_all("/0/", $rawIsbn);
        $an1 = preg_match_all("/1/", $rawIsbn);
        $an2 = preg_match_all("/2/", $rawIsbn);
        $an3 = preg_match_all("/3/", $rawIsbn);
        $an4 = preg_match_all("/4/", $rawIsbn);
        $an5 = preg_match_all("/5/", $rawIsbn);
        $an6 = preg_match_all("/6/", $rawIsbn);
        $an7 = preg_match_all("/7/", $rawIsbn);
        $an8 = preg_match_all("/8/", $rawIsbn);
        $an9 = preg_match_all("/9/", $rawIsbn);

        $antot = $an9+$an8+$an7+$an6+$an5+$an4+$an3+$an2+$an1+$an0+$anX+$anx+$anz;
        $lang  = strlen($rawIsbn);

    //    echo "<p>Es wurden: ".$antot." erlaubte Zeichen gefunden. Total sind ".$lang." Zeichen vorhanden.</p>";

        if($antot==$lang){
            
    //        echo "</br>RAW ISBN 5: ".$rawIsbn;

            $cleanIsbn = implode(explode("-", $rawIsbn));

    //        echo "<p>ISBN : ".$rawIsbn."</p>";
    //        echo "<p>Fragmente: ".$cleanIsbn."</p>";

            if (strlen($cleanIsbn) == 13){
                $z01 = substr($cleanIsbn, -13, 1);
                $z02 = substr($cleanIsbn, -12, 1);
                $z03 = substr($cleanIsbn, -11, 1);
                $z04 = substr($cleanIsbn, -10, 1);
                $z05 = substr($cleanIsbn,  -9, 1);
                $z06 = substr($cleanIsbn,  -8, 1);
                $z07 = substr($cleanIsbn,  -7, 1);
                $z08 = substr($cleanIsbn,  -6, 1);
                $z09 = substr($cleanIsbn,  -5, 1);
                $z10 = substr($cleanIsbn,  -4, 1);
                $z11 = substr($cleanIsbn,  -3, 1);  
                $z12 = substr($cleanIsbn,  -2, 1);
                $z13 = substr($cleanIsbn,  -1, 1);

                $sum = $z01+$z03+$z05+$z07+$z09+$z11+3*($z02+$z04+$z06+$z08+$z10+$z12);
                $pz  = 10-substr($sum, -1, 1);
            //    echo "<p>12-stellige Pr&uuml;fsumme: ".$sum."</p>";
            //    echo "<p>12-stellige Pr&uuml;fziffer: ".$pz."</p>";

                if ($pz == $z13){
                    $isbnCheck = 1;
                    return $isbnCheck;
                    // echo "<p>Die 13-stellige ISBN ist korrekt.</br>true</p>";						
                }
                else{
                    $isbnCheck = 0;
                    return $isbnCheck;
                    //echo "<p>Die 13-stellige ISBN hat einen Fehler.</br>false</p>";
                }
            }
            else{
                if (strlen($cleanIsbn) == 10){
                    $z01 = 1 * substr($cleanIsbn, -10, 1);
                    $z02 = 2 * substr($cleanIsbn,  -9, 1);
                    $z03 = 3 * substr($cleanIsbn,  -8, 1);
                    $z04 = 4 * substr($cleanIsbn,  -7, 1);
                    $z05 = 5 * substr($cleanIsbn,  -6, 1);
                    $z06 = 6 * substr($cleanIsbn,  -5, 1);
                    $z07 = 7 * substr($cleanIsbn,  -4, 1);
                    $z08 = 8 * substr($cleanIsbn,  -3, 1);  
                    $z09 = 9 * substr($cleanIsbn,  -2, 1);
                    if (substr($cleanIsbn,  -1, 1)== 'X' || 'x'){
                        $z10 = 100;
                    }
                    else{
                        $z10 = 10 * substr($cleanIsbn,  -1, 1);
                    }

                    $sum = $z01+$z03+$z05+$z07+$z09+$z02+$z04+$z06+$z08+$z10;
                    $pz  = $sum%11;
                    // echo "<p>9-stellige Pr&uuml;fsumme: ".$sum."</p>";
                    // echo "<p>Pr&uuml;fziffer: ".$pz."</p>";

                    if ($pz == 0){
                        // echo "</br>CHECK !!!!";
                        $isbnCheck = 1;
                        return $isbnCheck;
                        //echo "<p>Die 10-stellige ISBN ist korrekt.</br>true</p>";		
                    }
                    else{
                        $isbnCheck = 0;
                        return $isbnCheck;
                        //echo "<p>Die 10-stellige ISBN hat einen Fehler.</br>false</p>";
                    }
                }
                else{ 
                    $isbnCheck = 0;
                    return $isbnCheck;
                    //echo "<p>Die ISBN sollte genau 10 oder 13 Stellen haben. Der Trennstrich wird dabei nicht mitgerechnet.</p>";
                }
            }
        }
        else{ 
            $isbnCheck = 0;
            return $isbnCheck;
            //echo "Eine Nummer eingeben";
        }
        
    }

