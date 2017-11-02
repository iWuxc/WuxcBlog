<?php
/**
 * 注册命名空间文件
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */
$loader = new \Phalcon\Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Wuxc\\Apps\\Plugins'  => APP_DIR . '/common/plugins/',
    'Wuxc\\Apps\\Library'  => APP_DIR . '/common/library/',
    'Wuxc\\Apps\\Core'     => APP_DIR . '/common/core/',
    'Wuxc\\Apps\\Helpers'  => APP_DIR . '/common/helper/',

    'Wuxc\\Apps\\Frontend\\Controllers'     =>  APP_DIR . '/modules/frontend/controllers',
    'Wuxc\\Apps\\Frontend\\Models'          =>  APP_DIR . '/modules/frontend/models',
    'Wuxc\\Apps\\Frontend\\Repositories'    =>  APP_DIR . '/modules/frontend/repositories',

    'Wuxc\\Apps\\Backend\\Controllers'      =>  APP_DIR . '/modules/backend/controllers',
    'Wuxc\\Apps\\Backend\\Models'           =>  APP_DIR . '/modules/backend/models',
    'Wuxc\\Apps\\Backend\\Repositories'     =>  APP_DIR . '/modules/backend/repositories',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'Wuxc\\Apps\\Frontend\\FrontendModule'  => APP_DIR . '/modules/frontend/FrontendModule.php',
    'Wuxc\\Apps\\Backend\\BackendModule'    => APP_DIR . '/modules/backend/BackendModule.php',
]);

$loader->register();