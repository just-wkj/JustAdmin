<?php
/**
 * 模型基类
 * @since   2017/07/25 创建
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace app\model;


use app\util\Tools;
use think\Config;
use think\Model;

class Base extends Model {
    //状态
    const STATUS_SHOW = 1;
    const STATUS_HIDEN = 0;



    //所有状态
    public function allStatusName() {
        return [
            self::STATUS_HIDEN => '禁用',
            self::STATUS_SHOW => '启用'
        ];
    }


    /**
     *  获取一个
     * @author:wkj
     * @date  2018/11/4 16:10
     * @param $where
     * @return array|false|\PDOStatement|string|Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getOne($where, $with=[]){
        $order = [];
        if (isset($where[ORDER_SORT_FIELD])) {
            $order = $where[ORDER_SORT_FIELD];
            unset($where[ORDER_SORT_FIELD]);
        }

        return $this->where($where)->with($with)->order($order)->find();
    }

    /**
     *  获取所有
     * @author:wkj
     * @date  2018/11/4 16:10
     * @param       $where
     * @param array $with
     * @param int   $limit
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getAll($where, $with = [], $limit = 0){
        $order = [];
        if (isset($where[ORDER_SORT_FIELD])) {
            $order = $where[ORDER_SORT_FIELD];
            unset($where[ORDER_SORT_FIELD]);
        }
        if ($limit > 0) {
            return $this->where($where)->with($with)->order($order)->limit($limit)->select();
        }

        return $this->where($where)->with($with)->order($order)->select();
    }

}
