<?php


namespace app\lib\exception;


use app\lib\enum\ErrorCode;
use think\Exception;

class BaseException extends Exception {
    public $code = ErrorCode::ERROR;
    public $msg = '参数有误!';


    public function __construct($params = []) {
        parent::__construct();
        if (!is_array($params)) {
            return;
        }
        if (array_key_exists('errCode', $params)) {
            $this->code = $params['errCode'];
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
    }
}
