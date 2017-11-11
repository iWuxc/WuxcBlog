<?php
/**
 * 模型工厂
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.cn)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
 */

namespace Wuxc\Apps\Backend\Models;

class ModelFactory{

    /**
     * 模型对象容器
     * @var array
     */
    private static $_models = array();

    public static function get_model($modelName){
        $modelName = __NAMESPACE__ . "\\" . ucfirst($modelName);
        if(!class_exists($modelName)){
            throw new \Exception("{$modelName}类存在");
        }
        if(!isset(self::$_models[$modelName]) || empty(self::$_models[$modelName])){
            self::$_models[$modelName] = new $modelName();
        }
        return self::$_models[$modelName];
    }
}