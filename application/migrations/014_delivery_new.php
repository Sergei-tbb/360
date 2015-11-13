<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 11.11.15
 * Time: 11:18
 */
class Migration_delivery_new extends CI_Migration
{
    public function up()
    {
        $fields_areas = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_areas);
        $this->dbforge->create_table('delivery_areas');

        $fields_cities_areas = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_city' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_area' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_cities_areas);
        $this->dbforge->create_table('delivery_cities_areas');

        $fields_areas_streets = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_area' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_street' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_areas_streets);
        $this->dbforge->create_table('delivery_areas_streets');

        $field_delivery_addresses = array(
            'id_area' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        );
        $this->dbforge->add_column('delivery_addresses', $field_delivery_addresses);
    }

    public function down()
    {
        $this->dbforge->drop_table('delivery_areas');
        $this->dbforge->drop_table('delivery_cities_areas');
        $this->dbforge->drop_table('delivery_areas_streets');
        $this->dbforge->drop_column('delivery_addresses', 'id_area');
    }
}