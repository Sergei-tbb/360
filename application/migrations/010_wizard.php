<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 29.10.15
 * Time: 12:10
 */

class Migration_wizard extends CI_Migration
{
    public function up()
    {
        $fields_wizard = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'picture' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_wizard);
        $this->dbforge->create_table('wizard');

        $fields_categories = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'picture' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_categories);
        $this->dbforge->create_table('categories');

        $fields_wizard_categories = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_categories' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_wizard' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_wizard_categories);
        $this->dbforge->create_table('wizard_categories');

        $fields_wizard_steps = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => FALSE
            ),
            'id_wizard' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_steps' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_wizard_steps);
        $this->dbforge->create_table('wizard_steps');

        $fields_steps = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_steps);
        $this->dbforge->create_table('steps');

        $fields_steps_groups_parametrs = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_steps' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_groups_parametrs' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_steps_groups_parametrs);
        $this->dbforge->create_table('steps_groups_parametrs');

        $fields_group_parametrs = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_group' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_parameter' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_group_parametrs);
        $this->dbforge->create_table('groups_parametrs');

        $fields_groups = array(
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
        $this->dbfroge->add_field($fields_groups);
        $this->dbforge->create_table('groups');

        $fields_parameters = array(
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
            'id_parameters_types' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbfroge->add_field($fields_parameters);
        $this->dbforge->create_table('parameters');

        $fields_parameters_types = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ),
            'unit' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_parameters_types);
        $this->dbforge->create_table('parameters_types');

        $fields_parameters_types_value = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_types_values' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ),
            'id_parameters_types' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'price' => array(
                'type' => 'DECIMAL',
                'constraint' => 5,4,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_parameters_types_value);
        $this->dbforge->create_table('parameters_types_value');

        $fields_types_values = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'value' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbfroge->add_field($fields_types_values);
        $this->dbforge->create_table('types_values');


    }

    public function down()
    {
        $this->dbforge->drop_table('wizard');
        $this->dbforge->drop_table('categories');
        $this->dbforge->drop_table('wizard_categories');
        $this->dbforge->drop_table('wizard_steps');
        $this->dbforge->drop_table('steps');
        $this->dbforge->drop_table('steps_groups_parametrs');
        $this->dbforge->drop_table('groups_parametrs');
        $this->dbforge->drop_table('groups');
        $this->dbforge->drop_table('parameters');
        $this->dbforge->drop_table('parameters_types');
        $this->dbforge->drop_table('parameters_types_value');
        $this->dbforge->drop_table('types_values');
    }
}