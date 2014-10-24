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
        
    }
    
    
    
    
}
