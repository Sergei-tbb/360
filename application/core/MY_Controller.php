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
     * CodeIgniter isntance
     * @var object
     */
    private $instance;

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

        $this->instance =& get_instance();

        $this->tbname = $args['tbname'];

        $this->instance->load->model($this->tbname."_model", "working_model");

        $this->tbfileds = get_object_vars($this->instance->working_model);
    }

    /**
     * Checking the fields in model
     * @param array $data
     * @return boolean
     */
    private function _basic_validation($data) {
        foreach ($data as $key => $value) {
            if (in_array($key, $this->tbfileds) === false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Create operation
     * @param array $data
     * @return boolean
     */
    public function create($data) {
        return $this->_basic_validation($data)
                ? $this->instance->db->insert($this->tbname, $data)
                : false;
    }

    /**
     * Read operation one
     * @param integer $id
     * @param string $reading_fields = "*"
     * @return mixed boolead or object
     */
    public function read_one($id, $reading_fields = "*") {
        return $this->instance->db
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
        return $this->instance->db
                ->select(implode(",", $this->tbfileds))
                ->from($this->tbname)
//                ->where(1)
                ->get()
                ->result();
    }

    /**
     * Read operation custom query
     * @param string $query_string
     * @return object
     */
    public function read_custom($query_string) {
        return $this->instance->db->query($query_string)->result();
    }

    public function update_custom($data, array $where) {
        return $this->_basic_validation($data)
            ? $this->instance->db->where($where)->update($this->tbname, $data)
            : false;
    }

    /**
     * Update operation
     * @param integer $id
     * @param array $data
     * @return boolean
     */
    public function update($id,array $data) {
        return $this->_basic_validation($data)
                ? $this->instance->db->where("id", $id)->update($this->tbname, $data)
                : false;
    }

    /**
     * Object deleteing operation
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->instance->db
                ->where("id", $id)
                ->delete($this->tbname);
    }

    public function __destruct() {
        $this->working_model = null;
    }
}
