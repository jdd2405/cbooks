<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of statistics
 *
 * @author Jonas
 */
require_once 'classes/User.class.php';

class statisticsModule {
    
    public $smarty;
    public $mysqli;
    
    public function __construct($smarty, $mysqli) {
        $this->smarty = $smarty;
        $this->mysqli = $mysqli;
    }
     

    public function getPublicStats(){
        
    
        if ($result = $this->mysqli->query("SELECT * FROM personal_books")) {
            $nofRegBooks = $result->num_rows;
            $this->smarty->assign("nofRegBooks", $nofRegBooks);
            $result->close();
        }
        
        if ($result = $this->mysqli->query("SELECT * FROM cb_users")) {
            $nofRegUsers = $result->num_rows;
            $this->smarty->assign("nofRegUsers", $nofRegUsers);
            $result->close();
        }
        
        if ($result = $this->mysqli->query("SELECT * FROM lending_relations")) {
            $nofLends = $result->num_rows;
            $this->smarty->assign("nofLends", $nofLends);
            $result->close();
        }
        

        if ($result = $this->mysqli->query("SELECT pb.id_personal_book, pb.isbn, title
            FROM personal_books pb
            JOIN books b ON pb.isbn = b.id_isbn
            ORDER BY pb.reg_date DESC 
            LIMIT 5")) {

            $newestBooks = $result->fetch_all();
            $this->smarty->assign("newestBooks", $newestBooks);
        }
        
        
    }
    
    function getPrivateStats($user){
        if ($result = $this->mysqli->query("SELECT * FROM personal_books WHERE owner_id_user = ".$user->user_id)) {
            $nofRegBooks = $result->num_rows;
            $this->smarty->assign("nofRegBooks", $nofRegBooks);
            $result->close();
        }
        
        if ($result = $this->mysqli->query("SELECT * FROM lending_relations WHERE lender_id_user = ".$user->user_id)) {
            $nofLends = $result->num_rows;
            $this->smarty->assign("nofLends", $nofLends);
            $result->close();
        }
        

        if ($result = $this->mysqli->query("SELECT pb.id_personal_book, pb.isbn, b.title
            FROM personal_books pb
            JOIN books b ON pb.isbn = b.id_isbn
            JOIN cb_users u ON pb.owner_id_user = u.id_cb_user
            WHERE u.id_cb_user = ".$_SESSION['user_id']."
            ORDER BY pb.reg_date DESC 
            LIMIT 5")) {
            for ($newestBooks = array (); $row = $result->fetch_assoc(); $newestBooks[] = $row);
            $this->smarty->assign("newestBooks", $newestBooks);
        }
    }
    
    
    function allPersonalBooks(){
        $result= $this->mysqli->query("SELECT pb.id_personal_book, pb.isbn, b.title, b.subtitle, a.aut_name "
                . "FROM personal_books pb JOIN books b ON pb.isbn = b.id_isbn "
                . "JOIN cb_users u ON pb.owner_id_user = u.id_cb_user "
                . "JOIN books_has_authors bha ON b.id_isbn = bha.books_id_isbn "
                . "JOIN authors a ON bha.authors_id_author = a.id_author "
                . "WHERE u.id_cb_user = ".$_SESSION['user_id']." ORDER BY b.title DESC ");
        
        $allPersonalBooks = $result->fetch_all(MYSQLI_ASSOC);
        
        $result->close();
        
        $this->smarty->assign("allPersonalBooks", $allPersonalBooks);
        $this->smarty->display("book_list.tpl");
    }
    
    function allBooks(){
        $result= $this->mysqli->query("SELECT pb.id_personal_book, pb.isbn, b.title, b.subtitle, a.aut_name "
                . "FROM personal_books pb JOIN books b ON pb.isbn = b.id_isbn "
                . "JOIN books_has_authors bha ON b.id_isbn = bha.books_id_isbn "
                . "JOIN authors a ON bha.authors_id_author = a.id_author ORDER BY b.title ASC ");
        $allBooks = $result->fetch_all(MYSQLI_ASSOC);
        
        $result->close();
        
        $this->smarty->assign("allBooks", $allBooks);
        $this->smarty->display("book_list.tpl");
    }
    
     
}

