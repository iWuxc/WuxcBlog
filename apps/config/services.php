<?php
/**
 * DI注册配置文件
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */
use Phalcon\Di\FactoryDefault;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Events\Event;
use Phalcon\Db\Profiler as DbProfile;
use Phalcon\Mvc\Model\Manager as ModelsManager;
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
    $config = $di -> get('config');
    $dbconfig = $config -> database -> db;
    $dbconfig = $dbconfig -> toArray();
    if(!is_array($dbconfig) || count($dbconfig) == 0){
        throw new \Exception("the databases config is error");
    }
    //注册DB操作
    $connection = new \Phalcon\Db\Adapter\Pdo\Mysql(
        [
            'host'      => $config -> database -> db -> host,
            'username'  => $config -> database -> db -> username,
            'password'  => $config -> database -> db -> password,
            'dbname'    => $config -> database -> db -> dbname,
            'charset'   => $config -> database -> db -> charset
        ]
    );
    //分析底层sql性能， 并记录日志
    $eventsManager = new EventsManager();
    $profiler = $di -> get('profiler');
    $eventsManager -> attach('db',function(Event $event, $connection) use($profiler, $config, $di){
        if($event -> getType() == 'beforeQuery'){
            //在sql发送大数据库前启动分析
            $profiler -> startProfile($connection -> getSQLStatement());
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
            $logger = \Wuxc\Apps\Core\PhalBaseLogger::getInstance();
            $logger -> write_log("{$sql} {$params} {$executeTime}", 'debug');
        }
    });
    $connection -> setEventsManager($eventsManager);
    return $connection;
});

/**
 * DI注册modelsManager服务
 */
$di -> setShared('modelsManager', function() use($di){
    return new ModelsManager();
});

/**
 * DI注册日志服务
 */
$di -> setShared('logger', function() use($di){
    $logger = \Wuxc\Apps\Core\PhalBaseLogger::getInstance();
    return $logger;
});

/**
 * DI注册缓存服务
 */
$di -> setShared('cache', function() use($config){
    return new \Phalcon\Cache\Backend\File(new \Phalcon\Cache\Frontend\Output(), array(
        'cacheDir' => $config -> application -> cache_path
    ));
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * 注入自定义验证器
 */
$di -> setShared('validator', function() use($di){
    $validator = new \Wuxc\Apps\Library\Validator($di);
    return $validator;
});