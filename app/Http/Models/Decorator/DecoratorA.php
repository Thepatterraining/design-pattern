<?php

namespace App\Http\Models\Decorator;

/**
 * 装饰器A
 */
class DecoratorA extends Decorator {
    function show() {
       dump('这是装饰器A');
       parent::show();
    }
}
