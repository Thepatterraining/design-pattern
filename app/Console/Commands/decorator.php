<?php

namespace App\Console\Commands;

use App\Http\Models\Decorator\Compent;
use App\Http\Models\Decorator\DecoratorA;
use App\Http\Models\Decorator\DecoratorB;
use Illuminate\Console\Command;

class decorator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:decorator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '装饰模式，无限换装';

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
        $name = strval($this->ask('请输入名字'));

        $model = new Compent($name);
        $b = new DecoratorB($model);
        $a = new DecoratorA($b);

        $res = $a->show();
        dd($res);

    }
}
