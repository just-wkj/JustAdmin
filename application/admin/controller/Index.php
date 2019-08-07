<?php

namespace app\admin\controller;


use app\lib\utils\Tools;
use app\model\AdminUser;
use app\model\AdminUserData;

class Index extends Base {
    public function index() {
        return json(['welcome']);
    }

    public function upload() {
        $tools = new Tools();
        $data = $tools->upload();
        if ($data) {
            return $this->ok([
                'fileUrl'    => $data,
                'oldFileUrl' => Tools::getOldImg($data),
            ]);
        }
        return $this->json(0, '上传失败');
    }

    /**
     * Func: 公共首页提供数据
     * User: doushiwen
     * Date: 2018/10/7
     */
    public function baseIndex() {
        //用户登录数据
        $adminUserData = new AdminUserData();
        $where = [];
        $where['uid'] = $this->admin_id;
        $userLogin = $adminUserData->getInfo($where);

        //用户信息
        $adminUser = new AdminUser();
        $where = [];
        $where['id'] = $this->admin_id;
        $userInfo = $adminUser->getInfo($where);

        return $this->ok([
            'userLogin' => $userLogin,
            'userInfo'  => $userInfo,
        ]);
    }
}
