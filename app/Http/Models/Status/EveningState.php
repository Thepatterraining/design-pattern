<?php
namespace App\Http\Models\Status;

class EveningState extends State {
    function write(Worker $w) {
        if ($w->end == true) {
            $w->setState(new EndState);
            $w->write($w);
        }else {
            if ($w->hour < 21) {
                dump('大晚上加班要命哦');
            }else {
                $w->setState(new SleepState);
                $w->write($w);
            }
        }

    }
}
