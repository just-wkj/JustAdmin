<?php
/**
 * 接口管理
 * @since   2018-02-11
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace app\admin\controller;


use app\model\AdminApp;
use app\model\AdminFields;
use app\model\AdminList;
use app\util\ReturnCode;
use app\util\Tools;

class InterfaceList extends Base {
    /**
     * 获取接口列表
     * @return array
     * @throws \think\exception\DbException
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    public function index() {

        $limit = $this->request->get('size', config('justAdmin.ADMIN_LIST_DEFAULT'));
        $start = $this->request->get('page', 1);
        $keywords = $this->request->get('keywords', '');
        $type = $this->request->get('type', '');
        $status = $this->request->get('status', '');

        $where = [];
        if ($status === '1' || $status === '0') {
            $where['status'] = $status;
        }
        if ($type) {
            switch ($type) {
                case 1:
                    $where['hash'] = ['like', "%{$keywords}%"];
                    break;
                case 2:
                    $where['info'] = ['like', "%{$keywords}%"];
                    break;
                case 3:
                    $where['apiClass'] = ['like', "%{$keywords}%"];
                    break;
            }
        }
        $listObj = (new AdminList())->where($where)->order('id', 'DESC')
            ->paginate($limit, false, ['page' => $start])->toArray();

        return $this->ok([
            'list'  => $listObj['data'],
            'count' => $listObj['total']
        ]);
    }

    /**
     * 获取接口唯一标识
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     * @return array
     */
    public function getHash() {
        $res['hash'] = uniqid();

        return $this->ok($res);
    }

    /**
     * 新增接口
     * @return array
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    public function add() {
        $postData = $this->request->post();
        $res = AdminList::create($postData);
        if ($res === false) {
            return $this->json(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            return $this->ok([]);
        }
    }

    /**
     * 接口状态编辑
     * @return array
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    public function changeStatus() {
        $hash = $this->request->get('hash');
        $status = $this->request->get('status');
        $res = AdminList::update([
            'status' => $status
        ], [
            'hash' => $hash
        ]);
        if ($res === false) {
            return $this->json(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            cache('ApiInfo:' . $hash, null);
            return $this->ok([]);
        }
    }

    /**
     * 编辑接口
     * @return array
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    public function edit() {
        $postData = $this->request->post();
        $res = AdminList::update($postData);
        if ($res === false) {
            return $this->json(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            cache('ApiInfo:' . $postData['hash'], null);
            return $this->ok([]);
        }
    }

    /**
     * 删除接口
     * @return array
     * @throws \think\exception\DbException
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    public function del() {
        $hash = $this->request->get('hash');
        if (!$hash) {
            return $this->json(ReturnCode::EMPTY_PARAMS, '缺少必要参数');
        }

        $hashRule = AdminApp::all([
            'app_api' => ['like', "%$hash%"]
        ]);
        if ($hashRule) {
            $oldInfo = AdminList::get(['hash' => $hash]);
            foreach ($hashRule as $rule) {
                $appApiArr = explode(',', $rule->app_api);
                $appApiIndex = array_search($hash, $appApiArr);
                array_splice($appApiArr, $appApiIndex, 1);
                $rule->app_api = implode(',', $appApiArr);

                $appApiShowArrOld = json_decode($rule->app_api_show, true);
                $appApiShowArr = $appApiShowArrOld[$oldInfo->groupHash];
                $appApiShowIndex = array_search($hash, $appApiShowArr);
                array_splice($appApiShowArr, $appApiShowIndex, 1);
                $appApiShowArrOld[$oldInfo->groupHash] = $appApiShowArr;
                $rule->app_api_show = json_encode($appApiShowArrOld);

                $rule->save();
            }
        }

        AdminList::destroy(['hash' => $hash]);
        AdminFields::destroy(['hash' => $hash]);

        cache('ApiInfo:' . $hash, null);

        return $this->ok([]);
    }

    /**
     * 刷新接口路由
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     * @return array
     * @throws \think\exception\DbException
     */
    public function refresh() {
        $apiRoutePath = ROOT_PATH . 'application/apiRoute.php';
        $tplPath = ROOT_PATH . 'data/apiRoute.tpl';
        $methodArr = ['*','POST','GET'];

        $tplStr = file_get_contents($tplPath);
        $listInfo = AdminList::all(['status' => 1]);
        foreach ($listInfo as $value) {
            $tplStr .= 'Route::rule(\'api/'.$value->hash.'\',\'api/'.$value->apiClass.'\', \''.$methodArr[$value->method].'\', [\'after_behavior\' => $afterBehavior]);'.PHP_EOL;
        }

        file_put_contents($apiRoutePath, $tplStr);
        return $this->ok([]);
    }
}
