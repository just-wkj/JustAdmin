<?php


namespace app\lib\exception;



use app\lib\enum\ReturnCode;

class ParameterException extends BaseException {

    public $code = ReturnCode::PARAM_INVALID;
    public $msg = "参数异常!";
}
