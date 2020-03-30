<?php
namespace App\Http\Models\Status;

class NoonState extends State {
    function write(Worker $w) {
        if ($w->hour < 13) {
            dump('该吃中午饭打游戏了');
        }else {
            $w->setState(new AfterNoonState);
            $w->write($w);
        }
    }
}


