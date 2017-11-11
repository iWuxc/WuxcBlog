<?php
/**
 * 后台程序入口
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.cn)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
 */

namespace Wuxc\Apps\Backend;

use Wuxc\Apps\Core\PhalBaseVolt as VoltEngine;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\ModuleDefinitionInterface;

class BackendModule implements ModuleDefinitionInterface{

    public function registerAutoloaders(DiInterface $di = null)
    {
        // TODO: Implement registerAutoloaders() method.
    }

    public function registerServices(DiInterface $di)
    {
        /** DI注册dispatcher服务 */
        $this -> registerDispatcherService($di);
        /** DI注册url服务 */
        $this -> registerUrlService($di);
        /** DI注册View服务 */
        $this -> registerViewService($di);
    }

    /**
     * 注册dispatcher服务
     * @param DiInterface $di
     */
    protected function registerDispatcherService(DiInterface $di){
        $config = $di -> get('config');
        $di -> set('dispatcher', function() use($config){
            $eventsManager = new EventsManager();
            $eventsManager -> attach('dispatcher:beforeException', function($event, $dispatcher, $exception){
                if($event -> getType() == 'beforeException') {
                    switch($exception -> getCode()) {
                        case \Phalcon\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                            $dispatcher -> forward(array(
                                'controller' => 'Index',
                                'action'    => 'notfound'
                            ));
                            return false;
                        case \Phalcon\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                            $dispatcher -> forward(array(
                                'controller' => 'Index',
                                'action'    => 'notfound'
                            ));
                            return false;
                    }
                }
            });
            $dispatcher = new Dispatcher();
            $dispatcher -> setEventsManager($eventsManager);
            //默认设置为后台的调度器
            $dispatcher -> setDefaultNamespace($config -> application -> root_namespace . '\\Apps\\Backend\\Controllers');
            return $dispatcher;
        }, true);
    }

    /**
     * 注册url服务
     * @param DiInterface $di
     */
    protected function registerUrlService(DiInterface $di){
        $config = $di -> get('config');
        $di -> setShared('url', function() use($config){
            $url = new Url();
            $url -> setBaseUri($config -> application -> backend -> module_pathinfo);
            $url -> setStaticBaseUri($config -> application -> backend -> static_url);
            return $url;
        });
    }

    /**
     * 注册视图服务
     * @param DiInterface $di
     */
    protected function registerViewService(DiInterface $di){
        $config = $di -> get('config');
        $di -> setShared('view', function() use($config){
            $view = new View();
            $view -> setViewsDir($config -> application -> backend -> views);
            $view -> registerEngines(array(
                '.volt' => function($view, $di) use($config){
                    $volt = new VoltEngine($view, $di);
                    $volt -> setOptions(array(
                        'compileAlways' => $config -> application -> backend -> is_compiled,
                        'compiledPath'  => $config -> application -> backend -> compiled_path,
                        'compiledSeparator' => '_'
                    ));
                    $volt -> initFunction();
                    return $volt;
                }
            ));
            return $view;
        });
    }
}