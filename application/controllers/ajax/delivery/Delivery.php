<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 17.10.15
 * Time: 22:55
 */
class Delivery extends MY_Controller
{
    private $result;

    public function __construct()
    {
        parent::__construct(array('tbname' => 'delivery_companies'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    /**
     * method for getting list of delivery companies
     */
    public function get_list_delivery_companies()
    {
        $data['companies'] = $this->read_all();
        if(empty($data['companies']))
        {
            $this->result = array('message' => 'Для отображения списка компаний доставки нужно добавить хотя бы одну компанию!');
            echo $this->result['message'];
        }
        else {
            $this->load->view('admin_panel/delivery_companies_list_view', $data);
        }
    }

    /**
     * method for creating new delivery companies
     */
    public function new_delivery_company()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_company() === FALSE)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->create($data))
            {
                $this->result = array('message' => "{$data['name']} была успешно добавлена!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't add new delivery company.");
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
     * method for deleting delivery companies
     */
    public function delete_delivery_company($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if ($this->delete($id))
            {
                $this->result = array('message' => "Компания была успешно удалена!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't delete delivery company.");
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
     * method for getting all data of the delivery company
     */
    public function get_one_company($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if ($this->read_one($id))
            {
                $data['company'] = $this->read_one($id);
                $this->load->view('admin_panel/delivery_edit_company_view', $data);
            }
            else
            {
                throw new Exception("Can't add new delivery company.");
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
     * method for editing all data of delivery companies
     */
    public function edit_delivery_company($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_company() === FALSE)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->update($id, $data))
            {
                $this->result = array('message' => "Данные компании были успешно обновлены!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't update delivery company.");
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
     * method for loading departments of delivery companies
     */
    public function load_delivery_department_view($id)
    {
        $string_countries = "SELECT * FROM delivery_countries";
        $string_regions = "SELECT * FROM delivery_regions";
        $string_cities = "SELECT * FROM delivery_cities";
        $string_streets = "SELECT * FROM delivery_streets";

        $data['countries'] = $this->read_custom($string_countries);
        $data['regions'] = $this->read_custom($string_regions);
        $data['cities'] = $this->read_custom($string_cities);
        $data['streets'] = $this->read_custom($string_streets);
        $data['id'] = $id;
        if(empty($data['countries']) or empty($data['regions']) or empty($data['cities']) or empty($data['streets']))
        {
            $this->result = array('message' => 'Ошибка при загрузке данных!');
            echo $this->result['message'];
        }
        else {
            $this->load->view('admin_panel/delivery_departments_new_view', $data);
        }
    }

    private function _validate_company()
    {
        $this->form_validation->set_rules("name","Имя компании","required|trim|max_length[100]|xss_clean");
        $this->form_validation->set_rules("website","Сайт компании","required|trim|max_length[100]|xss_clean");

        return $this->form_validation->run();
    }
}
