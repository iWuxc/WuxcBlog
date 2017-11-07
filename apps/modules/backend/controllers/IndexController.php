<?php
/**
 * 首页
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */

namespace Wuxc\Apps\Backend\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends Controller {

    /**
     * 控制面板
     */
    public function indexAction(){
        $this -> view -> pick('index/index');
    }

    /**
     * 404页面
     */
    public function notfoundAction(){
        return $this -> response -> setHeader('status', '404 Not Found');
    }

    public function testAction(){

    }

}