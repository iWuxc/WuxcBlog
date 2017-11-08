<?php
/**
 * 控制器基类
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */

namespace Wuxc\Apps\Backend\Controllers;

use Wuxc\Apps\Core\PhalBaseController;

class BaseController extends PhalBaseController {

    public function initialize()
    {
        parent::initialize();
        $this -> set_common_vars();
    }



    /**
     * 设置公共参数
     */
    public function set_common_vars(){
        $this -> view -> setVars([
            'title' => $this -> config -> application -> app_name,
            'userinfo' => $this -> session -> get('user'),
            'assetsVersion' => strtotime(date("Y-m-d H", time()) . ':00:00')
        ]);
    }

    /**
     * 页面跳转
     * @param null $url
     */
    protected function redirect($url = null){
        empty($url) && $url = $this -> request -> getHeader('HTTP_REFERER');
        $this -> response -> redirect($url);
    }

}