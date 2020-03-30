<?php

namespace App\Console\Commands\Algorithm;

use App\Http\Models\Decorator\Compent;
use App\Http\Models\Decorator\DecoratorA;
use App\Http\Models\Decorator\DecoratorB;
use App\Http\Models\LinkList\LinkTable;
use App\Http\Models\ListTable as ModelsListTable;
use App\Http\Models\Proxy\Proxy as AppProxy;
use Illuminate\Console\Command;

class listTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:listTable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '线性表';

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
        // $table = new ModelsListTable(6);
        // $table->insert(1,3);
        // $table->insert(1,2);
        // $table->insert(1,1);
        // $table->insert(2,4);
        // $e = $table->remove(2);
        // dd($table->list(), $table->getElem(1));

        $table = new LinkTable();
        // $table->insert(1,123);
        // $table->insert(1,321);
        // dd($table);
        // dd($table->getElem(1));
        // dump($table->getElem(2));
        // $table->remove(1);
        $table->createListHead(5);
        dd($table);

    }
}
