<?php

namespace App\Http\Models\Proxy;

/**
 * 小六作为代理存在
 */
class Proxy implements IProxy {

    function __construct($name)
    {
        $this->proxy = new XiuCai($name);
    }

    function show() {
        $this->proxy->show();
    }
}
