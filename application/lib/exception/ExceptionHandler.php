<?php


namespace app\lib\exception;


use app\lib\enum\ReturnCode;
use Exception;
use think\exception\Handle;
use think\Log;

class ExceptionHandler extends Handle {
    private $code;
    private $msg;

    public function render(Exception $e) {
        if ($e instanceof BaseException) {

            $this->code = $e->code;
            $this->msg = $e->msg;
        } else {
            //服务器异常,需要做下日志
            if (config('app_debug')) {
                return parent::render($e);
            }
            $this->code = ReturnCode::SERVER_ERROR;
            $this->msg = $e->msg ?: '服务器异常!';
            $this->recordErrorLog($e);
        }


        $result = [
            'code'        => $this->code,
            'msg'         => $this->msg,
            'data'        => [],
        ];
        return  json($result);
    }

    /*
     * 将异常写入日志
     */
    private function recordErrorLog(Exception $e) {
        Log::init([
            'type'  => 'File',
            'path'  => LOG_PATH,
            'level' => ['error'],
        ]);
        Log::record($e->getMessage(), 'error');
    }
}
