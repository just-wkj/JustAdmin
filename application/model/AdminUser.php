<?php
/**
 * @since   2017-11-02
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace app\model;


class AdminUser extends Base {
    protected $table = 'admin_user';

    public function getInfo($where){
        return $this->where($where)->find();
    }
}
