<?php
/**
 * @author: justwkj
 * @date: 2019-08-08 14:24
 * @email: justwkj@gmail.com
 * @desc:
 */

namespace app\lib\exception;


use app\lib\enum\ErrorCode;

class DbUpdateException extends BaseException {
    public $code = ErrorCode::DB_UPDATE_ERROR;
    public $msg = "修改失败!";
}
