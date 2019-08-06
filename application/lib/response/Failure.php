<?php
/**
 * @author: justwkj
 * @date: 2019-08-06 16:29
 * @email: justwkj@gmail.com
 * @desc:
 */

namespace app\lib\response;


use app\lib\enum\ErrorCode;
use app\lib\exception\BaseException;

class Failure extends BaseException {
    public $code = ErrorCode::ERROR;
    public $msg = "操作失败,请稍后再试";
}
