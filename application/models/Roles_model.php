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
}