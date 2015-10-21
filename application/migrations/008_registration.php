<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 19.10.15
 * Time: 21:27
 */
class Migration_registration extends CI_Migration
{
    public function up()
    {
        $fields_verification = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'token' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_verification);
        $this->dbforge->create_table('verification');
    }

    public function down()
    {
        $this->dbforge->drop_table('verification');
    }
}