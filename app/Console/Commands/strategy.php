<?php

namespace App\Console\Commands;

use App\Http\Models\Strategy\StrategyContext;
use Illuminate\Console\Command;

class strategy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:strategy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '策略模式，打折或者满减';

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
        $num1 = strval($this->ask('请输入manjian or dazhe'));
        $money = 100;

        $model = new StrategyContext($num1);
        $res = $model->getMoney($money);
        dd($res);

    }
}
