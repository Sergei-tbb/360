<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 19.10.15
 * Time: 14:33
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Faq extends MY_Controller
{
    private $result;

    public function __construct()
    {
        parent::__construct(array('tbname' => 'faq'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->helper("security");
        $this->result = array();
    }

    /***
     * @data['faq'] - array with data about pages of FAQ
     *
     */
    public function get_list_faq()
    {
        $data['faq'] = $this->read_all();

        if(!empty($data['faq']))
        {
            $this->load->view('admin_panel/faq/faq_list_view', $data);
        }
        else
        {
            $this->result = array('message' => 'Для отображения страниц раздела помощи нужно добавить хотя бы одну страницу!');
            echo $this->result['message'];
        }
    }

    /**
     *create FAQ page
     */
    public function add_faq()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if($this->_validate_faq() === false)
            {
                throw new Exception("Invalid data!");
            }

            if($this->create($data))
            {
                $this->result = array("message" => "Page faq was successfully created.");
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

    /**
     * @param $id - id of FAQ page
     */
    public function delete_faq($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }


            if($this->delete($id))
            {
                $this->result = array("message" => "Page faq was successfully deleted.");
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

    /**
     * @param $id - id of FAQ page
     */
    public function get_one_faq($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            if($this->read_one($id))
            {
                $data['faq'] = $this->read_one($id);
                $this->load->view('admin_panel/faq/faq_edit_view', $data);
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

    /**
     * @param $id - id of FAQ page
     */
    public function edit_faq($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if($this->_validate_faq() === false)
            {
                throw new Exception("Invalid data!");
            }

            if($this->update($id, $data))
            {
                $this->result = array("message" => "Page faq was successfully updated.");
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


    private function _validate_faq()
    {
        $this->form_validation->set_rules('title', 'Заголовок', 'required');
        $this->form_validation->set_rules('page_data', 'Текст страницы', 'required');

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