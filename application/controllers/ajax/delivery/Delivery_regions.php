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
class Delivery_regions extends MY_Controller {

    public function __construct()
    {
        parent::__construct(array('tbname' => 'delivery_regions'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    /**
     * method for getting list of the regions
     */
    public function get_list_regions()
    {
        $string = "SELECT * FROM delivery_countries";
        $data['regions'] = $this->read_all();
        $data['countries'] = $this->read_custom($string);
        if(empty($data['regions']) or empty($data['countries']))
        {
            $this->result = array('message' => 'Для отображения списка регионов нужно добавить хотя бы один регион!');
            echo $this->result['message'];
        }
        else {
            $this->load->view('admin_panel/delivery_regions_list_view', $data);
        }
    }

    /**
     * method for addition regions to countries
     */
    public function load_new_region()
    {
        $string = "SELECT * FROM delivery_countries";
        $data['country'] = $this->read_custom($string);
        if(empty($data['country']))
        {
            $this->result = array('message' => 'Для отображения списка стран нужно добавить хотя бы одну страну!');
            echo $this->result['message'];
        }
        else {
            $this->load->view('admin_panel/delivery_regions_new_view', $data);
        }
    }

    /**
     * method for addition new regions
     */
    public function add_region()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_regions() === FALSE)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->create($data))
            {
                $this->result = array('message' => "Регион был успешно добавлен!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't add new region.");
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
     * method for getting all data of regions
     */
    public function get_one_region($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if ($this->read_one($id))
            {
                $string = "SELECT * FROM delivery_countries";
                $data['region'] = $this->read_one($id);
                $data['countries'] = $this->read_custom($string);
                $data['id'] = $id;
                $this->load->view('admin_panel/delivery_regions_edit_view', $data);
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
     * method for editing all data of regions
     */
    public function edit_region($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_regions() === FALSE)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->update($id, $data))
            {
                $this->result = array('message' => "Регион был успешно обновлен!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't update data region.");
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
     * method for deleting regions
     */
    public function delete_region($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if ($this->delete($id))
            {
                $this->result = array('message' => "Регион был успешно удален!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't delete current region.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    /**
     * method for addition regions to country
     */
    public function add_country_regions($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->update($id, $data))
            {
                $this->result = array('message' => "Регион был успешно добавлен!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't add new region.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    /**
     * method for loading list cities of regions
     */
    public function load_regions_cities($id)
    {
        $string = "SELECT * FROM delivery_cities";
        $string_regions_cities = "SELECT * FROM delivery_regions_cities";
        $data['cities'] = $this->read_custom($string);
        $data['regions_cities'] = $this->read_custom($string_regions_cities);
        $data['id'] = $id;

        if(empty($data['cities']))
        {
            $this->result = array('message' => 'Добавьте хотя бы один город!');
            echo $this->result['message'];
        }
        else
        {
            $this->load->view('admin_panel/delivery_regions_cities_view', $data);
        }
    }

    private function _validate_regions()
    {
        $this->form_validation->set_rules("name","Регион","required|trim|max_length[100]|xss_clean");
        $this->form_validation->set_rules("id_country","Страна","required|trim|max_length[100]|xss_clean");

        $this->form_validation->run();
    }
}
