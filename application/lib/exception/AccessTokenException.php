<?php


namespace app\lib\exception;



use app\lib\enum\ErrorCode;

class AccessTokenException extends BaseException {

    public $code = ErrorCode::ACCESS_TOKEN_INVALID;
    public $msg = "访问token有误!";
}
