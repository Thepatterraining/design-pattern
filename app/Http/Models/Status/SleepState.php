<?php
namespace App\Http\Models\Status;

class SleepState extends State {
    function write(Worker $w) {
        dump('不行了，太晚了，睡觉了');
    }
}
