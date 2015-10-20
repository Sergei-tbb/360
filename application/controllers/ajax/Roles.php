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

    /**
     * Create new role
     * public
     * @return null
     */
    public function add_new_role()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
               throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_role() === FALSE)
            {
                throw new Exception("Invalid data!");
            }


            if($this->create($data))
            {
                $this->result = array("message" => "New role was added successfully");
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

    /**
     * Display all roles
     * public
     * @return null
     */
    public function display_all()
    {
        $data['roles'] = $this->read_all();
        $this->load->view("admin_panel/roles_list_view", $data);
    }

    /**
     * Delete role
     * public
     * @return null
     */
    public function delete_role()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(is_null($data) || !is_numeric($data['id']) || strlen($data['id']) > 2)
            {
                throw new Exception("Invalid data!");
            }

            if($this->delete($data['id']))
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
     * Display data of one role
     * public
     * @return null
     */
    public function get_one_role()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(is_null($data) || !is_numeric($data["id"]) || strlen($data["id"]) > 2)
            {
                throw new Exception("Invalid data!");
            }

            $db_result["role"] = $this->read_one($data["id"]);

            if(empty($db_result["role"][0]))
            {
                throw new Exception("Failure of data role");
            }
            else
            {
                $data["role"] = $db_result["role"][0];
                $this->load->view("admin_panel/roles_create_view", $data);
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
        }
    }

    /**
     * Edit role
     * public
     * @param $id - id of role
     * @return null
     */
    public function edit_role($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed");
            }
            $data = $this->input->post();

            if(!is_numeric($id) || strlen($id) > 2 || $this->_validate_role() === FALSE)
            {
                throw new Exception("Invalid data");
            }

            if($this->update($id, $data) === FALSE)
            {
                throw new Exception("Data was not update");
            }
            else
            {
                $this->result = array("message" => "Role was update successfully");
            }
        }
        catch(Exception $ext)
        {
            $this->result = array("message" => $ext->getMessage());
        }
    }

    /**
     * Validate form for create and edit of role
     * private
     * @return bool
     */
    private function _validate_role()
    {
        $this->form_validation->set_rules(
            "name",
            "Названиея роли",
            "required|trim|max_length[100]|xss_clean"
        );
        return $this->form_validation->run();
    }

    public function __destruct()
    {
        if($this->result)
        {
            echo json_encode($this->result);
        }
    }
}