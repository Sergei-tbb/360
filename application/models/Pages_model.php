<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 09.10.15
 * Time: 9:47
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model
{
    public function select_pages()
    {
        $query = $this->db->get('pages');

        return empty($query) ? false : $query->result_array();
    }

    public function addition_page($data)
    {
        $new_page = array(
            'title' => $data['title'],
            'page' => $data['page'],
            'keywords' => $data['keywords'],
            'description' => $data['description'],
            'page_data' => $data['page_data'],
            'date_time' => $data['date_time'],
            'is_published' => $data['is_published']
        );

        $this->db->insert('pages', $new_page);

        return $this->db->affected_rows();
    }

    public function deleting_page($data)
    {
        $this->db->where('page', $data['page']);
        $this->db->delete('pages');

        return $this->db->affected_rows();
    }

    public function publish_page($data)
    {
        $publish = array('is_published', $data['published']);
        $this->db->where('page', $data['page']);
        $this->db->update('pages', $publish);

        return $this->db->affected_rows();
    }
}