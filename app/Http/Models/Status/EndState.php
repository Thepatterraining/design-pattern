<?php
namespace App\Http\Models\Status;

class EndState extends State {
    function write(Worker $w) {
        dump('终于下班回家了');
    }
}
