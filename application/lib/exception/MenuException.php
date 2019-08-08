<?php


namespace app\lib\exception;


use app\lib\enum\ErrorCode;

class MenuException extends BaseException {
    public $code = ErrorCode::DELETE_ERROR;
    public $msg = "菜单不存在!";
}
