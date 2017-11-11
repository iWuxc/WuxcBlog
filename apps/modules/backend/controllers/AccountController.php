<?php
/**
 *
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.con)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
 */

namespace Wuxc\Apps\Backend\Controllers;

class AccountController extends BaseController{

    public function initialize()
    {
        parent::initialize();
    }

    public function saveprofileAction(){
        try{
            if($this -> request -> isAjax() || $this -> request -> isPost()){
                throw new \Exception('非法请求');
            }
            $realname = $this -> request -> getPost('realname', 'trim');
            $username = $this -> request -> getPost('username', 'trim');
            $phone = $this -> request -> getPost('phone_number', 'trim');
            $oldpwd = $this -> request -> getPost('old_password', 'trim');
            $newpwd = $this -> request -> getPost('password', 'trim');
            $confirmpwd = $this -> request -> getPost('new_password', 'trim');
            empty($username) && $username = $this ->session -> get('user')['username'];
            //判断是否修改密码
            /** 添加验证规则 */

        }catch(\Exception $e){
            $this -> write_exception_log($e);
            $this -> flashSession -> error($e -> getMessage());
        }
        //return $this -> redirect('dashboard/index');
    }
}