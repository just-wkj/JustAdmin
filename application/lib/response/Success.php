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

class Success extends BaseException {
    public $code = ErrorCode::SUCCESS;
    public $msg = "操作成功";

}
