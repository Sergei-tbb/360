<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Migration_wizard_logic extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up()
    {
        $this->_create_orders_table();
        $this->_create_orders_modal_table();
        $this->_create_orders_parameters_table();
    }

    public function down()
    {
        $this->dbforge->drop_table('orders');
        $this->dbforge->drop_table('orders_modal');
        $this->dbforge->drop_table('orders_parameters');
    }

    /**
     * Create table Orders
     * private
     * return null
     */
    private function _create_orders_table()
    {
        $fields_orders = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'id_wizard' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'id_discount' => array(
                'type' => 'FLOAT',
                'constraint' => 11
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'width' => array(
                'type' => 'INT',
                'constraint' => 6
            ),
            'height' => array(
                'type' => 'INT',
                'constraint' => 6
            )
        );

        $this->load->dbforge();
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_orders);
        $this->dbforge->create_table('orders');

        $this->_set_foreign_key("orders", "fk_id_wizard", "id_wizard", "wizard", "id");
        //TODO FK DISCOUNT
//        $this->_set_foreign_key("orders", "fk_id_material", "id_material", "material", "id");
    }

    /**
     * Create table Orders_modal
     * private
     * return null
     */
    private function _create_orders_modal_table()
    {
        $fields_order_model = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'id_orders' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'model_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'file_path' => array(
                'type' => 'VARCHAR',
                'constraint' => 200
            )
        );

        $this->load->dbforge();
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_order_model);
        $this->dbforge->create_table('orders_modal');

        $this->_set_foreign_key("orders_modal", "fk_id_orders", "id_orders", "orders", "id");
    }

    /**
     * Create table Orders_parameters
     * private
     * return null
     */
    private function _create_orders_parameters_table()
    {
        $fields_orders_parameters = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'id_orders' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'id_parameters' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'parameters_value' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            )
        );

        $this->load->dbforge();
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_orders_parameters);
        $this->dbforge->create_table('orders_parameters');

        $this->_set_foreign_key("orders_parameters", "fk_id_orders_parameters", "id_orders", "orders", "id");
        $this->_set_foreign_key("orders_parameters", "fk_id_parameters", "id_parameters", "parameters", "id");
    }

    /**
     * Set foreign key
     * private
     * @param string $table - table name
     * @param string $constraint - constraint
     * @param string $fk - foreign key
     * @param string $refer_table - references table
     * @param string $refer_field - references id
     * return null
     */
    private function _set_foreign_key($table, $constraint, $fk, $refer_table, $refer_field)
    {
        $query_str = "ALTER TABLE {$table}
                      ADD CONSTRAINT {$constraint}
                      FOREIGN KEY ({$fk})
                      REFERENCES {$refer_table}($refer_field)";
        $this->db->query($query_str);
    }
}