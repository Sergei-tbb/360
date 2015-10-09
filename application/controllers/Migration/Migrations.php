<?php
/**
 * Created by PhpStorm.
 * User: zoltarrr
 * Date: 09.10.15
 * Time: 10:28
 */

defined("BASEPATH") or exit("No direct script access allowed");

class Migrations extends CI_Controller
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
            echo "\nMigrations ran successfully!\n";
        }
    }
}
?>