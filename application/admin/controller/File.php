<?php
/**
 * Created by PhpStorm.
 * Func: 资讯管理
 * User: doushiwen
 * Date: 2018/10/7
 * Time: 17:15
 */

namespace app\admin\controller;


use app\model\PrevFile;
use app\util\ReturnCode;
use think\Request;

class File extends Base {
    public $prevNews;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new PrevFile();
    }

    /**
     * Func: 列表
     * User: doushiwen
     * Date: 2018/10/7
     */
    public function getList() {
        $limit = $this->request->get('size', config('justAdmin.ADMIN_LIST_DEFAULT'));
        $f_title = $this->request->get('f_title', '');
        $f_status = $this->request->get('f_status', '');

        $where = [];
        if ($f_title) $where['f_title'] = ['like', "%$f_title%"];
        if ($f_status && $f_status >= 0) $where['f_status'] = $f_status;
        $listObj = $this->model->getList($where, $limit)->toArray();
        $listInfo = $listObj['data'];

        return $this->buildSuccess([
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
        $res = $this->model->updateData($postData);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            if (isset($postData['f_recommend']) && $postData['f_recommend']) {
                $this->model->updateData(['f_recommend' => PrevFile::RECOMMEND_HIDEN], ['f_id' => ['NOT IN', $postData['f_id']]]);
            }

            return $this->buildSuccess([]);
        }
    }

    /**
     * Func: 新增
     * User: doushiwen
     * Date: 2018/10/7
     */
    public function add() {
        $postData = $this->request->post();
        $res = $this->model->addData($postData);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            return $this->buildSuccess([]);
        }
    }

    /**
     * Func: 删除
     * User: doushiwen
     * Date: 2018/10/7
     */
    public function del() {
        $id = $this->request->get('id');
        $res = $this->model->deleteData($id);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            return $this->buildSuccess([]);
        }
    }
}
