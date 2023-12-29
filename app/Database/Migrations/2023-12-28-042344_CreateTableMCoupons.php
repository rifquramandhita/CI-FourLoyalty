<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableMCoupons extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'img_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'is_active' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime null',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('m_coupons');
    }

    public function down()
    {
        $this->forge->dropTable('m_coupons');
    }
}
