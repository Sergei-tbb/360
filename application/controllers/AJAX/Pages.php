<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 09.10.15
 * Time: 9:46
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        echo 'lol';
    }

    public function publish_page()
    {
        $data = $this->input->post();
        $this->load->model('Pages_model');
        $this->Pages_model->publish_page($data);
    }

    public function edit_page()
    {
        $data = $this->input->post();
        $this->load->model('Pages_model');
        $data['page'] = $this->Pages_model->select_page($data);
        $this->load->view('admin_panel/modal/edit_page_view');
    }

    public function create_page()
    {
        $this->load->view('admin_panel/modal/create_page_view');
    }

    public function remove()
    {
        $id_page = (int)$this->input->post('id');
        if(!empty($id_page))
        {
            $this->load->model('Pages_model');
            if($this->pages_model->remove($id_page))
            {
                set_status_header(200);
            }
            else
            {
                set_status_header(400);
            }
        }
        else
        {
            set_status_header(400);
        }

    }
}