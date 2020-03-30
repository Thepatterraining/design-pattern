<?php

namespace App\Http\Models\Str;

/**
 * 串
 */
class Str {
    /**
     * 串的朴素模式匹配算法
     * 返回子串T在子串S中第pos个字符之后的位置。若不存在，则返回0
     * T非空， 1 <= pos <= strlength(S)
     */
    function Index(string $S, string $T, int $pos) {
        $i = $pos;  //i为主串中当前位置下标 若pos不为1，则从pos位置开始匹配
        $j = 1;   //j用于子串中当前位置下标

        //判断长度
        while ($i <= $S[0] && $j <= $T[0]) {
            if ($S[$i] == $T[$j]) {
                //如果第一个字母相等则对比下一个字母
                $i++;
                $j++;
            }else {
                //把i回到上一个匹配的字符的下一个
                $i = $i - $j + 2;
                //j退回首位
                $j = 1;
            }
        }

        if ($j > $T[0]) {
            //匹配上了，返回下标
            return $i - $T[0];
        } else {
            //没匹配上， 返回0
            return 0;
        }
    }

    /**
     * 获取KMP算法的next数组
     */
    function getNext(string $T) {
        $next = [];
        $i = 2; //后缀的下标
        $next[1] = 0;
        $next[2] = 1;
        $j = 1; //前缀的下标
        while($i < $T[0]) {
            /**
             * j = 0 进入是因为j++后j = 1,完成两个数不相等，next[i] = 1的步骤
             * 因为比较两个数是在 1 到 j - 1这个区间比较，所以当i = j - 1时，i要先++，再作为next的下标
             * j++再赋值是因为 next[i] = n + 1，而j = 1时相等说明首字符相等 1+1,j = 2时判断两个字符相等说明前两个字符和后缀两个字符相等，根据n +1, 2+ 1，因为如果首字符和前面的字符不相等，这里的j = 1而不会是2
             */
            if ($j == 0 || $T[$i] == $T[$j]) {
                $i++;
                $j++;
                $next[$i] = $j;
            } else {
                $j = $next[$j];
            }
        }
        return $next;
    }

    /**
     * 串的KMP模式匹配算法
     * 返回子串T在子串S中第pos个字符之后的位置。若不存在，则返回0
     * T非空， 1 <= pos <= strlength(S)
     */
    function IndexKmp(string $S, string $T, int $pos) {
        $i = $pos;  //i为主串中当前位置下标 若pos不为1，则从pos位置开始匹配
        $j = 1;   //j用于子串中当前位置下标
        $next = $this->getNext($T);
        //判断长度
        while ($i <= $S[0] && $j <= $T[0]) {
            if ($j == 0 || $S[$i] == $T[$j]) {
                //如果第一个字母相等则对比下一个字母
                $i++;
                $j++;
            }else {
                //把i不后退
                // $i = $i - $j + 2;
                //j退回next数组的相应位置
                $j = $next[$j];
            }
        }

        if ($j > $T[0]) {
            //匹配上了，返回下标
            return $i - $T[0];
        } else {
            //没匹配上， 返回0
            return 0;
        }
    }

}
