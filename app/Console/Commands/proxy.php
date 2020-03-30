<?php

namespace App\Console\Commands;

use App\Http\Models\Decorator\Compent;
use App\Http\Models\Decorator\DecoratorA;
use App\Http\Models\Decorator\DecoratorB;
use App\Http\Models\Proxy\Proxy as AppProxy;
use Illuminate\Console\Command;

class proxy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:proxy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '代理模式，代理求爱';

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
        $name = $this->ask('请输入想像谁求爱');
        $proxy = new AppProxy($name);

        $proxy->show();

    }
}
