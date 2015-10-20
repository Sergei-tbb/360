<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Statuses_rols extends MY_Controller
{
    private $result;

    public function __construct()
    {
        parent::__construct(array("tbname" => "statuses_rols"));
        $this->load->library("form_validation");
        $this->load->helper("security");

        $this->result = array();
    }

    public function display_statuses_rols()
    {
        try
        {
            if ($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();
            if(empty($data) || !is_numeric($data['id']) || strlen($data['id']) > 3)
            {
                throw new Exception("Invalid data");
            }
            $query_str = $this->db->select("id_statuses, name")
                                  ->from("statuses_rols")
                                  ->join("statuses", "statuses_rols.id_statuses = statuses.id")
                                  ->where("statuses_rols.id_roles = {$data['id']}");
            $query_result = $this->read_custom($query_str);
            if(!empty($query_result))
            {
                $a['f']['statuses'] =  $query_result;
            }

            $query_str = $this->db->select("id, name")->from("statuses");
            $all_statuses = $this->read_custom($query_str);


            $this->load->view("admin_panel/statuses_rols_view");
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
        }
    }

    public function add_statuses_rols()
    {

    }

    public function __destruct()
    {
        if($this->result)
        {
            echo json_encode($this->result);
        }
    }
}