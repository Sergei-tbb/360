<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 19.10.15
 * Time: 15:30
 */
class Registration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('encrypt');
    }

    public function add_user()
    {

    }
}