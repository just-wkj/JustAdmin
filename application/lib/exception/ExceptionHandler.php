<?php


namespace app\lib\exception;


use app\lib\enum\ErrorCode;
use Exception;
use think\exception\Handle;

class ExceptionHandler extends Handle {
    private $code;
    private $msg;
    private $data;

    public function render(Exception $e) {
        if ($e instanceof BaseException) {
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->data = $e->data;
        } else {
            //服务器异常,需要做下日志
            if (config('app_debug')) {
                return parent::render($e);
            }
            $this->code = ErrorCode::SERVER_ERROR;
            $this->msg = '服务器异常!';
            $this->data = [];

            //记录异常日志
            $this->recordErrorLog($e);
        }

        $result = [
            'errCode' => $this->code,
            'msg'     => $this->msg,
            'data'    => $this->data,
        ];
        return json($result);
    }

    /*
     * 将异常写入日志
     */
    private function recordErrorLog(Exception $e) {

    }
}
