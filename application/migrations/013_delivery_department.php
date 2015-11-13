<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 09.11.15
 * Time: 18:27
 */
class Migration_delivery_department extends CI_Migration
{
    public function up()
    {
        $fields_department = array(
            'schedule' => array(
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => FALSE
            ),
            'location' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'note' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        );
        $this->dbforge->add_column('delivery_addresses',$fields_department);
    }

    public function down()
    {
        $this->dbforge->drop_column('delivery_addresses', 'schedule');
        $this->dbforge->drop_column('delivery_addresses', 'location');
        $this->dbforge->drop_column('delivery_addresses', 'note');
    }

}