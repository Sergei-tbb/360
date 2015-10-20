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

    public function add_new_statuses()
    {
        try
        {
            if($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }


        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
        }
    }

    private function _do_upload($id)
    {
        $config['upload_path']          = base_url().'download/statuses_image';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['file_name']            = $id."_statuses";

        $this->load->library('upload', $config);

        $this->upload->do_upload('userfile');


    }

}

