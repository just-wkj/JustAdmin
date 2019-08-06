<?php
/**
 * 工程基类
 * @since   2017/02/28 创建
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace app\admin\controller;
use app\util\ReturnCode;
use think\Controller;

class Base extends Controller {

    private $debug = [];
    protected $userInfo;
    protected $admin_id;
    protected $shop_id;

    public function _initialize() {
        $ApiAuth = $this->request->header('ApiAuth');
        if ($ApiAuth) {
            $userInfo = cache('Login:' . $ApiAuth);
            $this->userInfo = json_decode($userInfo, true);
            $this->admin_id = $this->userInfo['id'];
            $this->shop_id = $this->userInfo['shop_id'];
        }
    }

    public function buildSuccess($data=[], $msg = '操作成功', $code = ReturnCode::SUCCESS) {
        $return = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ];
        if ($this->debug) {
            $return['debug'] = $this->debug;
        }

        return json($return);

    }

    public function buildFailed($code, $msg, $data = []) {
        $return = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ];
        if ($this->debug) {
            $return['debug'] = $this->debug;
        }

        return json($return);
    }

    protected function debug($data) {
        if ($data) {
            $this->debug[] = $data;
        }
    }

}
