<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Menus_model extends CI_Model {
    /**
     * Insert new menu
     * @access public
     * @param array $data
     * @return bool
     */
    public function create(array $data) {
        return $this->db
                ->insert("menus", $data);
    }

    /**
     * Update existing menu data
     * @access public
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data) {
        return $this->db
                ->where("id",$id)
                ->update("menu",$data);
    }

    /**
     * Delete existing menus data
     * @access public
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        return $this->db
                ->where("id",$id)
                ->delete("menu");
    }

    /**
     * Get menu(s) data
     * @access public
     * @param mixed $id int
     * int if you want to get 1 menu,
     * null if you want to get all menus
     * @return array of objects
     */
    public function get($id = null) {
        $query = null;
        $this->db
            ->select("id,name")
            ->from("menus");

        if (!is_null($id)) {
            $this->db->where("id",$id);
        }

        $query = $this->db->get()->result();

        return $query;
    }
}