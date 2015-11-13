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
     * method for creating new department of delivery companies
     */
    public function new_department($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            $new_department = array(
                'id_company' => $id,
                'id_country' => $data['id_country'],
                'id_region' => $data['id_region'],
                'id_city' => $data['id_city'],
                'id_street' => $data['id_street'],
                'house_number' => $data['house_number'],
                'department_number' => $data['department_number'],
                'zip' => $data['zip'],
                'phone' => $data['phone'],
                'schedule' => $data['schedule'],
                'location' => $data['location'],
                'note' => $data['note'],
                'id_area' => $data['id_area']
            );

            if(!empty($new_department))
            {
                if($this->create($new_department))
                {
                    $this->result = array('message' => 'Новое отделение было успешно создано');
                    echo $this->result['message'];
                }
            }
            else
            {
                throw new Exception("Ошибка при создании нового отделения");
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
        $data['addresses'] = $this->read_custom("SELECT delivery_addresses.id as address_id,
                delivery_addresses.id_company as company_id,
                delivery_companies.name as company_name,
                delivery_countries.name as country_name,
                delivery_regions.name as region_name,
                delivery_cities.name as city_name,
                delivery_streets.name as street_name,
                delivery_addresses.house_number as house_number,
                delivery_addresses.department_number as department_number,
                delivery_addresses.zip as zip,
                delivery_addresses.phone as phone,
                delivery_areas.name as area_name
                FROM delivery_addresses, delivery_companies,
                delivery_countries, delivery_regions,
                delivery_cities, delivery_streets,
				delivery_areas
                WHERE delivery_addresses.id_company=delivery_companies.id
                AND delivery_addresses.id_country=delivery_countries.id
                AND delivery_addresses.id_region=delivery_regions.id
                AND delivery_addresses.id_city=delivery_cities.id
                AND delivery_addresses.id_street=delivery_streets.id
				AND delivery_addresses.id_area=delivery_areas.id
                group by delivery_addresses.id");

        if(empty($data['addresses']))
        {
            $this->result = array('message' => 'Для отображения списка отделений нужно добавить хотя бы одно отделение!');
            echo $this->result['message'];
        }
        else {
            $this->load->view('admin_panel/delivery_addresses_list_view', $data);
        }
    }

    public function get_one_department($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if($this->read_one($id))
            {
                $data['department'] = $this->read_one($id);
                $data['countries'] = $this->read_custom('SELECT id,  name FROM delivery_countries');
                $data['regions'] = $this->read_custom('SELECT id,  name FROM delivery_regions');
                $data['cities'] = $this->read_custom('SELECT id,  name FROM delivery_cities');
                $data['streets'] = $this->read_custom('SELECT id,  name FROM delivery_streets');
                $data['areas'] = $this->read_custom("SELECT id, name FROM delivery_areas");
                $data['id'] = $id;
                $this->load->view('admin_panel/delivery_department/delivery_department_edit_view', $data);
            }
            else
            {
                throw new Exception("Не удалось загрузить выбранное отделение.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function update_department($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if($this->update($id, $data))
            {
                $this->result = array('message' => 'Данные отделения успешно обновлены');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Не удалось загрузить выбранное отделение.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }
}
