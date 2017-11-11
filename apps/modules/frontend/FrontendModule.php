<?php

/**
 * 前台程序入口
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.cn)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
 */


namespace Wuxc\Apps\Frontend;

use Phalcon\Mvc\View;
use Phalcon\Mvc\Url;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;
use \Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;

class FrontendModule implements ModuleDefinitionInterface{

    public function registerAutoloaders(DiInterface $di=null){

    }

    /**
     * DI注册相关服务
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di){
        /** DI注册dispatcher服务 */
        $this -> registerDispatcherService($di);
        /**DI注册url服务*/
        $this -> registerUrlService($di);
        /**DI注册前台view*/
        $this -> registerViewService($di);
    }

    /**
     * DI注册dispatcher服务
     * @param DiInterface $di
     */
    protected function registerDispatcherService(DiInterface $di){
        $config = $di -> get('config');
        $di->set('dispatcher', function() use ($config) {
            $eventsManager = new EventsManager();
            $eventsManager->attach("dispatch:beforeException", function($event, $dispatcher, $exception) {
                if ($event->getType() == 'beforeException') {
                    switch ($exception->getCode()) {
                        case \Phalcon\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                            $dispatcher->forward(array(
                                'controller' => 'Index',
                                'action' => 'notfound'
                            ));
                            return false;
                        case \Phalcon\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                            $dispatcher->forward(array(
                                'controller' => 'Index',
                                'action' => 'notfound'
                            ));
                            return false;
                    }
                }
            });
            $dispatcher = new Dispatcher();
            $dispatcher->setEventsManager($eventsManager);
            //默认设置为前台的调度器
            $dispatcher->setDefaultNamespace($config -> application -> root_namespace . '\\Apps\\Frontend\\Controllers');
            return $dispatcher;
        }, true);
    }

    /**
     * DI注册url服务
     * @param DiInterface $di
     */
    protected function registerUrlService(DiInterface $di){
        $config = $di -> get('config');
        $di -> setShared('url', function() use($config) {
            $url = new Url();
            $url -> setBaseUri($config -> application -> frontend -> module_pathinfo);
            $url -> setStaticBaseUri($config -> application -> frontend -> static_url);
            return $url;
        });
    }

    /**
     * DI注册view服务
     * @param DiInterface $di
     */
    protected function registerViewService(DiInterface $di){
        $config = $di -> get('config');
        $di -> setShared('view', function() use($config) {
            $view = new View();
            $view -> setViewsDir($config -> application -> frontend -> views);
            $view -> registerEngines(array(
                '.volt' => function($view, $di) use($config) {
                    $volt = new VoltEngine($view, $di);
                    $volt -> setOptions(array(
                        'compileAlways' => $config -> application -> frontend -> is_compiled,
                        'compiledPath'  => $config -> application -> frontend -> compiled_path,
                        'compiledSeparator' => '_'
                    ));
                    return $volt;
                },
            ));
            return $view;
        });
    }
}
