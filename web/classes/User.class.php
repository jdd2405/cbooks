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
    public $email;
    public $password;
    public $access_right = NULL;
    public $first_name = NULL;
    public $family_name = NULL;
    public $street = NULL;
    public $street_num = NULL;
    public $zip = NULL;
    public $city = NULL;
    public $country = NULL;
    public $reg_date = NULL;
    public $last_activity = NULL;
    
    function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
   }
   

   
}
