<?php
/**
 * @since   2017-11-02
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace app\model;


class AdminUserData extends Base {
    protected $table = 'admin_user_data';
    protected $append = ['lastLoginTime_trans', 'lastLoginIp_trans'];

    public function getInfo($where){
        return $this->where($where)->find();
    }

    //时间
    public function getLastLoginTimeTransAttr($value, $data) {
        $time = intval($data['lastLoginTime']);
        return date('Y-m-d H:i:s', $time);
    }

    //ip
    public function getlastLoginIpTransAttr($value, $data) {
        return long2ip($data['lastLoginIp']);
    }
}
