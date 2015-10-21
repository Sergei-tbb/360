<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 17.10.15
 * Time: 23:03
 */

class Migration_delivery extends CI_Migration
{
    public function up()
    {
        $fields_delivery_company = array(
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
            ),
            'website' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_delivery_company);
        $this->dbforge->create_table('delivery_companies');

        $fields_delivery_countries = array(
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
        $this->dbforge->add_field($fields_delivery_countries);
        $this->dbforge->create_table('delivery_countries');

        $fields_delivery_regions = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_country' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_delivery_regions);
        $this->dbforge->create_table('delivery_regions');

        $fields_delivery_cities = array(
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
        $this->dbforge->add_field($fields_delivery_cities);
        $this->dbforge->create_table('delivery_cities');

        $fields_delivery_regions_cities = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_region' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_city' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_delivery_regions_cities);
        $this->dbforge->create_table('delivery_regions_cities');

        $fields_delivery_streets = array(
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
        $this->dbforge->add_field($fields_delivery_streets);
        $this->dbforge->create_table('delivery_streets');

        $fields_delivery_regions_cities_streets = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_region_city' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_street' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_delivery_regions_cities_streets);
        $this->dbforge->create_table('delivery_regions_cities_streets');

        $fields_delivery_addresses = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_company' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_region_city_street' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'house_number' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => FALSE
            ),
            'department_number' => array(
                'type' => 'INT',
                'constraint' => 4,
                'null' => FALSE
            ),
            'zip' => array(
                'type' => 'INT',
                'constraint' => 8,
                'null' => FALSE
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => 16,
                'null' => FALSE
            ),
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_delivery_addresses);
        $this->dbforge->create_table('delivery_addresses');
    }

    public function down()
    {
        $this->dbforge->drop_table('delivery_companies');
        $this->dbforge->drop_table('delivery_countries');
        $this->dbforge->drop_table('delivery_regions');
        $this->dbforge->drop_table('delivery_cities');
        $this->dbforge->drop_table('delivery_regions_cities');
        $this->dbforge->drop_table('delivery_streets');
        $this->dbforge->drop_table('delivery_regions_cities_streets');
        $this->dbforge->drop_table('delivery_addresses');
    }
}