<?php

namespace App\Console\Commands\Algorithm;

use App\Http\Models\Decorator\Compent;
use App\Http\Models\Decorator\DecoratorA;
use App\Http\Models\Decorator\DecoratorB;
use App\Http\Models\LinkList\LinkTable;
use App\Http\Models\ListTable as ModelsListTable;
use App\Http\Models\Proxy\Proxy as AppProxy;
use App\Http\Models\Str\Str as StrStr;
use Illuminate\Console\Command;

class str extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:str';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '字符串';

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
        $a = '9abcbaaaba';
        $b = '1c';
        $str = new StrStr;
        dd($str->IndexKmp($a, $b, 1));

    }
}
