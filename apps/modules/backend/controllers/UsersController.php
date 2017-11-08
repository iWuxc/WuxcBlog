<?php
/**
 * 用户控制器
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */

namespace Wuxc\Apps\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Wuxc\Apps\Backend\Models\UsersModel as Users;

class UsersController extends Controller{

    public function indexAction(){
        $user = Users::find();
        var_dump($user);
        return false;
        $metadata = $user -> getModelsMetaData();
        $attributes = $metadata -> getAttributes($user);
        var_dump($attributes);
    }

}