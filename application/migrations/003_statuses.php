<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Migration_statuses extends CI_Migration
{
    public function up()
    {
        $fields_pages = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'picture' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            )
        );

        $this->load->dbforge();
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_pages);
        $this->dbforge->create_table('statuses');
    }

    public function down()
    {
        $this->dbforge->drop_table('statuses');
    }
}