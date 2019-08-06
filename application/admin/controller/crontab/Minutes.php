<?php
/**
 * 每分钟定时任务
 * @author     :wkj
 * @createTime :2018/11/20 14:45
 * @description:
 */
namespace app\admin\controller\crontab;
use app\model\PrevConsult;
use app\model\PrevExpert;
use app\model\PrevUser;
use app\service\PhoneSmsService;
use app\service\QcloudSmsService;
use think\Config;
use think\console\Command;
use think\console\Input;
use think\console\Output;

use app\model\Base;
use app\model\PrevConsultOrder;

class Minutes extends Command{
    protected function configure(){
        $this->setName('Minutes')->setDescription('计划任务 Minutes');
    }

    protected function execute(Input $input, Output $output){
        $output->writeln('Minutes Crontab job start >>>...');

        $this->refreshChatTime($output);
        $this->smsSend();

        $output->writeln('Minutes Crontab job end...');
    }

    //刷新聊天的状态
    private function refreshChatTime(){
        writeLog(date('Y-m-d H:i:s'), 'crontab');
        (new PrevConsultOrder())->where([
            'co_pay_status' => Base::PAY_STATUS_YES,
            'co_chat_end_time' => function($where){
                    $where->where('co_chat_end_time', '>', 0)->where('co_chat_end_time', '<=', time());
            },
            'co_use_status'=> ['in', [Base::CHAT_NOT_USE, Base::CHAT_IS_USING]]
        ])->update([
            'co_use_status' => Base::CHAT_USED
        ]);
    }

    private function smsSend() {
        //给专家发送短信
        $model = new PrevConsult();
        $return = $model->where([
            'c_createtime' => ['gt', time() - Config::get('chatSeconds')],
            'c_type' => PrevConsult::MESSAGE_FROM_CUSTOMER,
            'co_id' => ['gt', 0]
        ])->group('co_id, u_id')->select();
        foreach ($return as $key => $value) {
            if ($value->c_createtime > (time() - 60)) {
                $expert = (new PrevExpert())->getInfo(['e_id' => $value->e_id]);

                $sms = new PhoneSmsService();
                $sms->sendSms($value->e_id, $expert->e_phone, QcloudSmsService::SMS_EXPERT_CONSULT_ATTENTION, [$expert->e_name], 2, $value->co_id);
                $sms->sendSms($value->e_id, '18913900130', QcloudSmsService::SMS_EXPERT_CONSULT_ATTENTION, [$expert->e_phone . $expert->e_name], 2, $value->co_id);
            }
        }

        //给用户发送短信
        $model = new PrevConsult();
        $return = $model->where([
            'c_createtime' => ['gt', time() - Config::get('chatSeconds')],
            'c_type' => PrevConsult::MESSAGE_FROM_EXPERT,
            'co_id' => ['gt', 0]
        ])->group('co_id, u_id')->select();
        foreach ($return as $key => $value) {
            if ($value->c_createtime > (time() - 60)) {
                $user = (new PrevUser())->getInfo(['u_id' => $value->u_id]);

                $sms = new PhoneSmsService();
                $sms->sendSms($value->u_id, $user->u_phone, QcloudSmsService::SMS_USER_CONSULT_ATTENTION, ['用户'], 1, $value->co_id);
                $sms->sendSms($value->u_id, '18913900130', QcloudSmsService::SMS_USER_CONSULT_ATTENTION, ['用户'], 1, $value->co_id);
            }
        }
    }
}
