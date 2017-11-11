<?php
/**
 * 首页
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.con)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
 */

namespace Wuxc\Apps\Backend\Controllers;

class IndexController extends BaseController {
    /**
     * 控制面板
     */
    public function indexAction(){
        return $this -> redirect('dashboard/index');
    }

    /**
     * 404页面
     */
    public function notfoundAction(){
        return $this -> response -> setHeader('status', '404 Not Found');
    }

    /**
     * 测试页面
     * @return bool
     */
    public function testAction(){

    }
}