<?php

defined("BASEPATH") or exit("No direct script access allowed!");

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array("form_validation", "Curl", "unit_test"));
        $this->load->helper(array("security", "form", "file"));
    }

    public function index()
    {

    }

    /**
     * Get user id
     * public
     * return null
     */
    public function login()
    {
        header('Content-Type: application/json');

        $data = $this->input->post();
        try
        {
            if(empty($data['email']) || empty($data['password']))
            {
                throw new Exception('400');
            }

            if($this->_validate_email() === FALSE)
            {
                throw new Exception("400");
            }

            $user_id = $this->_get_user_id($data['email'], $data['password']);

            if($user_id === FALSE)
            {
                throw new Exception("400");
            }
            else
            {
                set_status_header(200);
                echo json_encode(array("user_id" => $user_id));
            }
        }
        catch(Exception $exp)
        {
            set_status_header($exp->getMessage());
        }

    }

    /**
     * Get info about user files
     * public
     * @param int $id_user - id of user
     * return null
     */
    public function get_info_files($id_user)
    {
        header('Content-Type: application/json');

        try
        {
            if(empty($id_user) || !is_numeric($id_user) || strlen($id_user) > 11)
            {
                throw new Exception("400");
            }

            if(file_exists("./users_files/{$id_user}/"))
            {
                $file_info = get_dir_file_info("./users_files/{$id_user}/");
            }
            else
            {
                throw new Exception("400");
            }

            if(empty($file_info) || !is_array($file_info))
            {
                throw new Exception("400");
            }
            else
            {
                set_status_header(200);
                $file_list = $this->_do_proper_form_array($file_info, $id_user);
                echo json_encode($file_list);
            }
        }
        catch(Exception $exp)
        {
            set_status_header($exp->getMessage());
        }
    }

    /**
     * Validate email
     * private
     * @return bool
     */
    private function _validate_email()
    {
        $this->form_validation->set_rules("email", "Email", "required|trim|valid_email|xss_clean");

        return $this->form_validation->run() == FALSE
            ? FALSE
            : TRUE;
    }

    /**
     * Get from db id of user
     * private
     * @param string $email - email of user
     * @param string $password - password of user
     * @return mixed
     */
    private function _get_user_id($email, $password)
    {
        $data = array("email" => $email, "password" => $password);
        $query = $this->db->select("id")->from("users")->where($data)->limit(1)->get();

        return $query->num_rows() == TRUE
            ? $query->result()[0]->id
            : FALSE;
    }

    /**
     * It makes an array of appropriate type
     * @param array $data - array of data
     * @param int $id_user - id of user
     * @return array
     */
    private function _do_proper_form_array($data, $id_user)
    {
        $result = array();
        $count = 1;
        foreach($data as $val)
        {
             array_push($result, array(
                     $count => array(
                        "name:" => $val['name'],
                        "hash:" => md5_file(base_url()."users_files/".$id_user."/".$val['name'])
                    )
                 )
             );
            $count++;
        }
        return $result;
    }

}