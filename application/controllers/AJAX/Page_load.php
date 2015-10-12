<?php
/**
 * Created by PhpStorm.
 * User: zoltarrr
 * Date: 10.10.15
 * Time: 9:49
 */

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