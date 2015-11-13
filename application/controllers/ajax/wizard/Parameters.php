<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 30.10.15
 * Time: 13:13
 */
class Parameters extends MY_Controller
{
    private $result;
    public function __construct()
    {
        parent::__construct(array('tbname' => 'parameters'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");

        $this->result = array();
    }

    public function display_all()
    {
        $data['parameters'] = $this->read_all();
        if(empty($data['parameters'])):
            echo 'Для отображения списка параметров нужно создать хотя бы один параметр!';
        else:
            $this->load->view('admin_panel/wizard/parameters_list_view', $data);
        endif;
    }

    public function add_parameter()
    {
        try
        {
            if ($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(empty($data['name']))
            {
                throw new Exception('Заполните все поля и попробуйте снова');
            }

            if($this->create($data))
            {
                $this->result = array('message' => 'Новый параметр успешно добавлен!');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception('При создании нового параметра произошла ошибка!');
            }

        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function delete_parameter()
    {
        try
        {
            if ($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(empty($data['id']))
            {
                throw new Exception('При удалении параметра произошла ошибка');
            }

            if($this->delete($data['id']))
            {
                $this->result = array('message' => 'Выбранный параметр успешно удален!');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception('При удалении параметра произошла ошибка!');
            }

        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function get_one_parameter()
    {
        try
        {
            if ($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(empty($data['id']))
            {
                throw new Exception('При загрузке данных параметра произошла ошибка');
            }

            if($this->read_one($data['id']))
            {
                $data['parameter'] = $this->read_one($data['id']);
                $this->load->view('admin_panel/wizard/wizard_parameter_edit_view', $data);
            }
            else
            {
                throw new Exception('При загрузке данных параметра произошла ошибка');
            }

        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function update_parameter()
    {
        try
        {
            if ($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(empty($data['id']) || empty($data['name']))
            {
                throw new Exception('При загрузке данных параметра произошла ошибка');
            }

            if($this->update($data['id'], array('name' => $data['name'])))
            {
                $this->result = array('message' => 'Данные параметра успешно обновлены');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception('При загрузке данных параметра произошла ошибка');
            }

        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }
}