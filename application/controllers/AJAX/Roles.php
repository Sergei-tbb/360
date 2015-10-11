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
                echo json_encode(array("message"=>"All is ok. Page was add successfully"));
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
}