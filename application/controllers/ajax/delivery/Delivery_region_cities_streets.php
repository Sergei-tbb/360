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
class Delivery_region_cities_streets extends MY_Controller {

    private $result;
    public function __construct()
    {
        parent::__construct(array("tbname" => 'delivery_regions_cities_streets'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    public function create_new_region_city_street($id_region, $id_city)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            $select_array = "SELECT COUNT(*) as count, id FROM delivery_regions_cities WHERE id_region='{$id_region}' AND id_city='{$id_city}'";

            $select = $this->read_custom($select_array);

            if($select['0']->count==0)
            {
                throw new Exception("Для привязки улицы к городу нужно привязать город к региону!");
            }
            else
            {
                $count = count($data['id_street']);

                for($i=0; $i<=$count-1; $i++)
                {
                    $new_data = array(
                        'id_region_city' => $select['0']->id,
                        'id_street' => $data['id_street'][$i]
                    );

                    $select_count = "SELECT COUNT(*) as count FROM delivery_regions_cities_streets WHERE id_street={$data['id_street'][$i]}";

                    if($this->read_custom($select_count))
                    {
                        $result = $this->read_custom($select_count);
                        if($result['0']->count==0)
                        {
                            if($this->create($new_data))
                            {
                                $this->result = array('message' => 'Улица успешно добавлена!');
                            }
                            else
                            {
                                throw new Exception("Can't add street to city!");
                            }
                        }
                    }
                }
                echo $this->result['message'];
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }
}
