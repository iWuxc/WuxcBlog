<?php
/**
 * 用户业务仓库
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.con)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
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

    /**
     * 更改个人信息配置
     * @param array $data
     * @param $uid
     * @return bool
     * @throws \Exception
     */
    public function update(array $data, $uid){
        $uid = intval($uid);
        if($uid <= 0){
            throw new \Exception('非法操作');
        }
        /** @var 教研旧密码是否正确 */
        $user = $this -> detail($this -> getDI() -> get('session') -> get('user')['username']);
        if(!$user){
            throw new \Exception("密码错误");
        }
        $userinfo = $user -> toArray();
        if(!$this -> getDI() -> get('security') -> checkHash($data['oldpwd'], $userinfo['password'])){
            throw new \Exception('密码错误, 请重新输入');
        }
        /** 重新整理数据 */
        $udata = array(
            'realname' => $data['realname'],
            'username' => $data['username'],
            'phone_number' => $data['phone'],
        );
        /** 检测是否更新密码 */
        if(!empty($data['newpwd'])){
            $password = $this -> getDI() -> get('security') -> hash($data['newpwd']);
            $udata['password'] = $password;
        }
        $affectedRows = $this -> get_model('UsersModel') -> update_recond($udata, $uid);
        if(!$affectedRows){
            throw new \Exception('修改个人信息失败,请重新尝试更改!');
        }
        /** 修改成功之后刷新用户数据 */
        /**
         * 待开发中,马上解决的问题
         */
        return true;
    }
}

