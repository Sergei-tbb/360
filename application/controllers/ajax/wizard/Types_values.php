<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 30.10.15
 * Time: 15:36
 */

class Types_values extends MY_Controller
{
    private $result;

    public function __construct()
    {
        parent::__construct(array('tbname' => 'types_values'));
    }

    public function display_all()
    {
        $data['values'] = $this->read_all();

        if(empty($data['values']))
        {
            echo 'Для отображения значений нужно создать хотя бы одно значение';
        }
        else
        {
            $this->load->view('admin_panel/wizard/wizard_values_list_view', $data);
        }
    }

    public function add_value()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(empty($data['value']))
            {
                throw new Exception("Для успешного создания значения заполните все поля и повторите снова!");
            }

            if($this->create($data))
            {
                $this->result = array('message' => 'Новое значеное успешно создан!');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("При создании значения произошла ошибка");
            }
        }
        catch(Exception $ex)
        {
            $this->result = array('message' => $ex->getMessage());
            echo $this->result['message'];
        }
    }

    public function delete_value()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(empty($data['id']))
            {
                throw new Exception("При удалении выбранного значения произошла ошибка!");
            }

            if($this->delete($data['id']))
            {
                $this->result = array('message' => 'Выбранное значение было успешно удалёно!');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("При удалении выбранного значения произошла ошибка!");
            }
        }
        catch(Exception $ex)
        {
            $this->result = array('message' => $ex->getMessage());
            echo $this->result['message'];
        }
    }

    public function get_one_value()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(empty($data['id']))
            {
                throw new Exception("При загрузке данных значения произошла ошибка!");
            }

            if($this->read_one($data['id']))
            {
                $data['step'] = $this->read_one($data['id']);
                $this->load->view('admin_panel/wizard/wizard_values_edit_view', $data);
            }
            else
            {
                throw new Exception("При загрузке данных значения произошла ошибка!");
            }
        }
        catch(Exception $ex)
        {
            $this->result = array('message' => $ex->getMessage());
            echo $this->result['message'];
        }
    }

    public function update_value()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(empty($data['id']) || empty($data['value']))
            {
                throw new Exception("При обновлении данных значения произошла ошибка!");
            }

            if($this->update($data['id'], array('value' => $data['value'])))
            {
                $this->result = array('message' => 'Данные значения были успешно изменены!');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("При обновлении данных значения произошла ошибка!");
            }
        }
        catch(Exception $ex)
        {
            $this->result = array('message' => $ex->getMessage());
            echo $this->result['message'];
        }
    }
}