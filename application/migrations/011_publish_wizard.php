<?php
/**
 * Created by PhpStorm.
 * User: sasha
 * Date: 31.10.15
 * Time: 21:52
 */

class Migration_publish_wizard extends CI_Migration
{
    public function up()
    {
        $field_wizard_publish = array(
            'is_published' => array(
                'type' => 'INT',
                'constraint' => 1,
                'null' => FALSE
            )
        );
        $this->dbforge->add_column('wizard', $field_wizard_publish);
    }

    public function down()
    {
        $this->dbforge->drop_column('wizard', 'is_published');
    }
}