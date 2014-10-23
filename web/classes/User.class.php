<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Jonas
 */
class User {
    private $isLoggedIn;
    private $user_id;
    private $email;
    private $password;
    private $first_name;
    private $family_name;
    private $street;
    private $zip;
    private $city;
    private $tel;
    private $reg_date;
    private $last_activity;

    public function __construct(){
        
    }
    public function fillObject($isLoggedIn, $user_id, $email, $password, $first_name, $family_name, $street, $zip, $city, $tel, $reg_date, $last_activity) {
        $this->isLoggedIn = $isLoggedIn;
        $this->user_id = $user_id;
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->family_name = $family_name;
        $this->street = $street;
        $this->zip = $zip;
        $this->city = $city;
        $this->tel = $tel;
        $this->reg_date = $reg_date;
        $this->last_activity = $last_activity;
    }
    
    
    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
    
    public function getUserByID($user_id) {
        $this->user_id = $user_id;
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->family_name = $family_name;
        $this->street = $street;
        $this->zip = $zip;
        $this->city = $city;
        $this->tel = $tel;
        $this->reg_date = $reg_date;
        $this->last_activity = $last_activity;
    }
    
    public function getUserByEmail($email) {
        $this->user_id = $user_id;
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->family_name = $family_name;
        $this->street = $street;
        $this->zip = $zip;
        $this->city = $city;
        $this->tel = $tel;
        $this->reg_date = $reg_date;
        $this->last_activity = $last_activity;
    }
}
