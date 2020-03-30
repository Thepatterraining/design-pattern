<?php

namespace App\Console\Commands;

use App\Http\Models\Status\Worker;
use App\Http\Models\Strategy\StrategyContext;
use Illuminate\Console\Command;

class state extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:state';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '状态模式';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $worker = new Worker();
        $worker->hour = 9;
        $worker->write();
        $worker->hour = 10;
        $worker->write();
        $worker->hour = 12;
        $worker->write();
        $worker->hour = 13;
        $worker->write();
        $worker->hour = 18;
        $worker->write();
        $worker->end = true;
        $worker->hour = 21;
        $worker->write();

    }
}
