<?php
/**
 * Created by PhpStorm.
 * User: zoltarrr
 * Date: 13.10.15
 * Time: 18:55
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Roles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Roles_model');
    }

    public function index()
    {
        $this->load->view('admin_panel/header_view');
        $this->load->view('admin_panel/index_view');
        $this->load->view('admin_panel/footer_view');
    }
}