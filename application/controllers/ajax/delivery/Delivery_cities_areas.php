<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 13.11.15
 * Time: 13:46
 */
class Delivery_cities_areas extends MY_Controller
{
    private $result;
    public function __construct()
    {
        parent::__construct(array('tbname' => 'delivery_cities_areas'));

        $this->result = array();
    }

    public function load_cities_areas($id)
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if(empty($id))
            {
                throw new Exception("При загрузке списка городов произошла ошибка!");
            }

            if($this->read_custom("SELECT id, name FROM delivery_cities"))
            {
                $data['cities'] = $this->read_custom("SELECT id, name FROM delivery_cities");
                $data['cities_areas'] = $this->read_all();
                $data['id'] = $id;
                $this->load->view("admin_panel/delivery_city_area_view", $data);
            }
            else
            {
                throw new Exception("No direct script access allowed.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function add_cities_areas()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(!empty($data))
            {
                $new_city_area = array(
                    'id_city' => $data['id_city'],
                    'id_area' => $data['id_area']
                );

                if($data['id_city']!=0)
                {
                    if ($this->create($new_city_area))
                    {
                        $this->result = array('message' => 'Район был успешно привязан к городу!');
                        echo $this->result['message'];
                    }
                    else
                    {
                        throw new Exception("При привязке района к городу произошла ошибка!");
                    }
                }
                elseif($data['id_city']==0)
                {
                    if($this->read_custom("SELECT id FROM delivery_cities_areas WHERE id_area=".$data['id_area']))
                    {
                        $result = $this->read_custom("SELECT id FROM delivery_cities_areas WHERE id_area=".$data['id_area']);
                        if($this->delete($result['0']->id))
                        {
                            $this->result = array('message' => 'Район был успешно отвязан от города!');
                            echo $this->result['message'];
                        }
                        else
                        {
                            throw new Exception("При отвязке района от города произошла ошибка");
                        }
                    }
                }
            }
            else
            {
                throw new Exception("При привязке района к городу произошла ошибка!");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }
}