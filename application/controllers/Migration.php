<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 13.10.15
 * Time: 17:22
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Migration extends CI_Controller
{
    public function index($version)
    {
        $this->load->library('migration');
        if (!$this->migration->version($version))
        {
            echo 'Error'.$this->migration->error_string() . "\n";
        }
        else
        {
            echo "\nMigrations run successfully!\n";
        }
    }
}