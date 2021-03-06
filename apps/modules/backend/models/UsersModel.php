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

    /**
     * 自定义的update事件
     * @param array $data
     * @return array
     */
    protected function before_update(array $data){
        if(empty($data['modify_time'])){
            $data['modify_time'] = date('Y-m-d H:i:s');
        }
        return $data;
    }

    /**
     * 更新个人数据
     * @param array $data
     * @param $uid
     * @return mixed
     * @throws \Exception
     */
    public function update_recond(array $data, $uid){
        $uid = intval($uid);
        if(count($data) == 0 || $uid <= 0){
            throw new \Exception('参数错误');
        }
        $data = $this -> before_update($data);
        $this -> uid = $uid; //关键: 没有此参数(主键),无法进行修改
        $result = $this -> iupdate($data);
        if(!$result){
            throw new \Exception('更新失败');
        }
        $affectedRows = $this -> db -> affectedRows();
        return $affectedRows;
    }
}