<?php

namespace App\Http\Models\SimpleFactory;

/**
 * 除法计算
 */
class Div extends JiSuan
{
    function getResult($num1, $num2) {
        if ($num2 == 0) {
            return '除数不能为0';
        }
        return intval($num1) / intval($num2);
    }
}
