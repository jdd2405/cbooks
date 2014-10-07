<?php

require 'user.class.php';
require 'index.php';
require 'login.php';

$username;
$password;
$email;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

new user($username, $password, $email);
login($username, $password);