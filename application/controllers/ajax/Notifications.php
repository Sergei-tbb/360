<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 15.10.15
 * Time: 17:24
 */

class Notifications extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(array('tbname' => 'notifications'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->helper("security");

    }

    public function get_list_notifications()
    {
        try
        {
            $data['notification'] = $this->read_all();
            if(!empty($data['notification']))
            {
                $this->load->view('admin_panel/notifications_list_view', $data);
            }
            else
            {
                throw new Exception("Для отображения созданных уведомлений нужно создать хотя бы одно уведомление!");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array('message' => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function new_notification()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_new_update_notification() === false)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->create($data))
            {
                $this->result = array("message" => "New notification was added successfully.");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't add new notification.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function delete_notification($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }


            if ($this->delete($id))
            {
                $this->result = array("message" => "Notification was deleted successfully.");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't deleted notification.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function get_one_notification($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            if($this->read_one($id))
            {
                $data['notification'] = $this->read_one($id);
                if(!empty($data['notification']))
                {
                    $this->load->view('admin_panel/notifications_edit_view', $data);
                }
                else
                {
                    throw new Exception("Unable to load the notice , as it does not exist.");
                }
            }
            else
            {
                throw new Exception("Can't add new notification.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
        }
    }

    public function update_notification($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->_validate_new_update_notification() === false)
            {
                throw new Exception("Invalid data!");
            }

            if ($this->update($id, $data))
            {
                $this->result = array("message" => "Notification was updated successfully.");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't update notification.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    public function new_notification_roles($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if ($this->create($data))
            {
                $this->result = array("message" => "New role was added to notification successfully.");
                echo $this->result['message'];
            }
            else
            {
                throw new Exception("Can't add new role to notification.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }


    private function _validate_new_update_notification()
    {
        $this->form_validation->set_rules("title", "Название уведомления","required");
        $this->form_validation->set_rules("notification", "Текст уведомления","required");

        return $this->form_validation->run();
    }


}