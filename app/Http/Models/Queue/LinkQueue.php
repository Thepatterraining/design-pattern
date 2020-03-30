<?php

namespace App\Http\Models\Queue;

use App\Http\Models\LinkList\Node;

/**
 * 链式存储
 * 队列
 * 链队列
 */
class LinkQueue {
    private $front; //对头指针
    private $rear; //对尾指针
    private $len = 0;  //队列大小

    function __construct()
    {
        $node = new Node();
        $this->front = &$node;
        $this->rear = &$node;
    }

    /**
     * 在链队列添加元素
     */
    function push($data) {
        $node = new Node($data);
        $this->rear->next = $node; //把新元素放到队列尾的后面
        $this->rear = $node;  //把队列尾指向新元素
        $this->len++;
    }


    function isEmpty() {
        if ($this->len == 0) {
            return true;
        }
        return false;
    }

    /**
     * 在链队列弹出元素
     */
    function pop() {
        if ($this->isEmpty()) {
            return '空队列';
        }
        $elem = $this->front->next;  //把要弹出的队列头返回
        $this->front->next = $elem->next;  //把队列头指向原来队列头的下一个元素
        $this->len--;
        return $elem;
    }
}
