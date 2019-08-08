<?php
/**
 * @author: justwkj
 * @date: 2019-08-08 14:24
 * @email: justwkj@gmail.com
 * @desc:
 */

namespace app\lib\exception;


use app\lib\enum\ErrorCode;

class DbInsertException extends BaseException {
    public $code = ErrorCode::DB_INSERT_ERROR;
    public $msg = "添加失败!";
}
