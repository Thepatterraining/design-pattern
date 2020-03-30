<?php

namespace App\Http\Models\LinkList;

/**
 *
 * 单链表节点
 */
class Node {
    public $data;
    public $next; //指向下个元素的指针

    function __construct($data = null)
    {
        $this->data = $data;
        $this->next = null;
    }

    function __toString()
    {
        dump($this->data);
    }
}
