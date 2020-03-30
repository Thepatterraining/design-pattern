<?php

namespace App\Http\Models\Stack;

/**
 * 顺序存储
 * 栈
 */
class ArrayStack {
    private $data = [];
    private $top = 0; //栈顶指针
    private $len = 0; //栈大小

    function __construct($len, $data = [])
    {
        $this->len = $len;
        $this->data = $data;
        $this->top = count($data) - 1;
    }

    /**
     * 入栈操作
     */
    function push($value) {
        if ($this->checkLen() == false) {
            return '栈满了';
        }
        $this->top++;
        $this->data[$this->top] = $value;
        return true;
    }

    /**
     * 出栈操作
     */
    function pop() {
        if ($this->isEmpty()) {
            return '空栈';
        }
        $index = $this->top;
        $this->top--;
        return $this->data[$index];
    }

    function isEmpty() {
        if ($this->top == -1) {
            return true;
        }
        return false;
    }


    private function checkLen() {
        if ($this->top >= $this->len - 1) {
            return false;
        }
        return true;
    }

    function list() {
        return $this->data;
    }
}
