<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Statuses_rols extends MY_Controller
{
    private $result;

    public function __construct()
    {
        parent::__construct(array("tbname" => "statuses_rols"));

        $this->result = array();
    }

    /**
     * Get statuses roles data
     * public
     * return null
     */
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

            $query_str = $this->db->select("id, name,")->from("statuses")->order_by("name");
            $all_statuses = $this->read_custom_($query_str);

            if(!empty($all_statuses))
            {
                $data['all_status'] = $all_statuses;
            }

            $query_str = $this->db->select("id_statuses")->from($this->tbname)->where("id_roles", $data['id']);
            $selected = $this->read_custom_($query_str);
            if(!empty($selected))
            {
                $data['selected'] = $selected;
            }

            $this->load->view("admin_panel/statuses_rols_view", $data);
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
        }
    }

    /**
     * Change statuses
     * public
     * @param numeric $id - id of role
     * return null
     */
    public function change_statuses_rols($id)
    {
        try
        {
            if ($this->input->is_ajax_request() === FALSE)
            {
                throw new Exception("No direct script access allowed.");
            }

            $data = $this->input->post();
            if(empty($id) || !is_numeric($id) || strlen($id) > 3)
            {
                throw new Exception("Invalid data");
            }

            $query_str = $this->db->select("id_statuses")->from("statuses_rols")->where("id_roles", $id);
            $query_res = $this->read_custom_($query_str);

            if(!empty($query_res))
            {
               $select = $this->_do_array_type($query_res);
            }
            else
            {
                $select = array();
            }

            if(empty($data['id_statuses']))
            {
                $data['id_statuses'] = array();
            }

            $delete_id = array_diff($select, $data['id_statuses']);
            $insert_id = array_diff($data['id_statuses'],$select);

            if(count($delete_id) || count($insert_id))
            {
                if($this->_update_statuses($delete_id, $insert_id, $id))
                {
                    $this->result = array("message" => "Statuses update successfully");
                }
            }
        }
        catch(Exception $exp)
        {
            $this->result = array("message" => $exp->getMessage());
        }
    }

    /**
     * Delete, insert data
     * private
     * @param array $delete_id - array of deleted id
     * @param array $insert_id - array od insert id
     * @param numeric $id - id of role
     * @return bool
     */
    private function _update_statuses($delete_id, $insert_id, $id)
    {
        $delete = '';
        $insert = '';

        if(count($delete_id))
        {
            if($this->_delete_record($id, $delete_id) != FALSE)
            {
                $delete = TRUE;
            }
        }

        if(count($insert_id))
        {
            if($this->_insert_record($id, $insert_id) != FALSE)
            {
                $insert = TRUE;
            }
        }

        return $delete === TRUE || $insert === TRUE
            ? TRUE
            : FALSE;
    }

    /**
     * Do array of object in array
     * private
     * @param array $array_obj - array of object
     * @return array
     */
    private function _do_array_type($array_obj)
    {
        $i=0;
        foreach($array_obj as $value)
        {
            $select[$i] = $value->id_statuses;
            $i++;
        }
        return $select;
    }

    /**
     * Insert record in db
     * private
     * @param int $id - id of role
     * @param array $data - array of statuses id
     * @return bool
     */
    private function _insert_record($id, $data)
    {
        $result = TRUE;
        foreach($data as $id_statuses)
        {
            $insert_data = array("id_roles" => $id, "id_statuses" => $id_statuses);
            $this->db->insert("statuses_rols", $insert_data);
            if($this->db->affected_rows() == FALSE)
            {
                $result = FALSE;
                break;
            }
        }

        return $result;
    }

    /**
     * Delete record from db
     * private
     * @param int $id - id of role
     * @param array $data - array of statuses id
     * @return bool
     */
    private function _delete_record($id, $data)
    {
        $result = TRUE;
        foreach($data as $id_statuses)
        {
            $delete_data = array("id_roles" => $id, "id_statuses" => $id_statuses);
            $this->db->delete("statuses_rols", $delete_data);
            if($this->db->affected_rows() == FALSE)
            {
                $result = FALSE;
                break;
            }
        }

        return $result;
    }

    /**
     * Delete all record of current role
     * @param int $id - id of role
     * @return bool
     */
    private function _delete_all_records($id)
    {
        $remove_role = array("id_roles" => $id);
            $this->db->delete("statuses_rols", $remove_role);
            return $this->db->affected_rows()
                ? TRUE
                : FALSE;
    }

    public function __destruct()
    {
        if($this->result)
        {
            echo json_encode($this->result);
        }
    }
}