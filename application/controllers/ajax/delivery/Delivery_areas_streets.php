<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 13.11.15
 * Time: 14:35
 */
class Delivery_areas_streets extends MY_Controller
{
    private $result;
    public function __construct()
    {
        parent::__construct(array('tbname' => 'delivery_areas_streets'));

        $this->result = array();
    }

    public function load_cities_list($id)
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }
            $data = $this->input->post();

            $query = "SELECT delivery_areas.id, delivery_areas.name FROM delivery_areas, delivery_cities, delivery_cities_areas WHERE delivery_cities_areas.id_city={$id} AND delivery_areas.id=delivery_cities_areas.id_area";
            if($this->read_custom($query))
            {
                $data['areas'] = $this->read_custom($query);
                if(!empty($data)):
                    $this->load->view('admin_panel/delivery_areas/delivery_area_street_inputs_view', $data);
                else:
                    echo 'Для отображения списка районов, привязанных к городу, необходимо привязать хотя бы один район к выбранному городу!';
                endif;
            }
            else
            {
                throw new Exception("При загрузке списка районов произошла ошибка");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function load_areas_streets($id)
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if(empty($id))
            {
                throw new Exception("При загрузке списка районов произошла ошибка!");
            }

            if($this->read_custom("SELECT id, name FROM delivery_areas"))
            {
                $data['cities'] = $this->read_custom("SELECT id, name FROM delivery_cities");
                $data['id'] = $id;
                $this->load->view("admin_panel/delivery_area_street_view", $data);
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

    public function add_area_street()
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
                $new_area_street = array(
                    'id_area' => $data['id_area'],
                    'id_street' => $data['id_street']
                );

                if($data['id_area']!=0)
                {
                    if ($this->create($new_area_street))
                    {
                        $this->result = array('message' => 'Улица успешно привязан к району!');
                        echo $this->result['message'];
                    }
                    else
                    {
                        throw new Exception("При привязке улицы к району произошла ошибка!");
                    }
                }
                elseif($data['id_area']==0)
                {
                    if($this->read_custom("SELECT id FROM delivery_areas_streets WHERE id_street=".$data['id_street']))
                    {
                        $result = $this->read_custom("SELECT id FROM delivery_areas_streets WHERE id_street=".$data['id_street']);
                        if($this->delete($result['0']->id))
                        {
                            $this->result = array('message' => 'Улица успешно отвязана от района!');
                            echo $this->result['message'];
                        }
                        else
                        {
                            throw new Exception("При отвязке улицы от района произошла ошибка");
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