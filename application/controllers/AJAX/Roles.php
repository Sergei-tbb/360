<?php
/**
 * Created by PhpStorm.
 * User: zoltarrr
 * Date: 10.10.15
 * Time: 9:35
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("Roles_model");
    }

    public function add_new_role()
    {
        header("ContentType: application/json");

        try
        {
            if ($this->input->is_ajax_request() == false)
            {
                throw new Exception("No direct script access allowed");
            }

            $data = $this->input->post();

            if (is_null($data) || empty($data['name']))
            {
                throw new Exception("Invalid data");
            }

            if ($this->Roles_model->insert($data))
            {
                echo json_encode(array("message"=>"All is ok. Role was add successfully"));
            }
            else
            {
                throw new Exception("Can't add new role");
            }
        }
        catch (Exception $exp)
        {
            echo json_encode(array("message"=>$exp->getMessage()));
        }
    }

    /**
     * Remove role
     * public
     * return null
     */
    public function remove()
    {
        header("ContentType: application/json");

        try
        {
            if ($this->input->is_ajax_request() == false)
            {
                throw new Exception("No direct script access allowed");
            }
            $id_role = (int)$this->input->post("id");

            if(is_null($id_role) || empty($id_role))
            {
                throw new Exception("Invalid data");
            }

            if($this->Roles_model->remove($id_role))
            {
                echo json_encode(array("message" => "Role was remove successfully."));
            }
            else
            {
                throw new Exception("Can't remove the role");
            }
        }
        catch(Exception $exp)
        {
            echo json_encode(array("message"=>$exp->getMessage()));
        }
    }

}