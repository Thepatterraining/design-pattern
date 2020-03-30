<?php
namespace App\Http\Models\Strategy;

/**
 * 策略B
 * 打折活动
 */
class StrategyB extends StrategySuper {

    function __construct($zhe)
    {
        $this->zhe = $zhe;
    }
    function getResult($money) {
        return $money * $this->zhe;
    }
}
