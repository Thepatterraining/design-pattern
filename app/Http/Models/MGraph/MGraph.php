<?php

namespace App\Http\Models\MGraph;

use App\Http\Models\Queue\LinkQueue;

/**
 * 图
 * 邻接矩阵存储方式
 *
 */
class MGraph {
    protected $arc = [];  //二维数组存储边的信息
    protected $vexs = [];  //一维数组存储节点信息
    protected $numVertexs; //顶点个数
    protected $numEdges; //边数

    private $queue;

    private $visited = [];

    function __construct()
    {
        $vertex = ['v1','v2','v3','v4'];
    }

    /**
     * 深度优先搜索
     */
    function DFS($i) {
        $this->visited[$i] = true;
        dump($this->vexs[$i]);
        for ($j = 0; $j < $this->numVertexs; $j++) {
            // 判断这个节点和所有节点的边是否存在，如果存在， 并且这个邻接节点没有被访问过，接着递归这个邻接节点
            if ($this->arc[$i][$j] == 1 && !$this->visited[$j]) {
                $this->DFS($j);
            }
        }
    }

    function DFSTraverse() {
        for ($i = 0; $i < $this->numVertexs; $i++) {
            $this->DFS($i);
        }
    }

    function BFSTraverse() {
        $this->queue = new LinkQueue;
        for ($i = 0; $i < $this->numVertexs; $i++) {
            $this->BFS($i);
        }
    }

    /**
     * 广度优先搜索
     */
    function BFS($i) {
        //判断是否访问过
        if (!$this->visited[$i]) {
            //没访问过就访问
            $this->visited[$i] = TRUE;
            dump($this->vexs[$i]);
            //入队列
            $this->queue->push($i);

            //循环队列
            while(!$this->queue->isEmpty()) {
                //取出一个
                $i = $this->queue->pop();

                for ($j = 0; $j < $this->numVertexs; $j++) {
                    // 判断这个节点和所有节点的边是否存在，如果存在， 并且这个邻接节点没有被访问过，就访问这个节点
                    if ($this->arc[$i][$j] == 1 && !$this->visited[$j]) {
                        //就访问这个节点
                        $this->visited[$i] = TRUE;
                        dump($this->vexs[$i]);
                        //入队列
                        $this->queue->push($i);
                    }
                }
            }
        }
    }

    /**
     * 普里姆算法
     * 求最小生成树
     * 普里姆算法以顶点开始，先找到一个顶点加入最小生成树集合V中，然后找到原顶点集合U中的顶点到V中所有顶点的边，找到其中最小权值的那一条边，把这条边和连接的顶点加入最小生成树。
     * 把顶点加入集合V中，再继续找U-V中最小权值的边，不断把顶点加入V中，当所有顶点加入V中，所找到的那些边就是最小生成树。
     */
    function Prime() {
        $lowcost = [0 => 0];  //V0顶点加入最小生成树
        $mst = [0 => 0];    //V0顶点加入最小生成树

        $v = [0];

        for ($i = 1;$i < $this->numVertexs;$i++) {
            $lowcost[$i] = $this->arc[0][$i];
            $mst[$i] = 0;
        }

        for ($i = 1; $i < $this->numVertexs; $i++) {
            $min = 65535;
            $j = 1; $k = 0;

            while ($j < $this->numVertexs) {
                //等于0是已经在最小生成树里面，要检查不在最小生成树里面的权值 要找到最小的权值
                if ($lowcost[$j] != 0 && $lowcost[$j] < $min) {
                    $min = $lowcost[$j];  //更新最小权值
                    $k = $j;  //将当前最小权值顶点存入k
                }
                $j++;
            }

            //打印边信息
            dump('当前最小边：'. $mst[$k] .',' . $k);
            //将该顶点加入最小生成树
            $lowcost[$k] = 0;

            for ($j = 1; $j < $this->numVertexs; $j++) {
                if ($lowcost[$j] != 0 && $this->arc[$k][$j] < $lowcost[$j]) {
                    $lowcost[$j] = $this->arc[$k][$j];  //更新最小权值
                    $mst[$j] = $k;  //将当前最小权值顶点存入k
                }
            }

        }

    }

    /**
     * 克鲁斯卡尔算法
     * 求最小生成树
     *
     * 先把所有边按权值从小到大排序，从其中选最小的边开始连接顶点。只要不形成环路就可以连接。形成环路则跳过。当所有顶点连接完成就形成了最小生成树
     */
    function Kruskal() {
        $edges = [];  //边集数组
        $parent = []; //定义一维数组用来判断边与边是否形成环路

        for ($i =0; $i < $this->numVertexs; $i++) {
            $parent[$i] = 0;
        }

        for ($i = 0; $i< $this->numEdges; $i++) {
            $n = $this->find($parent, $edges[$i]->begin);
            $m = $this->find($parent, $edges[$i]->end);
            if ($n != $m) {  //说明没有和现有生成树形成环路
                $parent[$n] = $m;  //将此边的结尾顶点放入下标会起点的parent中，表示此顶点已经在生成树中
                dump($edges[$i]);
            }
        }
    }

    /**
     * 查找连线顶点的尾部下标
     */
    function find($parent, $f) {
        while($parent[$f] > 0) {
            $f = $parent[$f];
        }
        return $f;
    }


    /**
     * 迪杰斯特拉算法
     * 求最短路径
     * 求出起始点到相邻点的最短路径
     */
    function Dijkstra($G, $V0, $p, $d) {
        $final = [];   //$final[w] = 1 表示求得V0顶点到Vw顶点的最短路径

        for ($v = 0; $v< $this->numVertexs; $v++) {
            $final[$v] = 0;
            $d[$v] = 0;  //放入V0到V点边的权值
            $p[$v] = 0;
        }

        $d[$V0] = 0;    //V0到V0点的最短路径是0
        $final[$V0] = 1;   //V0到V0点的最短路径已经求出

        /**
         * 开始主循环，每次求得V0到某个V顶点的最短路径
         */
        for ($v = 1; $v < $this->numVertexs; $v++) {
            $min = 65535;  //当前所知离V0顶点的最近距离
            /**
             * 这个循环找到V0到Vw的最短路径
             */
            for ($w = 0; $w < $this->numVertexs; $w++) {
                //V0到Vw的最短路径 未知 并且 小于当前最短路径
                if (!$final[$w] && $d[$w] < $min) {
                    $k = $w;       //记录当前顶点
                    $min = $d[$w];  //更新最短路径
                }
            }

            $final[$k] = 1;  //将目前找到最近的顶点置位1

            //修正当前最短路径及距离
            /**
             * 这个循环找到Vw作为前驱，到其他邻接顶点的最短路径，也就是找到V0到Vw再到Vw邻接顶点的最短路径，放到最短路径数组中
             * 方便下一个主循环找到下一个Vw的最短路径
             */
            for ($w = 0; $w < $this->numVertexs; $w++) {

                //V0到Vw的最短路径 未知 并且 从V0到上一个顶点在倒这个顶点的路径 小于 V0到这个顶点的路径 也就是找到了更短的路径
                if (!$final[$w] && $min + $this->arc[$k][$w] < $d[$w]) {
                    //说明找到了更短路径
                    $d[$w] = $min + $this->arc[$k][$w];  //把更短路径赋值给从V0到这个顶点的距离
                    $p[$w] = $k;  //说明上个顶点是这个顶点的前驱
                }
            }

        }
    }

    /**
     * 佛洛依德算法
     * 求网图G中，各顶点V到其余顶点W中的最短路径P[v][w]及带权长度D[v][w]
     */
    function floyd($g, $p, $d) {
        $d = [];
        $p = [];
        //初始化d 和 p
        for ($v = 0; $v < $this->numVertexs; $v++) {
            for ($w = 0; $w < $this->numVertexs; $w++) {
                $d[$v][$w] = $this->arc[$v][$w];
                $p[$v][$w] = $w;
            }
        }

        /**
         * 查找一个V点通过k点到w点的距离是否比v点直接到w点距离短，如果是，那么更新最短距离并记录前驱顶点
         */
        for ($k = 0; $k < $this->numVertexs; $k++) {
            for ($v = 0; $v < $this->numVertexs; $v++) {
                for ($w = 0; $w < $this->numVertexs; $w++) {
                    //判断V点通过k点到w点的距离是否比v点直接到w点距离短
                    if ($d[$v][$w] > $d[$v][$k] + $d[$k][$w]) {
                        $d[$v][$w] = $d[$v][$k] + $d[$k][$w];  //更新最短路径
                        $p[$v][$w] = $p[$v][$k];    //更新前驱顶点
                    }
                }
            }
        }

    }
}
