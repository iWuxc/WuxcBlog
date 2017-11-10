<?php
/**
 * 首页
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
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

    public function testAction(){
        $this -> validator -> add_rule('username', 'required', '请输入用户名')
            -> add_rule('username', 'alpha_dash', '用户名由4-20个英文字符、数字、下划线和横杠组成')
            -> add_rule('username', 'min_length', '用户名由4-20个英文字符、数字、下划线和横杠组成', 4)
            -> add_rule('username', 'max_length', '用户名由4-20个英文字符、数字、下划线和横杠组成', 20);
        $this -> validator -> add_rule('password', 'required', '请输入密码')
            -> add_rule('password', 'min_length', '密码由6-32个字符组成', 6)
            -> add_rule('password', 'max_length', '密码由6-32个字符组成', 32);
        $username = 'asadsea';
        $password = 'wxcamjingasdddddddddddddddddddddddddddddddd';
        $a = $this -> validator -> run(array('username'=>$username, 'password'=>$password));
        var_dump($a);
        return false;
    }

}