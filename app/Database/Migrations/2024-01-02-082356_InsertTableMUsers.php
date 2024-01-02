<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InsertTableMUsers extends Migration
{
    public function up()
    {
        $data1 = [
            'email' => 'one@gmail.com',
            'password' => '$2y$10$Zue603/eOMB3NCH.a3d0cuWXvB9YlW8oYUj864K/6RpD5L3p19Snq', //password
            'name' => 'One',
            'address' => 'Jakarta',
            'phone' => '6281'
        ];
        $data2 = [
            'email' => 'two@gmail.com',
            'password' => '$2y$10$Zue603/eOMB3NCH.a3d0cuWXvB9YlW8oYUj864K/6RpD5L3p19Snq', //password
            'name' => 'Two',
            'address' => 'Jakarta',
            'phone' => '6282'
        ];
        $this->db->table('m_users')->insert($data1);
        $this->db->table('m_users')->insert($data2);
    }

    public function down()
    {
        //
    }
}
