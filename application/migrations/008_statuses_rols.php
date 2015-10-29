<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Migration_statuses_rols extends CI_Migration
{
    public function up()
    {
        $fields_pages = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'id_statuses' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'id_roles' => array(
                'type' => 'INT',
                'constraint' => 3
            )
        );

        $this->load->dbforge();
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_pages);
        $this->dbforge->create_table('statuses_rols');
    }

    public function down()
    {
        $this->dbforge->drop_table('statuses_rols');
    }
}