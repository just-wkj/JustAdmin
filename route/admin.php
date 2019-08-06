<?php
/**
 * @author: justwkj
 * @date: 2019-08-06 15:48
 * @email: justwkj@gmail.com
 * @desc:
 */


$afterBehavior = [
    '\app\admin\behavior\ApiAuth',
    '\app\admin\behavior\ApiPermission',
    '\app\admin\behavior\AdminLog'
];

return [
    '[admin]' => [
        'Login/index'                 => [
            'admin/Login/index',
            ['method' => 'post']
        ],
        'Index/upload'                => [
            'admin/Index/upload',
            ['method' => 'post', 'after_behavior' => ['\app\admin\behavior\ApiAuth', '\app\admin\behavior\AdminLog']]
        ],
        'Index/baseIndex'             => [
            'admin/Index/baseIndex',
            ['method' => 'get']
        ],
        'Login/logout'                => [
            'admin/Login/logout',
            ['method' => 'get', 'after_behavior' => ['\app\admin\behavior\ApiAuth', '\app\admin\behavior\AdminLog']]
        ],
        'Menu/index'                  => [
            'admin/Menu/index',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Menu/changeStatus'           => [
            'admin/Menu/changeStatus',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Menu/add'                    => [
            'admin/Menu/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Menu/edit'                   => [
            'admin/Menu/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Menu/del'                    => [
            'admin/Menu/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'User/index'                  => [
            'admin/User/index',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'User/getUsers'               => [
            'admin/User/getUsers',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'User/changeStatus'           => [
            'admin/User/changeStatus',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'User/add'                    => [
            'admin/User/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'User/own'                    => [
            'admin/User/own',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'User/edit'                   => [
            'admin/User/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'User/del'                    => [
            'admin/User/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Auth/index'                  => [
            'admin/Auth/index',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Auth/changeStatus'           => [
            'admin/Auth/changeStatus',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Auth/delMember'              => [
            'admin/Auth/delMember',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Auth/add'                    => [
            'admin/Auth/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Auth/edit'                   => [
            'admin/Auth/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Auth/del'                    => [
            'admin/Auth/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Auth/getGroups'              => [
            'admin/Auth/getGroups',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Auth/getRuleList'            => [
            'admin/Auth/getRuleList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'App/index'                   => [
            'admin/App/index',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'App/changeStatus'            => [
            'admin/App/changeStatus',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'App/getAppInfo'              => [
            'admin/App/getAppInfo',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'App/add'                     => [
            'admin/App/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'App/edit'                    => [
            'admin/App/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'App/del'                     => [
            'admin/App/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceList/index'         => [
            'admin/InterfaceList/index',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceList/refresh'       => [
            'admin/InterfaceList/refresh',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceList/changeStatus'  => [
            'admin/InterfaceList/changeStatus',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceList/getHash'       => [
            'admin/InterfaceList/getHash',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceList/add'           => [
            'admin/InterfaceList/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceList/edit'          => [
            'admin/InterfaceList/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceList/del'           => [
            'admin/InterfaceList/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Fields/index'                => [
            'admin/Fields/index',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Fields/request'              => [
            'admin/Fields/request',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Fields/response'             => [
            'admin/Fields/response',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Fields/add'                  => [
            'admin/Fields/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Fields/upload'               => [
            'admin/Fields/upload',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Fields/edit'                 => [
            'admin/Fields/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Fields/del'                  => [
            'admin/Fields/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceGroup/index'        => [
            'admin/InterfaceGroup/index',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceGroup/add'          => [
            'admin/InterfaceGroup/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceGroup/edit'         => [
            'admin/InterfaceGroup/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceGroup/del'          => [
            'admin/InterfaceGroup/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceGroup/getAll'       => [
            'admin/InterfaceGroup/getAll',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'InterfaceGroup/changeStatus' => [
            'admin/InterfaceGroup/changeStatus',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'AppGroup/index'              => [
            'admin/AppGroup/index',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'AppGroup/add'                => [
            'admin/AppGroup/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'AppGroup/edit'               => [
            'admin/AppGroup/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'AppGroup/del'                => [
            'admin/AppGroup/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'AppGroup/getAll'             => [
            'admin/AppGroup/getAll',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'AppGroup/changeStatus'       => [
            'admin/AppGroup/changeStatus',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Log/index'                   => [
            'admin/Log/index',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Log/del'                     => [
            'admin/Log/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Customer/getList'            => [
            'admin/Customer/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Customer/add'                => [
            'admin/Customer/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Customer/edit'               => [
            'admin/Customer/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Customer/del'                => [
            'admin/Customer/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'NewsType/getList'            => [
            'admin/NewsType/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'NewsType/add'                => [
            'admin/NewsType/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'NewsType/edit'               => [
            'admin/NewsType/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'NewsType/del'                => [
            'admin/NewsType/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'News/getList'                => [
            'admin/News/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'News/add'                    => [
            'admin/News/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'News/edit'                   => [
            'admin/News/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'News/del'                    => [
            'admin/News/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Advert/getList'              => [
            'admin/Advert/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Advert/add'                  => [
            'admin/Advert/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Advert/edit'                 => [
            'admin/Advert/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Advert/del'                  => [
            'admin/Advert/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Advert/getAdvertType'        => [
            'admin/Advert/getAdvertType',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'File/getList'                => [
            'admin/File/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'File/add'                    => [
            'admin/File/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'File/edit'                   => [
            'admin/File/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'File/del'                    => [
            'admin/File/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'PhoneSms/getList'            => [
            'admin/PhoneSms/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Feedback/edit'               => [
            'admin/Feedback/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Feedback/getList'            => [
            'admin/Feedback/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Feedback/del'                => [
            'admin/Feedback/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'FemaleRights/edit'           => [
            'admin/FemaleRights/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'FemaleRights/getList'        => [
            'admin/FemaleRights/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'FemaleRights/getTypeList'    => [
            'admin/FemaleRights/getTypeList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'FemaleRights/del'            => [
            'admin/FemaleRights/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'FemaleAppointment/edit'      => [
            'admin/FemaleAppointment/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'FemaleAppointment/getList'   => [
            'admin/FemaleAppointment/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'FemaleAppointment/del'       => [
            'admin/FemaleAppointment/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Activity/add'                => [
            'admin/Activity/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Activity/edit'               => [
            'admin/Activity/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Activity/getList'            => [
            'admin/Activity/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Activity/del'                => [
            'admin/Activity/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'ActivityJoin/add'            => [
            'admin/ActivityJoin/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'ActivityJoin/edit'           => [
            'admin/ActivityJoin/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'ActivityJoin/getList'        => [
            'admin/ActivityJoin/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'ActivityJoin/del'            => [
            'admin/ActivityJoin/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'JobGuide/add'                => [
            'admin/JobGuide/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'JobGuide/edit'               => [
            'admin/JobGuide/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'JobGuide/getList'            => [
            'admin/JobGuide/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'JobGuide/del'                => [
            'admin/JobGuide/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Train/add'                   => [
            'admin/Train/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Train/edit'                  => [
            'admin/Train/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'Train/getList'               => [
            'admin/Train/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Train/del'                   => [
            'admin/Train/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'TrainUser/add'               => [
            'admin/TrainUser/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'TrainUser/edit'              => [
            'admin/TrainUser/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'TrainUser/getList'           => [
            'admin/TrainUser/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'TrainUser/del'               => [
            'admin/TrainUser/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'MarryMeditation/add'         => [
            'admin/MarryMeditation/add',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'MarryMeditation/edit'        => [
            'admin/MarryMeditation/edit',
            ['method' => 'post', 'after_behavior' => $afterBehavior]
        ],
        'MarryMeditation/getList'     => [
            'admin/MarryMeditation/getList',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'MarryMeditation/del'         => [
            'admin/MarryMeditation/del',
            ['method' => 'get', 'after_behavior' => $afterBehavior]
        ],
        'Conf/index'                  => [
            'admin/Conf/index',
            ['method' => 'get']
        ],
        '__miss__'                    => ['admin/Miss/index'],
    ],
];
