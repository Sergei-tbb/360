<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 13.10.15
 * Time: 17:04
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Pages extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(array("tbname" => "pages"));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    /**
     * getting list of pages
     */
    public function pages_list()
    {
        $data['pages'] = $this->read_all();
        $this->load->view('admin_panel/pages_list_view', $data);
    }

    /**
     * deleting page
     */
    public function delete_page()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(is_null($data) || $this->_validation_delete_page()===false)
            {
                throw new Exception("Invalid data!");
            }

            if($this->delete($data['id']))
            {
                $this->result = array("message" => "Page was delete successfully.");
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

    private function _validation_delete_page()
    {
        $this->form_validation->set_rules('id', 'Номер страницы', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * creating new page
     */
    public function new_page()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if($this->_validation_new_page() === false)
            {
                throw new Exception("Invalid data!");
            }

            if($this->create($data))
            {
                $this->result = array("message" => "Page was successfully created.");
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

    private function _validation_new_page()
    {
        $this->form_validation->set_rules('title', 'Заголовок', 'required');
        $this->form_validation->set_rules('date_time', 'Дата создания', 'required');
        $this->form_validation->set_rules('keywords', 'Ключевые слова', 'required');
        $this->form_validation->set_rules('description', 'Описание страницы', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * @param $id - id of page for publish/unpublish
     */
    public function publish_page($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            if($this->read_one($id))
            {
                $state = $this->read_one($id);

                if($state['0']->is_published==1)
                {
                    $new_data = array('is_published' => 0);
                }
                elseif($state['0']->is_published==0)
                {
                    $new_data = array('is_published' => 1);
                }

                if ($this->update($id, $new_data))
                {
                    $this->result = array("message" => "Page was updated successfully.");
                    echo $this->result['message'];
                }
                else
                {
                    throw new Exception(".");
                }
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    private function _validation_publish_page()
    {
        $this->form_validation->set_rules('is_published', 'Опубликовано', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * @param $id - id of page for getting all data
     */
    public function get_page($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            if($this->read_one($id))
            {
                $data['pages'] = $this->read_one($id);
                $this->load->view('admin_panel/pages_edit_view', $data);
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
     * @param $id - id of page for updating
     */
    public function update_page($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if($this->_validation_update_page()===false)
            {
                throw new Exception("Invalid data!");
            }

            if($this->update($id, $data))
            {
                $this->result = array("message" => "Page was updated successfully.");
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

    private function _validation_update_page()
    {
        $this->form_validation->set_rules('title', 'Заголовок', 'required');
        $this->form_validation->set_rules('keywords', 'Ключевые слова', 'required');
        $this->form_validation->set_rules('description', 'Описание страницы', 'required');
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

    public function display_page($id)
    {
        if($this->read_custom("SELECT COUNT(*) as count FROM menus_pages WHERE id_page={$id}"))
        {
            $count = $this->read_custom("SELECT COUNT(*) as count FROM menus_pages WHERE id_page={$id}");
            if($count['0']->count==1)
            {
                if($this->read_one($id))
                {
                    $data['page'] = $this->read_one($id);
                    $this->load->view('static_page/index_view', $data);
                }
            }
        }
    }

}