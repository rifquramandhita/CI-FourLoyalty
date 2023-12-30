<?php

namespace App\Libraries;

class GlobalLibrary
{

    public function createTokenCoupon()
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789";
        srand((float)microtime() * 1000000);
        $i = 0;
        $pass = '';

        while ($i <= 5) {

            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }
}
