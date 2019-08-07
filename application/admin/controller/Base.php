<?php
/**
 * 工程基类
 * @since   2017/02/28 创建
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace app\admin\controller;

use app\admin\service\TokenService;
use app\lib\enum\ErrorCode;
use app\lib\utils\Tools;
use think\Controller;

class Base extends Controller {

    protected $userInfo;
    protected $admin_id;

    public function initialize() {
        $justToken = $this->request->header('justToken');
        if ($justToken) {
            $userInfo = TokenService::getUserInfo($justToken);
            $this->userInfo =$userInfo;
            $this->admin_id = $this->userInfo['id'];
        }
    }

    /**
     * 返回处理
     * @param $errCode 错误码
     * @param string $msg 提示信息
     * @param array $data 返回数据
     * @throws \app\lib\response\Success
     * @author: justwkj
     * @date: 2019-08-06 16:45
     */
    protected function json($errCode, $msg = '操作成功', $data = []) {
        Tools::json($errCode, $msg, $data);
    }

    /**
     *  成功快捷返回
     * @param array $data 成功数据
     * @param string $msg 成功提示语
     * @param int $errCode 错误码
     * @throws \app\lib\response\Success
     * @author: justwkj
     * @date: 2019-08-06 16:46
     */
    protected function ok($data = [], $msg = '操作成功', $errCode = ErrorCode::SUCCESS) {
        Tools::json($errCode, $msg, $data);
    }

    /**
     * 错误快捷返回
     * @param string $msg 错误信息
     * @param int $errCode 错误码
     * @param array $data 返回信息
     * @throws \app\lib\response\Success
     * @author: justwkj
     * @date: 2019-08-06 16:46
     */
    protected function err($msg = '操作失败', $errCode = ErrorCode::ERROR, $data = []) {
        Tools::json($errCode, $msg, $data);
    }
}
