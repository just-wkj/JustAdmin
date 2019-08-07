<?php


namespace app\lib\exception;



use app\lib\enum\ErrorCode;

class AuthTokenException extends BaseException {

    public $code = ErrorCode::AUTH_TOKEN_INVALID;
    public $msg = "授权token有误或者已失效!";
}
