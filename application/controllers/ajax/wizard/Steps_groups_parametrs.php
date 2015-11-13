<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 31.10.15
 * Time: 15:17
 */

class Steps_groups_parametrs extends MY_Controller
{
    private $result;
    public function __construct()
    {
        parent::__construct(array('tbname' => 'steps_groups_parametrs'));
        $this->load->helper(array('url','form'));

        $this->result = array();
    }

    public function display_groups()
    {
        $data['id'] = $this->input->post();
        $data['groups'] = $this->read_custom('SELECT id, name FROM groups');
        $data['steps_groups'] = $this->read_all();
        if(empty($data['groups'])):
            echo 'Для отображения списка групп параметров нужно создать хотя бы одну группу параметров!';
        else:
            $this->load->view('admin_panel/wizard/steps_groups_parameters_list_view', $data);
        endif;
    }


    public function add_step_group()
    {
        try
        {
            if ($this->input->is_ajax_request === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if (empty($data['id']))
            {
                throw new Exception("Ошибка при привязке мастера заказов к категории");
            }

            if ($data['group'] == 0)
            {
                $result = $this->read_custom("SELECT COUNT(id) as count, id FROM steps_groups_parametrs WHERE id_steps={$data['id']}");

                if ($result['0']->count == 1)
                {
                    if ($this->delete($result['0']->id))
                    {
                        $this->result = array('message' => 'Группа параметров успешно отвязана от шага!');
                        echo $this->result['message'];
                    }
                }
            }
            elseif($data['group']!=0)
            {
                if($this->create(array('id_steps' => $data['id'], 'id_groups_parametrs' => $data['group'])))
                {
                    $this->result = array('message' => 'Привязка группы параметров к шагу успешно выполнена!');
                    echo $this->result['message'];
                }
                else
                {
                    throw new Exception("Ошибка при привязке мастера заказов к категории");
                }
            }
        }
        catch(Exception $ex)
        {
            $this->result = array('message' => $ex->getMessage());
            echo $this->result['message'];
        }
    }
}