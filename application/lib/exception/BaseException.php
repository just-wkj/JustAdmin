<?php


namespace app\lib\exception;


use app\lib\enum\ReturnCode;
use think\Exception;

class BaseException extends Exception {
    public $code = ReturnCode::INVALID;
    public $msg = '参数有误!';


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
