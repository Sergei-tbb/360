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
        $string = "SELECT * FROM delivery_regions";
        $data['cities'] = $this->read_all();
        $data['regions'] = $this->read_custom($string);
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

    public function add_regions_cities()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            $count = count($data['id_city']);

            for($i=0; $i<=$count-1; $i++)
            {

                $string = "SELECT COUNT(*) as count FROM delivery_cities
                            WHERE id_region='{$data['id_region']}'
                            AND id='{$data['id_city'][$i]}'";

                $result_count = $this->read_custom($string);

                if($result_count['0']->count==0)
                {
                    if($this->update($data['id_city'][$i], array('id_region' => $data['id_region'])))
                    {
                        $this->result = array('message' => 'Город был успешно добавлен!');
                    }
                    else
                    {
                        throw new Exception("Can't add city to region.");
                    }
                }
            }
            echo $this->result['message'];
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

}
