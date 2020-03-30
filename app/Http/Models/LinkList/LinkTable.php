<?php

namespace App\Http\Models\LinkList;

/**
 * 链式存储
 * 线性表
 * 单链表
 */
class LinkTable {
    private $head; //头结点
    private $len = 0;  //链表长度

    function __construct()
    {
        $this->head = new Node();
    }

    /**
     * 在线性表末尾添加元素
     */
    function add($data) {
        $current = $this->head;
        //如果有后继节点就接着往后遍历，直到查找到最后一个节点
        while(!empty($current->next)) {
            $current = $current->next;
        }
        $current->next = new Node($data);
        $this->len++;
    }

    /**
     * 在线性表指定位置添加元素
     */
    function insert($index, $data) {
        $current = $this->getElem($index);
        $node = new Node($data);  //新建节点
        $node->next = $current->next; //把新节点的后继节点设置为之前这个位置节点的后继节点
        $current->next = &$node; //把之前这个位置的后继节点设置成新节点
        $this->len++;
        return true;
    }

    function isEmpty() {
        if ($this->len == 0) {
            return true;
        }
        return false;
    }

    /**
     * 删除线性表指定位置的元素
     */
    function remove($index) {
        if ($this->isEmpty()) {
            return '空表';
        }
        $current = $this->getElem($index);
        $elem = $current->next;
        $current->next = $elem->next;
        $this->len--;
        return $elem;
    }

    /**
     * 查找元素
     */
    function getElem($index) {
        $current = $this->head;
        $i = 1;
        //找到要查找位置的节点
        while($i < $index) {
            $current = $current->next;
            $i++;
        }
        return $current;
    }

    /**
     * 用头插法插入$count个节点创建一个单链表
     */
    function createListHead($count) {
        for ($i = 0; $i < $count; $i++) {
            $this->insert(1, rand(0, 100));
        }
        $this->len = $count;
    }

    /**
     * 用尾插法插入$count个节点创建一个单链表
     */
    function createListTail($count) {
        $current = $this->head;
        for ($i = 0; $i < $count; $i++) {
            $current->next = new Node(rand(0, 100));
            $current = $current->next;
        }
        $this->len = $count;
    }

    /**
     * 清空整个单链表
     */
    function clearList() {
        if ($this->isEmpty()) {
            return '空表';
        }
        $current = $this->head->next;
        while($current) {
            $temp = $current->next;
            unset($current);
            $current = $temp;
        }
        $this->head->next = null;
        $this->len = 0;
        return true;
    }
}
