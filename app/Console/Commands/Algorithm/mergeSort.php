<?php

namespace App\Console\Commands\Algorithm;

use Illuminate\Console\Command;

class mergeSort extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:mergeSort';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '归并排序，复杂度O(nlogn)';

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
     * 归并排序把数据逐步分解，然后对分解后的数据进行排序，最后合并到一起
     *
     * @return mixed
     */
    public function handle()
    {
        $this->a = [3,70,4,38,5,6,8,4,7,10,6,10,34,4];
        dump($this->a);
        $a = $this->mergeSort($this->a, 0, count($this->a));
       
        dd($a);
    }

    private function mergeSort($a, $lo, $hi) {
        if (($hi - $lo) < 2) return [$a[$lo]];
        $mi = ($lo + $hi) >> 1;
        //把中点左边的进行归并
        $b = $this->mergeSort($a, $lo, $mi);
        //把中点右边的进行归并
        $c = $this->mergeSort($a, $mi, $hi);
        $d = array_merge($b, $c);
        //把所有数据进行排序
        return $this->merge($d, $lo,$mi,$hi);
    }

    /**
     * 假设有一个数组$a分成了两个数组[3,4] [2,8]
     * 逐一比较，3and2，取出来2然后3and8取出来3然后4and8取出来4，最后取出来8
     *
     * @param [type] $lo
     * @param [type] $mi
     * @param [type] $hi
     * @return void
     */
    private function merge($a, $lo, $mi, $hi) {
        $lb = $mi - $lo;
        $b = [];
        //初始化从$lo - $mi之间的数据给$b数组
        for ($i = 0; $i < $lb; $i++) {
            $b[$i] = $a[$i];
        }
        $lc = $hi - $mi;
        //初始化从$mi - $hi之间的数据给$c数组
        $c = [];
        for ($i = $mi; $i < $lc; $i++) {
            $c[$i] = $a[$i];
        }
        $res = [];
        for($i = 0,$j=0,$k=0;$j<$lb || $k < $lc;){
            //比较两个数组首位的大小 如果b的首元素 < c的首元素，那么取出来b的首元素 || c的数组已经空了也就是$k >= $lc && j 下标没有越界
            if (($b[$j] <= $c[$k] || $k >= $lc) && $j < $lb) {
                $res[$i++] = $b[$j++];
            }
            //如果c的首元素 < b的首元素，那么取出来c的首元素 || b的数组已经空了也就是$j >= $lb && k 下标没有越界
            if (($b[$j] > $c[$k] || $j >= $lb) && $k < $lc) {
                $res[$i++] = $c[$k++];
            }
        }
        return $res;
    }
}
