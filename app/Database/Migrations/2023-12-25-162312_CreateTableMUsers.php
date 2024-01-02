<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableMUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'point' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => false,
                'default' => 0
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime null',
        ]);
        $this->forge->addPrimaryKey('email');
        $this->forge->createTable('m_users');
    }
    public function down()
    {
        $this->forge->dropTable('m_users');
    }
}
