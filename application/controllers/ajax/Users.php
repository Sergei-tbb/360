<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 16.10.15
 * Time: 18:31
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Users extends MY_Controller
{
    private $result;

    public function __construct()
    {
        parent::__construct(array("tbname" => "users"));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    public function get_list_users()
    {
        $string = "SELECT * FROM roles";
        $data['users'] = $this->read_all();
        $data['roles'] = $this->read_custom($string);

        if(empty($data['users']))
        {
            $this->result = array('message' => 'Для отображения списка пользователей нужно создать хотя бы одного пользователя!');
            echo $this->result['message'];
        }
        else
        {
            $this->load->view('admin_panel/users_list_view', $data);
        }
    }

    public function new_user_roles()
    {
        $string = "SELECT * FROM roles";
        $data['roles'] = $this->read_custom($string);
        $this->load->view('admin_panel/users_new_view', $data);
    }

    public function add_user()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_user() === FALSE)
            {
                throw new Exception("Invalid data!");
            }

            $date = date('Y-m-d');

            $this->load->library('encrypt');
            $password = $this->encrypt->encode($data['password']);

            $data_user = array(
                'name' => $data['name'],
                'surname' => $data['surname'],
                'middlename' => $data['middlename'],
                'email' => $data['email'],
                'password' => $password,
                'reg_date' => $date,
                'id_user_role' => $data['id_user_role']
            );

            if ($this->create($data_user))
            {
                $this->result = array('message' => 'New user was added successfully');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't add new user.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function delete_user($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if ($this->delete($id))
            {
                $this->result = array("message" => "User was deleted successfully.");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't delete user.");
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function get_one_user($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            if ($this->read_one($id))
            {
                $string = "SELECT * FROM roles";
                $data['user'] = $this->read_one($id);
                $data['id'] = $id;
                $data['roles'] = $this->read_custom($string);
                $this->load->view('admin_panel/users_edit_view', $data);
            }
            else
            {
                throw new Exception("Can't delete user.");
            }

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function edit_user($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();
            $this->load->library('encrypt');

            $data_user = array(
                'name' => $data['name'],
                'surname' => $data['surname'],
                'middlename' => $data['middlename'],
                'email' => $data['email'],
                'password' => $this->encrypt->encode($data['password']),
                'id_user_role' => $data['id_user_role']
            );

            if ($this->update($id, $data_user))
            {
                $this->result = array('message' => 'User data was updated successfully');
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't update user info.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    private function _validate_user()
    {
        $this->form_validation->set_rules("name","Имя пользователя","required|trim|max_length[100]|xss_clean");
        $this->form_validation->set_rules("surname","Имя пользователя","required|trim|max_length[100]|xss_clean");
        $this->form_validation->set_rules("middlename","Имя пользователя","required|trim|max_length[100]|xss_clean");
        $this->form_validation->set_rules("email","Имя пользователя","required|trim|max_length[100]|xss_clean");
        $this->form_validation->set_rules("password","Имя пользователя","required|trim|max_length[100]|xss_clean");
        $this->form_validation->set_rules("id_user_role","Имя пользователя","required|trim|max_length[100]|xss_clean");


        return $this->form_validation->run();
    }
}