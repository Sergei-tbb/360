<?php
/**
 * Created by PhpStorm.
 * User: zoltarrr
 * Date: 10.10.15
 * Time: 9:31
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model
{
    /**
     * Create new role
     * public
     * @param array $data - data of role
     * @return bool
     */
    public function insert(array $data)
    {
        if (empty($data) || empty($data['name']) || strlen($data['name']) > 100)
        {
            return false;
        }
        else
        {
            return $this->db->insert("roles", $data);
        }
    }

    /**
     * Display all list of roles
     * public
     * @return mixed
     */
    public function gel_all()
    {
        $query = $this->db->get("roles");
        return empty($query)
            ? FALSE
            : $query->result_array();
    }

    /**
     * Remove the role
     * public
     * @param integer $id - id of role
     * @return bool
     */
    public function remove($id)
    {
        return is_int($id) && !empty($id) && $this->db->where("id", $id)->delete("roles")
            ? $this->db->affected_rows()
            :FALSE;
    }
}