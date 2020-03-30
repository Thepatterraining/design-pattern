<?php

namespace App\Console\Commands;

use App\Http\Models\JiSuanQi;
use App\Http\Models\SimpleFactory\Factory;
use Illuminate\Console\Command;

class jisuan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:jisuan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '简易计算器';

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
        $num1 = intval($this->ask('请输入第一个数'));
        $simple = $this->ask('请输入+ - * /');
        $num2 = intval($this->ask('请输入第二个数'));

        $factory = new Factory();
        $jisuanqi = $factory->createJiSuanQi($simple);
        $res = $jisuanqi->getResult($num1, $num2);
        dd($res);

    }
}
