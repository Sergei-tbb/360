<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Price_list extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("price_list/Price_list_model");
    }

    /**
     * Display parameters list
     * public
     * return null
     */
    public function display_parameters_list()
    {
        $data['price_list'] = $this->Price_list_model->get_list_data();
       try
       {
           if($data['price_list'] === FALSE)
           {
                throw new Exception("Not found data about price list");
           }

           $this->load->view("price_list/price_list_view", $data);
       }
       catch(Exception $exp)
       {
            echo $exp->getMessage();
       }
    }

    private function _exchange_rates()
    {

    }
}