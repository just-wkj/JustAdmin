<?php
/**
 * 目录管理
 * @since   2018-01-16
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace app\admin\controller;


use app\lib\utils\Tools;
use app\model\AdminMenu;

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
            'data' => $list
        ]);
    }

    /**
     * 新增菜单
     * @return array
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    public function add() {
        $postData = $this->request->post();
        if ($postData['url']) {
            $postData['url'] = 'admin/' . $postData['url'];
        }
        $res = AdminMenu::create($postData);
        if ($res === false) {
            return $this->json(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            return $this->ok([]);
        }
    }

    /**
     * 菜单状态编辑
     * @return array
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    public function changeStatus() {
        $id = $this->request->get('id');
        $status = $this->request->get('status');
        $res = AdminMenu::update([
            'id'   => $id,
            'hide' => $status
        ]);
        if ($res === false) {
            return $this->json(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            return $this->ok([]);
        }
    }

    /**
     * 编辑菜单
     * @return array
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    public function edit() {
        $postData = $this->request->post();
        if ($postData['url']) {
            $postData['url'] = 'admin/' . $postData['url'];
        }
        $res = AdminMenu::update($postData);
        if ($res === false) {
            return $this->json(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            return $this->ok([]);
        }
    }

    /**
     * 删除菜单
     * @return array
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    public function del() {
        $id = $this->request->get('id');
        if (!$id) {
            return $this->json(ReturnCode::EMPTY_PARAMS, '缺少必要参数');
        }
        $childNum = AdminMenu::where(['fid' => $id])->count();
        if ($childNum) {
            return $this->json(ReturnCode::INVALID, '当前菜单存在子菜单,不可以被删除!');
        } else {
            AdminMenu::destroy($id);

            return $this->ok([]);
        }
    }

}
