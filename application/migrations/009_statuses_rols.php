<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Migration_statuses_rols extends CI_Migration
{
    public function up()
    {
        $fields_pages = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'id_statuses' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'id_roles' => array(
                'type' => 'INT',
                'constraint' => 3
            )
        );

        $foreign_array = array(
            'field' => 'id_roles',
            'foreign_table' => 'roles',
            'foreign_field' => 'id'
        );

        $this->load->dbforge();
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_foreign_key($foreign_array);
        $this->dbforge->add_field($fields_pages);
        $this->dbforge->create_table('statuses_rols');

        $this->_set_foreign_key("statuses_rols", "fk_id_roles_statuses", "id_roles", "roles", "id");
        $this->_set_foreign_key("statuses_rols", "fk_id_statuses_roles", "id_statuses", "statuses", "id");
    }

    public function down()
    {
        $this->dbforge->drop_table('statuses_rols');
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
                      REFERENCES {$refer_table}($refer_field)
                      ON DELETE CASCADE ";
        $this->db->query($query_str);
    }
}