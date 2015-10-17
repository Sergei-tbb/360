<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Delivery_countries
 *
 * @author snegas
 */
class Delivery_streets extends MY_Controller {

    private function _get_table_name_from_class() {
        return strtolower(strval(__CLASS__));
    }

    public function __construct() {
        parent::__construct(array("tbname" => $this->_get_table_name_from_class()));
    }

    public function create_new_countrie() {

    }
}
