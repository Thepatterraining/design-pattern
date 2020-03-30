<?php

namespace App\Http\Models\Decorator;

/**
 * 装饰器B
 */
class DecoratorB extends Decorator {
    function show() {
       dump('这是装饰器B');
       parent::show();
    }
}
