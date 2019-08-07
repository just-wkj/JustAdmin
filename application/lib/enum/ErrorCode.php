<?php


namespace app\lib\enum;


class ErrorCode {
    const SUCCESS = 0;//通用成功
    const ERROR = 1000;//通用错误
    CONST DATA_NOT_EXISTS = 1001;//数据不存在
    CONST DB_SAVE_ERROR = 1002;//数据库保存失败
    CONST PARAM_INVALID = 1003;//参数无效

    CONST ACCESS_TOKEN_INVALID = 1004;//访问token有误
    CONST AUTH_TOKEN_INVALID = 1005;//授权token有误

    CONST ADMIN_LOGIN_ERROR = 2000;//管理员登录失败

    CONST PERMISSION_DENY = 4000;//无权操作
    CONST SERVER_ERROR = 5000;//服务器错误
    CONST THIRD_ERROR = 5001;//第三方服务异常


    static public function getConstants() {
        $oClass = new \ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
}
