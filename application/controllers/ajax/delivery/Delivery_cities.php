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
class Delivery_cities extends MY_Controller {

    public function __construct()
    {
        parent::__construct(array('tbname' => 'delivery_cities'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    /**
     * method for getting list of cities
     */
    public function get_list_cities()
    {
        $string_cities_regions = "SELECT * FROM delivery_regions_cities";
        $string = "SELECT * FROM delivery_regions";
        $data['cities'] = $this->read_all();
        $data['regions'] = $this->read_custom($string);
        $data['cities_regions'] = $this->read_custom($string_cities_regions);
        if(empty($data['cities']) or empty($data['regions']))
        {
            $this->result = array('message' => 'Для отображения списка городов нужно добавить хотя бы один город!');
            echo $this->result['message'];
        }
        else {
            $this->load->view('admin_panel/delivery_cities_list_view', $data);
        }
    }

    /**
     * method for addition new cities
     */
    public function add_city()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_cities() === FALSE)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->create($data))
            {
                $this->result = array('message' => "Город был успешно добавлен!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't add new city.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    /**
     * @param $id
     * method for getting all data of city
     */
    public function get_one_city($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if ($this->read_one($id))
            {
                $data['city'] = $this->read_one($id);
                $data['id'] = $id;
                $this->load->view('admin_panel/delivery_cities_edit_view', $data);
            }
            else
            {
                throw new Exception("Can't read data.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    /**
     * @param $id
     * method for editing all data of city
     */
    public function edit_city($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_cities() === FALSE)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->update($id, $data))
            {
                $this->result = array('message' => "Город был успешно обновлен!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't update data city.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    /**
     * @param $id
     * method for deleting cities
     */
    public function delete_city($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if ($this->delete($id))
            {
                $this->result = array('message' => "Город был успешно удален!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't delete current city.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    private function _validate_cities()
    {
        $this->form_validation->set_rules("name","Город","required|trim|max_length[100]|xss_clean");

        $this->form_validation->run();
    }
}
