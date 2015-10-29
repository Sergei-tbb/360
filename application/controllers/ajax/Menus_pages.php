<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 15.10.15
 * Time: 12:01
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Menus_pages extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(array('tbname' => 'menus_pages'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");

        $this->result = array();
    }

    /**
     * @param $id
     * method for getting all data of pages menus
     */
    public function get_menu_pages($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $string = "SELECT menus_pages.id as mp_id, pages.title, pages.id FROM menus_pages, pages WHERE menus_pages.id_page=pages.id AND menus_pages.id_menu={$id}";
            if($this->read_custom($string))
            {
                $data['pages'] = $this->read_custom($string);
                $this->load->view('admin_panel/pages_menus_view', $data);
            }
            else
            {
                throw new Exception("Для отображения привязанных страниц в данном меню добавьте хотя бы одну страницу!");
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    /**
     * method for adding pages to menus
     */
    public function add_pages_menu()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if($this->_validation_add_pages_menu()===false)
            {
                throw new Exception("Invalid data!");
            }

            if($this->create($data))
            {
                $this->result = array("message" => "Page was successfully added to menu.");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Error");
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
     * method for deleting pages from menus
     */
    public function delete_menu_page($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            if($this->delete($id))
            {
                $this->result = array("message" => "Page was successfully deleted from menu.");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Error");
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    private function _validation_add_pages_menu()
    {
        $this->form_validation->set_rules('id_page', 'Номер страницы', 'required');
        $this->form_validation->set_rules('id_menu', 'Номер меню', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }


}