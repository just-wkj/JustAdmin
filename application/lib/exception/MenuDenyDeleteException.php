<?php


namespace app\lib\exception;


use app\lib\enum\ErrorCode;

class MenuDenyDeleteException extends BaseException {
    public $code = ErrorCode::DELETE_ERROR;
    public $msg = "当前菜单存在子菜单,不可以被删除!";
}
