<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InsertTableMCoupons extends Migration
{
    public function up()
    {
        $data1 = [
            'title' => 'Discount 75%',
            'description' => '*snk',
            'img_path' => 'uploads/img/default.png',
            'is_active' => '1',
            'fee' => 25
        ];
        $data2 = [
            'title' => 'Discount 50%',
            'description' => '*snk',
            'img_path' => 'uploads/img/default.png',
            'is_active' => '1',
            'fee' => 20
        ];
        $data3 = [
            'title' => 'Discount 25%',
            'description' => '*snk',
            'img_path' => 'uploads/img/default.png',
            'is_active' => '1',
            'fee' => 15
        ];
        $data4 = [
            'title' => 'Discount 15%',
            'description' => '*snk',
            'img_path' => 'uploads/img/default.png',
            'is_active' => '1',
            'fee' => 13
        ];
        $data5 = [
            'title' => 'Discount 5%',
            'description' => '*snk',
            'img_path' => 'uploads/img/default.png',
            'is_active' => '1',
            'fee' => 3
        ];
        $this->db->table('m_coupons')->insert($data1);
        $this->db->table('m_coupons')->insert($data2);
        $this->db->table('m_coupons')->insert($data3);
        $this->db->table('m_coupons')->insert($data4);
        $this->db->table('m_coupons')->insert($data5);
    }

    public function down()
    {
        //
    }
}
