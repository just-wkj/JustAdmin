<?php

namespace app\http\middleware;

use app\lib\exception\AuthTokenException;
use app\lib\exception\ParameterException;
use app\model\AdminAuthGroup;
use app\model\AdminAuthGroupAccess;
use app\model\AdminAuthRule;
use think\Request;
use think\Route;

class AccessRule {
    public function handle($request, \Closure $next) {


       //$autoToken = $request->header('authToken');
       //if(empty($autoToken)){
       //    throw new AuthTokenException();
       //}
        return $next($request);
    }




}
