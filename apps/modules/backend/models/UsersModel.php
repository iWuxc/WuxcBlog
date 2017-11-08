<?php
/**
 * 用户数据层
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */

namespace Wuxc\Apps\Backend\Models;

use Phalcon\Mvc\Model;

class UsersModel extends Model {

    public function initialize(){
        $this -> setSource('users');
    }
}