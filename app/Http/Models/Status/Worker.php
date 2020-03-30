<?php
namespace App\Http\Models\Status;

class Worker {
    public $state;
    public $hour;
    public $end = false;

    public function __construct()
    {
        $this->state = new ForeNoonState;
    }

    function setState(State $state) {
        $this->state = $state;
    }

    function write() {
        $this->state->write($this);
    }
}
