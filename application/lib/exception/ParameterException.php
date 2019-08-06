<?php


namespace app\lib\exception;



use app\lib\enum\ErrorCode;

class ParameterException extends BaseException {

    public $code = ErrorCode::PARAM_INVALID;
    public $msg = "参数异常!";
}
