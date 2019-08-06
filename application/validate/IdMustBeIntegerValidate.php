<?php


namespace app\validate;


class IdMustBeIntegerValidate extends BaseValidate {
    protected $rule = [
        'id' => 'require|isPositiveInteger',
    ];

}
