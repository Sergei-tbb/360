<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 13.10.15
 * Time: 16:17
 */
defined("BASEPATH") or exit("No direct script access allowed");

class View_load extends CI_Controller
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

    public function admin_folders($folder, $page_name)
    {
        header("ContentType: application/json");
        try
        {
            if ($this->input->is_ajax_request() == false)
            {
                throw new Exception("No direct script access allowed");
            }
            $this->load->view("admin_panel/".$folder."/".$page_name."_view");
        }
        catch (Exception $exp)
        {
            echo $exp->getMessage();
        }
    }

    public function index_page($page_name)
    {
        header("ContentType: application/json");
        try
        {
            if ($this->input->is_ajax_request() == false)
            {
                throw new Exception("No direct script access allowed");
            }
            $this->load->view("index_page/".$page_name."_view");
        }
        catch (Exception $exp)
        {
            echo $exp->getMessage();
        }
    }

    public function personal_page($page_name)
    {
        header("ContentType: application/json");
        try
        {
            if ($this->input->is_ajax_request() == false)
            {
                throw new Exception("No direct script access allowed");
            }
            $this->load->view("personal_page/".$page_name."_view");
        }
        catch (Exception $exp)
        {
            echo $exp->getMessage();
        }
    }
}