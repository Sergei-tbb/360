<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 13.10.15
 * Time: 17:04
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Pages extends MY_Controller
{
    public function __construct()
    {
        parent::__construct(array('tbname' => 'pages'));
    }

    public function pages_list()
    {
        $data['pages'] = $this->read_all();
        $this->load->view('admin_panel/pages_list_view', $data);
    }
}