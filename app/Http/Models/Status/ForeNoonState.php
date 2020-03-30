<?php
namespace App\Http\Models\Status;

class ForeNoonState extends State {
    function write(Worker $w) {
        if ($w->hour < 12) {
            dump('上午工作啊');
        } else {
            $w->setState(new NoonState);
            $w->write($w);
        }
    }
}
