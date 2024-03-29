<?php

namespace app\http\middleware;

use app\admin\service\TokenService;
use app\lib\enum\ErrorCode;
use app\lib\utils\Tools;
use app\model\AdminAuthGroup;
use app\model\AdminAuthGroupAccess;
use app\model\AdminAuthRule;
use think\Request;

class AccessPermission {

    private $justToken;
    private $route;

    public function handle($request, \Closure $next) {
        $this->route = $request->routeInfo();
        $routeOptions = $this->route['option'];

        //无需校验token
        if(array_key_exists('checkAccessPermission',$routeOptions) &&  empty($routeOptions['checkAccessPermission'])){
            return $next($request);
        }

        $this->justToken = $request->header('justToken');
        //查看token是否有效
        $userInfo = TokenService::getUserInfo($this->justToken);

        if (!$this->checkAuth($userInfo['id'], $this->route['route'])) {
            $data = ['code' => ErrorCode::ERROR, 'msg' => '非常抱歉，您没有权限这么做！', 'data' => []];

            return json($data, 200, $header);
        }


        return $next($request);
    }





    /**
     * 检测用户权限
     * @param $uid
     * @param $route
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    private function checkAuth($uid, $route) {
        $isSupper = Tools::isAdministrator($uid);
        if ($isSupper) {
            return true;
        }
        $rules = $this->getAuth($uid);
        return in_array($route, $rules);

    }

    /**
     * 根据用户ID获取全部权限节点
     * @param $uid
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    private function getAuth($uid) {
        $groups = AdminAuthGroupAccess::get(['uid' => $uid]);
        if (!isset($groups) || !$groups->groupId) {
            return [];
        }

        $openGroup = (new AdminAuthGroup())->whereIn('id', $groups->groupId)->where(['status' => 1])->select();
        if (!isset($openGroup)) {
            return [];
        }
        $openGroupArr = [];
        foreach ($openGroup as $group) {
            $openGroupArr[] = $group->id;
        }
        $allRules = (new AdminAuthRule())->whereIn('groupId', $openGroupArr)->select();
        if (!isset($allRules)) {
            return [];
        }
        $rules = [];
        foreach ($allRules as $rule) {
            $rules[] = $rule->url;
        }

        return array_unique($rules);
    }

}
