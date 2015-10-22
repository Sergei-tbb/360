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

        $this->result = array();
    }

    /**
     * method for getting list of notifications
     */
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

    /**
     * method for creating new notifications
     */
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

    /**
     * @param $id
     * method for deleting notifications
     */
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

    /**
     * @param $id
     * method for getting all data of notification
     */
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

    /**
     * @param $id
     * method for updating all data of notifications
     */
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

    /**
     * method of load view and data of notifications and roles
     */
    public function notifications_roles()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $string = "SELECT * FROM roles";
            if ($this->read_custom($string))
            {
                $data['roles'] = $this->read_custom($string);
                $data['id'] = $this->input->post();
                $data['selected'] = $this->get_notification_roles($data['id']['id']);
                if(!empty($data['roles']) and !empty($data['id']))
                {
                    $this->load->view('admin_panel/notifications_roles_view', $data);
                }
            }
            else
            {
                throw new Exception("Can't load roles and notification.");
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
            echo $this->result['message'];
        }
    }

    /**
     * @param $id
     * @return object
     * method for getting data of notifications roles
     */
    public function get_notification_roles($id)
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $string = "SELECT notifications_roles.id_role as selected
                        FROM notifications_roles, notifications
                        WHERE notifications.id={$id}
                        AND notifications.id=notifications_roles.id_notification";

            if($this->read_custom($string))
            {
                return $selected = $this->read_custom($string);
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