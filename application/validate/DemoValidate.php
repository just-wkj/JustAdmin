<?php


namespace app\validate;


class DemoValidate {
    protected $rule = [
        'advert_img|图片'       => 'require|url',
        'advert_start_time'   => 'require|date',
        'advert_end_time'     => 'require|date|timeRange:activity_start_time',
        'advert_jump_id|跳转id' => 'require|number|typeSelect',
    ];

    protected $message = [
        'advert_end_time.timeRange' => '结束时间必须大于开始时间',
        'advert_end_time.require'   => '活动结束时间必填',
    ];


    /**
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool|string
     * @author: justwkj
     * @date: 2019-08-06 11:34
     */
    protected function typeSelect($value, $rule = '', $data = '', $field = '') {
        if ($value > 0) {
            //必须能选择类型和跳转类型
            if (empty($data['advert_type'])) {
                return '请选择展示类型!';
            }
            if (empty($data['advert_jump_type'])) {
                return '请选择跳转类型!';
            }

        }
        return true;
    }
}
