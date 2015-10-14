<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 13.10.15
 * Time: 17:18
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Migration_pages extends CI_Migration
{
    public function up()
    {
        $fields_pages = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'keywords' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'page_data' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'date_time' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'is_published' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            )
        );
        $this->load->dbforge();
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->add_field($fields_pages);

        $this->dbforge->create_table('pages');
    }

    public function down()
    {
        $this->dbforge->drop_table('pages');
    }
}