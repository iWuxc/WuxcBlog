<?php
/**
 * 控制器基类
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.con)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
 */

namespace Wuxc\Apps\Backend\Controllers;

use Wuxc\Apps\Core\PhalBaseController;
use Wuxc\Apps\Backend\Repositories\RepositoryFactory;

class BaseController extends PhalBaseController {

    public function initialize()
    {
        parent::initialize();
        $this -> login_check();
        $this -> set_common_vars();
    }

    /**
     * 登录检测
     * @return bool
     */
    public function login_check(){
        if(!$this -> get_repository('Users') -> login_check()){
            $this -> redirect('passport/index');
        }
        return true;
    }

    /**
     * 获取业务对象
     * @param $repositoryName
     * @return mixed
     */
    protected function get_repository($repositoryName){
        return RepositoryFactory::get_repository($repositoryName);
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
     * @return null|string
     */
    protected function redirect($url = null){
        empty($url) && $url = $this -> request -> getHeader('HTTP_REFERER');
        $this -> response -> redirect($url);
    }

}