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


        $output->writeln('Minutes Crontab job end...');
    }

}
