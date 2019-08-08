<?php
/**
 * 登录登出
 * @since   2017-11-02
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace app\admin\controller;


use app\admin\service\CacheService;
use app\admin\service\TokenService;
use app\admin\validate\LoginValidate;
use app\lib\exception\AdminLoginException;
use app\lib\utils\Tools;
use app\model\AdminAuthGroupAccess;
use app\model\AdminAuthRule;
use app\model\AdminMenu;
use app\model\AdminUser;
use app\model\AdminUserData;

class Login extends Base {


    /**
     *  管理员登录处理
     * @throws AdminLoginException
     * @throws \app\lib\exception\ParameterException
     * @throws \app\lib\response\Success
     * @author: justwkj
     * @date: 2019-08-06 18:13
     */
    public function index() {
        $validate = new LoginValidate();
        $validate->goCheck();
        $data = $validate->getDataByRule();

        $username = $data['username'];
        $password = $data['password'];

        $password = Tools::userMd5($password);
        $userInfo = AdminUser::get(['username' => $username, 'password' => $password]);
        if (empty($userInfo)) {
            return $this->err('用户名密码不正确');
        }

        if (!($userInfo['status'])) {
            return $this->err('用户已被封禁，请联系管理员');
        }

        //更新用户数据
        $userData = AdminUserData::get(['uid' => $userInfo['id']]);
        $data = [];
        $return = [];
        $return['headImg'] = $userData['headImg'];
        if ($userData) {
            $userData->loginTimes++;
            $userData->lastLoginIp = $this->request->ip(1);
            $userData->lastLoginTime = time();
            $userData->save();
        } else {
            $data['loginTimes'] = 1;
            $data['uid'] = $userInfo['id'];
            $data['lastLoginIp'] = $this->request->ip(1);
            $data['lastLoginTime'] = time();
            AdminUserData::create($data);
        }
        $apiAuth = md5(uniqid() . time());
        TokenService::setLoginToken($apiAuth, $userInfo);

        $return['access'] = [];

        $isSupper = Tools::isAdministrator($userInfo['id']);
        if ($isSupper) {
            $access = AdminMenu::all(['hide' => 0]);
        } else {
            $groups = AdminAuthGroupAccess::get(['uid' => $userInfo['id']]);
            if (!isset($groups) || !$groups->groupId) {
                throw new AdminLoginException();
            }
            $access = (new AdminAuthRule())->whereIn('groupId', $groups->groupId)->select();
        }
        $access = $access->toArray();
        $return['access'] = array_values(array_filter(array_column($access, 'url')));

        $return['id'] = $userInfo['id'];
        $return['username'] = $userInfo['username'];
        $return['nickname'] = $userInfo['nickname'];
        $return['justToken'] = $apiAuth;

        return $this->ok($return);
    }


    /**
     * 退出登录
     * @throws \app\lib\response\Success
     * @author: justwkj
     * @date: 2019-08-07 17:27
     */
    public function logout() {
        TokenService::clearLoginToken();
        return $this->ok();
    }

}
