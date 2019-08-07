<?php
/**
 * @author: justwkj
 * @date: 2019-08-06 15:48
 * @email: justwkj@gmail.com
 * @desc:
 */


use think\facade\Route;

$afterBehavior = [
    '\app\admin\behavior\ApiAuth',
    '\app\admin\behavior\ApiPermission',
    '\app\admin\behavior\AdminLog'
];
//Route::group('admin/', function(){
//    Route::rule('Login/index12', 'admin/Login/index', 'POST', ['after_behavior' => ['\app\admin\behavior\ApiAuth', '\app\admin\behavior\AdminLog'], 'middleware' =>false]) ;
//    Route::rule('Login/logout', 'admin/Login/logout', 'GET', ['after_behavior' => ['\app\admin\behavior\ApiAuth', '\app\admin\behavior\AdminLog']]) ;
//});

return [
    '[admin]' => [
        'Login/index'                 => [
            'admin/Login/index',
            ['method' => 'post', 'checkAccessPermission' => false]
        ],
        'Index/upload'                => [
            'admin/Index/upload',
            ['method' => 'post']
        ],
        'Index/baseIndex'             => [
            'admin/Index/baseIndex',
            ['method' => 'get']
        ],
        'Login/logout'                => [
            'admin/Login/logout',
            ['method' => 'get']
        ],
        'Menu/index'                  => [
            'admin/Menu/index',
            ['method' => 'get']
        ],
        'Menu/changeStatus'           => [
            'admin/Menu/changeStatus',
            ['method' => 'get']
        ],
        'Menu/add'                    => [
            'admin/Menu/add',
            ['method' => 'post']
        ],
        'Menu/edit'                   => [
            'admin/Menu/edit',
            ['method' => 'post']
        ],
        'Menu/del'                    => [
            'admin/Menu/del',
            ['method' => 'get']
        ],
        'User/index'                  => [
            'admin/User/index',
            ['method' => 'get']
        ],
        'User/getUsers'               => [
            'admin/User/getUsers',
            ['method' => 'get']
        ],
        'User/changeStatus'           => [
            'admin/User/changeStatus',
            ['method' => 'get']
        ],
        'User/add'                    => [
            'admin/User/add',
            ['method' => 'post']
        ],
        'User/own'                    => [
            'admin/User/own',
            ['method' => 'post']
        ],
        'User/edit'                   => [
            'admin/User/edit',
            ['method' => 'post']
        ],
        'User/del'                    => [
            'admin/User/del',
            ['method' => 'get']
        ],
        'Auth/index'                  => [
            'admin/Auth/index',
            ['method' => 'get']
        ],
        'Auth/changeStatus'           => [
            'admin/Auth/changeStatus',
            ['method' => 'get']
        ],
        'Auth/delMember'              => [
            'admin/Auth/delMember',
            ['method' => 'get']
        ],
        'Auth/add'                    => [
            'admin/Auth/add',
            ['method' => 'post']
        ],
        'Auth/edit'                   => [
            'admin/Auth/edit',
            ['method' => 'post']
        ],
        'Auth/del'                    => [
            'admin/Auth/del',
            ['method' => 'get']
        ],
        'Auth/getGroups'              => [
            'admin/Auth/getGroups',
            ['method' => 'get']
        ],
        'Auth/getRuleList'            => [
            'admin/Auth/getRuleList',
            ['method' => 'get']
        ],
        'App/index'                   => [
            'admin/App/index',
            ['method' => 'get']
        ],
        'App/changeStatus'            => [
            'admin/App/changeStatus',
            ['method' => 'get']
        ],
        'App/getAppInfo'              => [
            'admin/App/getAppInfo',
            ['method' => 'get']
        ],
        'App/add'                     => [
            'admin/App/add',
            ['method' => 'post']
        ],
        'App/edit'                    => [
            'admin/App/edit',
            ['method' => 'post']
        ],
        'App/del'                     => [
            'admin/App/del',
            ['method' => 'get']
        ],
        'InterfaceList/index'         => [
            'admin/InterfaceList/index',
            ['method' => 'get']
        ],
        'InterfaceList/refresh'       => [
            'admin/InterfaceList/refresh',
            ['method' => 'get']
        ],
        'InterfaceList/changeStatus'  => [
            'admin/InterfaceList/changeStatus',
            ['method' => 'get']
        ],
        'InterfaceList/getHash'       => [
            'admin/InterfaceList/getHash',
            ['method' => 'get']
        ],
        'InterfaceList/add'           => [
            'admin/InterfaceList/add',
            ['method' => 'post']
        ],
        'InterfaceList/edit'          => [
            'admin/InterfaceList/edit',
            ['method' => 'post']
        ],
        'InterfaceList/del'           => [
            'admin/InterfaceList/del',
            ['method' => 'get']
        ],
        'Fields/index'                => [
            'admin/Fields/index',
            ['method' => 'get']
        ],
        'Fields/request'              => [
            'admin/Fields/request',
            ['method' => 'get']
        ],
        'Fields/response'             => [
            'admin/Fields/response',
            ['method' => 'get']
        ],
        'Fields/add'                  => [
            'admin/Fields/add',
            ['method' => 'post']
        ],
        'Fields/upload'               => [
            'admin/Fields/upload',
            ['method' => 'post']
        ],
        'Fields/edit'                 => [
            'admin/Fields/edit',
            ['method' => 'post']
        ],
        'Fields/del'                  => [
            'admin/Fields/del',
            ['method' => 'get']
        ],
        'InterfaceGroup/index'        => [
            'admin/InterfaceGroup/index',
            ['method' => 'get']
        ],
        'InterfaceGroup/add'          => [
            'admin/InterfaceGroup/add',
            ['method' => 'post']
        ],
        'InterfaceGroup/edit'         => [
            'admin/InterfaceGroup/edit',
            ['method' => 'post']
        ],
        'InterfaceGroup/del'          => [
            'admin/InterfaceGroup/del',
            ['method' => 'get']
        ],
        'InterfaceGroup/getAll'       => [
            'admin/InterfaceGroup/getAll',
            ['method' => 'get']
        ],
        'InterfaceGroup/changeStatus' => [
            'admin/InterfaceGroup/changeStatus',
            ['method' => 'get']
        ],
        'AppGroup/index'              => [
            'admin/AppGroup/index',
            ['method' => 'get']
        ],
        'AppGroup/add'                => [
            'admin/AppGroup/add',
            ['method' => 'post']
        ],
        'AppGroup/edit'               => [
            'admin/AppGroup/edit',
            ['method' => 'post']
        ],
        'AppGroup/del'                => [
            'admin/AppGroup/del',
            ['method' => 'get']
        ],
        'AppGroup/getAll'             => [
            'admin/AppGroup/getAll',
            ['method' => 'get']
        ],
        'AppGroup/changeStatus'       => [
            'admin/AppGroup/changeStatus',
            ['method' => 'get']
        ],
        'Log/index'                   => [
            'admin/Log/index',
            ['method' => 'get']
        ],
        'Log/del'                     => [
            'admin/Log/del',
            ['method' => 'get']
        ],
        'Customer/getList'            => [
            'admin/Customer/getList',
            ['method' => 'get']
        ],
        'Customer/add'                => [
            'admin/Customer/add',
            ['method' => 'post']
        ],
        'Customer/edit'               => [
            'admin/Customer/edit',
            ['method' => 'post']
        ],
        'Customer/del'                => [
            'admin/Customer/del',
            ['method' => 'get']
        ],
        'NewsType/getList'            => [
            'admin/NewsType/getList',
            ['method' => 'get']
        ],
        'NewsType/add'                => [
            'admin/NewsType/add',
            ['method' => 'post']
        ],
        'NewsType/edit'               => [
            'admin/NewsType/edit',
            ['method' => 'post']
        ],
        'NewsType/del'                => [
            'admin/NewsType/del',
            ['method' => 'get']
        ],
        'News/getList'                => [
            'admin/News/getList',
            ['method' => 'get']
        ],
        'News/add'                    => [
            'admin/News/add',
            ['method' => 'post']
        ],
        'News/edit'                   => [
            'admin/News/edit',
            ['method' => 'post']
        ],
        'News/del'                    => [
            'admin/News/del',
            ['method' => 'get']
        ],
        'Advert/getList'              => [
            'admin/Advert/getList',
            ['method' => 'get']
        ],
        'Advert/add'                  => [
            'admin/Advert/add',
            ['method' => 'post']
        ],
        'Advert/edit'                 => [
            'admin/Advert/edit',
            ['method' => 'post']
        ],
        'Advert/del'                  => [
            'admin/Advert/del',
            ['method' => 'get']
        ],
        'Advert/getAdvertType'        => [
            'admin/Advert/getAdvertType',
            ['method' => 'get']
        ],
        'File/getList'                => [
            'admin/File/getList',
            ['method' => 'get']
        ],
        'File/add'                    => [
            'admin/File/add',
            ['method' => 'post']
        ],
        'File/edit'                   => [
            'admin/File/edit',
            ['method' => 'post']
        ],
        'File/del'                    => [
            'admin/File/del',
            ['method' => 'get']
        ],
        'PhoneSms/getList'            => [
            'admin/PhoneSms/getList',
            ['method' => 'get']
        ],
        'Feedback/edit'               => [
            'admin/Feedback/edit',
            ['method' => 'post']
        ],
        'Feedback/getList'            => [
            'admin/Feedback/getList',
            ['method' => 'get']
        ],
        'Feedback/del'                => [
            'admin/Feedback/del',
            ['method' => 'get']
        ],
        'FemaleRights/edit'           => [
            'admin/FemaleRights/edit',
            ['method' => 'post']
        ],
        'FemaleRights/getList'        => [
            'admin/FemaleRights/getList',
            ['method' => 'get']
        ],
        'FemaleRights/getTypeList'    => [
            'admin/FemaleRights/getTypeList',
            ['method' => 'get']
        ],
        'FemaleRights/del'            => [
            'admin/FemaleRights/del',
            ['method' => 'get']
        ],
        'FemaleAppointment/edit'      => [
            'admin/FemaleAppointment/edit',
            ['method' => 'post']
        ],
        'FemaleAppointment/getList'   => [
            'admin/FemaleAppointment/getList',
            ['method' => 'get']
        ],
        'FemaleAppointment/del'       => [
            'admin/FemaleAppointment/del',
            ['method' => 'get']
        ],
        'Activity/add'                => [
            'admin/Activity/add',
            ['method' => 'post']
        ],
        'Activity/edit'               => [
            'admin/Activity/edit',
            ['method' => 'post']
        ],
        'Activity/getList'            => [
            'admin/Activity/getList',
            ['method' => 'get']
        ],
        'Activity/del'                => [
            'admin/Activity/del',
            ['method' => 'get']
        ],
        'ActivityJoin/add'            => [
            'admin/ActivityJoin/add',
            ['method' => 'post']
        ],
        'ActivityJoin/edit'           => [
            'admin/ActivityJoin/edit',
            ['method' => 'post']
        ],
        'ActivityJoin/getList'        => [
            'admin/ActivityJoin/getList',
            ['method' => 'get']
        ],
        'ActivityJoin/del'            => [
            'admin/ActivityJoin/del',
            ['method' => 'get']
        ],
        'JobGuide/add'                => [
            'admin/JobGuide/add',
            ['method' => 'post']
        ],
        'JobGuide/edit'               => [
            'admin/JobGuide/edit',
            ['method' => 'post']
        ],
        'JobGuide/getList'            => [
            'admin/JobGuide/getList',
            ['method' => 'get']
        ],
        'JobGuide/del'                => [
            'admin/JobGuide/del',
            ['method' => 'get']
        ],
        'Train/add'                   => [
            'admin/Train/add',
            ['method' => 'post']
        ],
        'Train/edit'                  => [
            'admin/Train/edit',
            ['method' => 'post']
        ],
        'Train/getList'               => [
            'admin/Train/getList',
            ['method' => 'get']
        ],
        'Train/del'                   => [
            'admin/Train/del',
            ['method' => 'get']
        ],
        'TrainUser/add'               => [
            'admin/TrainUser/add',
            ['method' => 'post']
        ],
        'TrainUser/edit'              => [
            'admin/TrainUser/edit',
            ['method' => 'post']
        ],
        'TrainUser/getList'           => [
            'admin/TrainUser/getList',
            ['method' => 'get']
        ],
        'TrainUser/del'               => [
            'admin/TrainUser/del',
            ['method' => 'get']
        ],
        'MarryMeditation/add'         => [
            'admin/MarryMeditation/add',
            ['method' => 'post']
        ],
        'MarryMeditation/edit'        => [
            'admin/MarryMeditation/edit',
            ['method' => 'post']
        ],
        'MarryMeditation/getList'     => [
            'admin/MarryMeditation/getList',
            ['method' => 'get']
        ],
        'MarryMeditation/del'         => [
            'admin/MarryMeditation/del',
            ['method' => 'get']
        ],
        'Conf/index'                  => [
            'admin/Conf/index',
            ['method' => 'get']
        ],
        '__miss__'                    => ['admin/Miss/index'],
    ],
];
