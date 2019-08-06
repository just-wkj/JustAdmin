<?php
/**
 *
 * @since   2017-11-01
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace app\lib\utils;


use app\lib\enum\ErrorCode;
use app\lib\response\Failure;
use app\lib\response\Success;
use think\Image;

class Tools {

    public static function json($errCode, $msg = '操作成功', $data = []) {
        $throwData = [
            'errCode' => $errCode,
            'msg'     => $msg,
            'data'    => $data,
        ];
        if ($errCode == ErrorCode::SUCCESS) {
            throw new Success($throwData);
        } else {
            throw new Failure($throwData);
        }
    }


    public static function ok($data = [], $msg = '操作成功', $errCode = ErrorCode::SUCCESS) {
        self::json($errCode, $msg, $data);

    }

    public static function err($msg = '操作失败', $errCode = ErrorCode::ERROR, $data = []) {
        self::json($errCode, $msg, $data);
    }

    public static function getDate($timestamp) {
        $now = time();
        $diff = $now - $timestamp;
        if ($diff <= 60) {
            return $diff . '秒前';
        } elseif ($diff <= 3600) {
            return floor($diff / 60) . '分钟前';
        } elseif ($diff <= 86400) {
            return floor($diff / 3600) . '小时前';
        } elseif ($diff <= 2592000) {
            return floor($diff / 86400) . '天前';
        } else {
            return '一个月前';
        }
    }

    public static function getFBDate($timestamp) {
        $now = time();
        $diff = $now - $timestamp;
        if ($diff <= 60) {
            return '1分钟前';
        } elseif ($diff <= 3600) {
            return floor($diff / 60) . '分钟前';
        } elseif ($diff <= 3600 * 3) {
            return floor($diff / 3600) . '小时前';
        } else {
            return date('Y-m-d H:i:s', $timestamp);
        }
    }

    public static function userMd5($str, $auth_key = '') {
        if (!$auth_key) {
            $auth_key = config('justAdmin.AUTH_KEY');
        }

        return '' === $str ? '' : md5(sha1($str) . $auth_key);
    }

    //是否是超级管理员
    public static function isAdministrator($uid = '') {
        if (empty($uid) || !is_numeric($uid)) {
            return false;
        }

        $adminConf = config('justAdmin.USER_ADMINISTRATOR');
        if (!is_array($adminConf)) {
            $adminConf = explode(',', $adminConf);
        }
        if (!in_array($uid, $adminConf)) {
            return false;
        }
        return true;
    }

    public static function isNotEmptyString($str, $trim = true) {
        $str = $trim ? trim($str) : $str;
        return strlen($str) > 0;
    }
}
