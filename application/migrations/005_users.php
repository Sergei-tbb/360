<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 16.10.15
 * Time: 16:23
 */
defined("BASEPATH") or exit("No direct script access allowed");

class Migration_users extends CI_Migration
{
    public function up()
    {
        $fields_users = array(
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
            'surname' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'middlename' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => FALSE
            ),
            'reg_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'is_verify' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            ),
            'is_online' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            ),
            'id_user_role' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_users);
        $this->dbforge->create_table('users');

        $fields_users_orders = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'id_user_files' => array(
                'type' => 'INT'
            ),
            'creating_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'new_field' => array(
                'type' => 'INT'
            ),
            'id_status' => array(
                'type' => 'INT'
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_users_orders);
        $this->dbforge->create_table('users_orders');

        $fields_users_contractors = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'surname' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'middlename' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => FALSE
            ),
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_users_contractors);
        $this->dbforge->create_table('users_contractors');

        $fields_contractor_phones = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_users_contactors' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_phones' => array(
                'type' => 'INT'
            ),
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_contractor_phones);
        $this->dbforge->create_table('contractor_phones');

        $fields_users_bonuses = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_bonuses' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_users_bonuses);
        $this->dbforge->create_table('users_bonuses');

        $fields_users_files = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'path' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_users_files);
        $this->dbforge->create_table('users_files');

        $fields_phones = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => 16,
                'null' => FALSE
            ),
            'is_main' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            ),
            'is_notify' => array(
                'type' => 'TINYINT',
                'constraint' => 11,
                'null' => FALSE
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_phones);
        $this->dbforge->create_table('phones');

        $fields_users_phones = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_phone' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_users_phones);
        $this->dbforge->create_table('users_phones');

        $fields_users_account = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'amount' => array(
                'type' => 'DECIMAL',
                'constraint' => 7,4,
                'null' => FALSE
            ),
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'is_nds' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_users_account);
        $this->dbforge->create_table('users_account');

        $fields_users_documents = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'filename' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE
            ),
            'filepath' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => FALSE
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_users_documents);
        $this->dbforge->create_table('users_documents');

        $fields_users_token = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_token_types' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'token' => array(
                'type' => 'VARCHAR',
                'constraint' => 299,
                'null' => FALSE
            ),
            'date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_users_documents);
        $this->dbforge->create_table('users_token');


    }


    public function down()
    {
        $this->dbforge->drop_table('users');
        $this->dbforge->drop_table('users_orders');
        $this->dbforge->drop_table('users_contractors');
        $this->dbforge->drop_table('contractor_phones');
        $this->dbforge->drop_table('users_bonuses');
        $this->dbforge->drop_table('users_files');
        $this->dbforge->drop_table('phones');
        $this->dbforge->drop_table('users_phones');
        $this->dbforge->drop_table('users_account');
        $this->dbforge->drop_table('users_documents');
        $this->dbforge->drop_table('users_token');
    }
}