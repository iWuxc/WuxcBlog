<?php
/**
 * model基类
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.con)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
 */

namespace Wuxc\Apps\Backend\Models;

use Wuxc\Apps\Core\PhalBaseModel;

class BaseModel extends PhalBaseModel{

    /** 用户session */
    protected $_user;

    public function initialize()
    {
        parent::initialize();
        $this -> _user = $this -> getDI() -> get('session') -> get('user');
    }
}