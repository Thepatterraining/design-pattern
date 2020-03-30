<?php

namespace App\Http\Models\Strategy;

/**
 * 策略A
 * 满减活动
 */
class StrategyA extends StrategySuper {

    function __construct($man, $jian)
    {
        $this->man = $man;
        $this->jian = $jian;
    }

    function getResult($money) {
        if ($money >= $this->man) {
            return $money -= $this->jian;
        }
        return $money;
    }
}
