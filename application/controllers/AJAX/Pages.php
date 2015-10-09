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