<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 30.10.15
 * Time: 15:57
 */
class Wizard_categories extends MY_Controller
{
    private $result;

    public function __construct()
    {
        parent::__construct(array('tbname' => 'wizard_categories'));
        $this->load->helper(array('url', 'form'));

        $this->result = array();
    }

    public function display_wizards()
    {
        $data['id'] = $this->input->post();
        $data['wizards'] = $this->read_custom('SELECT id, name FROM wizard');
        $data['wizard_categories'] = $this->read_custom('SELECT id_wizard, id_categories FROM wizard_categories');
        if(empty($data['wizards'])):
            echo 'Для отображения списка мастеров заказов нужно создать хотя бы один мастер заказов!';
        else:
            $this->load->view('admin_panel/wizard/wizards_category_list_view', $data);
        endif;
    }


    public function add_wizard_category()
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

            if ($data['wizard'] == 0)
            {
                $result = $this->read_custom("SELECT COUNT(id) as count, id FROM wizard_categories WHERE id_categories={$data['id']}");

                if ($result['0']->count == 1)
                {
                    if ($this->delete($result['0']->id))
                    {
                        $this->result = array('message' => 'Мастер заказов успешно отвязан от категории!');
                        echo $this->result['message'];
                    }
                }
            }
            elseif($data['wizard']!=0)
            {
                if($this->create(array('id_wizard' => $data['wizard'], 'id_categories' => $data['id'])))
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