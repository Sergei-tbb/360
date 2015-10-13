<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 12.10.15
 * Time: 14:24
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Page_load extends CI_Controller
{
    public function admin($page_name)
    {
        header("ContentType: application/json");
        try
        {
            if ($this->input->is_ajax_request() == false)
            {
                throw new Exception("No direct script access allowed");
            }
            $this->load->view("admin_panel/".$page_name."_view");
        }
        catch (Exception $exp)
        {
            echo $exp->getMessage();
        }
    }
}