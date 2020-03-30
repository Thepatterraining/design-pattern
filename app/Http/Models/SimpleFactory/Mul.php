<?php

namespace App\Http\Models\SimpleFactory;

/**
 * 乘法计算
 */
class Mul extends JiSuan
{
    function getResult($num1, $num2) {
        return intval($num1) - intval($num2);
    }
}
