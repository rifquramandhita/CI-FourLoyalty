<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTUserCoupon extends Migration
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
            'coupon_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => false,
            ],
            'user_email' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 6,
                'null' => false,
            ],
            'exp_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime null',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('t_usercoupon');
    }

    public function down()
    {
        $this->forge->dropTable('t_usercoupon');
    }
}
