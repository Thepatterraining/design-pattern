<?php

namespace App\Console\Commands\Algorithm;

use App\Http\Models\Decorator\Compent;
use App\Http\Models\Decorator\DecoratorA;
use App\Http\Models\Decorator\DecoratorB;
use App\Http\Models\LinkList\LinkTable;
use App\Http\Models\ListTable as ModelsListTable;
use App\Http\Models\Proxy\Proxy as AppProxy;
use Illuminate\Console\Command;

class unsortDeduplicate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:unsortDeduplicate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '无序数组去重算法，复杂度O(n平方)';

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
        $a = [4,5,4,3,8,6,6,10,34,10,4];
        dump($a);
        $i = 1;
        $len = count($a);
        dump("长度:".$len);
        while ($i < $len) { //循环全部数据
            //在整个数组中寻找这个值，如果找到了就删除他，如果没找到就下一个
            $preIndex = $this->find($i, $a);
            if ($preIndex!==false) {unset($a[$preIndex]);}
            else $i++;
        }
        dd($a);
    }

    private function find($i, array $a) {
        $index = 0;
        //循环从0到这个下标
        while ($index < $i) {
            //不存在说明被删除了
            if (!array_key_exists($index, $a)) {$index++;continue;}
            //如果找到了返回下标
            if ($a[$i] == $a[$index]) return $index;
            else $index++;
        }
        return false;
    }
}
