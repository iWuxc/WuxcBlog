<?php
/**
 * 用户数据层
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.con)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
 */

namespace Wuxc\Apps\Backend\Models;


class UsersModel extends BaseModel {

    const TABLE_NAME = 'users';

    public function initialize(){
        parent::initialize();
        $this -> set_table_source(self::TABLE_NAME);
    }

    /**
     * 获取用户信息
     * @param $username
     * @param array $ext
     * @return \Phalcon\Mvc\Model
     * @throws \Exception
     */
    public function detail($username, array $ext=array()){
        if(empty($username)){
            throw new \Exception('参数错误');
        }
        $params = array(
            'conditions' => 'username = :username:',
            'bind' => array(
                'username' => $username,
            ),
        );

        if(isset($ext['columns']) && !empty(ext['columns'])){
            $params['columns'] = $ext['columns'];
        }
        $result = $this -> findFirst($params);
        if(!$result){
            throw new \Exception('获取用户信息失败');
        }
        return $result;
    }
}