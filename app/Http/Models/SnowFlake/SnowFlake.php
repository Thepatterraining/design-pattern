<?php

namespace App\Http\Models\SnowFlake;

class SnowFlake {

    const FIRST = 0; //首位 符号位 表示正负0为正 1为负

    const TIME_LENGTH = 38; //时间戳位数 二进制的位数

    const MACHINE_LENGTH = 5; //机器码位数 二进制的位数

    const BUSINESS_LENGTH = 8; //业务位数 二进制的位数

    const SEQUENCE_LENGTH = 12; //序列号位数 二进制的位数

    private $machineId = 1;

    //上一次发号时间
    private $oldTime;

    private $sequence;

    //业务对应的业务id
    private $businessArr = [
        'order' => 1,
    ];

    function __construct($machineId = 1)
    {
        if (strlen(decbin($machineId)) > self::MACHINE_LENGTH) {
            return '机器id超长！';
        }
        $this->machineId = $machineId;
        //初始化时间戳
        $this->oldTime = $this->getTime();
        //初始化序号
        $this->sequence = 1;
    }

    /**
     * 生成唯一id
     * @param string $businessType 业务类型
     */
    function generate($businessType) {
        $time = $this->getTime();
        //比较时间戳
        if ($time == $this->oldTime) {
            //在同一毫秒内创建，序号递增
            if (strlen(decbin($this->sequence)) >= self::SEQUENCE_LENGTH) {
                return '到达最大发号个数';
            }
            ++$this->sequence;
        } else {
            //到达下一个时间，重置序号
            $this->sequence = 1;
        }

        $businessId = $this->getBusinessId($businessType);

        //字符位偏移量
        $firstShift = self::TIME_LENGTH + self::MACHINE_LENGTH + self::BUSINESS_LENGTH + self::SEQUENCE_LENGTH;
        //时间戳偏移量
        $timeShift = self::MACHINE_LENGTH + self::BUSINESS_LENGTH + self::SEQUENCE_LENGTH;
        //机器位偏移量
        $machineShift = self::BUSINESS_LENGTH + self::SEQUENCE_LENGTH;
        //业务偏移量
        $businessShift = self::SEQUENCE_LENGTH;

        $res = self::FIRST << $firstShift | $time << $timeShift | $this->machineId << $machineShift | $businessId << $businessShift | $this->sequence;

        //写入时间
        $this->oldTime = $time;
        return $res;
    }

    /**
     * 获取毫秒级时间戳
     */
    function getTime() {
        return time();
    }

    /**
     * 获取业务id
     */
    function getBusinessId($businessType) {
        return $this->businessArr[$businessType];
    }
}
