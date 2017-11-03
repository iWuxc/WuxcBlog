<?php
/**
 * 路由配置文件
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */
$router = new \Phalcon\Mvc\Router();

//设置默认模块
$router -> setDefaultModule('frontend');

//配置路由
$router -> add('/admin/:controller/:action/:params', [
    'namespace' => '\\Wuxc\\Apps\\Backend\\Controllers',
    'module' => 'backend',
    'controller' => 1,
    'action' => 2,
]);