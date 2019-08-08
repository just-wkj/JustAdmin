<?php

namespace app\admin\controller;


use app\lib\exception\MenuDenyDeleteException;
use app\model\AdminMenu;
use app\validate\IdMustBeIntegerValidate;

class Menu extends Base {


    /**
     * 菜单列表
     * @throws \app\lib\response\Success
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author: justwkj
     * @date: 2019-08-08 11:06
     */
    public function index() {
        $list = (new AdminMenu)->order('sort', 'ASC')->select();
        $list = formatTree(listToTree($list->toArray()));

        return $this->ok([
            'data' => $list,
        ]);
    }


    /**
     * 新增菜单
     * @throws \app\lib\response\Success
     * @author: justwkj
     * @date: 2019-08-08 14:22
     */
    public function add() {
        $postData = $this->request->post();
        if ($postData['url']) {
            $postData['url'] = 'admin/' . $postData['url'];
        }
        $res = AdminMenu::create($postData);
        if ($res === false) {
            $this->err();
        }
        return $this->ok();
    }


    /**
     * 修改状态
     * @throws \app\lib\response\Success
     * @author: justwkj
     * @date: 2019-08-08 14:21
     */
    public function changeStatus() {
        $id = $this->request->get('id');
        $status = $this->request->get('status');
        $res = AdminMenu::update([
            'id'   => $id,
            'hide' => $status,
        ]);
        if ($res === false) {
            $this->err();
        }
        return $this->ok();
    }


    /**
     * 菜单编辑
     * @throws \app\lib\response\Success
     * @author: justwkj
     * @date: 2019-08-08 14:21
     */
    public function edit() {
        $postData = $this->request->post();
        if ($postData['url']) {
            $postData['url'] = 'admin/' . $postData['url'];
        }
        $res = AdminMenu::update($postData);
        if ($res === false) {
            $this->err();
        }
        return $this->ok();
    }


    /**
     * 菜单删除
     * @throws MenuDenyDeleteException
     * @throws \app\lib\exception\ParameterException
     * @throws \app\lib\response\Success
     * @author: justwkj
     * @date: 2019-08-08 14:21
     */
    public function del() {
        $validate = new IdMustBeIntegerValidate();
        $validate->goCheck();
        $data = $validate->getDataByRule();
        $id = $data['id'];

        $childNum = AdminMenu::where(['fid' => $id])->count();
        if ($childNum) {
            throw new MenuDenyDeleteException();
        }
        AdminMenu::destroy($id);
        return $this->ok([]);
    }

}
