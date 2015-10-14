<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author snegas
 */
class MY_Controller extends CI_Controller {

    /**
     * Table name
     * @var string
     */
    public $tbname = "";

    /**
     * Array with table fields name
     * @var array
     */
    private $tbfileds = array();

    /**
     * Constructor
     *
     * @access public
     * @param array $args
     */
    public function __construct($args) {
        parent::__construct();

        $this->tbname = $args['tbname'];

        $this->load->model($this->tbname."_model", "working_model");

        $this->tbfileds = get_object_vars($this->working_model);
    }

    /**
     * Checking the fields in model
     * @param array $data
     * @return boolean
     */
    private function _basic_validation(array $data) {
        foreach ($data as $field) {
            if (!in_array($this->tbfileds, $field)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Create operation
     * @param array $data
     * @return boolean
     */
    public function create(array $data) {
        return $this->_basic_validation($data)
                ? $this->db->insert($this->tbname, $data)
                : false;
    }

    /**
     * Read operation one
     * @param integer $id
     * @param string $reading_fields = "*"
     * @return mixed boolead or object
     */
    public function read_one($id, $reading_fields = "*") {
        return $this->db
                ->select($reading_fields)
                ->from($this->tbname)
                ->where("id", $id)
                ->get()
                ->result();
    }

    /**
     * Read operation all
     * @return mixed boolean or array oj objects
     */
    public function read_all() {
        return $this->db
                ->select(implode(",", $this->tbfileds))
                ->from($this->tbname)
//                ->where(1)
                ->get()
                ->result();
    }

    /**
     * Read operation custom query
     * @param object $obj
     * @return object
     */
    public function read_custom($obj) {
        return $obj->get()->result();
    }

    /**
     * Update operation
     * @param integer $id
     * @param array $data
     * @return boolean
     */
    public function update($id,array $data) {
        return $this->_basic_validation($data)
                ? $this->db->where("id", $id)->update($data)
                : false;
    }

    /**
     * Object deleteing operation
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->db
                ->where("id", $id)
                ->delete($this->tbname);
    }
    
    public function __destruct() {

    }
}
