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

    var $returned_data;

    private function _get_table_name_from_class() {
        return strtolower(strval(__CLASS__));
    }

    public function __construct() {
        parent::__construct(array("tbname" => $this->_get_table_name_from_class()));
    }

    public function create_new_country() {
        try {
            $data = $this->input->post();

            if (empty($data)) {
                throw new Exception("Не правильные входные данные!");
            }

            if ($this->create($data) === false) {
                throw new Exception("Не возможно добавить страну с текущими параметрами");
            } else {
                $this->returned_data = array("error" => false, "message"=>"Страна успешно добавлена");
            }

        } catch (Exception $exp) {
            $this->returned_data = array("error" => true, "message" => $exp->getMessage());
        }
    }

    public function update_current_country() {
        try {
            $data = $this->input->post();

            $id = $data['id'];

            unset($data['id']);

            if (empty($id) || empty($data)) {
                throw new Exception("Не верные параметры");
            }

            if ($this->update($id, $data) === false) {
                throw new Exception("Не возможно обновить данные по стране текущими параметрами");
            } else {
                $this->returned_data = array("error" => false, "message" => "Данные по стране были успешно обновлены");
            }

        } catch (Exception $exp) {
            $this->returned_data = array("error" => true, "message" => $exp->getMessage());
        }
    }

    public function delete_current_country() {
        try {
            $data = $this->input->post();

            if (empty($data)) {
                throw new Exception("Не верные параметры");
            }

            if ($this->delete($data['id']) === false) {
                throw new Exception("Не возможно удалить страну из базы");
            } else {
                $this->returned_data = array("error" => false, "message" => "Страна удалена из базы успешно");
            }
        } catch (Exception $ex) {
            $this->returned_data = array("error" => true, "message" => $exp->getMessage());
        }
    }
}
