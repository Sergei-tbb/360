<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Migration_roles extends CI_Migration
{
    public function __construct()
    {
        $this->load->dbforge();
    }

    public function up()
    {
        $fields_array = array(
            "id" => array(
                "type" => "int",
                "constraint" => 2,
                "unsigned" => true,
                "auto_increment" => true
            ),
            "name" => array(
                "type" => "varchar",
                "constraint" => 100
            )
        );

        $this->dbforge->add_field($fields_array);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('roles');
    }

    public function down()
    {
        $this->dbforge->drop_table('roles');
    }
}