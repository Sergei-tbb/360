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
class Delivery_regions_cities extends MY_Controller
{

    private $result;

    public function __construct()
    {
        parent::__construct(array('tbname' => 'delivery_regions_cities'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    /**
     * method for adding cities to regions
     */
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
                $new_data = array(
                    'id_region' => $data['id_region'],
                    'id_city' => $data['id_city'][$i]
                );

                $string = "SELECT COUNT(*) as count FROM delivery_regions_cities
                            WHERE id_region='{$data['id_region']}'
                            AND id_city='{$data['id_city'][$i]}'";

                $result_count = $this->read_custom($string);

                if($result_count['0']->count==0)
                {
                    if($this->create($new_data))
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
