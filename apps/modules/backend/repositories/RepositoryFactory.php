<?php
/**
 * 业务仓库工厂
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.con)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
 */
namespace Wuxc\Apps\Backend\Repositories;

use Phalcon\Exception;

class RepositoryFactory{

    /**
     * 仓库对象容器
     * @var array
     */
    private static $_repositories = array();

    public static function get_repository($repositoryName){
        $repositoryName = __NAMESPACE__ . "\\" . ucfirst($repositoryName);
        if(!class_exists($repositoryName)){
            throw new \Exception("{$repositoryName}类不存在");
        }
        if(!isset(self::$_repositories[$repositoryName]) || empty(self::$_repositories[$repositoryName])){
            self::$_repositories[$repositoryName] = new $repositoryName();
        }
        return self::$_repositories[$repositoryName];
    }
}