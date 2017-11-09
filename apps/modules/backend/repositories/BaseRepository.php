<?php
/**
 * 业务仓库基类
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
 * @license GNU General Public License 2.0
 * @link www.wuxceng.cn
 */

namespace Wuxc\Apps\Backend\Repositories;

use Phalcon\Di;
use Phalcon\DiInterface;
use Wuxc\Apps\Backend\Models\ModelFactory;

class BaseRepository{

    /**
     * DI容器
     * @var
     */
    private $_di;

    public function __construct(DiInterface $di=null)
    {
        $this -> setDI($di);
    }

    /**
     * 设置DI容器
     * @param mixed $di
     */
    public function setDI(DiInterface $di=null)
    {
        empty($di) && $di = Di::getDefault();
        $this -> _di = $di;
    }

    /**
     * 获取DI容器
     * @return mixed
     */
    public function getDI()
    {
        return $this -> _di;
    }

    /**
     * 获取模型对象
     * @param $modelName
     * @return mixed
     */
    protected function get_model($modelName){
        return ModelFactory::get_model($modelName);
    }
}