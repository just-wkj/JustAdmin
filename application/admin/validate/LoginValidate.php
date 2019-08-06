<?php
/**
 * @author: justwkj
 * @date: 2019-08-06 16:52
 * @email: justwkj@gmail.com
 * @desc:
 */

namespace app\admin\validate;


use app\validate\BaseValidate;

class LoginValidate extends BaseValidate {
    protected $rule = [
        'username|用户名' => 'require|isNotEmptyString',
        'password|密码'  => 'require|isNotEmptyString',
    ];

    protected $message = [
        'username.isNotEmptyString' => '用户名不能为空',
        'password.isNotEmptyString' => '密码不能为空',
    ];

}
