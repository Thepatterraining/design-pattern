<?php

namespace App\Http\Models\Decorator;

/**
 * 要装饰的核心代码
 */
class Compent {

    function __construct($name)
    {
        $this->name = $name;
    }

    function show() {
        dump($this->name);
    }
}
