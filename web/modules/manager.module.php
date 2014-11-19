<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of requestHandler
 *
 * @author Jonas
 */
include_once 'modules/registrate_user.module.php';
include_once 'modules/login.module.php';
require_once 'modules/settings.module.php';
require_once 'modules/statistics.module.php';
require_once 'modules/search_book.module.php';
require_once 'modules/detail_book.module.php';
require_once 'modules/lend_book.module.php';

class ModuleManager {

    public $smarty;
    public $mysqli;
    public $modules;

    public function __construct($smarty, $mysqli) {
        $this->smarty = $smarty;
        $this->mysqli = $mysqli;
    }

    public function handleRequest($request) {
        
        if (empty($request)) {
            $this->personalizeContent();
            $this->smarty->display('index.tpl');
        } else {
            foreach ($request as $key => $value) {
                switch ($key) {

                    case 'logout':
                        $login = new LoginModule($this->smarty, $this->mysqli);
                        $login->logout();
                        $this->smarty->display('index.tpl');
                        break;

                    case 'registrateUser':
                        $registrate = new RegistrateUserModule($this->smarty, $this->mysqli);
                        $registrate->registrateUser();
                        break;

                    case 'warning':
                        $this->smarty->assign("alert_warning", filter_input(INPUT_GET, 'warning', FILTER_SANITIZE_STRING));

                    case 'info':
                        $this->smarty->assign("alert_info", filter_input(INPUT_GET, 'info', FILTER_SANITIZE_STRING));

                    case 'page':
                        $this->smarty->display(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING) . ".tpl");
                        break;

                    case 'searchBook':
                        $searchBookModule = new SearchBookModule($this->smarty, $this->mysqli);
                        $searchBookModule->search(filter_input(INPUT_GET, 'searchBook', FILTER_SANITIZE_STRING));
                        break;

                    case 'login':
                        $email = filter_input(INPUT_POST, 'loginEmail', FILTER_SANITIZE_STRING);
                        $password = filter_input(INPUT_POST, 'loginPassword', FILTER_SANITIZE_STRING);
                        $login = new LoginModule($this->smarty, $this->mysqli);
                        $login->login($email, $password);
                        break;

                    case 'resetPassword':
                        $email = filter_input(INPUT_POST, 'loginEmail', FILTER_SANITIZE_STRING);
                        $login = new LoginModule($this->smarty, $this->mysqli);
                        $login->resetPassword($email);
                        break;

                    case 'book_id':
                        $showDetail = new DetailBook($this->smarty, $this->mysqli);
                        $showDetail->details(filter_input(INPUT_GET, 'book_id', FILTER_SANITIZE_NUMBER_INT));
                        break;

                    case 'allBooks':
                        $listdetails = new statisticsModule($this->smarty, $this->mysqli);
                        $listdetails->allBooks();
                        break;

                    case 'do':
                        switch ($value) {
                            case "cronjob":
                                $lendBookModule = new LendBook($this->smarty, $this->mysqli);
                                $lendBookModule->checkLendingRelations();
                        }

                    default:
                        $this->personalizeContent();
                        $this->smarty->display('index.tpl');
                }
            }
        }
    }

    public function personalizeContent() {
        $statisticsModule = new statisticsModule($this->smarty, $this->mysqli);
        $statisticsModule->getPublicStats();
    }

}
