<?php


namespace app\lib\exception;


use app\lib\enum\ReturnCode;
use think\Exception;

class BaseException extends Exception {
    public $code = ReturnCode::INVALID;
    public $msg = '参数有误!';

    /**
     * 构造函数，接收一个关联数组
     * @param array $params 关联数组只应包含code, msg，且不应该是空值
     */
    public function __construct($params = []) {
        parent::__construct();
        if (!is_array($params)) {
            return;
        }
        if (array_key_exists('code', $params)) {
            $this->code = $params['code'];
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
    }
}
