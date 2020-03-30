<?php

namespace App\Http\Models\SimpleFactory;

/**
 * 加法计算
 */
class Add extends JiSuan
{
    function getResult($num1, $num2) {
        return intval($num1) + intval($num2);
    }
}
