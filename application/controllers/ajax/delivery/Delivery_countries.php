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
class Delivery_countries extends MY_Controller {

    public function __construct()
    {
        parent::__construct(array('tbname' => 'delivery_countries'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    public function get_list_countries()
    {
        $data['country'] = $this->read_all();
        if(empty($data['country']))
        {
            $this->result = array('message' => 'Для отображения списка стран нужно добавить хотя бы одну страну!');
            echo $this->result['message'];
        }
        else {
            $this->load->view('admin_panel/delivery_countries_list_view', $data);
        }
    }

    public function add_country()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_countries() === FALSE)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->create($data))
            {
                $this->result = array('message' => "Страна была успешно добавлена!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't add new country.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function get_one_country($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if ($this->read_one($id))
            {
                $data['country'] = $this->read_one($id);
                $this->load->view('admin_panel/delivery_country_edit_view', $data);
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

    public function edit_country($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_countries() === FALSE)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->update($id, $data))
            {
                $this->result = array('message' => "Страна была успешно обновлена!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't update data country.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function delete_country($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if ($this->delete($id))
            {
                $this->result = array('message' => "Страна была успешно удалена!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't delete country.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function load_countries_regions_view($id)
    {
        $string = "SELECT * FROM delivery_regions";
        $data['regions'] = $this->read_custom($string);
        $data['id'] = $id;
        if(empty($data['regions']))
        {
            $this->result = array('message' => 'Can`t load regions');
            echo $this->result['message'];
        }
        else
        {
            $this->load->view('admin_panel/delivery_countries_regions_add_view',  $data);
        }
    }

    private function _validate_countries()
    {
        $this->form_validation->set_rules("name","Страна","required|trim|max_length[100]|xss_clean");

        $this->form_validation->run();
    }
}
