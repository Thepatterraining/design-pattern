<?php

namespace App\Http\Models\SimpleFactory;

/**
 * 减法计算
 */
class Sub extends JiSuan
{
    function getResult($num1, $num2) {
        return intval($num1) - intval($num2);
    }
}
