<?php
/**
 * Created by PhpStorm.
 * Func: 资讯管理
 * User: doushiwen
 * Date: 2018/10/7
 * Time: 17:15
 */

namespace app\admin\controller;


use app\model\PrevNews;
use app\util\ReturnCode;
use app\util\Tools;
use think\Db;
use think\Request;

class News extends Base {
    public $prevNews;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->prevNews = new PrevNews();
    }

    /**
     * Func: 列表
     * User: doushiwen
     * Date: 2018/10/7
     */
    public function getList() {
        $limit = $this->request->get('size', config('justAdmin.ADMIN_LIST_DEFAULT'));
        $n_name = $this->request->get('n_name', '');
        $nt_id = $this->request->get('nt_id', '');
        $na_id = $this->request->get('na_id', '');

        $where = [];
        if ($n_name) $where['n_name'] = ['like', "%$n_name%"];
        if ($nt_id) $where['nt_id'] = $nt_id;
        if ($na_id) $where['na_id'] = $na_id;
        $listObj = $this->prevNews->getList($where, $limit)->toArray();
        $listInfo = $listObj['data'];

        return $this->ok([
            'list'  => $listInfo,
            'count' => $listObj['total']
        ]);
    }

    /**
     * Func: 编辑
     * User: doushiwen
     * Date: 2018/10/7
     */
    public function edit() {
        $postData = $this->request->post();
        if (isset($postData['n_desc'])) $postData['n_desc'] = str_replace('<img',   '<img style="width:100%; height:auto" ' , $postData['n_desc']);
        $info =  $this->prevNews->where([
            'n_id' => $postData['n_id'],
        ])->find();

        if(!$info){
            return $this->json(ReturnCode::NOT_EXISTS, '操作失败,数据不存在');
        }

        $res = $this->prevNews->updateData($postData);
        if ($res === false) {
            return $this->json(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            return $this->ok([]);
        }
    }

    /**
     * Func: 新增
     * User: doushiwen
     * Date: 2018/10/7
     */
    public function add() {
        $postData = $this->request->post();
        if (isset($postData['n_desc'])) $postData['n_desc'] = str_replace('<img',   '<img style="width:100%; height:auto" ' , $postData['n_desc']);
        $res = $this->prevNews->addData($postData);
        if ($res === false) {
            return $this->json(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            return $this->ok([]);
        }
    }

    /**
     * Func: 删除
     * User: doushiwen
     * Date: 2018/10/7
     */
    public function del() {
        $id = $this->request->get('id');
        $info =  $this->prevNews->where([
            'n_id' => $id
        ])->find();
        if(!$info){
            return $this->json(ReturnCode::NOT_EXISTS, '操作失败,数据不存在');
        }
        $res = $this->prevNews->deleteData($id);
        if ($res === false) {
            return $this->json(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            return $this->ok([]);
        }
    }
}
