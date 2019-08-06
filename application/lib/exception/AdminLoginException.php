<?php


namespace app\lib\exception;


use app\lib\enum\ErrorCode;

class AdminLoginException extends BaseException {
    public $code = ErrorCode::ADMIN_LOGIN_ERROR;
    public $msg = "管理员登录异常!";
}
