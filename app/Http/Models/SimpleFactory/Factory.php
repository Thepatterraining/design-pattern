<?php

namespace App\Http\Models\SimpleFactory;

/**
 * 计算器
 */
class Factory
{
    function createJiSuanQi(string $symblo) : JiSuan {
        switch ($symblo) {
            case '+':
                return new Add;
            case '-':
                return new Sub;
            case '*':
                return new Mul;
            case '/':
                return new Div;
            default:
                return '输入错误';
        }
        return '输入错误';
    }
}
