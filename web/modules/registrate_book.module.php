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

    function searchBookByIsbn($input) {
        
        // If no valid ISBN
        if (!$this->checkIsbn($input)) {
            $this->smarty->assign("alert_warning", "Sie haben keine gültige ISBN angegeben.");
            $this->smarty->display('portal.tpl');
        } else {
            preg_match("/[0-9]{13}|[0-9]{10}|([0-9]{9}X?|x?)/", $input, $match);
            $isbn = $match[0];
            $query = "SELECT b.id_isbn, b.title, b.subtitle, b.blurb, GROUP_CONCAT(a.aut_name SEPARATOR ', ') AS aut_name
                FROM books b
                JOIN books_has_authors bhs ON b.id_isbn = bhs.books_id_isbn
                JOIN authors a ON bhs.authors_id_author = a.id_author
                WHERE id_isbn = '" . $isbn . "' LIMIT 1";
                        
            if ($result = $this->mysqli->query($query)) {
                $book = $result->fetch_assoc();
                $this->smarty->assign("book", $book);
            }

            $this->smarty->assign("isbn_input", $isbn);


            //Template aufrufen mit Smarty


            /* $isbnCheck = NULL;
              $error_msg = NULL;

              if (checkISBN($isbn) == 1) {
              $this->smarty->display("registrate_book.tpl");
              }
              else{
              $this->smarty->display("registrate_book_ISBN_check.tpl");
              } */
            $this->smarty->display("registrate_book.tpl");
        }
    }

    function insertPersonalBook() {
        $isbn = $_POST['isbn'];
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
        $this->mysqli->query($queryAddBook);

        $run = filter_input(INPUT_POST, 'run', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

        $queryAddPersonalBook = "INSERT INTO personal_books "
                . "(isbn, run, description, owner_id_user) values ("
                . "'" . $isbn . "', "
                . "'" . $run . "', "
                . "'" . $description . "', "
                . "'" . $_SESSION['user_id'] . "')";
        $this->mysqli->query($queryAddPersonalBook);
        
        
            $authorsAllInOne = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
            $authorsArray = explode(", ", $authorsAllInOne);
            
            //Hier
            require_once('modules/edit_Book.module.php');
            editBook::updateAuthor($authorsArray, $isbn);
        

        /* Template aufrufen mit Smarty */

        header("Location: portal.php?info=Dein Buch wurde hinzugefügt.");
    }


    function checkIsbn($str) {
        $regex = '/\b(?:ISBN(?:: ?| ))?((?:97[89])?\d{9}[\dx])\b/i';

        if (preg_match($regex, str_replace('-', '', $str), $matches)) {
            return (10 === strlen($matches[1])) 
                ? $this->isValidIsbn10($matches[1])  // ISBN-10
                : $this->isValidIsbn13($matches[1]); // ISBN-13
        } else {
            return false;
        }
    }

    function isValidIsbn10($isbn) {
        $check = 0;

        for ($i = 0; $i < 10; $i++) {
            if ('x' === strtolower($isbn[$i])) {
                $check += 10 * (10 - $i);
            } elseif (is_numeric($isbn[$i])) {
                $check += (int) $isbn[$i] * (10 - $i);
            } else {
                return false;
            }
        }

        return (0 === ($check % 11)) ? 1 : false;
    }

    function isValidIsbn13($isbn) {
        $check = 0;

        for ($i = 0; $i < 13; $i += 2) {
            $check += (int) $isbn[$i];
        }

        for ($i = 1; $i < 12; $i += 2) {
            $check += 3 * $isbn[$i];
        }

        return (0 === ($check % 10)) ? 2 : false;
    }

    /*function checkISBN($input) {

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

        $antot = $an9 + $an8 + $an7 + $an6 + $an5 + $an4 + $an3 + $an2 + $an1 + $an0 + $anX + $anx + $anz;
        $lang = strlen($rawIsbn);

        //    echo "<p>Es wurden: ".$antot." erlaubte Zeichen gefunden. Total sind ".$lang." Zeichen vorhanden.</p>";

        if ($antot == $lang) {

            //        echo "</br>RAW ISBN 5: ".$rawIsbn;

            $cleanIsbn = implode(explode("-", $rawIsbn));

            //        echo "<p>ISBN : ".$rawIsbn."</p>";
            //        echo "<p>Fragmente: ".$cleanIsbn."</p>";

            if (strlen($cleanIsbn) == 13) {
                $z01 = substr($cleanIsbn, -13, 1);
                $z02 = substr($cleanIsbn, -12, 1);
                $z03 = substr($cleanIsbn, -11, 1);
                $z04 = substr($cleanIsbn, -10, 1);
                $z05 = substr($cleanIsbn, -9, 1);
                $z06 = substr($cleanIsbn, -8, 1);
                $z07 = substr($cleanIsbn, -7, 1);
                $z08 = substr($cleanIsbn, -6, 1);
                $z09 = substr($cleanIsbn, -5, 1);
                $z10 = substr($cleanIsbn, -4, 1);
                $z11 = substr($cleanIsbn, -3, 1);
                $z12 = substr($cleanIsbn, -2, 1);
                $z13 = substr($cleanIsbn, -1, 1);

                $sum = $z01 + $z03 + $z05 + $z07 + $z09 + $z11 + 3 * ($z02 + $z04 + $z06 + $z08 + $z10 + $z12);
                $pz = 10 - substr($sum, -1, 1);
                //    echo "<p>12-stellige Pr&uuml;fsumme: ".$sum."</p>";
                //    echo "<p>12-stellige Pr&uuml;fziffer: ".$pz."</p>";

                if ($pz == $z13) {
                    $isbnCheck = 1;
                    return $isbnCheck;
                    // echo "<p>Die 13-stellige ISBN ist korrekt.</br>true</p>";						
                } else {
                    $isbnCheck = 0;
                    return $isbnCheck;
                    //echo "<p>Die 13-stellige ISBN hat einen Fehler.</br>false</p>";
                }
            } else {
                if (strlen($cleanIsbn) == 10) {
                    $z01 = 1 * substr($cleanIsbn, -10, 1);
                    $z02 = 2 * substr($cleanIsbn, -9, 1);
                    $z03 = 3 * substr($cleanIsbn, -8, 1);
                    $z04 = 4 * substr($cleanIsbn, -7, 1);
                    $z05 = 5 * substr($cleanIsbn, -6, 1);
                    $z06 = 6 * substr($cleanIsbn, -5, 1);
                    $z07 = 7 * substr($cleanIsbn, -4, 1);
                    $z08 = 8 * substr($cleanIsbn, -3, 1);
                    $z09 = 9 * substr($cleanIsbn, -2, 1);
                    if (substr($cleanIsbn, -1, 1) == 'X' || 'x') {
                        $z10 = 100;
                    } else {
                        $z10 = 10 * substr($cleanIsbn, -1, 1);
                    }

                    $sum = $z01 + $z03 + $z05 + $z07 + $z09 + $z02 + $z04 + $z06 + $z08 + $z10;
                    $pz = $sum % 11;
                    // echo "<p>9-stellige Pr&uuml;fsumme: ".$sum."</p>";
                    // echo "<p>Pr&uuml;fziffer: ".$pz."</p>";

                    if ($pz == 0) {
                        // echo "</br>CHECK !!!!";
                        $isbnCheck = 1;
                        return $isbnCheck;
                        //echo "<p>Die 10-stellige ISBN ist korrekt.</br>true</p>";		
                    } else {
                        $isbnCheck = 0;
                        return $isbnCheck;
                        //echo "<p>Die 10-stellige ISBN hat einen Fehler.</br>false</p>";
                    }
                } else {
                    $isbnCheck = 0;
                    return $isbnCheck;
                    //echo "<p>Die ISBN sollte genau 10 oder 13 Stellen haben. Der Trennstrich wird dabei nicht mitgerechnet.</p>";
                }
            }
        } else {
            $isbnCheck = 0;
            return $isbnCheck;
            //echo "Eine Nummer eingeben";
        }
    }*/

}
