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
    
    function getPrivateStats(){
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
     
}

