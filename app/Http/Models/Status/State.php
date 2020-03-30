<?php
namespace App\Http\Models\Status;

abstract class State {
    abstract function write(Worker $w);
}
