<?php
/**
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */
error_reporting(E_ALL);

try {
    /**
     * 定义全局根路径
     */
    define('BASE_DIR', dirname(__DIR__));
    define('APP_DIR', BASE_DIR . '/apps');

    /**
     * 加载配置文件
     */
    $config = include APP_DIR . '/config/config.php';

    /**
     * Include Auto-loader
     */
    include APP_DIR . '/config/loader.php';

    /**
     * Include general services
     */
    require APP_DIR . '/config/services.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    /**
     * Register application modules
     */
    $application->registerModules([
        'frontend' => [
            'className' => 'Wuxc\\Apps\\Frontend\\FrontendModule',
            'path'      =>  APP_DIR . '/modules/frontend/FrontendModule.php'
        ],
        'backend' => [
            'className' => 'Wuxc\\Apps\\Backend\\BackendModule',
            'path'      =>  APP_DIR . '/modules/backend/BackendModule.php'
        ],
    ]);

    echo $application->handle()->getContent();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}

