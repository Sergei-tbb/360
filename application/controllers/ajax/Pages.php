<?php
defined("BASEPATH") or exit("No direct script access allowed!");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Pages extends CI_Controller {

    /**
     * Variable for sending data
     * @var type array
     */
    public $returned_data;

    /**
     * Constructor
     * Load Pages_model
     * @todo: load helpers
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('Pages_model');
    }

    /**
     * Create new page
     * get POST data
     * and send request to Pages_model
     * @throws Exception when something wrong
     */
    public function create() {
        try {
            $data = $this->input->post();

            if (empty($data)) {
                throw new Exception('Empty data');
            }

            if ($this->Pages_model->create($data)) {
                $this->returned_data["error"] = false;
            } else {
                throw new Exception("Can't add new page");
            }
        } catch (Exception $exp) {
            $this->returned_data['error'] = true;
            $this->returned_data['message'] = $exp->getMessage();
        }
    }

    /**
     * Update page data
     * by id
     * @throws Exception
     */
    public function update() {
        try {
            $data = $this->input->post();

            if (empty($data)) {
                throw new Exception('Empty data');
            }

            $id = $data['id'];

            if (is_null($id) || !is_numeric($id)) {
                throw new Exception("Invalid id");
            }

            unset($data['id']);

            if ($this->Pages_model->update($id, $data)) {
                $this->returned_data["error"] = false;
            } else {
                throw new Exception("Can't update current page");
            }
        } catch (Exception $exp) {
            $this->returned_data['error'] = true;
            $this->returned_data['message'] = $exp->getMessage();
        }
    }

    /**
     * Delete page data
     * by id
     * @throws Exception
     */
    public function delete() {
        try {
            $id = $this->input->post("id");

            if (is_null($id) || !is_numeric($id)) {
                throw new Exception("Invalid id");
            }

            if ($this->Pages_model->delete($id)) {
                $this->returned_data["error"] = false;
            } else {
                throw new Exception("Can't delete current page");
            }
        } catch (Exception $exp) {
            $this->returned_data['error'] = true;
            $this->returned_data['message'] = $exp->getMessage();
        }
    }

    /**
     * Get page data by id
     * @throws Exception
     */
    public function get() {
        try {
            $id = $this->input->post("id");

            if (is_null($id) || !is_numeric($id)) {
                throw new Exception("Invalid id");
            }

            $data = $this->Pages_model->get($id);

            if (empty($data)) {
                $this->returned_data["error"] = false;
                $this->returned_data['page_data'] = $data;
            } else {
                throw new Exception("Can't delete current page");
            }
        } catch (Exception $exp) {
            $this->returned_data['error'] = true;
            $this->returned_data['message'] = $exp->getMessage();
        }
    }

    /**
     * Get all pages by id
     * @throws Exception
     */
    public function get_all() {
        try {
            $data = $this->Pages_model->get();

            if (empty($data)) {
                $this->returned_data["error"] = false;
                $this->returned_data['page_data'] = $data;
            } else {
                throw new Exception("Can't get pages");
            }
        } catch (Exception $exp) {
            $this->returned_data['error'] = true;
            $this->returned_data['message'] = $exp->getMessage();
        }
    }

    public function __destruct() {
        $this->load->view("returned_ajax_view", $this->returned_data);
    }

}