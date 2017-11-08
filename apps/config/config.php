<?php
/**
 * 系统配置文件
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */
return new \Phalcon\Config(
    [

        'database' => [
            'host'     => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'blog',
            'charset'  => 'utf8',
            'prefix'   => '',
        ],

        'application' => [
            //项目名称
            'app_name'  =>  'WuxcBlog后台管理系统',
            //版本号
            'version'   =>  '1.0',
            //根命名空间
            'root_namespace'    =>  'Wuxc',
            //前台配置
            'frontend'  =>  [
                //模块在URL中的pathinfo路径名
                'module_pathinfo'   =>  '/',
                //控制器路径
                'backend'   =>  APP_DIR . '/modules/frontend/controllers/',
                //视图路径
                'views' =>  APP_DIR . '/modules/frontend/views/',
                //是否实时编译模板
                'is_compiled'   =>  true,
                //编译模板路径
                'compiled_path' =>  APP_DIR . '/cache/volt/frontend/',
                //后台静态资源
                'static_url'    =>  '/statics/home/'
            ],
            //后台配置
            'backend'   =>  [
                //模块在URL中的pathinfo路径名
                'module_pathinfo'   =>  '/admin/',
                //控制器路径
                'backend'   =>  APP_DIR . '/modules/backend/controllers/',
                //视图路径
                'views' =>  APP_DIR . '/modules/backend/views/',
                //是否实时编译模板
                'is_compiled'   =>  false,
                //编译模板路径
                'compiled_path' =>  APP_DIR . '/cache/volt/backend/',
                //后台静态资源
                'static_url'    =>  '/statics/admin/'
            ],

            'cache_path' => APP_DIR . '/cache/data/', //数据缓存路径
        ],

        'logger' => [
            'enabled' => true,
            'debug' => true,
            'path'  => APP_DIR . '/cache/logs/', //日志路径
            'format' => '[%date%][%type%] %message%',
        ],
]);
