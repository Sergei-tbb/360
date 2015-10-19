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
class Delivery_region_cities extends MY_Controller
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

    public function add_regions_cities()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->create($data))
            {
                $this->result = array('message' => "Город был успешно добавлен!");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't add city to region.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }


}
