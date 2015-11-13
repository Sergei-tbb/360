<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 31.10.15
 * Time: 11:17
 */
class Wizard_steps extends MY_Controller
{
    private $result;
    public function __construct()
    {
        parent::__construct(array('tbname' => 'wizard_steps'));
        $this->load->helper(array('url', 'form'));

        $this->result = array();
    }

    public function display_steps()
    {
        $data['id'] = $this->input->post();
        $data['steps'] = $this->read_custom('SELECT steps.id, steps.name FROM steps');
        $data['wizard_steps'] = $this->read_all();
        if(empty($data['steps'])):
            echo 'Для отображения списка шагов для мастера заказов нужно создать хотя бы один шаг!';
        else:
            $this->load->view('admin_panel/wizard/wizards_steps_list_view', $data);
        endif;
    }

    public function add_wizard_step()
    {
        try
        {
            if ($this->input->is_ajax_request === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(empty($data['id']))
            {
                throw new Exception("Ошибка при привязке шага к мастеру заказов!");
            }

            if ($data['step'] == 0)
            {
                $result = $this->read_custom("SELECT COUNT(id) as count, id FROM wizard_steps WHERE id_wizard={$data['id']}");

                if ($result['0']->count == 1)
                {
                    if ($this->delete($result['0']->id))
                    {
                        $this->result = array('message' => 'Шаг успешно отвязан от мастера заказов !');
                        echo $this->result['message'];
                    }
                }
            }
            elseif($data['step']!=0)
            {
                if($this->create(array('id_wizard' => $data['id'], 'id_steps' => $data['step'])))
                {
                    $this->result = array('message' => 'Привязка мастера заказов к категории успешно выполнена!');
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