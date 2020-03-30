<?php

namespace App\Http\Models;

/**
 * 顺序存储
 * 线性表
 */
class ListTable {
    private $data = [];
    private $len = 0; //数据大小
    private $dataLen = 0; //线性表大小

    function __construct($dataLen, $data = [])
    {
        $this->dataLen = $dataLen;
        $this->data = $data;
        $this->len = count($data);
    }

    /**
     * 在线性表末尾添加元素
     */
    function add($value) {
        if ($this->checkLen() == false) {
            return '表满了';
        }
        $this->data[] = $value;
        $this->len++;
    }

    /**
     * 在线性表指定位置添加元素
     */
    function insert($index, $value) {
        if ($this->checkLen() == false) {
            return '表满了';
        }
        if ($index < 1 || $index > $this->dataLen) {
            return '出错啦';
        }

        /**
         * 如果$data = [1,2,3];
         * 要在2号位置添加4, $index = 2, $value=4, $this->len = 3
         * 把从最后一个元素到要插入的$index - 1的位置的元素全部向后移动一位，把$index - 1的位置空出来让新元素插入
         */
        if ($index <= $this->len) {
            for ($i = $this->len - 1; $i >= $index - 1; $i--) { //$i = 2; $i >= 1; $i--
                /**
                 * 第一遍 $this->data = [1,2,3,3]; $i = 2;
                 * 第二遍 $this->data = [1,2,2,3];$i = 1;
                 */
                $this->data[$i + 1] = $this->data[$i];
            }
        }
        $this->data[$index - 1] = $value; // $this->data = [1,4,2,3]
        $this->len++;
        return true;
    }

    private function checkLen() {
        if ($this->len >= $this->dataLen) {
            return false;
        }
        return true;
    }

    function list() {
        return $this->data;
    }

    /**
     * 删除线性表指定位置的元素
     */
    function remove($index) {

        if ($this->len == 0) {
            return '空表';
        }

        if ($this->checkLen() == false) {
            return '表满了';
        }
        if ($index < 1 || $index > $this->len) {
            return '出错啦';
        }

        /**
         * 如果$data = [1,4,2,3];
         * 要把2号位置4删除, $index = 2, $value=4, $this->len = 4
         * 把从要删除的$index - 1的位置到最后一个位置的元素全部向前移动一位，把最后的元素删除
         */
        $elem = $this->data[$index - 1]; //取出要删除的元素
        if ($index <= $this->len) {
            for ($i = $index - 1; $i < $this->len - 1; $i++) { //$i = 1; $i < 3; $i--
                /**
                 * 第一遍 $this->data = [1,2,2,3]; $i = 1;
                 * 第二遍 $this->data = [1,2,3,3];$i = 2;
                 */
                $this->data[$i] = $this->data[$i + 1];
            }
            //删除最后一个元素 $this->data = [1,2,3];
            unset($this->data[$this->len - 1]);
        }
        $this->len--;
        return $elem;
    }

    function getIndex($value) {
        if (in_array($value, $this->data)) {
            return array_search($value, $this->data) + 1;
        } else {
            return 0;
        }
    }

    function getElem($index) {
        if (empty($this->data) || $index < 1 || $index > $this->dataLen) {
            return '出错啦';
        }
        return $this->data[$index - 1];
    }
}
