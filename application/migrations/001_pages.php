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

        $fields_menus = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_menus);
        $this->dbforge->create_table('menus');

        $fields_menus_pages = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_menu' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_page' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_menus_pages);
        $this->dbforge->create_table('menus_pages');
    }

    public function down()
    {
        $this->dbforge->drop_table('pages');
        $this->dbforge->drop_table('menus');
        $this->dbforge->drop_table('menus_pages');
    }
}