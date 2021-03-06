<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Statuses extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(array("tbname" => "statuses"));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    /**
     * Crete new status
     * public
     * return null
     */
    public function add_new_statuses()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }
            $data = $this->input->post();

            if(is_null($data) || $this->_validate_statuses() === FALSE)
            {
                throw new Exception("Invalid data");
            }

            if($this->create($data))
            {
                $id = $this->_get_id($data);
                if(!is_numeric($id) || is_null($id) || strlen($id) > 5)
                {
                    throw new Exception("Invalid id");
                }

                $data['picture'] = $this->_do_upload($id);

                if(!empty($data['picture']))
                {
                    if($this->update($id, $data))
                    {
                        $this->result = array("message" => "Status was create successfully");
                    }
                    else
                    {
                        throw new Exception("Can't add new status");
                    }
                }
            }
            else
            {
                throw new Exception("Can`t add new status");
            }

        }
        catch(Exception $exp)
        {
            if($id)
            {
                $this->delete($id);
            }
            $this->result = array("message" => $exp->getMessage());
        }
    }

    /**
     * Display list of all statuses
     * public
     * return null
     */
    public function display_all()
    {
        $data['statuses']  = $this->read_all();
        if(!empty($data))
        {
            $this->load->view("admin_panel/statuses_list_view", $data);
        }
    }

    /**
     * Delete status
     * public
     * return null
     */
    public function delete_statuses()
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

            if($this->_delete_picture($data['id']) === TRUE)
            {
                if($this->delete($data['id']))
                {
                    $this->result = array("message" => "Status was delete successfully.");
                }
                else
                {
                    throw new Exception("Can't delete a status.");
                }
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
        }
    }

    /**
     * Display data of one status
     * public
     * return null
     */
    public function get_one_statuses()
    {
        try
        {
            if ($this->input->is_ajax_request() === FALSE) {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if (is_null($data) || !is_numeric($data["id"]) || strlen($data["id"]) > 2) {
                throw new Exception("Invalid data!");
            }

            $db_result["statuses"] = $this->read_one($data['id']);

            if(empty($db_result['statuses'][0]))
            {
                throw new Exception("Failure of data role");
            }

            $data['statuses'] = $db_result['statuses'][0];
            $this->load->view("admin_panel/statuses_create_view", $data);

        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
        }
    }

    /**
     * Edit status
     * public
     * return null
     */
    public function edit_statuses()
    {
        try {
            if ($this->input->is_ajax_request() === FALSE) {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();

            if(!empty($data) || is_numeric($data['id']) || strlen($data['id']) <= 5)
            {
                if($_FILES['image']['error'] === 0) {
                    foreach (array('gif', 'jpg', 'png') as $format){

                        $file_path = base_url() . "download/statuses_image/" . $data['id'] . "_status_image." . $format;
                        $headers = @get_headers($file_path);

                        if (preg_match("|200|", $headers[0]))
                        {
                            if (strpos($headers[0], '200'))
                            {
                                unlink("download/statuses_image/".$data['id']."_status_image.".$format);
                                break;
                            }
                        }
                    }
                    $data['picture'] = $this->_do_upload($data['id']);
                }

                if($this->update($data['id'], $data) === FALSE)
                {
                    throw new Exception("Data was not update");
                }
                else
                {
                    $this->result = array("message" => "Status was update successfully");
                }
            }
        }
        catch(Exeption $exp)
        {
            $this->result = array("message" => $exp->getMessage());
        }
    }

    /**
     * Do image upload
     * private
     * @param int $id - id of status
     * @return mixed
     * @throws Exception
     */
    private function _do_upload($id)
    {
        $config['upload_path']   = 'download/statuses_image';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 50;
        $config['max_width']     = 100;
        $config['max_height']    = 100;
        $config['file_name']     = $id."_status_image";

        $this->load->library('upload', $config);

        if($this->upload->do_upload('image'))
        {
            $pic_data = $this->upload->data();
            chmod($pic_data['full_path'], 0777);

            return $pic_data['file_name'];
        }
        else
        {
            throw new Exception("Invalid image data. Image was not save.");
        }
    }

    /**
     * Get id of current status
     * private
     * @param array $data - array with name of status
     * @return int
     */
    private function _get_id($data)
    {
        $query_str = $this->db->select("id")->from($this->tbname)->where("name", $data['name'])->limit(1)->order_by('id', 'DESC');

        $id = $this->read_custom_($query_str);

        return (int)$id[0]->id;
    }

    /**
     * Validate input data
     * private
     * @return mixed
     */
    private function _validate_statuses()
    {
        $this->form_validation->set_rules(
            "name",
            "Названиея роли",
            "required|trim|max_length[100]|xss_clean"
        );
        return $this->form_validation->run();
    }

    /**
     * Delete image
     * private
     * @param int $id - status id
     * @return bool
     */
    private function _delete_picture($id)
    {
        $picture_name = $this->_get_picture_name($id);
        if(empty($picture_name))
        {
           return FALSE;
        }

        if(unlink("download/statuses_image/" . $picture_name) === TRUE)
        {
            return TRUE;
        }
    }

    /**
     * Get image name
     * @param int $id - id of status
     * @return string
     */
    private function _get_picture_name($id)
    {
        $query_str = $this->db->select("picture")->from($this->tbname)->where("id", $id)->limit(1);
        $picture = $this->read_custom_($query_str);

        return $picture[0]->picture;
    }

    public function __destruct()
    {
        if($this->result)
        {
            echo json_encode($this->result);
        }
    }
}