<?php

namespace App\Http\Models\Decorator;

/**
 * 装饰器，把核心代码传入执行
 */
class Decorator extends Compent {

    function __construct($compent) {
        $this->compent = $compent;
    }
    function show() {
       if (!empty($this->compent)) {
           $this->compent->show();
       }
    }
}
