<?php

namespace App\Http\Models\Stack;

use App\Http\Models\LinkList\Node;

/**
 * 链式存储
 * 栈
 * 链栈
 */
class LinkStack {
    private $top; //栈顶指针
    private $len = 0;  //栈大小

    function __construct()
    {
        $this->head = new Node();
    }

    /**
     * 在链栈添加元素
     */
    function push($data) {
        $node = new Node($data);
        $node->next = $this->top;  //把原来的栈顶元素放到新元素的下面
        $this->top = $node;  //把栈顶指向新元素
        $this->len++;
    }


    function isEmpty() {
        if ($this->len == 0) {
            return true;
        }
        return false;
    }

    /**
     * 在链栈弹出元素
     */
    function pop() {
        if ($this->isEmpty()) {
            return '空栈';
        }
        $elem = $this->top;  //把要弹出的栈顶返回
        $this->top = $this->top->next;  //把栈顶指向原来栈顶的下一个元素
        $this->len--;
        return $elem;
    }
}
