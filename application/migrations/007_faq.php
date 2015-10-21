<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 19.10.15
 * Time: 14:39
 */
class Migration_faq extends CI_Migration
{
    public function up()
    {
        $fields_faq = array(
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

        );
        $this->load->dbforge();
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->add_field($fields_faq);

        $this->dbforge->create_table('faq');
    }

    public function down()
    {
        $this->dbforge->drop_table('faq');
    }
}