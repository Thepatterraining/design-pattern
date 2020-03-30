<?php
namespace App\Http\Models\Status;

class AfterNoonState extends State {
    function write(Worker $w) {
        if ($w->hour < 18) {
            dump('下午精神焕发了');
        }else {
            $w->setState(new EveningState);
            $w->write($w);
        }
    }
}
