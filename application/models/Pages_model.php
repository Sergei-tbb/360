<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Pages_model extends CI_Model {
    /**
     * Insert new page
     * @access public
     * @param array $data
     * @return bool
     */
    public function create(array $data) {
        return $this->db
                ->insert("pages", $data);
    }

    /**
     * Update existing page data
     * @access public
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data) {
        return $this->db
                ->where("id",$id)
                ->update("pages",$data);
    }

    /**
     * Delete existing page data
     * @access public
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        return $this->db
                ->where("id",$id)
                ->delete("pages");
    }

    /**
     * Get page(s) data
     * @access public
     * @param mixed $id int
     * int if you want to get 1 page,
     * null if you want to get all pages
     * @return array of objects
     */
    public function get($id = null) {
        $query = null;

        if (is_null($id)) {
            $query = $this->db
                    ->select("id,title,is_published")
                    ->from("pages")
                    ->get()
                    ->result();
        } else {
            $query = $this->db
                    ->select("id,title,keywords,description,page_data,is_published")
                    ->from("pages")
                    ->get()
                    ->result();
        }

        return $query;
    }
}