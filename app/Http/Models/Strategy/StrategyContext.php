<?php

namespace App\Http\Models\Strategy;

/**
 * 根据策略规则创建策略类
 *
 */
class StrategyContext{


    private $strategy;

    function __construct(string $type)
    {
        switch($type) {
            case 'manjian':
                $this->strategy = new StrategyA(100,10);
                break;
            case 'dazhe':
                $this->strategy = new StrategyB(0.5);
                break;
        }

    }
    function getMoney($money) {
        return $this->strategy->getResult($money);
    }
}
