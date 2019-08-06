<?php
/**
 * 登录登出
 * @since   2017-11-02
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace app\admin\controller;


use app\admin\validate\LoginValidate;
use app\lib\enum\ReturnCode;
use app\lib\utils\Tools;
use app\model\AdminAuthGroupAccess;
use app\model\AdminAuthRule;
use app\model\AdminMenu;
use app\model\AdminUser;
use app\model\AdminUserData;

class Login extends Base {

    /**
     * 用户登录
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\DbException
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    public function index() {
        $validate = new LoginValidate();
        $validate->goCheck();
        $data = $validate->getDataByRule();

        $username = $data['username'];
        $password = $data['password'];

        $password = Tools::userMd5($password);
        $userInfo = AdminUser::get(['username' => $username, 'password' => $password]);
        if (!empty($userInfo)) {
            if ($userInfo['status']) {
                //更新用户数据
                $userData = AdminUserData::get(['uid' => $userInfo['id']]);
                $data = [];
                if ($userData) {
                    $userData->loginTimes ++;
                    $userData->lastLoginIp = $this->request->ip(1);
                    $userData->lastLoginTime = time();
                    $return['headImg'] = $userData['headImg'];
                    $userData->save();
                } else {
                    $data['loginTimes'] = 1;
                    $data['uid'] = $userInfo['id'];
                    $data['lastLoginIp'] = $this->request->ip(1);
                    $data['lastLoginTime'] = time();
                    $data['headImg'] = '';
                    $return['headImg'] = '';
                    AdminUserData::create($data);
                }
            } else {
                return $this->err( '用户已被封禁，请联系管理员');
            }
        } else {
            return $this->err('用户名密码不正确');
        }
        $apiAuth = md5(uniqid() . time());
        cache('Login:' . $apiAuth, json_encode($userInfo), config('justAdmin.ONLINE_TIME'));
        cache('Login:' . $userInfo['id'], $apiAuth, config('justAdmin.ONLINE_TIME'));

        $return['access'] = [];
        $isSupper = Tools::isAdministrator($userInfo['id']);
        if ($isSupper) {
            $access = AdminMenu::all(['hide' => 0]);
            $access = Tools::buildArrFromObj($access);
            $return['access'] = array_values(array_filter(array_column($access, 'url')));
        } else {
            $groups = AdminAuthGroupAccess::get(['uid' => $userInfo['id']]);
            if (isset($groups) || $groups->groupId) {
                $access = (new AdminAuthRule())->whereIn('groupId', $groups->groupId)->select();
                $access = Tools::buildArrFromObj($access);
                $return['access'] = array_values(array_unique(array_column($access, 'url')));
            }
        }

        $return['id'] = $userInfo['id'];
        $return['username'] = $userInfo['username'];
        $return['nickname'] = $userInfo['nickname'];
        $return['apiAuth'] = $apiAuth;

        return $this->ok($return);
    }

    public function logout() {
        $ApiAuth = $this->request->header('ApiAuth');
        cache('Login:' . $ApiAuth, null);
        cache('Login:' . $this->userInfo['id'], null);

        return $this->buildSuccess([], '登出成功');
    }

}
