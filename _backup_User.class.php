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

 
    public function __construct($user_id, $email, $password, $first_name, $family_name, $street, $street_num, $zip, $city, $tel, $reg_date, $last_activity) {
        $this->user_id = $user_id;
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->family_name = $family_name;
        $this->street = $street;
        $this->street .= " ".$street_num;
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

    /*public function getValuesFromDB($email, $mysqli) {
        if ($stmt = $mysqli->prepare(
            "SELECT 
            id_cb_user, 
            email, 
            first_name, 
            family_name, 
            street, 
            zip, 
            city, 
            tel, 
            reg_date, 
            last_activity
            FROM cb_users 
            WHERE id_cb_user = ? LIMIT 1"
                )) {
            // Bind "$user_id" zum Parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            
            if ($stmt->num_rows == 1) {
                    // Wenn es den Benutzer gibt, hole die Variablen von result.
                    $stmt->bind_result(
                        $this->user_id, $this->email, $this->first_name, $this->family_name, $this->street, $this->zip, $this->city, $this->tel, $this->reg_date, $this->last_activity
                    );
                    $stmt->fetch();
            }

           
        }
    }*/
}
    