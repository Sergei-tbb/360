<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 14.10.15
 * Time: 23:34
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Menus extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(array('tbname' => 'menus'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    public function menu_list()
    {
        $data['menus'] = $this->read_all();
        $this->load->view('admin_panel/menus_list_view', $data);
    }

    public function new_menu()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if($this->_validation_new_menu() === false)
            {
                throw new Exception("Invalid data!");
            }

            if($this->create($data))
            {
                $this->result = array("message" => "Menu was successfully created.");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception(".");
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    private function _validation_new_menu()
    {
        $this->form_validation->set_rules('name', 'Имя меню', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function get_menu($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            if($this->read_one($id))
            {
                $data['menu'] = $this->read_one($id);
                $this->load->view('admin_panel/menus_edit_view', $data);
            }
            else
            {
                throw new Exception(".");
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function update_menu($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if($this->_validation_update_menu()===false)
            {
                throw new Exception("Invalid data!");
            }

            if($this->update($id, $data))
            {
                $this->result = array("message" => "Menu was updated successfully.");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception(".");
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    private function _validation_update_menu()
    {
        $this->form_validation->set_rules('name', 'Имя меню', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function delete_menu($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            if($this->delete($id))
            {
                $this->result = array("message" => "Menu was deleted successfully.");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception(".");
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function get_pages_menu($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $string = "SELECT pages.id, menus.id as menu_id, menus.name FROM pages JOIN menus WHERE pages.id={$id}";
            if($this->read_custom($string))
            {
                $data['menu'] = $this->read_custom($string);
                $this->load->view('admin_panel/menus_pages_view', $data);
            }
            else
            {
                throw new Exception(".");
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

}