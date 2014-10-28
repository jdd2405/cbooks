<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lending_relations
 *
 * @author Theresa
 */
class LendingRelations {
    //put your code here
    private $id_lending_relation;
    private $requestDate;
    private $authorizationDate;
    private $returnDate;
    private $state;
    private $lender_id_user;
    private $item_id_personal_book;
    
    
    function __construct($requestDate, $state, $lender_id_user, $item_id_personal_book) {
        $this->requestDate=$requestDate;
        $this->state=$state;
        $this->lender_id_user=$lender_id_user;
        $this->item_id_personal_book=$lender_id_user;
        
    }
    
    
    
}
