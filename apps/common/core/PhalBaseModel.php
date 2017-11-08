<?php
/**
 * Phalcon模型扩展
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */

namespace Wuxc\Apps\Core;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\ModelInterface;

class PhalBaseModel extends Model implements ModelInterface{

    /**
     * 数据库链接对象
     * @var
     */
    protected $db;

    public function initialize(){
        $this -> db = $this -> getDI() -> get('db');

        /** 不对空字段进行validation校验 */
        self::setup(array(
            'notNullValidations' => false,
        ));
    }

    /**
     * 设置表(补上表前缀)
     * @param $tableName
     */
    protected function set_table_source($tableName){
        $prefix = $this -> getDI() -> get('config') -> database -> prefix;
        $this -> setSource($prefix . $tableName);
    }

    public function iupdate(array $data=null, $whiteList=null){
        if(count($data) > 0){
            $attributes = $this -> getModelsMetaData() -> getAttributes($this);

        }
    }
}