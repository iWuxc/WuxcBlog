<?php
/**
 * Phalcon控制器扩展
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.cn)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
 */

namespace Wuxc\Apps\Core;

use Phalcon\Mvc\Controller;

class PhalBaseController extends Controller{

    public function initialize(){

    }

    /**
     * ajax输出
     * @param int $code
     * @param $message
     * @param array $data
     */
    protected function ajax_return($code=1, $message, $data=array()){
        $result = array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
        $this -> response -> setJsonContent($result);
        $this -> response -> send();
    }

    /**
     * exception日志记录
     * @param \Exception $e
     */
    protected function write_exception_log(\Exception $e){
        $logArray = array(
            'file' => $e -> getFile(),
            'line' => $e -> getLine(),
            'code' => $e -> getCode(),
            'message' => $e -> getMessage(),
            'trace' => $e -> getTraceAsString(),
        );
        $this -> logger -> write_log($logArray);
    }

}