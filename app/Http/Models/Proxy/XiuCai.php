<?php

namespace App\Http\Models\Proxy;

/**
 * 秀才
 * 通过代理去像郭芙蓉表白
 */
class XiuCai implements IProxy {

    function __construct($name)
    {
        $this->name = $name;
    }

    function show() {
        dump($this->name . '我喜欢你');
    }
}
