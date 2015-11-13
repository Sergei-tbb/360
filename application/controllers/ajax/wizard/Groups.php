<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 30.10.15
 * Time: 13:48
 */
class Groups extends MY_Controller
{
    private $result;

    public function __construct()
    {
        parent::__construct(array('tbname' => 'groups'));
        $this->load->helper(array('url', 'form'));
        $this->load->library("form_validation");

        $this->result = array();
    }

    public function display_all()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception('Ошибка при загрузке списка групп параметров');
            }

            $data['groups'] = $this->read_all();
            $data['groups_parameters'] = $this->read_custom('SELECT parameters.name as parameter_name
                    FROM parameters, groups_parametrs, groups
                    WHERE parameters.id=groups_parametrs.id_parameter
                    AND groups.id=groups_parametrs.id_group');
            if(empty($data['groups']))
            {
                echo 'Для отображения групп параметров нужно создать хотя бы один параметр';
            }
            else
            {
                $this->load->view('admin_panel/wizard/wizard_groups_list_view', $data);
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp.getMessage());
            echo $this->result['message'];
        }
    }

    public function add_group()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("При создании группы параметров произошла ошибка");
            }

            $data = $this->input->post();

            if(empty($data['name']))
            {
                throw new Exception("Для создания группы параметров заполните все поля и попробуйте снова!");
            }

            if($this->create(array('name' => $data['name'])))
            {
                $this->result = array('message' => 'Новая группа параметро успешно создана!');
                echo $this->result['message'];
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function delete_group()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("При удалении группы параметров произошла ошибка");
            }

            $data = $this->input->post();

            if(empty($data['id']))
            {
                throw new Exception("При удалении группы параметров произошла ошибка");
            }

            if($this->delete($data['id']))
            {
                $this->result = array('message' => 'Выбранная группа параметров была успешно удалена!');
                echo $this->result['message'];
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function get_one_group()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("При загрузке данных выбранной группы произошла ошибка");
            }

            $data = $this->input->post();

            if(empty($data['id']))
            {
                throw new Exception("При загрузке данных выбранной группы произошла ошибка");
            }

            if($this->read_one($data['id']))
            {
                $data['group'] = $this->read_one($data['id']);
                $this->load->view('admin_panel/wizard/wizard_group_edit_view', $data);
            }
            else
            {
                throw new Exception("При загрузке данных выбранной группы произошла ошибка");
            }
        }
        catch(Exception $ex)
        {
            $this->result = array('message' => $ex->getMessage());
            echo $this->result['message'];
        }
    }

    public function update_group()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("При обновлении группы параметров произошла ошибка");
            }

            $data = $this->input->post();

            if(empty($data['id']) || empty($data['name']))
            {
                throw new Exception("Для успешного обновления данных группы параметров заполните все поля!");
            }

            if($this->update($data['id'], array('name' => $data['name'])))
            {
                $this->result = array('message' => 'Группа параметров была успешно обновлена');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("При обновлении группы параметров произошла ошибка");
            }
        }
        catch(Exception $ex)
        {
            $this->result = array('message' => $ex->getMessage());
            echo $this->result['message'];
        }
    }
}