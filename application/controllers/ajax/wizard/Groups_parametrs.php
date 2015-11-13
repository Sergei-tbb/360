<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 31.10.15
 * Time: 15:59
 */

class Groups_parametrs extends MY_Controller
{
    private $result;

    public function __construct()
    {
        parent::__construct(array('tbname' => 'groups_parametrs'));
        $this->load->helper(array('url','form'));

        $this->result = array();
    }


    public function display_groups_parameters()
    {
        $data['id'] = $this->input->post();
        $data['parameters'] = $this->read_custom('SELECT id, name FROM parameters');
        $data['groups_parametrs'] = $this->read_all();
        if(empty($data['parameters'])):
            echo 'Для отображения списка параметров нужно создать хотя бы один параметр!';
        else:
            $this->load->view('admin_panel/wizard/groups_parameters_list_view', $data);
        endif;
    }


    public function add_groups_parameter()
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
                throw new Exception("Ошибка при привязке параметов к группе");
            }

            if ($data['parameter'] == 0)
            {
                $result = $this->read_custom("SELECT COUNT(id) as count, id FROM groups_parametrs WHERE id_group={$data['id']}");

                if ($result['0']->count == 1)
                {
                    if ($this->delete($result['0']->id))
                    {
                        $this->result = array('message' => 'Параметр(ы) успешно отвязана(ы) от группы!');
                        echo $this->result['message'];
                    }
                }
            }
            elseif($data['parameter']!=0)
            {
                if($this->create(array('id_group' => $data['id'], 'id_parameter' => $data['parameter'])))
                {
                    $this->result = array('message' => 'Привязка параметра(ов) к группе успешно выполнена!');
                    echo $this->result['message'];
                }
                else
                {
                    throw new Exception("Ошибка при привязке параметов к группе");
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