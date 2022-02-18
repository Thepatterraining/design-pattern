<?php

namespace App\Console\Commands\Algorithm;

use Illuminate\Console\Command;

class sortDeduplicate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:sortDeduplicate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '有序数组去重算法，复杂度O(n)';

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
     * 因为是有序数组，为了提高去重效率，取一个元素往后一直比对，如果相邻的相等表示是重复的
     * 继续往后，直到不相等，也就是遇到一个不重复的为止，将这个不重复的元素移动到该元素的下一个
     * 然后用这个不重复的元素为起始，重复上述操作。直到最后
     * 删除最后一个不重复元素后面所有的元素
     * 因为只循环一遍，复杂度O(n)
     *
     * @return mixed
     */
    public function handle()
    {
        $a = [3,4,4,4,5,6,6,8,10,10,34];
        dump($a);
        //分别代表第一个数据，和要比对的数据
        $i = 0;$j=0;
        $len = count($a);
        dump("长度:".$len);
        while ((++$j) < $len) { //循环全部数据
            //从$i往后寻找，如果相邻的相等表示是重复的，继续往后，直到不相等，也就是遇到一个不重复的为止，将这个不重复的元素移动到该元素的下一个
            if($a[$i] != $a[$j]) {
                $a[++$i] = $a[$j];
            }
        }
        //截取前面去重过的数据
        $a = array_slice($a, 0, ++$i);
        dd($a);
    }
}
