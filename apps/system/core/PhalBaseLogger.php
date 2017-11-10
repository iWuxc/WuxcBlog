<?php
/**
 * Phalcon 日志扩展
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */
namespace Wuxc\Apps\Core;

use \Phalcon\DI;
use \Phalcon\Logger\Adapter\File as LoggerAdapter;

class PhalBaseLogger{

    private static $_instance;

    private static $_logger;

    /**
     * 禁止克隆
     */
    public function __clone(){
        trigger_error('Clone is not allow!'. E_USER_ERROR);
    }

    /**
     * 获取单例logs的实例
     * @param null $file
     * @return PhalBaseLogger
     */
    public static function getInstance($file = null){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self($file);
        }
        return self::$_instance;
    }

    public function __construct($file = null){
        if(!empty($file)){
            $logFile = $file;
        }else{
            $fileName = date('YmdH', time());
            $systemConfig = Di::getDefault() -> get('config');
            $logPath = $systemConfig -> logger -> path;
            $logFile = "{$logPath}/{$fileName}.log";
        }
        $logger = new LoggerAdapter($logFile);
        self::$_logger = $logger;
    }

    /**
     * 记录日志
     * @param $log
     * @param string $level 日志等级
     * @link https://docs.phalconphp.com/zh/latest/reference/logging.html
     */
    public function write_log($log, $level=''){
        if(is_array($log)){
            $log = json_encode($log);
        }
        empty($level) && $level = 'error';
        $level = strtolower($level);
        self::$_logger -> $level($log);
    }
}