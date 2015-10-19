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
class Delivery_addresses extends MY_Controller {

    private $result;
    public function __construct()
    {
        parent::__construct(array('tbname' => 'delivery_addresses'));

        $this->result = array();
    }

    /**
     * @param $id_street
     * method for creating new department of delivery companies
     */
    public function new_department($id_street)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            $select_count = "SELECT COUNT(*) as count, id FROM delivery_regions_cities_streets WHERE id_street={$id_street}";

            $result_count = $this->read_custom($select_count);

            $check_department = "SELECT COUNT(*) as count FROM delivery_addresses
                      WHERE id_company={$data['id_company']}
                      AND id_region_city_street={$result_count['0']->id}
                      AND house_number={$data['house_number']}";
            $result_department = $this->read_custom($check_department);

            if($result_department['0']->count==0)
            {
                if ($result_count['0']->count == 1)
                {
                    $new_data = array(
                        'id_company' => $data['id_company'],
                        'id_region_city_street' => $result_count['0']->id,
                        'house_number' => $data['house_number'],
                        'department_number' => $data['department_number'],
                        'zip' => $data['zip'],
                        'phone' => $data['phone']
                    );

                    if ($this->create($new_data)) {
                        $this->result = array('message' => "Отделение было успешно добавлено!");
                        echo $this->result['message'];
                    } else {
                        throw new Exception("Can't add new delivery department.");
                    }
                }
            }
            else
            {
                throw new Exception("Это отделение было создано ранее!");
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
     * method for deleting current departments of delivery companies
     */
    public function delete_department($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if($this->delete($id))
            {
                $this->result = array('message' => 'Выбранное отделение было успешно удалено!');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Не удалось удалить выбранное отделение.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    /**
     * method for getting list of addresses
     */
    public function get_list_addresses()
    {
        $string_company = "SELECT * FROM delivery_companies";
        $string_rcs = "SELECT * FROM delivery_regions_cities_streets";
        $string_rc = "SELECT * FROM delivery_regions_cities";
        $string_regions = "SELECT * FROM delivery_regions";
        $string_cities = "SELECT * FROM delivery_cities";
        $string_streets = "SELECT * FROM delivery_streets";
        $data['companies'] = $this->read_custom($string_company);
        $data['addresses'] = $this->read_all();
        $data['rcs'] = $this->read_custom($string_rcs);
        $data['rc'] = $this->read_custom($string_rc);
        $data['streets'] = $this->read_custom($string_streets);
        $data['cities'] = $this->read_custom($string_cities);
        $data['regions'] = $this->read_custom($string_regions);
        if(empty($data['addresses']) or empty($data['companies']))
        {
            $this->result = array('message' => 'Для отображения списка отделений нужно добавить хотя бы одно отделение!');
            echo $this->result['message'];
        }
        else {
            $this->load->view('admin_panel/delivery_addresses_list_view', $data);
        }
    }
}
