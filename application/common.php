<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
const ORDER_SORT_FIELD = '__order';//定义排序字段
// 应用公共文件
/**
 * 把返回的数据集转换成Tree
 * @param $list
 * @param string $pk
 * @param string $pid
 * @param string $child
 * @param string $root
 * @return array
 */
function listToTree($list, $pk = 'id', $pid = 'fid', $child = '_child', $root = '0') {
    $tree = [];
    if (is_array($list)) {
        $refer = [];
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }
        foreach ($list as $key => $data) {
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] = &$list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent = &$refer[$parentId];
                    $parent[$child][] = &$list[$key];
                }
            }
        }
    }
    return $tree;
}

function formatTree($list, $lv = 0, $title = 'name') {
    $formatTree = [];
    foreach ($list as $key => $val) {
        $title_prefix = '';
        for ($i = 0; $i < $lv; $i++) {
            $title_prefix .= "|---";
        }
        $val['lv'] = $lv;
        $val['namePrefix'] = $lv == 0 ? '' : $title_prefix;
        $val['showName'] = $lv == 0 ? $val[$title] : $title_prefix . $val[$title];
        if (!array_key_exists('_child', $val)) {
            array_push($formatTree, $val);
        } else {
            $child = $val['_child'];
            unset($val['_child']);
            array_push($formatTree, $val);
            $middle = formatTree($child, $lv + 1, $title); //进行下一层递归
            $formatTree = array_merge($formatTree, $middle);
        }
    }
    return $formatTree;
}

//毫秒级时间戳
function getMillisecond() {
    list($t1, $t2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
}

if (!function_exists('p')) {
    /**
     * 打印函数
     * @param string $data
     * @param int $is_die
     * @author:wkj
     * @date
     */
    function p() {
        echo "<pre>";
        foreach (func_get_args() as $variable) {
            if (is_bool($variable)) {
                var_dump($variable);
            } else {
                print_r($variable);
            }
            echo "\r\n";
        }
        echo "</pre>\r\n";
        die;
    }
}

function exlpodeNoEmpty($data) {
    return preg_split('/[,\s]+/', $data, -1, PREG_SPLIT_NO_EMPTY);
}


function createOrderNo($orderType = 1) {
    return $orderType . date('ymdHis') . rand(100, 999);
}


/*
@Func:按字符截取字符串(utf8)
@Auth:wkj
@Date:2016/12/5
@Param:
	$start:开始的位置
	$length:截取长度 (length不需要乘以3)
*/
function msubstr_just($str, $start, $length) {
    $i = 0;
    $j = 0;
    //完整排除之前的UTF8字符
    while ($i < $start) {
        $ord = ord($str{$i});
        if ($ord < 192) {
            $i++;
        } elseif ($ord < 224) {
            $i += 2;
        } else {
            $i += 3;
        }
    }
    //开始截取
    $result = '';
    while ($j < $start + $length && $i < strlen($str)) {
        $ord = ord($str{$i});
        if ($ord < 192) {
            $result .= $str{$i};
            $i++;
        } elseif ($ord < 224) {
            $result .= $str{$i} . $str{$i + 1};
            $i += 2;
        } else {
            $result .= $str{$i} . $str{$i + 1} . $str{$i + 2};
            $i += 3;
        }
        $j++;
    }

    return $result;
}

function writeLog($log, $type = 'sql') {
    $path = ROOT_PATH . '/runtime/';
    if (!is_dir($path) && !mkdir($path, 0755, true)) {
        return false;
    }
    if (is_array($log)) {
        $log = json_encode($log);
    }
    $filename = $path . date("Ymd") . '_' . $type . ".log";
    @$handle = fopen($filename, "a+");
    @fwrite($handle, date('Y-m-d H:i:s') . "  " . $log . "\r\n");
    @fclose($handle);
}
