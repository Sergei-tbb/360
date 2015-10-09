<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 09.10.15
 * Time: 10:12
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_panel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('admin_panel/header_view');
        $this->load->view('admin_panel/index_view');
        $this->load->view('admin_panel/footer_view');
    }

    public function pages()
    {
        $this->load->model('Pages_model');
        $data['pages'] = $this->Pages_model->select_pages();
        $this->load->view('admin_panel/pages_view', $data);
    }

}