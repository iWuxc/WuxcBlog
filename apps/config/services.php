<?php
/**
 * DI注册配置文件
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Events\Event;
use Phalcon\Db\Profiler as DbProfile;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;

$di = new FactoryDefault();

/**
 * 注册配置文件
 */
$di -> setShared('config', function() use($config){
    return $config;
});

/**
 * 注册路由
 */
$di -> setShared('router', function(){
   return require APP_DIR . '/config/routes.php';
});

/**
 * 注册session服务
 */
$di -> setShared('session', function(){
    $session = new SessionAdapter();
    $session -> start();
    return $session;
});

/**
 * 注册cookies服务
 */
$di -> set('cookies', function(){
    $cookies = new \Phalcon\Http\Response\Cookies();
    $cookies -> useEncryption(false); //禁用加密
    return $cookies;
});

/**
 * 注册 profiler 服务
 */
$di -> set('profiler', function(){
    return new DbProfile();
});

/**
 * 注册DB配置
 */
$di -> setShared('db', function() use($di) {
    $config = $this -> getConfig();
    $dbconfig = $config -> database -> db;
    $dbconfig = $dbconfig -> toArray();
    if(!is_array($dbconfig) || count($dbconfig) == 0){
        throw new \Exception("the databases config is error");
    }
    //注册DB操作
    $connection = new \Phalcon\Db\Adapter\Pdo\Mysql(
        [
            'host'      => $config -> database -> host,
            'username'  => $config -> database -> username,
            'password'  => $config -> database -> password,
            'dbname'    => $config -> database -> dbname,
            'charset'   => $config -> database -> charset
        ]
    );
    //分析底层sql性能， 并记录日志
    $eventsManager = new EventsManager();
    $profiler = $di -> get('profiler');
    $eventsManager -> attach('db',function(Event $event, $connection) use($profiler, $config, $di){
        if($event -> getType() == 'beforeQuery'){
            //在sql发送大数据库前气动分析
            $profiler -> startProfle($connection -> getSQLStatement());
        }
        if($event -> getType() == 'afterQuery'){
            //在sql执行完毕后停止分析
            $profiler -> stopProfile();
            //获取分析结果
            $profiler = $profiler -> getLastProfile();
            $sql = $profiler -> getSQLStatement();
            $params = $connection -> getSqlVariables();
            (is_array($params) && count($params)) && $params = json_encode($params);
            $executeTime = $profiler -> getTotalElapsedSeconds();
            //日志记录
            $logger = \Wuxc\App\Core\PhalBaseLogger::getInstance();
            $logger -> write_log("{$sql} {$params} {$executeTime}", 'debug');
        }
    });
    $connection -> setEventsManager($eventsManager);

});
