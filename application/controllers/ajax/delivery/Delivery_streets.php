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

    public function __construct()
    {
        parent::__construct(array('tbname' => 'delivery_streets'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    /**
     * getting list of the streets
     */
    public function get_list_streets()
    {
        $data['streets'] = $this->read_all();
        $data['cities'] = $this->read_custom("SELECT * FROM delivery_cities");
        if(empty($data['streets']))
        {
            $this->result = array('message' => 'Для отображения списка улиц нужно добавить хотя бы одну улицу!');
            echo $this->result['message'];
        }
        else {
            $this->load->view('admin_panel/delivery_streets_list_view', $data);
        }
    }

    /**
     * method for adding new streets
     */
    public function add_street()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_street() === FALSE)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->create($data))
            {
                $this->result = array('message' => "Улица была успешно добавлена!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't add new street.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    /**
     * @param $id - id of street for get all data
     */
    public function get_one_street($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if ($this->read_one($id))
            {
                $data['street'] = $this->read_one($id);
                $data['id'] = $id;
                $this->load->view('admin_panel/delivery_streets_edit_view', $data);
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
     * @param $id - var for edit street
     */
    public function edit_street($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_street() === FALSE)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->update($id, $data))
            {
                $this->result = array('message' => "Улица была успешно обновлена!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't update data street.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    /**
     * @param $id - variable for deleting street
     */
    public function delete_street($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if ($this->delete($id))
            {
                $this->result = array('message' => "Улица была успешно удалена!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't delete current street.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    /**
     * @param $city
     * region - id region
     * city - id city
     * method for getting list of the streets in cities
     */
    public function load_streets($city)
    {
        $data['streets'] = $this->read_custom("SELECT delivery_streets.id_city as id_city,
                                                delivery_streets.id as street_id,
                                                delivery_streets.name as street_name
                                                FROM delivery_cities, delivery_streets
                                                WHERE delivery_streets.id_city={$city}
                                                OR delivery_streets.id_city=0
                                                GROUP BY street_id;");
        $data['id'] = $city;
        $data['cities'] = $this->read_custom("SELECT * FROM delivery_cities");
        if(!empty($data['streets']))
        {
            $this->load->view('admin_panel/delivery_cities_streets_view', $data);
        }
    }

    public function create_city_street()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            $count = count($data['id_street']);

            for($i=0; $i<=$count-1; $i++)
            {
                $select_street = $this->read_custom("SELECT COUNT(*) as count
                                                    FROM delivery_streets
                                                    WHERE id={$data['id_street'][$i]}
                                                    AND id_city={$data['id_city']}");
                if($select_street['0']->count==0)
                {
                    if($this->update($data['id_street'][$i], array('id_city' => $data['id_city'])))
                    {
                        $this->result = array('message' => 'Улица(ы) успешно привязаны к городу');
                    }
                    else
                    {
                        throw new Exception('Ошибка при привязке улиц к городу');
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


    private function _validate_street()
    {
        $this->form_validation->set_rules("name","Улица","required|trim|max_length[100]|xss_clean");

        $this->form_validation->run();
    }
}
