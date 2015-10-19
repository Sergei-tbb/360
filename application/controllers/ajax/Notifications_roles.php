<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 16.10.15
 * Time: 12:44
 */

class Notifications_roles extends MY_Controller
{
    private $result;

    public function __construct()
    {
        parent::__construct(array('tbname' => 'notifications_roles'));
        $this->load->helper(array('form', 'url'));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    /**
     * method for adding role to notification
     */
    public function new_notification_role()
    {
        try
        {
            if($this->input->is_ajax_request() === false)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            $count = count($data['id_role']);

            if($count>1)
            {
                for($i=0; $i<=$count-1; $i++)
                {
                    $new_data = array(
                        'id_notification' => $data['id_notification'],
                        'id_role' => $data['id_role'][$i]
                    );

                    if($this->create($new_data))
                    {
                        $this->result = array("message" => "New roles was added to notification successfully.");
                    }
                }
                echo $this->result['message'];
            }
            elseif($count==1)
            {
                $new_data = array(
                    'id_notification' => $data['id_notification'],
                    'id_role' => $data['id_role']['0']
                );

                if($this->create($new_data))
                {
                    $this->result = array("message" => "New role was added to notification successfully.");
                    echo $this->result['message'];
                }
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
     * method for deleting roles from notifications
     */
    public function delete_notification_roles($id)
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed");
            }

            if($this->delete($id) === FALSE)
            {
                throw new Exception("Data was not delete");
            }
            else
            {
                $this->result = array('message' => 'Data was deleted successfully');
                echo $this->result['message'];
            }
        }
        catch(Exception $ext)
        {
            $this->result = array("message" => $ext->getMessage());
            echo $this->result['message'];
        }
    }


}
