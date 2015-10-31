<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 30.10.15
 * Time: 14:59
 */

class Steps extends MY_Controller
{
    private $result;
    public function __construct()
    {
        parent::__construct(array('tbname' => 'steps'));

        $this->result = array();
    }

    public function display_all()
    {
        $data['steps'] = $this->read_all();
        $data['wizard_steps'] = $this->read_custom('SELECT groups.name as group_name
                        FROM steps, groups, steps_groups_parametrs
                        WHERE steps.id=steps_groups_parametrs.id_steps
                        AND groups.id=steps_groups_parametrs.id_groups_parametrs');
        if(empty($data['steps']))
        {
            echo 'Для отображения списка шагов нужно создать хотя бы один шаг!';
        }
        else
        {
            $this->load->view('admin_panel/wizard/wizard_steps_list_view', $data);
        }
    }

    public function add_step()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(empty($data['name']))
            {
                throw new Exception("Для успешного создания шага заполните все поля и повторите снова!");
            }

            if($this->create($data))
            {
                $this->result = array('message' => 'Новый шаг успешно создан!');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("При создании шага произошла ошибка");
            }
        }
        catch(Exception $ex)
        {
            $this->result = array('message' => $ex->getMessage());
            echo $this->result['message'];
        }
    }

    public function delete_step()
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
                throw new Exception("При удалении выбранного шага произошла ошибка!");
            }

            if($this->delete($data['id']))
            {
                $this->result = array('message' => 'Выбранный шаг был успешно удалён!');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("При удалении выбранного шага произошла ошибка!");
            }
        }
        catch(Exception $ex)
        {
            $this->result = array('message' => $ex->getMessage());
            echo $this->result['message'];
        }
    }

    public function get_one_step()
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
                throw new Exception("При загрузке данных шага произошла ошибка!");
            }

            if($this->read_one($data['id']))
            {
                $data['step'] = $this->read_one($data['id']);
                $this->load->view('admin_panel/wizard/wizard_steps_edit_view', $data);
            }
            else
            {
                throw new Exception("При загрузке данных шага произошла ошибка!");
            }
        }
        catch(Exception $ex)
        {
            $this->result = array('message' => $ex->getMessage());
            echo $this->result['message'];
        }
    }

    public function update_step()
    {
        try
        {
            if($this->input->is_ajax_request===FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(empty($data['id']) || empty($data['name']))
            {
                throw new Exception("При обновлении данных шага произошла ошибка!");
            }

            if($this->update($data['id'], array('name' => $data['name'])))
            {
                $this->result = array('message' => 'Данные шага были успешно изменены!');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("При обновлении данных шага произошла ошибка!");
            }
        }
        catch(Exception $ex)
        {
            $this->result = array('message' => $ex->getMessage());
            echo $this->result['message'];
        }
    }
}