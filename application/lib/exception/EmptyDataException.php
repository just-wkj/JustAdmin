<?php


namespace app\lib\exception;




use app\lib\enum\ReturnCode;

class EmptyDataException extends  BaseException {
    public $code = ReturnCode::NOT_EXISTS;
    public $msg = "请求的数据不存在!";
}
