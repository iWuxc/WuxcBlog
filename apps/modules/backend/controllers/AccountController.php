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
            if($this -> request -> isAjax() || !$this -> request -> isPost()){
                throw new \Exception('非法请求');
            }
            $realname = $this -> request -> getPost('realname', 'trim');
            $username = $this -> request -> getPost('username', 'trim');
            $phone = $this -> request -> getPost('phone_number', 'trim');
            $oldpwd = $this -> request -> getPost('old_password', 'trim');
            $newpwd = $this -> request -> getPost('password', 'trim');
            $confirmpwd = $this -> request -> getPost('new_password', 'trim');
            empty($username) && $username = $this ->session -> get('user')['username'];
            /** 添加验证规则 */
            $this -> validator -> add_rule('realname', 'required', '请填写真实姓名')
                -> add_rule('username', 'chinese_alpha_numeric_dash', '昵称由2-20个中英文字符、数字、中下划线组成')
                -> add_rule('username', 'min_length', '呢称由2-20个中英文字符、数字、中下划线组成', 2)
                -> add_rule('username', 'max_length', '昵称由2-20个中英文字符、数字、中下划线组成', 20);
            $this -> validator -> add_rule('phone', 'required', '请填写联系方式');
            $this -> validator -> add_rule('oldpwd', 'required', '请填写当前密码')
                -> add_rule('oldpwd', 'min_length', '密码由6-20个字符组成', 6)
                -> add_rule('oldpwd', 'max_length', '密码由6-20个字符组成', 20);
            /** 是否修改密码 */
            if(!empty($newpwd)){
                $this -> validator -> add_rule('oldpwd', 'not_equals', '新密码不能与旧密码相同', $newpwd)
                    -> add_rule('newpwd', 'min_length', '密码由6-20个字符组成', 6)
                    -> add_rule('newpwd', 'max_length', '密码由6-20个字符组成', 20)
                    -> add_rule('newpwd', 'equals', '两次密码输入不一致', $confirmpwd);
            }
            /** 截获验证异常 */
            $error = $this -> validator -> run(array(
                'realname' => $realname,
                'username' => $username,
                'phone' => $phone,
                'oldpwd' => $oldpwd,
                'newpwd' => $newpwd,
            ));
            if(!empty($error)){
                $error = array_values($error);
                $error = $error[0];
                throw new \Exception($error['message'], $error['code']);
            }
            /** 变更个人配置 */
            $data = [
                'realname' => $realname,
                'username' => $username,
                'phone' => $phone,
                'oldpwd' => $oldpwd,
                'newpwd' => $newpwd,
            ];
            $this -> get_repository('Users') -> update($data, $this -> session -> get('user')['uid']);
            $this -> flashSession -> success('更新成功');
        }catch(\Exception $e){
            $this -> write_exception_log($e);
            $this -> flashSession -> error($e -> getMessage());
        }
        return $this -> redirect('dashboard/index');
    }
}