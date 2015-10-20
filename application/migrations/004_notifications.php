<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 15.10.15
 * Time: 16:58
 */

defined("BASEPATH") or exit("No direct script access allowed");

class Migration_notifications extends CI_Migration
{
    public function up()
    {
        $fields_notification = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE
            ),
            'notification' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => FALSE
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_notification);
        $this->dbforge->create_table('notifications');

        $fields_notifications_roles = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_notification' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_role' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_notifications_roles);
        $this->dbforge->create_table('notifications_roles');

        $fields_sent_notifications = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_notification' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'sent_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_sent_notifications);
        $this->dbforge->create_table('sent_nofitications');

        $fields_answered_notifications = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'id_notification' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'answer_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields_answered_notifications);
        $this->dbforge->create_table('answered_notifications');
    }

    public function down()
    {
        $this->dbforge->drop_table('notifications');
        $this->dbforge->drop_table('notifications_roles');
        $this->dbforge->drop_table('sent_notifications');
        $this->dbforge->drop_table('answered_notifications');
    }
}