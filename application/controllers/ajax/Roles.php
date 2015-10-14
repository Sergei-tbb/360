<?php
/**
 * Created by PhpStorm.
 * User: zoltarrr
 * Date: 13.10.15
 * Time: 18:55
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Roles extends MY_Controller
{
    private $result;

    public function __construct()
    {
        parent::__construct(array("tbname" => "roles"));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    public function add_new_role()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
               throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_add_role() === false)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->create($data))
            {
                $this->result = array("message" => "New role was added successfully.");
            }
            else
            {
                throw new Exception("Can't add new role.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
        }
    }

    public function display_all()
    {
        $data['roles'] = $this->read_all();
        $this->load->view("admin_panel/roles_list_view", $data);
    }

    public function delete_role()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(is_null($data) || !is_numeric($data['id']) || strlen($data['id']) > 2)
            {
                throw new Exception("Invalid data!");
            }

            if($this->delete($data))
            {
                $this->result = array("message" => "Role was delete successfully.");
            }
            else
            {
                throw new Exception("Can't delete a role.");
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
        }
    }

    /**
     * @return mixed
     */
    private function _validate_add_role()
    {
        $this->form_validation->set_rules(
            "name",
            "Названиея роли",
            "required|trim|max_length[150]|xss_clean",
            array(
                  "required" => "Введит название роли",
                  "max_length" => "Длина не должна привышать 100 символов."
                 )
        );
        return $this->form_validation->run();
    }

    public function __destruct()
    {
        echo json_encode($this->result);
    }
}