<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Jonas
 */
class user {
    function __construct($username, $password, $email) {
       $this->username = $username;
       $this->password = $password;
       $this->email = $email;
   }
   
}
