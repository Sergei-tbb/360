<?php
/**
 * Created by PhpStorm.
 * User: zoltarrr
 * Date: 09.10.15
 * Time: 10:31
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_pages extends CI_Migration
{
    /**
     * Create table "pages"
     * public
     * return null
     */
    public function up()
    {
        $this->load->dbforge();

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '3',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE
            ),
            'title' => array(
                'type' => 'varchar',
                'constraint' => '100'
            ),
            'page' => array(
                'type' => 'varchar',
                'constraint' => '100',
                'null' => FALSE
            ),
            'keywords' => array(
                'type' => 'varchar',
                'constraint' => '300',
                'null' => FALSE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'page_data' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'date_time' =>array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'is_published' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'null' => FALSE

            )
        );

        //create fields
        $this->dbforge->add_field($fields);

        //add primary key
        $this->dbforge->add_key('id',TRUE);

        //create table
        if($this->dbforge->create_table('pages',TRUE))
        {
            echo "Table \"pages\" has been added successfully!";
        }
    }

    /**
     * Remove table "pages"
     * public
     * return null
     */
    public function down()
    {
        if($this->dbforge->drop_table('pages', TRUE))
        {
            echo "Table \"pages\" successfully removed!";
        }
    }
}