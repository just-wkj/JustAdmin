<?php
/**
 * @author: justwkj
 * @date: 2019-08-07 11:36
 * @email: justwkj@gmail.com
 * @desc:
 */

namespace app\admin\service;


use app\lib\exception\AccessTokenException;
use app\lib\exception\AuthTokenException;
use think\facade\Request;

class TokenService {

    public static function setLoginToken($token, $userInfo) {
        cache('User:token:' . $token, json_encode($userInfo), config('justAdmin.ONLINE_TIME'));
        cache('User:uid:' . $userInfo['id'], $token, config('justAdmin.ONLINE_TIME'));

        //cache('User:group:'.$userInfo[''])
    }

    public static function clearLoginToken(){
        $request = Request::instance();
        $token = $request->header('justToken');
        $userInfo = self::getUserInfo($token);
        cache('User:token:'.$token, null);
        cache('User:uid:'.$userInfo['id'], null);
    }

    public static function getUserInfo($token){
        if(strlen($token) != 32){
            throw new AuthTokenException();
        }
        $userInfo = cache('User:token:'.$token);
        if(!$userInfo){
            throw new AuthTokenException();
        }
        if(!is_array($userInfo)){
            $userInfo = json_decode($userInfo, true);
        }
        return $userInfo;
    }
}
