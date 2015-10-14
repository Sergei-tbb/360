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
//        $this->load->model('Roles_model');
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

//    public function add_new_role()
//    {
//        header("ContentType: application/json");
//
//        try{
//            if($this->input->is_ajax_request() == false)
//            {
//               throw new Exception("No direct script access allowed");
//            }
//
//            $data = $this->input->post();
//
//            if(!$this->_validate_add_role())
//            {
//                throw new Exception("Не правильные данные.");
//            }
//            if($this->create($data))
//            {
//                throw new Exception("Роль была успешно создана.");
//            }
//            else
//            {
//                throw new Exception("Не возможно создат новую роль.");
//            }
//        }
//        catch(Exception $exp)
//        {
//            echo json_encode(array("message" => $exp->getMessage()));
//        }
//    }

public function add_new_role()
{
    try
    {
        if($this->input->is_ajax_request() === false)
        {
           throw new Exception("No direct script access allowed");
        }

        $data = $this->input->post();

        if ($this->_validate_add_role() === false)
        {
            throw new Exception("Invalid data!");
        }

        if ($this->create($data))
        {
            $this->result = array("message" => "New role was added successfully");
        }
        else
        {
            throw new Exception("Can't add new role");
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
        header("ContentType: application/json;");

        echo json_encode($this->result);
    }
}