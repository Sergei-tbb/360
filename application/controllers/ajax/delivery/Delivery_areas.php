<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 13.11.15
 * Time: 11:57
 */
class Delivery_areas extends MY_Controller
{
    private $result;
    public function __construct()
    {
        parent::__construct(array('tbname' => 'delivery_areas'));
        $this->load->helper(array('url', 'form'));

        $this->result = array();
    }

    public function display_all()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data['areas'] = $this->read_all();
            $data['cities'] = $this->read_custom("SELECT id, name FROM delivery_cities");
            $data['cities_areas'] = $this->read_custom("SELECT id, id_city, id_area FROM delivery_cities_areas");
            if(!empty($data['areas']))
            {
                $this->load->view('admin_panel/delivery_areas_list_view', $data);
            }
            else
            {
                    echo "Для отображения списка районов нужно создать хотя бы один район!";
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function create_new_area()
    {
      try
      {
          if ($this->input->is_ajax_request === FALSE) {
              throw new Exception("No direct script access allowed.");
          }

          $data = $this->input->post();

          if(empty($data))
          {
              throw new Exception("При создании нового района произошла ошибка!");
          }

          if($this->create($data))
          {
              $this->result = array('message' => 'Новый район был успешно создан!');
              echo $this->result['message'];
          }
          else
          {
              throw new Exception("При создании нового района произошла ошибка");
          }
      }
      catch(Exception $exp)
      {
          $this->result = array('message' => $exp->getMessage());
          echo $this->result['message'];
      }
    }

    public function read_one_area($id)
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if(empty($id))
            {
                throw new Exception("При загрузке района произошла ошибка");
            }

            if($this->read_one($id))
            {
                $data['area'] = $this->read_one($id);
                $this->load->view('admin_panel/delivery_areas_edit_view', $data);
            }
            else
            {
                throw new Exception("При загрузке района произошла ошибка");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function update_area($id)
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(empty($data))
            {
                throw new Exception("При обновлении района произошла ошибка");
            }

            if($this->update($id, array('name' => $data['name'])))
            {
                $this->result = array('message' => 'Данные района успешно обновлены');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("При обновлении данных района произошла ошибка");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function delete_area($id)
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if(empty($id))
            {
                throw new Exception("При удалении района произошла ошибка");
            }

            if($this->delete($id))
            {
                $this->result = array('message' => 'Район успешно удален!');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("При удалении района произошла ошибка");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }
}