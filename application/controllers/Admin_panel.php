<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 13.10.15
 * Time: 16:00
 */
defined("BASEPATH") or exit("No direct script access allowed!");

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
}