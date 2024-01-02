<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InsertTableTUserCoupon extends Migration
{
    public function up()
    {
        $data1 = [
            'coupon_id' => '1',
            'user_email' => 'one@gmail.com',
            'token' => 'ARU8TF',
            'exp_at' => '2024-01-14 10:12:46',
        ];
        $data2 = [

            'coupon_id' => '2',
            'user_email' => 'one@gmail.com',
            'token' => 'TSFT49',
            'exp_at' => '2024-01-14 10:12:46',
        ];
        $data3 = [

            'coupon_id' => '1',
            'user_email' => 'two@gmail.com',
            'token' => 'BKRM8X',
            'exp_at' => '2024-01-14 10:12:46',
        ];
        $data4 = [

            'coupon_id' => '2',
            'user_email' => 'two@gmail.com',
            'token' => 'ALPDEH',
            'exp_at' => '2024-01-14 10:12:46',
        ];
        $data5 = [

            'coupon_id' => '5',
            'user_email' => 'one@gmail.com',
            'token' => 'ALPEWS',
            'exp_at' => '2024-01-14 10:12:46',
        ];
        $this->db->table('t_usercoupon')->insert($data1);
        $this->db->table('t_usercoupon')->insert($data2);
        $this->db->table('t_usercoupon')->insert($data3);
        $this->db->table('t_usercoupon')->insert($data4);
        $this->db->table('t_usercoupon')->insert($data5);
    }

    public function down()
    {
        //
    }
}
