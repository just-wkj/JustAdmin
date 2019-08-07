<?php

namespace app\admin\controller;
use app\util\ReturnCode;
use think\Request;

class Miss extends Base {
    public function index() {
        if (Request::instance()->isOptions()) {
            return $this->ok([]);
        } else {
            return $this->json(ReturnCode::INVALID, '接口地址异常', []);
        }
    }
}
