<?php
/**
 * 用户业务仓库
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */

namespace Wuxc\Apps\Backend\Repositories;

use Phalcon\DiInterface;

class Users extends BaseRepository{

    public function __construct(DiInterface $di = null)
    {
        parent::__construct($di);
    }

    /**
     * 检测是否已经登录
     * @return bool
     */
    public function login_check(){
        if($this -> getDI() -> get('session') -> has('user')){
            if(!empty($this -> getDI() -> get('session') -> get('user')['uid'])){
                return true;
            }
        }
        return false;
    }

    public function login($username, $password){
        /** 获取用户信息 */
        $user = $this -> detail($username);
        if(!$user){
            throw new \Exception('用户名或密码错误');
        }
        $userinfo = $user -> toArray();
        /** 校验密码 */
        if(!$this -> getDI() -> get('security') -> checkHash($password, $userinfo['password'])){
            throw new \Exception('用户名或者密码错误,请重新输入');
        }
        /** 设置session */
        unset($userinfo['password']);
        $this -> getDI() -> get('session') -> set('user', $userinfo);
    }

    /**
     * 获取用户数据
     * @param $username
     * @param array $ext
     * @return mixed
     * @throws \Exception
     */
    public function detail($username, array $ext=array()){
        $user = $this -> get_model('UsersModel') -> detail($username, $ext);
        if(!$user -> uid){
            throw new \Exception('获取用户信息失败');
        }
        return $user;
    }
}

